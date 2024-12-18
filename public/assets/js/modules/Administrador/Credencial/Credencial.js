$(function () {
    var personaTabla = $('#tabla-credencial').DataTable({
        processing: true,
        deferRender: true,
        serverSide: true,
        responsive: true, autoWidth: false,
        order: [[0, 'asc']],
        ajax: {
            url: urlIndexPersona,
            data: function (d) {
                d.externo = '1';
            }
        },
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false, visible: false},
            {data: 'Unidad', name: 'ua.Unidad', title: 'Unidad'},
            {data: 'Persona', name: 'p.Persona', title: 'Nombre Completo'},
            {data: 'TipoContrato', name: 'tc.TipoContrato', title: 'Tipo de Contrato'},
            {data: 'Rol', name: 'r.Rol', title: 'Rol'},
            {data: 'email', name: 'p.email', title: 'Email'},
            {data: 'CI', name: 'p.CI', title: 'Carnet'},
            {
                data: 'Activo',
                name: 'p.Activo',
                title: 'Activo',
                render: function (data, type, row) {
                    if (!row.Activo) {
                        return '<b style="color: red"><i class="fa fa-ban text-danger"></i> Inactivo</b>';
                    } else {
                        return '<b style="color: green"><i class="fa fa-check text-success"></i> Activo</b>';
                    }
                }
            },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showPersona(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
    });

    // $('#tabla-credencial tbody').on('click', 'tr', function () {
    //     var data = personaTabla.row(this).data();
    //     vm.$options.methods.showPersona(data.id);
    // });
});

var vm = new Vue({
    el: '#credencial-app',
    data: {
        //accounting: accounting,
        // moment: moment,
        auth: auth,
        errorBag: {},
        isLoading: false,
        isLoadingFile: false,
        persona: {},
        datosLab: {},
        datosRef: {},
        unidades: {},
        roles: {},
        isEditing: false,
        password: {},
        tipoDocumentos: {},
        estadoCivils: {},
        generarCorreo: false,
        parentescos: {},
        escalasSalarial: {},
        cargos: {},
        tiposContrato: {},
    },
    methods: {
        loadFile(input) {
            vm.isLoadingFile = true;
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                var data = new FormData();
                data.append('File', input.files[0]);
                // pasamos la variable vm.persona para poder recuperar el CI y guardar en carpetas la informacion de cada persona
                data.append('ci', JSON.stringify(vm.persona));
                axios.post(urlUploadFile, data)
                    .then(result => {
                        if (result.data.success) {
                            // toastr.info(result.data.msg, 'Correcto!');
                            vm.persona.Foto = result.data.data;
                        } else {
                            toastr.error(result.data.msg, 'Oops!');
                        }
                        vm.isLoadingFile = false;
                    })
                    .catch(error => {
                        toastr.error('Error subiendo archivo', 'Oops!');
                        vm.isLoadingFile = false;
                    });
            }
        },
        getUnidades() {
            axios.get(urlListUnidad)
                .then(result => {
                    response = result.data;
                    vm.unidades = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getTipoDocumento() {

            axios.get(urlListTipoDocumento)
                .then(result => {
                    vm.tipoDocumentos = result.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getEstadoCivil() {

            axios.get(urlListEstadoCivil)
                .then(result => {
                    vm.estadoCivils = result.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getRoles() {
            axios.get(urlListRol)
                .then(result => {
                    response = result.data;
                    vm.roles = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        getTiposContrato() {
            axios.get(urlLisTipoContrato)
                .then(result => {
                    response = result.data;
                    vm.tiposContrato = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getParentezcos() {
            axios.get(urlListTipoParentezco)
                .then(result => {
                    response = result.data;
                    vm.parentescos = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        getEscalas() {

            axios.get(urlListEscalaSalarial)
                .then(result => {
                    vm.escalasSalarial = result.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        getCargos() {
            axios.get(urlListCargo)
                .then(result => {
                    vm.cargos = result.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        newPersona() {
            vm.persona = {};
            vm.datosLab = {};
            $('#frm-persona').modal('show');
        },
        AbiriModalRef() {
            vm.datosRef = {};
            // vm.datosLab = {};
            $('#frm-refPer').modal('show');
        },
        saveRef() {

            vm.datosRef.idPersona = vm.persona.id;
            axios.post(urlSaveRef, vm.datosRef)
                .then(result => {
                    response = result.data;
                    vm.datosRef = response.data;
                    toastr.success(response.msg, 'Correcto!');
                    $('#frm-refPer').modal('hide');
                    var refTabla = $('#ref-table').DataTable();
                    refTabla.draw();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.data.errors;
                });
        },
        showRef(id) {
            axios.get(urlShowRef, {params: {id: id}})
                .then(result => {
                    response = result.data;
                    vm.datosRef = response.data;

                    $('#frm-refPer').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showPersona(id) {
            //VARIABLE PARA HABILITAR EL BOTON GENERAR CORREO
            this.generarCorreo = false;
            axios.get(urlShowPersona, {params: {id: id}})
                .then(response => {
                    vm.persona = response.data.data;
                    if (response.data.lab == null) {
                        console.log("if");
                    } else {
                        vm.datosLab = response.data.lab;
                    }

                    $('#frmverpersona').modal('show');
                    var refTabla = $('#ref-table').DataTable();
                    refTabla.draw();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        saveCorreoInst() {
            axios
                .post(urlSavePersona, vm.persona)
                .then(result => {
                    response = result.data;
                    vm.persona = response.data;
                    swal("Exito!", "Se guardo el correo institucional", "success");
                })
                .catch(error => {
                    console.log(error);
                    swal("Ocurrio un error!", "...", "error");
                });
        },
        editPersona() {
            $('#frmverpersona').modal('hide');
            $('#frmpersona').modal('show');
        },
        savePersona() {
            vm.persona.idTipoContrato = 0;
            axios.post(urlSavePersona, vm.persona)
                .then(result => {
                    response = result.data;
                    vm.persona = response.data;

                    vm.datosLab.idPersona = vm.persona.id;
                    $('#frmpersona').modal('hide');
                    $('#frmverpersona').modal('show');
                    var personaTabla = $('#c-persona-table').DataTable();
                    personaTabla.draw();
                    /* axios.post(urlSaveDatosLaborales, vm.datosLab)
                         .then(result => {
                             response = result.data;
                             vm.datosLab = response.data;
                             toastr.success(response.msg, 'Correcto!');
                             $('#frm-persona').modal('hide');
                             $('#view-persona').modal('show');
                             var personaTabla = $('#c-persona-table').DataTable();
                             personaTabla.draw();
                         })
                         .catch(error => {
                             console.log(error);
                             toastr.error('Error al guardar el registro', 'Oops!');
                             vm.errorBag = error.data.errors;
                         });*/


                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.data.errors;
                });
        },
        imprimeCredencialA(tipo) {

            axios.get(urlPrintPersonaA, {params: {id: vm.persona.id, TipoCredencial: 'T', Lado: tipo}})
                .then(result => {
                    window.open(result.data.data.url, '_blank');
                })
                .catch(error => {
                    toastr.error('Ha ocurrido un error al generar la credencial', 'Oops!');
                    console.log(error);
                })
        },
    },
    mounted() {
        this.getUnidades();
        this.getRoles();
        this.getTipoDocumento();
        this.getEstadoCivil();
        this.getParentezcos();
        this.getEscalas();
        this.getCargos();
        this.getTiposContrato();
    }
});

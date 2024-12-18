$(function () {
    var personaTabla = $('#tabla-persona').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: urlIndexPersona,
            data: function (d) {
                d.reparticion = parseInt($('#reparticion').val(), 0);
            }
        },
        deferRender: true,
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false, visible: false},

            {data: 'idUnidad', name: 'ua.id', orderable: false, visible: false},
            {data: 'Unidad', name: 'ua.Unidad', title: 'Unidad'},
            {data: 'Persona', name: 'p.Persona', title: 'Nombre Completo'},
            {data: 'idTipoContrato', name: 'tc.id', orderable: false, visible: false},
            {data: 'TipoContrato', name: 'tc.TipoContrato', title: 'Tipo de Contrato'},
            {data: 'idRol', name: 'r.id', orderable: false, visible: false},
            {data: 'email', name: 'p.email', title: 'Email'},
            {data: 'CI', name: 'p.CI', title: 'Carnet'},
            {data: 'Reparticion', name: 'rr.Reparticion', title: 'Reparticion'},
            {data: 'Cargo', name: 'c.Cargo', title: 'Cargo'},
            {data: 'FechaConclusion', name: 'dl.FechaConclusion', title: 'Contrato',
                render: function (data, type, row) {
                    if (row.FechaConclusion < moment().format('YYYY-MM-DD') || row.FechaConclusion == null) {
                        return '<b style="color: red"><i class="fa fa-ban text-danger"></i> Concluido</b>';
                    } else {
                        return '<b style="color: green"><i class="fa fa-check text-success"></i> Vigente</b>';
                    }
                }
                },
            {data: 'Celular', name: 'p.Celular', title: 'Celular'},
            {
                data: 'Activo', name: 'p.Activo', title: 'Usuario',
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
                    return `<a onclick="vm.$options.methods.showPersona(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles(${row.id})</a>`;
                }
            },
        ],
        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
        // dom: 'T<"clear">lBfrtip',
        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "Todo"]]
    });

    // $('#tabla-persona tbody').on('click', 'tr', function () {
    //     var data = personaTabla.row(this).data();
    //     vm.$options.methods.showPersona(data.id);
    // });

    $('#unidadAcademica').on('change', function () {
        var nro = parseInt($('#unidadAcademica').val(), 0);
        if (nro > 0)
            personaTabla.columns(2).search(nro).draw();
        else
            personaTabla.search('').columns(2).search('').draw();
        personaTabla.draw();
    });

    $('#tipoContrato').on('change', function () {
        var nro = parseInt($('#tipoContrato').val(), 0);
        if (nro > 0)
            personaTabla.columns(5).search(nro).draw();
        else
            personaTabla.search('').columns(5).search('').draw();
        personaTabla.draw();
    });

    $('#rol').on('change', function () {
        var nro = parseInt($('#rol').val(), 0);
        if (nro > 0)
            personaTabla.columns(7).search(nro).draw();
        else
            personaTabla.search('').columns(7).search('').draw();
        personaTabla.draw();
    });
    /*$('#reparticion').on('change', function(){
        var nro = parseInt( $('#reparticion').val(), 0 );
        if(nro > 0)
        personaTabla.columns(11).search(nro).draw();
        else
        personaTabla.search( '' ).columns(11).search( '' ).draw();
        personaTabla.draw();
    });*/
    $('#reparticion').on('change', function () {
        personaTabla.draw();
    });
    // $('#reparticion').keyup(function(){
    //     personaTabla.draw();
    // });
    $('#estado').on('change', function () {
        var nro = $('#estado').val();
        if (nro != parseInt($('#estado').val(), 0))
            personaTabla.columns(15).search(nro).draw();
        else
            personaTabla.search('').columns(15).search('').draw();
        personaTabla.draw();
    });
});

//Para la tabla de referencias
$(function () {
    var refTabla = $('#ref-table').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexReferenciaPersonal,
            data: function (d) {
                d.id = vm.persona.id;
            }

        },
        deferRender: true,
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false, visible: false},
            {data: 'Nombre', name: 'Nombre', title: 'Nombre'},
            {data: 'TipoParentesco', name: 'TipoParentesco', title: 'Parentesco'},
            {data: 'Telefono', name: 'Telefono', title: 'Telefono'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        language: {"url": "/lang/datatables.es.json"},
        dom: 'lftip',
    });

    $('#ref-table tbody').on('click', 'tr', function () {
        var data = refTabla.row(this).data();
        vm.$options.methods.showRef(data.id);
    });
});

//Para la tabla de salud
$(function () {
    var saludTabla = $('#salud-table').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexSalud,
            data: function (d) {
                d.id = vm.persona.id;
            }

        },
        deferRender: true,
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false, visible: false},
            {data: 'Motivo', name: 'Motivo', title: 'Motivo'},
            {data: 'Lugar', name: 'Lugar', title: 'Lugar'},
            {data: 'FechaInicio', name: 'FechaInicio', title: 'Inicio'},
            {data: 'FechaFin', name: 'FechaFin', title: 'Fin'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        language: {"url": "/lang/datatables.es.json"},
        dom: 'lftip',
    });

    $('#salud-table tbody').on('click', 'tr', function () {
        var data = saludTabla.row(this).data();
        vm.$options.methods.showSalud(data.id);
    });
});

// Para la tabla de novedades
$(function () {
    var novTabla = $('#nov-table').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexNov,
            data: function (d) {
                d.id = vm.persona.id;
            }
        },
        deferRender: true,
        columns: [
            {data: 'id', name: 'id', orderable: false, searchable: false, visible: false},
            {data: 'Motivo', name: 'Motivo', title: 'Motivo'},
            {data: 'Lugar', name: 'Lugar', title: 'Lugar'},
            {data: 'FechaInicio', name: 'FechaInicio', title: 'Inicio'},
            {data: 'FechaFin', name: 'FechaFin', title: 'Fin'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        language: {"url": "/lang/datatables.es.json"},
        dom: 'lftip',
    });

    $('#nov-table tbody').on('click', 'tr', function () {
        var data = novTabla.row(this).data();
        vm.$options.methods.showNov(data.id);
    });
});

var vm = new Vue({
    el: '#persona-app',
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
        reparticions: {},
        reparticiones: {},
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
        datosalud: {},
        datosnovedad: {},
        arroba: true,
        fechaConclusion : "",
        dependencia: {},
        unidadSeleccionada: '',
        Reparticion: '',
    },
    watch: {
        Reparticion() {
            if (vm.Reparticion == null) {
                vm.unidades_padres = [];
                vm.unidad_padre_seleccionada = null;
            } else {
                vm.getListCargo(vm.Reparticion);
            }
        },
    },
    created: function () {
        // Ladda.bind('.ladda-button');
            axios
                .get(urlListUnidad)
                .then(response => {
                    this.unidades = response.data.data;
                });
            axios
                .get('/Reparticion/list')
                .then(response => {
                    this.reparticiones = response.data.data;
                });
            axios
                .get(urlListTipoDocumento)
                .then(response => {
                    this.tipoDocumentos = response.data.data;
                });
            axios
                .get(urlListEstadoCivil)
                .then(response => {
                    this.estadoCivils = response.data.data;
                });
            axios
                .get(urlListRol)
                .then(response => {
                    this.roles = response.data.data;
                });
            axios
                .get(urlLisTipoContrato)
                .then(response => {
                    this.tiposContrato = response.data.data;
                });
            axios
                .get(urlListTipoParentezco)
                .then(response => {
                    this.parentescos = response.data.data;
                });
            axios
                .get(urlListEscalaSalarial)
                .then(response => {
                    this.escalasSalarial = response.data.data;
                });

        axios
            .get(urlListCargo)
            .then(response => {
                this.cargos = response.data.data;
            });
            // axios
            //     .get(urlListCargo, {params: {Unidad: vm.persona.Unidad}})
            //     .then(response => {
            //         vm.cargos = response.data.data;
            //     });
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
                data.append('ci', JSON.stringify(vm.persona))
                axios
                    .post(urlUploadFile, data)
                    .then(response => {
                        if (response.data.success) {
                            toastr.info(response.data.msg, 'Correcto!');
                            vm.persona.Foto = response.data.data;
                        } else {
                            toastr.error(response.data.msg, 'Oops!');
                        }
                        vm.isLoadingFile = false;
                    })
                    .catch(error => {
                        toastr.error('Error subiendo archivo', 'Oops!');
                        vm.isLoadingFile = false;
                    });
            }
        },
        loadFiled(tipo, sw = null) {
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
                    .then(response => {

                        if (response.data.success) {
                            toastr.info(response.data.msg, 'Correcto!');
                            if (tipo == 'Dis') {
                                vm.persona.ArchivoDiscapacidad = response.data.data;
                            }
                            if (tipo == 'TutDis') {
                                vm.persona.ArchivoTutor = response.data.data;
                            }
                            if (tipo == 'Respaldo') {
                                vm.datosalud.Respaldo = response.data.data;
                            }
                            if (tipo == 'Novedad') {
                                vm.datosnovedad.Respaldo = response.data.data;
                            }
                        } else {
                            toastr.error(response.data.msg, 'Oops!');
                        }
                        vm.isLoadingFile = false;
                    })
                    .catch(error => {
                        toastr.error('Error subiendo archivo', 'Oops!');
                        vm.isLoadingFile = false;
                    });
            }
        },
        getListCargo(id) {
            axios
                .get(getListCargo+ '/' + id)
                .then(response => {
                    this.cargos = response.data.data;
                });
        },
        descargarPDF(PDF, tipo) {
            var x = new XMLHttpRequest();
            x.open("GET", PDF, true);
            x.responseType = 'blob';
            x.onload = e => {
                vm.isLoading = false;
                if (tipo = 'Salud') {
                    download(x.response, vm.persona.Persona + '_' + vm.datosalud.Motivo + '.pdf', "application/pdf");
                }
                if (tipo = 'Novedad') {
                    download(x.response, vm.persona.Persona + '_' + vm.datosnovedad.Motivo + '.pdf', "application/pdf");
                }
            }
            x.send();

            //window.open(PDF, "abrir");
        },
        newPersona() {
            vm.persona = {};
            vm.datosLab = {};
            vm.datosalud = {};
            vm.datosnovedad = {};
            $('#frmpersona').modal('show');
        },
        AbiriModalRef() {
            vm.datosRef = {};
            // vm.datosLab = {};
            $('#frmverpersona').modal('hide');
            $('#frmrefPer').modal('show');
        },
        AbiriModalSalud() {
            vm.datosalud = {};
            // vm.datosLab = {};
            $('#frmverpersona').modal('hide');
            $('#frmsaludPer').modal('show');
        },
        AbiriModalNov() {
            vm.datosnovedad = {};
            // vm.datosLab = {};
            $('#frmverpersona').modal('hide');
            $('#frmnovPer').modal('show');
        },
        saveRef() {
            vm.datosRef.idPersona = vm.persona.id;
            axios.post(urlSaveRef, vm.datosRef)
                .then(response => {
                    vm.datosRef = response.data.data;
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmrefPer').modal('hide');
                    var refTabla = $('#ref-table').DataTable();
                    refTabla.draw();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        saveSalud() {
            vm.datosalud.idPersona = vm.persona.id;
            axios.post(urlSaveSalud, vm.datosalud)
                .then(response => {
                    vm.datosalud = response.data.data;
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmsaludPer').modal('hide');
                    var saludTabla = $('#salud-table').DataTable();
                    saludTabla.draw();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        saveNov() {
            vm.datosnovedad.idPersona = vm.persona.id;
            axios.post(urlSaveNov, vm.datosnovedad)
                .then(response => {
                    vm.datosnovedad = response.data.data;
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmnovPer').modal('hide');
                    var novTabla = $('#nov-table').DataTable();
                    novTabla.draw();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        showRef(id) {
            axios.get(urlShowRef, {params: {id: id}})
                .then(response => {
                    vm.datosRef = response.data.data;
                    $('#frmverpersona').modal('hide');
                    $('#frmrefPer').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },

        showSalud(id) {
            axios.get(urlShowSalud, {params: {id: id}})
                .then(response => {
                    vm.datosalud = response.data.data;
                    $('#frmverpersona').modal('hide');
                    $('#frmsaludPer').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showNov(id) {
            axios.get(urlShowNov, {params: {id: id}})
                .then(response => {
                    vm.datosnovedad = response.data.data;
                    $('#frmverpersona').modal('hide');
                    $('#frmnovPer').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showPersona(id) {
            console.log(id);
            //VARIABLE PARA HABILITAR EL BOTON GENERAR CORREO
            this.generarCorreo = false;
            axios.get(urlShowPersona, {params: {id: id}})
                .then(response => {
                    vm.persona = response.data.data;
                    if (response.data.lab == null) {
                    } else {
                        vm.datosLab = response.data.lab;
                    }
                    vm.arroba = vm.persona.email ? vm.persona.email.includes('@') : false;

                    vm.fechaConclusion = moment().format('YYYY-MM-DD');

                    $('#frmverpersona').modal('show');
                    var refTabla = $('#ref-table').DataTable();
                    refTabla.draw();
                    var refTabla = $('#salud-table').DataTable();
                    refTabla.draw();
                    var refTabla = $('#nov-table').DataTable();
                    refTabla.draw();
                })
                .catch(error => {
                    console.log(error);
                });
        },

        saveCorreoInst() {
            vm.persona.idTipoContrato = 3;//solo de ejemplo
            axios.post(urlSavePersona, vm.persona)
                .then(response => {
                    vm.persona = response.data.data;
                    swal("Exito!", "Se guardo el correo institucional", "success");
                })
                .catch(error => {
                    console.log(error);
                    swal("Ocurrio un error!", "...", "error");
                });
        },

        registrarOffice365() {
            this.generarCorreo = true;
            axios.post(urlregistrarOffice365, vm.persona)
                .then(response => {

                    if (response.success) {
                        toastr.success(response.msg, 'Correcto!');
                        vm.persona.email = response.data.userPrincipalName;
                        this.generarCorreo = false;
                        this.saveCorreoInst();
                    } else {
                        toastr.error(response.msg, 'Oops!');
                        this.generarCorreo = false;
                    }
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                    this.generarCorreo = false;
                })
        },
        obtenerDatos() {
            this.getReparticions();
            this.getCargos();
        },
        enviarCorreo() {
            axios.post(urlEnviarCorreo, vm.persona)
                .then(response => {
                    toastr.success('Correo enviado', 'Exito!');
                })
                .catch(error => {
                    toastr.error('Error al enviar correo' + response.msg, 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        cambiopassword(id) {
            $('#frmverpersona').modal('hide');
            $('#frmverpassword').modal('show');
        },
        changePassword() {
            vm.password.Persona = vm.persona.id;
            axios.post(urlChangePasswordPersona, vm.password)
                .then(response => {
                    if (response.data.success) {
                        toastr.success(response.data.msg, 'Correcto!');
                        $('#frmverpassword').modal('hide');
                        $('#frmverpersona').modal('show');
                    } else {
                        toastr.error(response.msg, 'Oops!');
                    }
                })
                .catch(error => {
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                })
        },
        editPersona() {
            $('#frmverpersona').modal('hide');
            $('#frmpersona').modal('show');
        },

        savePersona() {
            vm.persona.idTipoContrato = vm.datosLab.idTipoContrato
            axios.post(urlSavePersona, vm.persona)
                .then(response => {
                    if (response.data.success) {
                        vm.datosLab.idPersona = response.data.data.id;
                        console.log('hola');
                        console.log(vm.datosLab);
                        axios.post(urlSaveDatosLaborales, vm.datosLab)
                            .then(response => {
                                // vm.datosLab = response.data.data;
                                var personaTabla = $('#tabla-persona').DataTable();
                                personaTabla.draw();
                                toastr.success(response.msg, 'Correcto!');
                                $('#frmpersona').modal('hide');
                                this.showPersona(vm.persona.id);
                                //$('#view-persona').modal('show');
                            })
                            .catch(error => {
                                toastr.error('Error al guardar el registro', 'Oops!');
                                vm.errorBag = error.response.data.errors;
                            });
                    } else {
                        console.log(response.error.errorInfo, response.error.errorInfo[0]);
                        if (response.error.errorInfo[0] == '23505') {//errores de campo unico
                            toastr.warning('El Carnet ya se encuentra registrado, verifique sus datos o actualicelos', '¡USUARIO EXISTENTE!');
                        }
                    }
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },

        deletePersona() {
            Swal.fire({
                title: "Estas seguro que deseas eliminar el registro?",
                text: "Esta accion es irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            })
                .then((response) => {
                    if (response.isConfirmed) {
                        axios.post(urlDestroyPersona, {id: vm.persona.id})
                            .then(response => {
                                if (response.data.success) {
                                    toastr.success(response.data.msg, 'Correcto!');
                                    var personaTabla = $('#tabla-persona').DataTable();
                                    personaTabla.draw();
                                    $('#frmverpersona').modal('hide');
                                } else {
                                    toastr.error(response.data.msg, 'Oops!');
                                }
                            })
                            .catch(error => {
                                toastr.success('Hubo un problema, contactese con el administrador', 'Error!');
                            })
                    } else {
                    }
                });
        },
        itemPersona(id) {
            axios.post(urlItemPersona, {id: id})
                .then(response => {
                    //console.log('Exito_pregrado: ',response);
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmpersona').modal('hide');
                    var personaTabla = $('#tabla-persona').DataTable();
                    personaTabla.draw();
                    //location.reload();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        eventualPersona(id) {
            axios.post(urlEventualPersona, {id: id})
                .then(response => {
                    //console.log('Exito_pregrado: ',response);
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmpersona').modal('hide');
                    var personaTabla = $('#tabla-persona').DataTable();
                    personaTabla.draw();
                    //location.reload();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        consultorPersona(id) {
            axios.post(urlConsultorPersona, {id: id})
                .then(response => {
                    //console.log('Exito_pregrado: ',response);
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmpersona').modal('hide');
                    var personaTabla = $('#tabla-persona').DataTable();
                    personaTabla.draw();
                    //location.reload();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        destinadoPersona(id) {
            axios.post(urlDestinadoPersona, {id: id})
                .then(response => {
                    //console.log('Exito_pregrado: ',response);
                    toastr.success(response.msg, 'Correcto!');
                    $('#frmpersona').modal('hide');
                    var personaTabla = $('#tabla-persona').DataTable();
                    personaTabla.draw();
                    //location.reload();
                })
                .catch(error => {
                    console.log(error);
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                });
        },
        imprimeCredencial(tipo) {
            axios.get(urlPrintPersona, {params: {id: vm.persona.id, TipoCredencial: 'T', Lado: tipo}})
                .then(response => {
                    window.open(response.data.data.url, '_blank');
                })
                .catch(error => {
                    toastr.error('Ha ocurrido un error al generar la credencial', 'Oops!');
                    console.log(error);
                })
        },
    },
    // mounted() {
    //     this.getUnidades();
    //     this.getReparticiones();
    //     this.getRoles();
    //     this.getTipoDocumento();
    //     this.getEstadoCivil();
    //     this.getParentezcos();
    //     this.getEscalas();
    //     //this.getCargos();
    //     this.getTiposContrato();
    // }
});

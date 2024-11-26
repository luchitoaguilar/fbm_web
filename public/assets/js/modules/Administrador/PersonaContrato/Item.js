$(function () {
    var posgradoTabla = $('#tabla-item').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: urlIndexDocumentacion
        },
        deferRender: true,
        columns: [
            {data: 'id', name: 'p.id', orderable: false, searchable: false, visible: false},
            {
                data: 'id',width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            {data: 'Unidad', name: 'ua.Unidad', title: 'Unidad/Direccion/Centro'},
            {data: 'Persona', name: 'p.Persona', title: 'Nombre Completo'},
            {data: 'Rol', name: 'r.Rol', title: 'Rol'},
            {data: 'Celular', name: 'p.Celular', title: 'Celular'},
            {data: 'CI', name: 'p.CI', title: 'Carnet'},
            {data: 'total', searchable: false, name: 'total', title: 'Documentos'},
            {
                data: 'Activo', name: 'p.Activo', title: 'Activo', className: 'centradito',
                render: function (data, type, row) {
                    if (!row.Activo) {
                        return '<i class="fa fa-ban text-danger"> Inactivo</i>';
                    } else {
                        return '<i class="fa fa-check text-success"> Activo</i>';
                    }
                }
            },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showPersona(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],

        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
        // dom: 'T<"clear">lBfrtip',
        // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
    });

    // $('#tabla-item tbody').on('click', 'tr', function () {
    //     var data = posgradoTabla.row(this).data();
    //     vm.$options.methods.showPersona(data.id);
    // });
});

$(function () {
    var docTabla = $('#doc-table').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: urlDocumentoPersona,
            //type: "post",
            data: function (d) {
                d.idPersona = vm.persona.id
                d.id = vm.idDocumento;
            }
        },
        deferRender: true,
        columns: [
            {data: 'id', name: 'pd.id', orderable: false, searchable: false, visible: false},
            {data: 'Titulo', name: 'pd.Titulo', title: 'Nombre'},
            {data: 'Descripcion', name: 'pd.Descripcion', title: 'Descripción'},
            {data: 'Estado', name: 'e.Estado', title: 'Estado'},
            {data: 'Fecha', name: 'pd.Fecha', title: 'Fecha'},
            {data: 'Observacion', name: 'pd.Observacion', title: 'Observación'},
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showDoc(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lftip',
    });

    // $('#doc-table tbody').on('click', 'tr', function () {
    //     var data = docTabla.row(this).data();
    //     vm.$options.methods.showDoc(data.id);
    // });
});


var vm = new Vue({
    el: '#item-app',
    data: {
        //accounting: accounting,
        moment: moment,
        auth: auth,
        errorBag: {},
        isLoading: false,
        isLoadingFile: false,
        persona: {},
        prioridad: {},
        idDocumento: {},
        doc: {},
        unidades: {},
        personadocumento: {},
        estado: {},
        documento: {},
        roles: {},
        isEditing: false,
        password: {},
        Nuevo: {},
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
                            toastr.info(result.data.msg, 'Correcto!');
                            vm.personadocumento.Archivo = result.data.data;
                            console.log('mensaje: ', vm.personadocumento.Archivo);
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
        getEstado() {
            axios.get(urlListEstado)
                .then(result => {
                    response = result.data;
                    vm.estado = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        showDoc(id) {
            vm.personadocumento = {};
            axios.post(urlListDocumentoPersona, {id: id})
                .then(result => {
                    response = result.data;
                    vm.personadocumento = response.data;
                    Archivo = vm.personadocumento.Archivo;
                    vm.personadocumento.Archivo = Archivo;
                    //console.log('VERDETALLE ',vm.personadocumento.Archivo,);
                    $('#frmverdetalleD').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        descargarPDF(PDF) {
            var x = new XMLHttpRequest();
            x.open("GET", PDF, true);
            x.responseType = 'blob';
            x.onload = e => {
                vm.isLoading = false;
                download(x.response, vm.personadocumento.Persona + '_' + vm.personadocumento.Nombre + '.pdf', "application/pdf");
            }
            x.send();

            //window.open(PDF, "abrir");
        },
        AbrirModalDoc() {
            vm.personadocumento = {};
            vm.Nuevo = 0;
            $('#frmpersonadocumento').modal('show');
        },
        getDocumento() {
            axios.get(urlListDocumento)
                .then(result => {
                    response = result.data;
                    vm.documento = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        showPersona(id) {
            axios.get(urlShowPersona, {params: {id: id}})
                .then(result => {

                    response = result.data;
                    //responsed = result.docs;

                    vm.persona = response.data;
                    vm.doc = response.docs;
                    vm.prioridad = response.prioridad;

                    $('#frmpersona').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cambiopassword(id) {
            $('#frmverpersona').modal('hide');
            $('#frmverpassword').modal('show');
        },
        editPersonaDocumento(id) {//revisar
            //console.log('VERID ',id);
            vm.personadocumento = {};
            axios.post(urlListDocumentoPersona, {id: id})
                .then(result => {
                    response = result.data;
                    vm.personadocumento = response.data;
                    //console.log('VERDETALLE ',vm.personadocumento);
                    $('#frmpersonadocumento').modal('show');

                })
                .catch(error => {
                    console.log(error);
                });
        },
        detallePersonaDocumento(id) {//revisar
            //console.log('VERID ',id);
            vm.personadocumento = {};
            axios.post(urlListDocumentoPersona, {id: id})
                .then(result => {
                    response = result.data;
                    vm.personadocumento = response.data;
                    Archivo = vm.personadocumento.Archivo;
                    vm.personadocumento.Archivo = "/storage/documents/" + Archivo;
                    //console.log('VERDETALLE ',vm.personadocumento.Archivo,);
                    $('#frmverdetalleD').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        documentoPersonaDocumento(id) {
            vm.idDocumento = id;

            $('#frmpersona').modal('hide');
            $('#frmverdetalleDP').modal('show');

            var docTabla = $('#doc-table').DataTable();
            docTabla.draw();
        },
        savePersonaDocumento() {
            vm.personadocumento.idDocumento = vm.idDocumento;
            vm.personadocumento.idPersona = vm.persona.id;
            axios.post(urlSavePersonaDocumento, vm.personadocumento)
                .then(result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmpersonadocumento').modal('hide');
                    $('#frmverdetalleD').modal('hide');

                    //location.reload();
                    var docTabla = $('#doc-table').DataTable();
                    docTabla.draw();
                })
                .catch(error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        borrarPersonaDocumento(id) {
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
                        axios.post(urlDestroyPersonaDocumento, {id: id})
                            .then(result => {
                                response = result.data;
                                toastr.success(response.msg, 'Correcto!');
                                $('#frmverdetalleD').modal('hide');
                                var docTabla = $('#doc-table').DataTable();
                                docTabla.draw();
                                //var personadocumentoTabla = $('#personadocumento-table').DataTable();
                                //personadocumentoTabla.draw();
                                //$('#view-personadocumento').modal('hide');
                                //location.reload();
                            })
                            .catch(error => {
                                console.log(error);
                            })
                    } else {
                        //swal("Your imaginary file is safe!");
                    }
                });
        }
    },
    mounted() {
        this.getEstado();
        this.getDocumento();
    }
});

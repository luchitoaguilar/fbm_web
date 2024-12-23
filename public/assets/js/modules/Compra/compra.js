// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-compra').DataTable({
        order: [[1, 'asc']],
        processing: true,
        deferRender: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: 'listar'
        },
        columnDefs: [
            {
                targets:1, 
                render:function(data){
                    return moment(data).format('D-M-YYYY');
                }
            }
        ],
        columns: [
            { data: 'id', name: 'id', visible: false },
            { data: 'fecha_creado', name: 'fecha_creado', title: 'Fecha', orderable: true, searchable: true },
            { data: 'grado', name: 'grado', title: 'Grado', orderable: true, searchable: true },
            { data: 'nombre', name: 'nombre', title: 'Nombre', orderable: true, searchable: true },
            { data: 'email', name: 'email', title: 'Email', orderable: true, searchable: false },
            { data: 'celular', name: 'celular', title: 'Celular', orderable: true, searchable: true },
            { data: 'baucher', name: 'baucher', title: 'Baucher', orderable: false, searchable: true },
            { data: 'monto', name: 'monto', title: 'Monto', orderable: true, searchable: true },
            { data: 'ciudad', name: 'ciudad', title: 'Ciudad', orderable: true, searchable: true },
            { data: 'estado', name: 'estado', title: 'Correo Electronico', orderable: false, searchable: true },
            { data: 'estado_whats', name: 'estado_whats', title: 'WhatsApp', orderable: false, searchable: true },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showCompra(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#compra-app',
    data: {
        errors: {},
        modelo: {},
        nombre: {},
        grado: {},
        celular: {},
        baucher: {},
        email: {},
        id_ciudad: {},
        monto: {},
        mensaje: {},
        editar: false
    },
    created: function () {
        this.id = null;
        this.nombre = '';
        this.celular = '';
        this.grado = '';
        this.email = '';
        this.id_ciudad = '';
        this.baucher = '';
        this.monto = '';
        this.mensaje = '';
        this.editar = false;
        this.errors = {};
    },
    methods: {
        showCompra(id) {
            vm.usuario = {
                rol: {},
                persona: {},
                cargo: {},
            };
            axios
                .get(datos_compra + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmvercompra').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createCompra() {
            vm.id = null;
            vm.nombre = '';
            vm.celular = '';
            vm.grado = '';
            vm.baucher = '';
            vm.monto = '';
            vm.email = '';
            vm.id_ciudad = '';
            vm.mensaje = '';
            vm.editar = false;
            vm.errors = {};
        },
        storeCompra() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre.toUpperCase(),
                celular: vm.celular,
                grado: vm.grado,
                baucher: vm.baucher,
                monto: vm.monto,
                email: vm.email,
                id_ciudad: vm.id_ciudad,
            };

            axios
                .post(guardar_compra, vm.modelo, {
                    headers: {
                        'Accept': 'multipart/form-data',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Su mensaje se ha enviado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    if (error.response.data.mostrar_mensaje) swal(error.response.data.message, { icon: 'error' });
                })
        },
        replyCompra(id) {
            $('#frmvercompra').modal('hide');
            Swal.fire({
                title: 'Deseas responder mediante correo Institucional?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    vm.reply = {
                        id: id,
                        msg: result.value,
                    };
                    axios.post(reply_compra, vm.reply)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-compra').DataTable();
                    tablaPrincipal.draw();
                            $('#frmvergrado').modal('hide');
                        })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#frmvercompra').modal('show');
                }
            });
        },
        replyWhatsappCompra(id) {
            $('#frmvercompra').modal('hide');
            Swal.fire({
                title: 'Deseas responder mediante WhatsApp',
                text: "Debe tener abierto su WhatsApp en esta computador!",
                icon: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    vm.reply = {
                        id: id,
                        msg: result.value,
                    };
                    axios.post(reply_whatsapp_compra, vm.reply)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-compra').DataTable();
                            tablaPrincipal.draw();
                            window.open(response.data.whatsapp); 
                        })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#frmvercompra').modal('show');
                }
            });
        },
        replyWhatsappMasivoCompra() {
            $('#frmvercompra').modal('hide');
            vm.modelo = {
                mensaje: vm.mensaje,
            };
            try {
                axios.post(reply_whatsapp_compra_masiva, vm.modelo)
                    .then(response => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.data.mensaje,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.open(response.data.whatsapp); 
                        var tablaPrincipal = $('#tabla-compra').DataTable();
                        tablaPrincipal.draw();
                    })
            } catch {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#frmvercompra').modal('show');
            }
        },
    }
});

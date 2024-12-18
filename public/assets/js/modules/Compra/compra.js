// $(".default-select2").select2();

$(function () {
    // var tablaPrincipal = $('#tabla-compra').DataTable({
    //     order: [[1, 'asc']],
    //     processing: true,
    //     deferRender: true,
    //     serverSide: true,
    //     responsive: true,
    //     autoWidth: false,
    //     ajax: {
    //         url: 'listar'
    //     },
    //     columnDefs: [
    //         // { className: "text-center", targets: "_all" },
    //         // { className: "align-middle", targets: "_all" },
    //         // { className: "text-center", targets: [7] },
    //     ],
    //     columns: [
    //         { data: 'id', name: 'id', visible: false },
    //         { data: 'tipoProducto', name: 'tp.tipo_producto', title: 'Tipo de Producto', orderable: true, searchable: true },
    //         { data: 'nombre', name: 'nombre', title: 'Nombre', orderable: true, searchable: true },
    //         { data: 'precio', name: 'precio', title: 'Precio Actual (Bs)', orderable: true, searchable: true },
    //         { data: 'precio_antes', name: 'precio_antes', title: 'Precio Anterior (Bs)', orderable: true, searchable: true },
    //         { data: 'enlace', name: 'enlace', title: 'Enlace', orderable: true, searchable: true },
    //         { data: 'presentacion', name: 'presentacion', title: 'Presentacion (Kg.)', orderable: false, searchable: true },
    //         { data: 'imagen', name: 'imagen', title: 'Imagen', orderable: false, searchable: true },
    //         {
    //             title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
    //                 return `<a onclick="vm.$options.methods.showProducto(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
    //             }
    //         },
    //     ],
    //     lengthMenu: [8, 50, 75, 100, 150, 200],
    //     language: { 'url': ruta_tabla_traduccion },
    //     dom: 'lfiptip',
    // });
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
        mensaje: {},
        id_ciudad: {},
        editar: false
    },
    created: function () {
        // axios
        //     .get(getTipoProducto)
        //     .then(response => {
        //         this.tipoProducto = response.data.data;
        //     });
        axios
            .get(getCiudadVenta)
            .then(response => {
                console.log('here');
                this.ciudadVenta = response.data.data;
            });
    },
    methods: {
        showCompra(id) {
            vm.usuario = {
                rol: {},
                persona: {},
                cargo: {},
            };
            axios
                .get(datos_producto + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmverproducto').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createCompra() {
            vm.id = null;
            vm.nombre = '';
            vm.telefono = '';
            vm.asunto = '';
            vm.email = '';
            vm.mensaje = '';
            vm.id_ciudad = '';
            vm.editar = false;
            vm.errors = {};
        },
        storeCompra() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre.toUpperCase(),
                telefono: vm.telefono,
                email: vm.email,
                asunto: vm.asunto,
                mensaje: vm.mensaje,
            };

            axios
                .post(guardar_Compra, vm.modelo, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
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
        leerMensaje(id) {
            Swal.fire({
                title: 'Deseas marcar como leido el mensaje?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(eliminar_producto + '/' + id)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-producto').DataTable();
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
                    $('#frmverproducto').modal('show');
                }
            });
        }
    }
});
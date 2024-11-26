// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-noticia').DataTable({
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
            // { className: "text-center", targets: "_all" },
            // { className: "align-middle", targets: "_all" },
            // { className: "text-center", targets: [7] },
        ],
        columns: [
            { data: 'id', name: 'id', visible: false },
            { data: 'nombre', name: 'nombre', title: 'Nombre', orderable: true, searchable: true },
            { data: 'descripcion', name: 'descripcion', title: 'Descripcion', orderable: true, searchable: true },
            { data: 'enlace', name: 'enlace', title: 'Enlace', orderable: true, searchable: true },
            { data: 'archivo', name: 'archivo', title: 'Archivo', orderable: false, searchable: true },
            { data: 'imagen_0', name: 'imagen_0', title: 'Imagen 1', orderable: false, searchable: true },
            { data: 'imagen_1', name: 'imagen_1', title: 'Imagen 2', orderable: false, searchable: true },
            { data: 'imagen_2', name: 'imagen_2', title: 'Imagen 3', orderable: false, searchable: true },
            { data: 'imagen_3', name: 'imagen_3', title: 'Imagen 4', orderable: false, searchable: true },
            { data: 'imagen_4', name: 'imagen_4', title: 'Imagen 5', orderable: false, searchable: true },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showNoticia(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#noticia-app',
    data: {
        errors: {},
        modelo: {},
        nombre: {},
        descripcion: {},
        archivo: {},
        imagen_0: {},
        imagen_1: {},
        imagen_2: {},
        imagen_3: {},
        imagen_4: {},
        enlace: {},
        mensaje: {},
        editar: false
    },
    created: function () {
        this.id = null;
        this.nombre = '';
        this.telefono = '';
        this.asunto = '';
        this.email = '';
        this.mensaje = '';
        this.editar = false;
        this.errors = {};
    },
    methods: {
        showProducto(id) {
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
        createNoticia() {
            vm.id = null;
            vm.nombre = '';
            vm.telefono = '';
            vm.asunto = '';
            vm.email = '';
            vm.mensaje = '';
            vm.editar = false;
            vm.errors = {};
        },
        storeContacto() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre,
                telefono: vm.telefono,
                email: vm.email,
                asunto: vm.asunto,
                mensaje: vm.mensaje,
            };

            axios
                .post(guardar_contacto, vm.modelo)
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
                    vm.id = null;
                    vm.nombre = '';
                    vm.telefono = '';
                    vm.asunto = '';
                    vm.email = '';
                    vm.mensaje = '';
                    vm.editar = false;
                    vm.errors = {};
                }).catch(error => {
                    vm.errors = error.response.data.errors;
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

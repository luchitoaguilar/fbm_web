// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-producto').DataTable({
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
            { data: 'ciudad', name: 'cd.departamento', title: 'Ciudad de Venta', orderable: true, searchable: true },
            { data: 'tipoProducto', name: 'tp.tipo_producto', title: 'Tipo de Producto', orderable: true, searchable: true },
            { data: 'nombre', name: 'nombre', title: 'Nombre', orderable: true, searchable: true },
            { data: 'precio', name: 'precio', title: 'Precio Actual (Bs)', orderable: true, searchable: true },
            // { data: 'precio_antes', name: 'precio_antes', title: 'Precio Anterior (Bs)', orderable: true, searchable: true },
            { data: 'enlace', name: 'enlace', title: 'Enlace', orderable: true, searchable: true },
            { data: 'presentacion', name: 'presentacion', title: 'Presentacion', orderable: false, searchable: true },
            { data: 'imagen', name: 'imagen', title: 'Imagen', orderable: false, searchable: true },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showProducto(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#producto-app',
    data: {
        errors: {},
        modelo: {},
        nombre: {},
        precio: {},
        precio_antes: {},
        imagen: {},
        presentacion: {},
        tipoProducto: {},
        tipo_producto: {},
        id_ciudad: {},
        ciudadVenta: {},
        enlace: {},
        editar: false
    },
    created: function () {
        axios
            .get(getTipoProducto)
            .then(response => {
                this.tipoProducto = response.data.data;
            });
        axios
            .get(getCiudadVenta)
            .then(response => {
                this.ciudadVenta = response.data.data;
            });
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
        createProducto() {
            vm.id = null;
            vm.nombre = '';
            vm.precio = '';
            vm.precio_antes = '';
            vm.imagen = '';
            vm.presentacion = '';
            vm.tipo_producto = '';
            vm.id_ciudad = '';
            vm.enlace = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmproducto').modal('show');
        },
        buscarPersona(search, loading) {
            if (search.length) {
                loading(true);
                vm.search(loading, search, vm);
            }
        },
        storeProducto() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre.toUpperCase(),
                presentacion: vm.presentacion,
                precio: vm.precio,
                precio_antes: vm.precio_antes,
                enlace: vm.enlace,
                tipo_producto: vm.tipo_producto,
                id_ciudad: vm.id_ciudad,
            };
            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('imagen', vm.imagen);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }

            axios
                .post(guardar_producto, modelo, {
                    headers: {
                        'Accept': 'multipart/form-data',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmproducto').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Creado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-producto').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    if (error.response.data.mostrar_mensaje) swal(error.response.data.message, { icon: 'error' });
                    if (!error.response.data.mostrar_formulario) $('#frmproducto').modal('hide');
                })
        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_imagen(event) {
            vm.imagen = event.target.files[0];
        },
        editProducto(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_producto + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.nombre = temporal.nombre.toUpperCase();
                    vm.presentacion = temporal.presentacion;
                    vm.precio = temporal.precio;
                    vm.precio_antes = temporal.precio_antes;
                    vm.enlace = temporal.enlace;
                    vm.imagen = temporal.imagen;
                    vm.tipo_producto = temporal.tipo_producto;
                    vm.id_ciudad = temporal.id_ciudad;

                    $('#frmproducto').modal('show');
                    $('#frmverproducto').modal('hide');
                });
        },
        deleteProducto(id) {
            $('#frmverproducto').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar el producto?',
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

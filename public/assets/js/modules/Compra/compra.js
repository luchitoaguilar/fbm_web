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
        email: {},
        id_ciudad: {},
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
            vm.celular = '';
            vm.grado = '';
            vm.baucher = '';
            vm.email = '';
            vm.id_ciudad = '';
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
                email: vm.email,
                id_ciudad: vm.id_ciudad,
            };

            console.log(vm.modelo);
            axios
                .post(guardar_compra, vm.modelo, {
                    headers: {
                        'Accept': 'application/json',
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
    }
});

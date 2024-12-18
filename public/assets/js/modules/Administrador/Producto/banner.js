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
            { data: 'nombre', name: 'nombre', title: 'Nombre', orderable: true, searchable: true },
            { data: 'precio', name: 'precio', title: 'Precio', orderable: true, searchable: true },
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
        imagen: {},
        presentacion: {},
        enlace: {},
        editar: false
    },
    created: function () {
        // axios
        //     .get(lista_roles)
        //     .then(response => {
        //         this.roles = response.data.data
        //     });
    },
    methods: {
        showBanner(id) {
            vm.usuario = {
                rol: {},
                persona: {},
                cargo: {},
            };
            axios
                .get(datos_banner + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmverbanner').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createBanner() {
            vm.id = null;
            vm.nombre = '';
            vm.datos = '';
            vm.precio = '';
            vm.imagen_fondo = '';
            vm.imagen_frente = '';
            vm.enlace = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmbanner').modal('show');
        },
        buscarPersona(search, loading) {
            if (search.length) {
                loading(true);
                vm.search(loading, search, vm);
            }
        },
        storeBanner() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre,
                datos: vm.datos,
                precio: vm.precio,
                enlace: vm.enlace,
            };

            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('imagen_fondo', vm.imagen_fondo);
            modelo.append('imagen_frente', vm.imagen_frente);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }
            
            axios
                .post(guardar_banner, modelo, {
                    headers: {
                    'Accept': 'application/json',
                    "Content-Type": "multipart/form-data",
                }
            })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmbanner').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Creado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    var tablaPrincipal = $('#tabla-banner').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    if (error.response.data.mostrar_mensaje) swal(error.response.data.message, { icon: 'error' });
                    if (!error.response.data.mostrar_formulario) $('#frmbanner').modal('hide');
                })
        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_imagen_fondo(event) {
            vm.imagen_fondo = event.target.files[0];
        },
        select_imagen_frente(event) {
            vm.imagen_frente = event.target.files[0];
        },
        updateBanner(id) {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre,
                datos: vm.datos,
                precio: vm.precio,
                enlace: vm.enlace,
            };

            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('imagen_fondo', vm.imagen_fondo);
            modelo.append('imagen_frente', vm.imagen_frente);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }
        },
        editBanner(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_banner + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.nombre = temporal.nombre;
                    vm.datos = temporal.datos;
                    vm.precio = temporal.precio;
                    vm.enlace = temporal.enlace;
                    vm.imagen_fondo = temporal.imagen_fondo;
                    vm.imagen_frente = temporal.imagen_frente;

                    $('#frmbanner').modal('show');
                    $('#frmverbanner').modal('hide');
                });
        },
        deleteBanner(id) {
            $('#frmverbanner').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar el banner?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete( eliminar_banner + '/' + id)
                        .then( response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                              })
                              var tablaPrincipal = $('#tabla-banner').DataTable();
                              tablaPrincipal.draw();
                            $('#frmvergrado').modal('hide');
                        })
                }else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#frmverbanner').modal('show');
                }
            });
        }
    }
});

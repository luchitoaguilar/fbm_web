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
            { data: 'titulo', name: 'titulo', title: 'Nombre', orderable: true, searchable: true },
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
        titulo: {},
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

    },
    methods: {
        showNoticia(id) {
            axios
                .get(datos_noticia + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmvernoticia').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createNoticia() {
            vm.id = null;
            vm.titulo = '';
            vm.descripcion = '';
            vm.archivo = '';
            vm.imagen_0 = '';
            vm.imagen_1 = '';
            vm.imagen_2 = '';
            vm.imagen_3 = '';
            vm.imagen_4 = '';
            vm.enlace = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmnoticia').modal('show');
        },
        storeNoticia() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                titulo: vm.titulo,
                descripcion: vm.descripcion,
                archivo: vm.archivo,
                enlace: vm.enlace,
                imagen_0: vm.imagen_0,
                imagen_1: vm.imagen_1,
                imagen_2: vm.imagen_2,
                imagen_3: vm.imagen_3,
                imagen_4: vm.imagen_4,
            };
            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('imagen_0', vm.imagen_0);
            modelo.append('imagen_1', vm.imagen_1);
            modelo.append('imagen_2', vm.imagen_2);
            modelo.append('imagen_3', vm.imagen_3);
            modelo.append('imagen_4', vm.imagen_4);
            modelo.append('archivo', vm.archivo);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }

            axios
                .post(guardar_noticia, modelo, {
                    headers: {
                        'Accept': 'multipart/form-data',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmnoticia').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Su noticia se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-noticia').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_archivo(event) {
            vm.imagen_fondo = event.target.files[0];
        },
        select_imagen_0(event) {
            vm.imagen_0 = event.target.files[0];
        },
        select_imagen_1(event) {
            vm.imagen_1 = event.target.files[0];
        },
        select_imagen_2(event) {
            vm.imagen_2 = event.target.files[0];
        },
        select_imagen_3(event) {
            vm.imagen_3 = event.target.files[0];
        },
        select_imagen_4(event) {
            vm.imagen_4 = event.target.files[0];
        },
        editNoticia(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_noticia + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.titulo = temporal.titulo;
                    vm.descripcion = temporal.descripcion;
                    vm.archivo = temporal.archivo;
                    vm.enlace = temporal.enlace;
                    vm.imagen_0 = temporal.imagen_0;
                    vm.imagen_1 = temporal.imagen_1;
                    vm.imagen_2 = temporal.imagen_2;
                    vm.imagen_3 = temporal.imagen_3;
                    vm.imagen_4 = temporal.imagen_4;

                    $('#frmnoticia').modal('show');
                    $('#frmvernoticia').modal('hide');
                });
        },
        deleteNoticia(id) {
            $('#frmvernoticia').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar la noticia?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete( eliminar_noticia + '/' + id)
                        .then( response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                              })
                              var tablaPrincipal = $('#tabla-noticia').DataTable();
                              tablaPrincipal.draw();
                            $('#frmvernoticia').modal('hide');
                        })
                }else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    $('#frmvernoticia').modal('show');
                }
            });
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

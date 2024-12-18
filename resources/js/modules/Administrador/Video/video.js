// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-video').DataTable({
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
            { data: 'titulo', name: 'titulo', title: 'Titulo', orderable: true, searchable: true },
            {
                title: 'Video', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.mostrarVideo(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-video"></i> Video</a>`;
                }
            },
            { data: 'estado', name: 'estado', title: 'Estado', orderable: true, searchable: true },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showVideo(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#video-app',
    data: {
        errors: {},
        modelo: {},
        titulo: {},
        descripcion: {},
        video: {},
        estado: {},
        editar: false
    },
    created: function () {

    },
    methods: {
        mostrarVideo(id) {
            axios
                .get(mostrar_video + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    console.log(vm.modelo.video);
                    $('#frmmostrarvideo').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        showVideo(id) {
            axios
                .get(datos_video + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmvervideo').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createVideo() {
            vm.id = null;
            vm.titulo = '';
            vm.video = '';
            vm.estado = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmvideo').modal('show');
        },
        storeVideo() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                titulo: vm.titulo,
            };
            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('video', vm.video);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }
            for (var pair of modelo.entries()) {
                console.log(pair[0]+ '=> ' + pair[1]); 
            }
            axios
                .post(guardar_video, modelo, {
                    headers: {
                        'Accept': 'application/json',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmvideo').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Su video se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-video').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_video(event) {
            vm.video = event.target.files[0];
        },
        editVideo(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_video + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.titulo = temporal.titulo;
                    vm.video = temporal.video;

                    $('#frmvideo').modal('show');
                    $('#frmvervideo').modal('hide');
                });
        },
        deleteVideo(id) {
            $('#frmvervideo').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar la video?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(eliminar_video + '/' + id)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-video').DataTable();
                            tablaPrincipal.draw();
                            $('#frmvervideo').modal('hide');
                        })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#frmvervideo').modal('show');
                }
            });
        },
    }
});

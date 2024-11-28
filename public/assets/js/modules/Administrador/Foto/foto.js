// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-foto').DataTable({
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
            { data: 'detalle', name: 'detalle', title: 'detalle', orderable: true, searchable: true },
            { data: 'foto', name: 'foto', title: 'Foto', orderable: false, searchable: true },
            { data: 'estado', name: 'estado', title: 'Estado', orderable: true, searchable: true },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showFoto(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#foto-app',
    data: {
        errors: {},
        modelo: {},
        detalle: {},
        foto: {},
        estado: {},
        editar: false
    },
    created: function () {

    },
    methods: {
        mostrarFoto(id) {
            axios
                .get(mostrar_foto + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                  
                    $('#frmmostrarfoto').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        showFoto(id) {
            axios
                .get(datos_foto + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmverfoto').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createFoto() {
            vm.id = null;
            vm.detalle = '';
            vm.foto = '';
            vm.estado = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmfoto').modal('show');
        },
        storeFoto() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                detalle: vm.detalle,
            };
            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('foto', vm.foto);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }
          
            axios
                .post(guardar_foto, modelo, {
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmfoto').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Su foto se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-foto').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_foto(event) {
            vm.foto = event.target.files[0];
        },
        editFoto(id) {
            console.log('here');
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_foto + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.detalle = temporal.detalle;
                    vm.foto = temporal.foto;

                    $('#frmfoto').modal('show');
                    $('#frmverfoto').modal('hide');
                });
        },
        deleteFoto(id) {
            $('#frmverfoto').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar la foto?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(eliminar_foto + '/' + id)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-foto').DataTable();
                            tablaPrincipal.draw();
                            $('#frmverfoto').modal('hide');
                        })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#frmverfoto').modal('show');
                }
            });
        },
    }
});

// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-vehiculo').DataTable({
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
            { data: 'placa', name: 'placa', title: 'Placa', orderable: true, searchable: true },
            { data: 'vehiculo', name: 'vehiculo', title: 'Vehiculo', orderable: true, searchable: true },
            { data: 'cod_vehiculo', name: 'cod_vehiculo', title: 'Codigo Vehiculo', orderable: true, searchable: true },
            { data: 'tara', name: 'tara', title: 'Tara', orderable: false, searchable: true },
            { data: 'gestion', name: 'gestion', title: 'Gestion', orderable: false, searchable: false },
            { data: 'observaciones', name: 'observaciones', title: 'Observaciones', orderable: false, searchable: false },
            { data: 'estado', name: 'estado', title: 'Estado', orderable: false, searchable: false },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showVehiculo(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#vehiculo-app',
    data: {
        errors: {},
        modelo: {},
        placa: {},
        cod_vehiculo: {},
        tara: {},
        observaciones: {},
        vehiculos: {},
        vehiculo: '',
        gestion: {},
        enlace: {},
        mensaje: {},
        editar: false
    },
    created: function () {
        // Ladda.bind('.ladda-button');
        axios
            .get(listar_vehiculo)
            .then(response => {
                this.vehiculos = response.data.data;
            });
    },
    methods: {
        showVehiculo(id) {
            axios
                .get(datos_vehiculo + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmvervehiculo').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createVehiculo() {
            vm.id = null;
            vm.placa = '';
            vm.cod_vehiculo = '';
            vm.vehiculo = '';
            vm.tara = '';
            vm.observaciones = '';
            vm.gestion = '';
            vm.estado = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmvehiculo').modal('show');
        },
        storeVehiculo() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                cod_vehiculo: vm.cod_vehiculo,
                placa: vm.placa,
                vehiculo: vm.vehiculo,
                gestion: vm.gestion,
                tara: vm.tara,
                observaciones: vm.observaciones,
            };
            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('archivo', vm.archivo);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }

            axios
                .post(guardar_vehiculo, modelo, {
                    headers: {
                        'Accept': 'application/json',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmvehiculo').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Sus datos de la Vehiculo se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-vehiculo').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_archivo(event) {
            vm.archivo = event.target.files[0];
        },
        editVehiculo(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_vehiculo + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.cod_vehiculo = temporal.cod_vehiculo;
                    vm.placa = temporal.placa;
                    vm.vehiculo = temporal.vehiculo;
                    vm.tara = temporal.tara;
                    vm.gestion = temporal.gestion;
                    vm.observaciones = temporal.observaciones;

                    $('#frmvehiculo').modal('show');
                    $('#frmvervehiculo').modal('hide');
                });
        },
        deleteVehiculo(id) {
            $('#frmvervehiculo').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar la vehiculo?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(eliminar_vehiculo + '/' + id)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-vehiculo').DataTable();
                            tablaPrincipal.draw();
                            $('#frmvervehiculo').modal('hide');
                        })
                }
            });
        },
        personalZafra(id) {
            $('#frmverzafra').modal('hide');
            swal({
                text: 'Deseas eliminar el vehiculo?',
                icon: 'warning',
                buttons: ['No', 'Si'],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(eliminar_vehiculo + '/' + id)
                        .then(response => {
                            swal(response.data.message, {icon: 'success'});
                            var tablaPrincipal = $('#tabla-vehiculo').DataTable();
                            tablaPrincipal.draw();
                        }).catch(error => {
                            swal(error.response.data.message, {
                            icon: 'error',
                        });
                    });
                } else {
                    swal('El vehiculo no fue eliminada');
                }
            });
        },
    }
});

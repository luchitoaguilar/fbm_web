// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-zafra').DataTable({
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
            { data: 'num_recibo', name: 'num_recibo', title: 'Numero de Recibo', orderable: true, searchable: true },
            { data: 'placa', name: 'placa', title: 'Cod. Vehiculo', orderable: true, searchable: true },
            { data: 'fecha_ingreso', name: 'fecha_ingreso', title: 'Fecha Ingreso', orderable: true, searchable: true },
            { data: 'peso_neto', name: 'peso_neto', title: 'Peso Neto', orderable: true, searchable: true },
            { data: 'observaciones', name: 'observaciones', title: 'Observaciones', orderable: false, searchable: true },
            { data: 'personal_zafra', name: 'personal_zafra', title: 'Personal Zafra', orderable: false, searchable: false },
            { data: 'estado', name: 'estado', title: 'Estado', orderable: false, searchable: false },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showZafra(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#zafra-app',
    data: {
        errors: {},
        modelo: {},
        fecha_ingreso: {},
        cod_vehiculo: {},
        peso_neto: {},
        observaciones: {},
        vehiculos: {},
        personal: {},
        num_recibo: '',
        tipo_cosecha: {},
        personal_zafra: [],
        total_zafra: '',
        total_personal_zafra: '',
        enlace: {},
        mensaje: {},
        editar: false
    },
    created: function () {
        // Ladda.bind('.ladda-button');
        axios
            .get(get_total_zafra)
            .then(response => {
                this.total_zafra = response.data.data;
            });
        axios
            .get(get_vehiculos)
            .then(response => {
                this.vehiculos = response.data.data;
            });
            axios
            .get(get_personal)
            .then(response => {
                this.personal = response.data.data;
            });
    },
    methods: {
        showZafra(id) {
            axios
                .get(datos_zafra + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmverzafra').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createZafra() {
            vm.id = null;
            vm.tipo_cosecha = '';
            vm.cod_vehiculo = '';
            vm.fecha_ingreso = '';
            vm.peso_neto = '';
            vm.observaciones = '';
            vm.tipo_cosecha = '';
            vm.num_recibo = '';
            vm.estado = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmzafra').modal('show');
        },
        storeZafra() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                cod_vehiculo: vm.cod_vehiculo,
                tipo_cosecha: vm.tipo_cosecha,
                fecha_ingreso: vm.fecha_ingreso,
                num_recibo: vm.num_recibo,
                peso_neto: vm.peso_neto,
                personal_zafra_id: vm.personal_zafra_id,
                observaciones: vm.observaciones,
            };
            if (vm.personal_zafra_id != null) vm.modelo.total_personal_zafra = vm.personal_zafra_id.length;
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
                .post(guardar_zafra, modelo, {
                    headers: {
                        'Accept': 'multipart/form-data',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    axios
                        .get(get_total_zafra)
                        .then(response => {
                            this.total_zafra = response.data.data;
                        });
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmzafra').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Sus datos de la ZAFRA se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-zafra').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_archivo(event) {
            vm.archivo = event.target.files[0];
        },
        editZafra(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_zafra + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.cod_vehiculo = temporal.idv;
                    vm.tipo_cosecha = temporal.tipo_cosecha;
                    vm.fecha_ingreso = temporal.fecha_ingreso;
                    vm.num_recibo = temporal.num_recibo;
                    vm.peso_neto = temporal.peso_neto;
                    vm.observaciones = temporal.observaciones;

                    $('#frmzafra').modal('show');
                    $('#frmverzafra').modal('hide');
                });
        },
        deleteZafra(id) {
            $('#frmverzafra').modal('hide');
            Swal.fire({
                title: 'Deseas eliminar la zafra?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(eliminar_zafra + '/' + id)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-zafra').DataTable();
                            tablaPrincipal.draw();
                            $('#frmverzafra').modal('hide');
                        })
                }
            });
        },
        personalZafra(id) {
            $('#frmverzafra').modal('hide');
            Swal.fire({
                title: 'Ingrese la cantidad de Personal de Zafreros',
                input: 'number',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Ingresar',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    vm.modelo = {
                        id: id,
                        personal_zafra: result.value,
                    };
                    axios.
                        post(personal_zafra, vm.modelo)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-zafra').DataTable();
                            tablaPrincipal.draw();
                            $('#frmverzafra').modal('hide');
                        })
                }
            });
        },
    }
});

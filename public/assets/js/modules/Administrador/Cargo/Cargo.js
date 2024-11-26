$(function () {
    var cargoTable = $('#tabla-cargo').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        responsive: true,
        ajax: {
            url: urlIndexCargo
        },
        deferRender: true,
        columns: [
            {
                data: 'id', width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            { data: 'ReparticionPadre', name: 'rp.Reparticion', title: 'Unidad / Direccion / Centro' },
            { data: 'Reparticion', name: 'rp1.Reparticion', title: 'Dependencia' },
            { data: 'Cargo', name: 'c.Cargo', title: 'Cargo' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showCargo(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lftip',
    });

    // $('#tabla-cargo tbody').on('click', 'tr', function () {
    //     var data = cargoTable.row( this ).data();
    //     vm.$options.methods.showCargo(data.id);
    // });
});

var vm = new Vue({
    el: '#cargo-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        cargo: {},
        unidades: {},
        dependencia: {},
        unidadSeleccionada: '',
        destino_edifSeleccionado: '',
    },
    watch: {
        destino_edifSeleccionado() {
            if (vm.destino_edifSeleccionado == null) {
                vm.unidades_padres = [];
                vm.unidad_padre_seleccionada = null;
            } else {
                vm.getListDependencias(vm.destino_edifSeleccionado);
            }
        },
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre);
        },
        getDependencias() {
            axios
            .get(listaReparticionesPadre)
                .then(result => {
                    response = result.data;
                    vm.unidades = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getListDependencias(id) {
            axios
                .get(listaReparticiones+ '/' + id)
                .then(response => {
                    this.dependencia = response.data.data;
                });
        },
        newCargo() {
            vm.cargo = {};
            this.getDependencias();
            $('#frmcargo').modal('show');
        },
        showCargo(id) {
            axios.post(urlShowCargo, { id: id, cargo: 6 })
                .then(result => {
                    response = result.data;
                    vm.cargo = response.data;
                    $('#frmvercargo').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editCargo() {
            this.getDependencias();
            $('#frmcargo').modal('show');
            $('#frmvercargo').modal('hide');
        },
        saveCargo() {
            if (vm.destino_edifSeleccionado != null) vm.cargo.Sigla = vm.destino_edifSeleccionado;
            axios.post(urlSaveCargo, vm.cargo)
                .then(result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmcargo').modal('hide');
                    var cargoTabla = $('#tabla-cargo').DataTable();
                    cargoTabla.draw();
                })
                .catch(error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteCargo() {
            Swal.fire({
                title: "Estas seguro que deseas eliminar el registro?",
                text: "Esta accion es irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            })
                .then((response) => {
                    if (response.isConfirmed) {
                        axios.post(urlDestroyCargo, { id: vm.cargo.id })
                            .then(result => {
                                response = result.data;
                                toastr.success(response.msg, 'Correcto!');
                                var cargoTabla = $('#tabla-cargo').DataTable();
                                cargoTabla.draw();
                                $('#frmvercargo').modal('hide');
                            })
                            .catch(error => {
                                console.log(error);
                            })
                    } else {

                    }
                });
        }
    },
    mounted() {
        this.getDependencias();
    }
});

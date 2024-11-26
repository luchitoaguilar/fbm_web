$(function () {
    var escalasalarialTable = $('#tabla-escala').DataTable({
        processing: true,
        deferRender: true,
        serverSide: true,
        responsive: true, autoWidth: false,
        order: [[0, 'asc']],
        ajax: {
            url: urlIndexEscalaSalarial
        },
        columns: [
            {data: 'id', name: 'd.id', orderable: false, searchable: false, visible: false},
            {
                data: 'id', width: '5%', searchable: false, targets: 0, title: 'Nº',
                render: function (data, type, full, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            {width: '30%', data: 'DenominacionPuesto', name: 'DenominacionPuesto', title: 'Denominacion Puesto'},
            {width: '10%', data: 'Salario', name: 'Salario', title: 'Salario'},
            {width: '10%', data: 'NivelSalarial', name: 'NivelSalarial', title: 'Nivel Salarial'},
            {width: '15%', data: 'Categoria', name: 'Categoria', title: 'Categoria'},
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showEscalaSalarial(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lftip',
    });

    // $('#tabla-escala tbody').on('click', 'tr', function () {
    //     var data = escalasalarialTable.row( this ).data();
    //     vm.$options.methods.showEscalaSalarial(data.id);
    // });
});

var vm = new Vue({
    el: '#escala-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        escalasalarial: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre);
        },
        newEscalaSalarial() {
            vm.escalasalarial = {};
            $('#frmescala').modal('show');
        },
        showEscalaSalarial(id) {
            axios.post(urlShowEscalaSalarial, {id: id, escalasalarial: 6})
                .then(result => {
                    response = result.data;
                    vm.escalasalarial = response.data;
                    $('#frmverescala').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editEscalaSalarial() {
            $('#frmescala').modal('show');
            $('#frmverescala').modal('hide');
        },
        saveEscalaSalarial() {
            axios.post(urlSaveEscalaSalarial, vm.escalasalarial)
                .then(result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmescala').modal('hide');
                    var escalasalarialTabla = $('#tabla-escala').DataTable();
                    escalasalarialTabla.draw();
                })
                .catch(error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteEscalaSalarial() {
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
                        axios.post(urlDestroyEscalaSalarial, {id: vm.escalasalarial.id})
                            .then(result => {
                                response = result.data;
                                toastr.success(response.msg, 'Correcto!');
                                var escalasalarialTabla = $('#tabla-escala').DataTable();
                                escalasalarialTabla.draw();
                                $('#frmverescala').modal('hide');
                            })
                            .catch(error => {
                                toastr.success(response.msg, 'Error!');
                            })
                    } else {
                        //swal("Your imaginary file is safe!");
                    }
                });
        }
    },
});

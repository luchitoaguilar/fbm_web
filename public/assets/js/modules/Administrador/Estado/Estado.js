$(function() {
    var estadoTable = $('#tabla-estado').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexEstado
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { width: '75%', data: 'Estado', name: 'Estado', title: 'Estado' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showEstado(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? val : '', true, false).draw();
                });
            });
        },
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
    });

    // $('#tabla-estado tbody').on('click', 'tr', function () {
    //     var data = estadoTable.row( this ).data();
    //     vm.$options.methods.showEstado(data.id);
    // });
});

var vm = new Vue({
    el: '#estado-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        estado: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newEstado () {
            vm.estado = {};
            $('#frmestado').modal('show');
        },
        showEstado (id) {
            axios.post( urlShowEstado, { id: id, estado: 6 })
                .then ( result => {
                        response = result.data;
                    vm.estado = response.data;
                    $('#frmverestado').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editEstado () {
            $('#frmestado').modal('show');
            $('#frmverestado').modal('hide');
        },
        saveEstado () {
            axios.post( urlSaveEstado, vm.estado)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmestado').modal('hide');
                    var estadoTabla = $('#tabla-estado').DataTable();
                    estadoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.responde.data.errors;
                });
        },
        deleteEstado () {
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
                    axios.post( urlDestroyEstado, {id : vm.estado.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var estadoTabla = $('#tabla-estado').DataTable();
                            estadoTabla.draw();
                            $('#frmverestado').modal('hide');
                        })
                        .catch( error => {
                            console.log ( error );
                        })
                } else {
                  //swal("Your imaginary file is safe!");
                }
              });
        }
    },
});

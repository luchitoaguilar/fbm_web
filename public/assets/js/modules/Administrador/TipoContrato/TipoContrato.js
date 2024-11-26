$(function() {
    var tipocontratoTable = $('#tabla-tipocontrato').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        responsive:true,
        ajax: {
            url: urlIndexTipoContrato
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { data: 'id', width: '5px', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { data: 'TipoContrato', name: 'TipoContrato', title: 'Tipo Contrato' },
            { data: 'Descripcion', name: 'Descripcion', title: 'Descripción' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showTipoContrato(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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
        language: { "url": "/lang/datatables.es.json" },
        dom: 'lftip',
    });

    $('#tabla-tipocontrato tbody').on('click', 'tr', function () {
        var data = tipocontratoTable.row( this ).data();
        vm.$options.methods.showTipoContrato(data.id);
    });
});

var vm = new Vue({
    el: '#tipocontrato-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        tipocontrato: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newTipoContrato () {
            vm.tipocontrato = {};
            $('#frmtipocontrato').modal('show');
        },
        showTipoContrato (id) {
            axios.post( urlShowTipoContrato, { id: id, tipocontrato: 6 })
                .then ( result => {
                        response = result.data;
                    vm.tipocontrato = response.data;
                    $('#frmvertipocontrato').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editTipoContrato () {
            $('#frmtipocontrato').modal('show');
            $('#frmvertipocontrato').modal('hide');
        },
        saveTipoContrato () {
            axios.post( urlSaveTipoContrato, vm.tipocontrato)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmtipocontrato').modal('hide');
                    var tipocontratoTabla = $('#tabla-tipocontrato').DataTable();
                    tipocontratoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteTipoContrato () {
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
                        axios.post( urlDestroyTipoContrato, {id : vm.tipocontrato.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var tipocontratoTabla = $('#tabla-tipocontrato').DataTable();
                            tipocontratoTabla.draw();
                            $('#frmvertipocontrato').modal('hide');
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

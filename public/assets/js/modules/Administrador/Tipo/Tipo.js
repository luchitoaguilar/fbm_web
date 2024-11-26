$(function() {
    var tipodocumentoTabla = $('#tabla-tipo').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexTipoDocumento
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { width: '75%', data: 'Tipo', name: 'Tipo', title: 'Tipo' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showTipoDocumento(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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

    // $('#tabla-tipo tbody').on('click', 'tr', function () {
    //     var data = tipodocumentoTable.row( this ).data();
    //     vm.$options.methods.showTipoDocumento(data.id);
    // });
});

var vm = new Vue({
    el: '#tipo-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        tipodocumento: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newTipoDocumento () {
            vm.tipodocumento = {};
            $('#frmtipo').modal('show');
        },
        showTipoDocumento (id) {
            axios.post( urlShowTipoDocumento, { id: id, tipodocumento: 6 })
                .then ( result => {
                        response = result.data;
                    vm.tipodocumento = response.data;
                    $('#frmvertipo').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editTipoDocumento () {
            $('#frmtipo').modal('show');
            $('#frmvertipo').modal('hide');
        },
        saveTipoDocumento () {
            axios.post( urlSaveTipoDocumento, vm.tipodocumento)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmtipo').modal('hide');
                    var tipodocumentoTabla = $('#tabla-tipo').DataTable();
                    tipodocumentoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteTipoDocumento () {
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
                    axios.post( urlDestroyTipoDocumento, {id : vm.tipodocumento.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var tipodocumentoTabla = $('#tabla-tipo').DataTable();
                            tipodocumentoTabla.draw();
                            $('#frmvertipo').modal('hide');
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

$(function() {
    var tipoparentescoTable = $('#tabla-parentesco').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: urlIndexTipoParentesco
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { data: 'id',width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { data: 'TipoParentesco', name: 'TipoParentesco', title: 'Tipo Parentesco' },
            { data: 'Descripcion', name: 'Descripcion', title: 'Descripción' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showTipoParentesco(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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

    $('#tabla-parentesco tbody').on('click', 'tr', function () {
        var data = tipoparentescoTable.row( this ).data();
        vm.$options.methods.showTipoParentesco(data.id);
    });
});

var vm = new Vue({
    el: '#tipoparentesco-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        tipoparentesco: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newTipoParentesco () {
            vm.tipoparentesco = {};
            $('#frmparentesco').modal('show');
        },
        showTipoParentesco (id) {
            axios.post( urlShowTipoParentesco, { id: id, tipoparentesco: 6 })
                .then ( result => {
                        response = result.data;
                    vm.tipoparentesco = response.data;
                    $('#frmverparentesco').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editTipoParentesco () {
            $('#frmparentesco').modal('show');
            $('#frmverparentesco').modal('hide');
        },
        saveTipoParentesco () {
            axios.post( urlSaveTipoParentesco, vm.tipoparentesco)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmparentesco').modal('hide');
                    var tipoparentescoTabla = $('#tabla-parentesco').DataTable();
                    tipoparentescoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteTipoParentesco () {
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
                    axios.post( urlDestroyTipoParentesco, {id : vm.tipoparentesco.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var tipoparentescoTabla = $('#tabla-parentesco').DataTable();
                            tipoparentescoTabla.draw();
                            $('#frmverparentesco').modal('hide');
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

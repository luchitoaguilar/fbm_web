$(function() {
    var unidadTable = $('#unidad-table').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexUnidad
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { width: '5px', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { data: 'Unidad', name: 'Unidad', title: 'Unidad / Empresa / Centro' },
            { data: 'Sigla', name: 'Sigla', title: 'Sigla' },
            { data: 'action', name: 'action', title: 'Opciones', orderable: false, searchable: false },
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

    $('#unidad-table tbody').on('click', 'tr', function () {
        var data = unidadTable.row( this ).data();
        vm.$options.methods.showUnidad(data.id);
    });
});

var vm = new Vue({
    el: '#unidad-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        unidad: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newUnidad () {
            vm.unidad = {};
            $('#frm-unidad').modal('show');
        },
        showUnidad (id) {
            axios.post( urlShowUnidad, { id: id, unidad: 6 })
                .then ( result => {
                        response = result.data;
                    vm.unidad = response.data;
                    $('#view-unidad').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editUnidad () {
            $('#frm-unidad').modal('show');
            $('#view-unidad').modal('hide');
        },
        saveUnidad () {
            axios.post( urlSaveUnidad, vm.unidad)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frm-unidad').modal('hide');
                    var unidadTabla = $('#unidad-table').DataTable();
                    unidadTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.data.errors;
                });
        },
        deleteUnidad () {
            // axios.post( urlDestroyConsulta, {id : vm.consulta.id} )
            //     .then( result => {
            //         response = result.data;
            //         toastr.success(response.msg, 'Correcto!');
            //         var consultaTabla = $('#consulta-table').DataTable();
            //         consultaTabla.draw();
            //         $('#view-consulta').modal('hide');
            //     })
            //     .catch( error => {
            //         console.log ( error );
            //     })
            //$('#view-consulta').modal('hide');
            swal({
                title: "Estas seguro que deseas eliminar?",
                text: "Esta accion es irreversible!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                    axios.post( urlDestroyUnidad, {id : vm.unidad.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var unidadTabla = $('#unidad-table').DataTable();
                            unidadTabla.draw();
                            $('#view-unidad').modal('hide');
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
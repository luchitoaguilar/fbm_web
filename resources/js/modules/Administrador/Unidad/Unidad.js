$(function() {
    var unidadTable = $('#tabla-unidad').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: urlIndexUnidad
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { data: 'id',width: '5px', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { data: 'Unidad', name: 'Unidad', title: 'Unidad / Empresa / Centro' },
            { data: 'Sigla', name: 'Sigla', title: 'Sigla' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showUnidad(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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
        dom: 'lftip',
    });

    // $('#tabla-unidad tbody').on('click', 'tr', function () {
    //     var data = unidadTable.row( this ).data();
    //     vm.$options.methods.showUnidad(data.id);
    // });
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
            $('#frmunidad').modal('show');
        },
        showUnidad (id) {
            axios.post( urlShowUnidad, { id: id, unidad: 6 })
                .then ( result => {
                        response = result.data;
                    vm.unidad = response.data;
                    $('#frmverunidad').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editUnidad () {
            $('#frmunidad').modal('show');
            $('#frmverunidad').modal('hide');
        },
        saveUnidad () {
            axios.post( urlSaveUnidad, vm.unidad)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmunidad').modal('hide');
                    var unidadTabla = $('#tabla-unidad').DataTable();
                    unidadTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
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
                    axios.post( urlDestroyUnidad, {id : vm.unidad.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var unidadTabla = $('#tabla-unidad').DataTable();
                            unidadTabla.draw();
                            $('#frmverunidad').modal('hide');
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

$(function() {
    var gradoTable = $('#tabla-grado').DataTable({
        processing: true,
        order: [[0, 'asc']],
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: urlIndexGrado
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { data: 'id', width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { data: 'Grado', name: 'Grado', title: 'Grado' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showGrado(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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

    // $('#tabla-grado tbody').on('click', 'tr', function () {
    //     var data = gradoTable.row( this ).data();
    //     vm.$options.methods.showGrado(data.id);
    // });
});

var vm = new Vue({
    el: '#grado-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        grado: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newGrado () {
            vm.grado = {};
            $('#frmgrado').modal('show');
        },
        showGrado (id) {
            axios.post( urlShowGrado, { id: id, grado: 6 })
                .then ( result => {
                        response = result.data;
                    vm.grado = response.data;
                    $('#frmvergrado').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editGrado () {
            $('#frmgrado').modal('show');
            $('#frmvergrado').modal('hide');
        },
        saveGrado () {
            axios.post( urlSaveGrado, vm.grado)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmgrado').modal('hide');
                    var gradoTabla = $('#tabla-grado').DataTable();
                    gradoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteGrado () {
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
                    axios.post( urlDestroyGrado, {id : vm.grado.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var gradoTabla = $('#tabla-grado').DataTable();
                            gradoTabla.draw();
                            $('#frmvergrado').modal('hide');
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

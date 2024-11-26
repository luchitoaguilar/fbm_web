$(function() {
    var nivelacademicoTable = $('#tabla-nivel').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: urlIndexNivelAcademico
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { width: '5%', data: 'id', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { data: 'Nivel', name: 'Nivel', title: 'Nivel' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showNivelAcademico(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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

    // $('#tabla-nivel tbody').on('click', 'tr', function () {
    //     var data = nivelacademicoTable.row( this ).data();
    //     vm.$options.methods.showNivelAcademico(data.id);
    // });
});

var vm = new Vue({
    el: '#nivel-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        nivelacademico: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newNivelAcademico () {
            vm.nivelacademico = {};
            $('#frmnivel').modal('show');
        },
        showNivelAcademico (id) {
            axios.post( urlShowNivelAcademico, { id: id, nivelacademico: 6 })
                .then ( result => {
                        response = result.data;
                    vm.nivelacademico = response.data;
                    $('#frmvernivel').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editNivelAcademico () {
            $('#frmnivel').modal('show');
            $('#frmvernivel').modal('hide');
        },
        saveNivelAcademico () {
            axios.post( urlSaveNivelAcademico, vm.nivelacademico)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmnivel').modal('hide');
                    var nivelacademicoTabla = $('#tabla-nivel').DataTable();
                    nivelacademicoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteNivelAcademico () {
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
                    axios.post( urlDestroyNivelAcademico, {id : vm.nivelacademico.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var nivelacademicoTabla = $('#tabla-nivel').DataTable();
                            nivelacademicoTabla.draw();
                            $('#frmvernivel').modal('hide');
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

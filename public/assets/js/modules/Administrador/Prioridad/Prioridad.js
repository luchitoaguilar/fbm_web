$(function() {
    var prioridadTable = $('#tabla-prioridad').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexPrioridad
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false , visible: false},
            { width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { width: '75%', data: 'Prioridad', name: 'Prioridad', title: 'Prioridad' },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showPrioridad(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
    });

    // $('#tabla-prioridad tbody').on('click', 'tr', function () {
    //     var data = prioridadTable.row( this ).data();
    //     vm.$options.methods.showPrioridad(data.id);
    // });
});

var vm = new Vue({
    el: '#prioridad-app',
    data: {
        errorBag: {},
        isLoading: false,
        prioridad: {},
    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        newPrioridad () {
            vm.prioridad = {};
            $('#frmprioridad').modal('show');
        },
        showPrioridad (id) {
            axios.post( urlShowPrioridad, { id: id, prioridad: 6 })
                .then ( result => {
                        response = result.data;
                    vm.prioridad = response.data;
                    $('#frmverprioridad').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editPrioridad () {
            $('#frmprioridad').modal('show');
            $('#frmverprioridad').modal('hide');
        },
        savePrioridad () {
            axios.post( urlSavePrioridad, vm.prioridad)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmprioridad').modal('hide');
                    var prioridadTabla = $('#tabla-prioridad').DataTable();
                    prioridadTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deletePrioridad () {
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
                    axios.post( urlDestroyPrioridad, {id : vm.prioridad.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');

                            $prioridadTabla = $('#tabla-prioridad').DataTable();
                            $prioridadTabla.ajax.reload();
                            $('#frmverprioridad').modal('hide');
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

$(function() {
    var documentoTable = $('#tabla-documento').DataTable({
        processing: true,
        order: [[1, 'asc']],
        serverSide: true,
        ajax: {
            url: urlIndexDocumento
        },
        deferRender: true,
        columns: [
            { data: 'id', name: 'd.id', orderable: false, searchable: false , visible: false},
            { width: '5%', searchable: false, targets: 0, title: 'Nº', render: function (data, type, full, meta) {
                return meta.settings._iDisplayStart + meta.row + 1;}},
            { width: '10%', data: 'Tipo', name: 't.Tipo', title: 'Tipo Documento' },
            { width: '10%', data: 'Prioridad', name: 'p.Prioridad', title: 'Sección' },
            { width: '35%', data: 'Nombre', name: 'd.Nombre', title: 'Nombre' },
            { width: '25%', data: 'Descripcion', name: 'd.Descripcion', title: 'Descripción' },
            { width: '10%', data: 'Activo', name: 'd.Activo', title: 'Activo', className: 'centradito', render:function(data, type, row){
                if (!row.Activo){
                    return '<i class="fa fa-ban text-danger"></i>';
                }
                else{
                    return '<i class="fa fa-check text-success"></i>';
                }
            } },
            {
                width: '5%',title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showDocumento(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
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
        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
        lengthMenu: [[10, 25, 50, -1],[10, 25, 50, "Todo"]]
    });

    $('#tabla-documento tbody').on('click', 'tr', function () {
        var data = documentoTable.row( this ).data();
        vm.$options.methods.showDocumento(data.id);
    });
});

var vm = new Vue({
    el: '#documento-app',
    data: {
        //accounting: accounting,
        //auth: auth,
        errorBag: {},
        isLoading: false,
        //consultas: {},
        documento: {},
        prioridad: {},
        tipodoc: {},

    },
    methods: {
        ejecutar() {
            alert('Hola' + vm.nombre );
        },
        getTipo () {
            axios.get( urlListTipoDocumento )
                .then( result => {
                    response = result.data;
                    vm.tipodoc = response.data;
                    console.log('tipo: ',response);

                })
                .catch( error => {
                    console.log( error );
                })
        },
        getPrioridad () {
            axios.get( urlListPrioridad )
                .then( result => {
                    response = result.data;
                    vm.prioridad = response.data;
                })
                .catch( error => {
                    console.log( error );
                })
        },
        newDocumento () {
            this.getPrioridad();
            this.getTipo();
            vm.documento = {};
            $('#frmdocumento').modal('show');
        },
        showDocumento (id) {
            axios.post( urlShowDocumento, { id: id, documento: 6 })
                .then ( result => {
                        response = result.data;
                        console.log(response);
                    vm.documento = response.data;
                    $('#frmverdocumento').modal('show');
                })
                .catch ( error => {
                    console.log( error );
                });
        },
        editDocumento () {
            this.getPrioridad();
            this.getTipo();
            $('#frmdocumento').modal('show');
            $('#frmverdocumento').modal('hide');
        },
        saveDocumento () {
            axios.post( urlSaveDocumento, vm.documento)
                .then ( result => {
                    response = result.data;
                    toastr.success(response.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmdocumento').modal('hide');
                    var documentoTabla = $('#tabla-documento').DataTable();
                    documentoTabla.draw();
                })
                .catch( error => {
                    vm.errorBag = error.response.data.errors;
                });
        },
        deleteDocumento () {
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
                    axios.post( urlDestroyDocumento, {id : vm.documento.id} )
                        .then( result => {
                            response = result.data;
                            toastr.success(response.msg, 'Correcto!');
                            var documentoTabla = $('#tabla-documento').DataTable();
                            documentoTabla.draw();
                            $('#frmverdocumento').modal('hide');
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
    mounted () {
        this.getPrioridad();
        this.getTipo();
    }
});

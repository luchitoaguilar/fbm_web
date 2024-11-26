$(function () {
    var tablaPrincipal = $('#tabla-usuario').DataTable({
        processing: true,
        order: [[1, 'asc']],
        deferRender: true,
        serverSide: true,
        responsive: true, autoWidth: false,
        ajax: {
            url: lista_usuarios,
            // headers: {
            //     'Accept' : 'application/json',
            //     'Seosoft' : $('meta[name="luchito"]').attr('content')
            // }
        },
        columnDefs: [
            // { className: "text-center", targets: "_all" },
            // { className: "align-middle", targets: "_all" },
            // { className: "text-center", targets: [7] },
        ],
        columns: [
            {data: 'id', name: 'id', title: 'Id', visible: true},
            {data: 'ApellidoPaterno', name: 'ApellidoPaterno', title: 'Ap. Paterno', orderable: true, searchable: true},
            {data: 'ApellidoMaterno', name: 'ApellidoMaterno', title: 'Ap. Materno', orderable: true, searchable: true},
            {data: 'Nombres', name: 'Nombres', title: 'Nombres', orderable: true, searchable: true},
            {data: 'CI', name: 'CI', title: 'CI', orderable: true, searchable: true},
            {data: 'TipoContrato', name: 'TipoContrato', title: 'Tipo Contrato', orderable: true, searchable: true},
            {data: 'email', name: 'email', title: 'Correo Corporativo', orderable: true, searchable: true},
        ],
        // lengthMenu: [8, 50, 75, 100, 150, 200],
        language: {'url': ruta_tabla_traduccion},
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#content',
    data: {
        errors: {},
        modelo: {},
        tipo_contrato: {},
        editar: false
    },
    created: function () {
        // Ladda.bind('.ladda-button');

        axios
            .get(lista_tipo_contrato)
            .then(response => {
                this.tipo_contrato = response.data
            });
    },
    methods: {
        verDetalle(id) {
            console.log(id);
        },
    }
});

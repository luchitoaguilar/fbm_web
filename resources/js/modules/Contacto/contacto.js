// $(".default-select2").select2();

$(function () {
    var tablaPrincipal = $('#tabla-contacto').DataTable({
        order: [[1, 'asc']],
        processing: true,
        deferRender: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: 'listar'
        },
        columnDefs: [
            {
                targets:1, 
                render:function(data){
                    return moment(data).format('D-M-YYYY');
                }
            }
        ],
        columns: [
            { data: 'id', name: 'id', visible: false },
            { data: 'fecha_creado', name: 'fecha_creado', title: 'Fecha', orderable: true, searchable: true },
            { data: 'nombre', name: 'nombre', title: 'Nombre', orderable: true, searchable: true },
            { data: 'email', name: 'email', title: 'Email', orderable: true, searchable: true },
            { data: 'telefono', name: 'telefono', title: 'Telefono', orderable: true, searchable: true },
            { data: 'asunto', name: 'asunto', title: 'Asunto', orderable: true, searchable: true },
            { data: 'mensaje', name: 'mensaje', title: 'Mensaje', orderable: false, searchable: true },
            { data: 'estado', name: 'personas.estado', title: 'Estado', orderable: false, searchable: false },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showContacto(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#contacto-app',
    data: {
        errors: {},
        modelo: {},
        reply: {},
        nombre: {},
        email: {},
        telefono: {},
        asunto: {},
        mensaje: {},
        editar: false
    },
    created: function () {
        this.id = null;
        this.nombre = '';
        this.telefono = '';
        this.asunto = '';
        this.email = '';
        this.mensaje = '';
        this.editar = false;
        this.errors = {};
    },
    methods: {
        showContacto(id) {
            vm.usuario = {
                rol: {},
                persona: {},
                cargo: {},
            };
            axios
                .get(datos_contacto + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data
                    $('#frmvercontacto').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        createContacto() {
            vm.id = null;
            vm.nombre = '';
            vm.telefono = '';
            vm.asunto = '';
            vm.email = '';
            vm.mensaje = '';
            vm.editar = false;
            vm.errors = {};
        },
        storeContacto() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombre: vm.nombre,
                telefono: vm.telefono,
                email: vm.email,
                asunto: vm.asunto,
                mensaje: vm.mensaje,
            };

            axios
                .post(guardar_contacto, vm.modelo)
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Su mensaje se ha enviado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    vm.id = null;
                    vm.nombre = '';
                    vm.telefono = '';
                    vm.asunto = '';
                    vm.email = '';
                    vm.mensaje = '';
                    vm.editar = false;
                    vm.errors = {};
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        replyContacto(id) {
            $('#frmvercontacto').modal('hide');
            Swal.fire({
                title: 'Deseas responder la consulta ?',
                text: "No se puede deshacer esta accion!",
                icon: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.value) {
                    vm.reply = {
                        id: id,
                        msg: result.value,
                    };
                    axios.post(reply_contacto, vm.reply)
                        .then(response => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.data.mensaje,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            var tablaPrincipal = $('#tabla-producto').DataTable();
                            tablaPrincipal.draw();
                            $('#frmvergrado').modal('hide');
                        })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Hubo algun problema, contactese con el administrador de la UTIC',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#frmverproducto').modal('show');
                }
            });
        }
    }
});

$(".default-select2").select2();

$(function() {
    var tablaPrincipal = $('#tabla-usuario').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        autoWidth: false,
        ajax: {
            url: lista_usuarios
        },
        columnDefs: [
            // { className: "text-center", targets: "_all" },
            // { className: "align-middle", targets: "_all" },
            // { className: "text-center", targets: [7] },
        ],
        columns: [
            {data: 'id', name: 'usuarios.id', visible: false},
            {data: 'usuario', name: 'usuarios.usuario', title: titulo1, orderable: true, searchable: true},
            {data: 'ApellidoPaterno', name: 'Persona.ApellidoPaterno', title: titulo2, orderable: true, searchable: true},
            {data: 'ApellidoMaterno', name: 'Persona.ApellidoMaterno', title: titulo3, orderable: true, searchable: true},
            {data: 'Nombres', name: 'Persona.Nombres', title: titulo4, orderable: true, searchable: true},
            {data: 'Rol', name: 'Rol.Rol', title: titulo5, orderable: true, searchable: true},
            {data: 'Cargo', name: 'Cargo.Cargo', title: titulo6, orderable: true, searchable: true},
            {data: 'TipoRol', name: 'TipoRol.TipoRol', title: 'Tipo Rol', orderable: true, searchable: true },
            {data: 'Sistema', name: 'Sistema.Sistema', title: 'Sistema', orderable: true, searchable: true },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showUsuario(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        order: [
            [6, 'desc'],
            [3, 'asc'],
            [4, 'asc'],
            [5, 'asc'],
            // [7, 'asc'],
        ],
        lengthMenu: [8, 50, 75, 100, 150, 200],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#usuario-app',
    data: {
        errors: {},
        modelo: {},
        campo_usuario: '',
        usuario: {
            persona: {},
            rol: {},
            cargo: {}
        },
        personas: [],
        personaSeleccionada: '',
        roles: [],
        rolSeleccionado: '',
        cargos: [],
        cargoSeleccionado: '',
        sistemas: [],
        sistemaSeleccionado: '',
        tipo_roles: [],
        tipoRolSeleccionado: '',
        editar: false
    },
    created: function () {
        axios
            .get(lista_roles)
            .then(response => {
                this.roles = response.data.data
            });
        axios
            .get(lista_cargos)
            .then(response => {
                this.cargos = response.data.data
            });
        axios
            .get(lista_sistemas)
            .then(response => {
                this.sistemas = response.data.data
            });
        axios
            .get(lista_tipo_roles)
            .then(response => {
                this.tipo_roles = response.data.data
            });
    },
    methods: {
        showUsuario(id) {
            vm.usuario = {
                rol: {},
                persona: {},
                cargo: {},
            };
            axios
                .get(datos_usuario + '/' + id)
                .then(response => {
                    vm.usuario = response.data.data
                    $('#frmverusuario').modal('show');
                }).catch(error => {
                Swal.fire(error.response.data.message, {icon: 'error'});
            });
        },
        createUsuario() {
            vm.id = null;
            vm.campo_usuario = '';
            vm.personaSeleccionada = '';
            vm.rolSeleccionado = '';
            vm.cargoSeleccionado = '';
            vm.sistemaSeleccionado = '';
            vm.tipoRolSeleccionado = '';
            vm.personas = [];
            vm.editar = false;
            vm.errors = {};
            $('#frmusuario').modal('show');
        },
        buscarPersona(search, loading) {
            if (search.length) {
                loading(true);
                vm.search(loading, search, vm);
            }
        },
        storeUsuario() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                usuario: vm.campo_usuario,
            };
            if (vm.personaSeleccionada != null) vm.modelo.persona_id = vm.personaSeleccionada.id;
            if (vm.rolSeleccionado != null) vm.modelo.rol_id = vm.rolSeleccionado.id;
            if (vm.cargoSeleccionado != null) vm.modelo.cargo_id = vm.cargoSeleccionado.id;
            if (vm.sistemaSeleccionado != null) vm.modelo.sistema_id = vm.sistemaSeleccionado.id;
            if (vm.tipoRolSeleccionado != null) vm.modelo.tipo_rol_id = vm.tipoRolSeleccionado.id;

            console.log(vm.modelo);
            // let l = $('.ladda-button-guardar').ladda();
            // l.ladda('start');
            axios
                .post(guardar_usuario, vm.modelo)
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmusuario').modal('hide');
                    swal(response.data.message, {icon: 'success'});
                    var tablaPrincipal = $('#tabla-usuario').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    if (error.response.data.mostrar_mensaje) swal(error.response.data.message, {icon: 'error'});
                    if (! error.response.data.mostrar_formulario) $('#frmusuario').modal('hide');
                }).finally(() => {
                    l.ladda('stop');
                });
        },
        editUsuario(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_usuario + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.campo_usuario = temporal.usuario;
                    vm.personaSeleccionada = {
                        id: temporal.persona.id,
                        nombres: temporal.persona.paterno + ' ' + temporal.persona.materno + ' ' + temporal.persona.nombres
                    };
                    vm.rolSeleccionado = {
                        id: temporal.rol.id,
                        rol: temporal.rol.rol
                    };
                    vm.cargoSeleccionado = {
                        id: temporal.cargo.id,
                        cargo: temporal.cargo.cargo
                    };
                    $('#formulario').modal({keyboard: true, backdrop: 'static'});
                });
        },
        deleteUsuario(id) {
            swal({
                text: 'Deseas eliminar al usuario?',
                icon: 'warning',
                buttons: ['No', 'Si'],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(eliminar_usuario + '/' + id)
                        .then(response => {
                            swal(response.data.message, {icon: 'success'});
                            var tablaPrincipal = $('#tabla-contenido').DataTable();
                            tablaPrincipal.draw();
                        }).catch(error => {
                            swal(error.response.data.message, {
                            icon: 'error',
                        });
                    });
                } else {
                    swal('El usuario no fue eliminada');
                }
            });
        },
        search: _.debounce((loading, search, vm) => {
            axios
                .get(lista_personas + '?buscar=' + search)
                .then(response => {
                    vm.personas = response.data.data;
                }).catch(error => {
                vm.errors = error.response.data;
            }).finally(() => {
                loading(false);
            });
        }, 500)
    }
});

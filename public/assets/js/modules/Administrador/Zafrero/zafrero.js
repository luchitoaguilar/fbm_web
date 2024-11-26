$(function () {
    var personaTabla = $('#tabla-zafrero').DataTable({
        processing: true,
        deferRender: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: listar_zafrero,
        },
        columns: [
            { data: 'id', name: 'id', orderable: false, searchable: false, visible: false },
            { data: 'foto', name: 'zafrero.foto', title: 'Foto', orderable: false },
            { data: 'paterno', name: 'zafrero.paterno', title: 'Ap. Paterno', orderable: true, searchable: true },
            { data: 'materno', name: 'zafrero.materno', title: 'Ap. Materno', orderable: true, searchable: true },
            { data: 'nombres', name: 'zafrero.nombres', title: 'Nombres', orderable: true, searchable: true },
            { data: 'ci', name: 'zafrero.ci', title: 'CI', orderable: true, searchable: true },
            { data: 'complemento', name: 'zafrero.complemento', title: 'Complemento', orderable: true, searchable: true },
            { data: 'telefono', name: 'zafrero.telefono', title: 'Telefono', orderable: true, searchable: true },
            { data: 'departamento', name: 'nacimiento.departamento', title: 'Lugar Nacimiento', orderable: true, searchable: true },
            { data: 'fecha_nacimiento', name: 'zafrero.fecha_nacimiento', title: 'Fecha Nacimiento', orderable: true, searchable: true },
            { data: 'estado', name: 'zafrero.estado', title: 'Estado', orderable: false, searchable: false },
            {
                title: 'Opciones', searchable: false, orderable: false, data: function (row, type, set) {
                    return `<a onclick="vm.$options.methods.showZafrero(${row.id})" class="btn btn-outline-info btn-xs"><i class="fa fa-bars"></i> Detalles</a>`;
                }
            },
        ],
        language: { 'url': ruta_tabla_traduccion },
        dom: 'lfiptip',
    });
});

var vm = new Vue({
    el: '#zafrero-app',
    data: {
        auth: auth,
        errorBag: {},
        isLoading: false,
        isLoadingFile: false,
        modelo: {},
        roles: {},
        isEditing: false,
        password: {},
        arroba: true,
        nombres : '',
        paterno : '',
        materno : '',
        ci : '',
        complemento : '',
        fecha_nacimiento : '',
        lugar_nacimiento_id : '',
        expedido_id : '',
        telefono: '',
        lugarNacimiento: [],
        lugarExpedido: [],
    },
    created: function () {
        // Ladda.bind('.ladda-button');
        axios
            .get(lugar_nacimiento)
            .then(response => {
                this.lugarNacimiento = response.data.data;
            });
        axios
            .get(expedido)
            .then(response => {
                this.lugarExpedido = response.data.data;
            });
    },
    methods: {
        getListCargo(id) {
            axios
                .get(getListCargo + '/' + id)
                .then(response => {
                    this.cargos = response.data.data;
                });
        },
        newZafrero() {
            vm.id = null;
            vm.nombres = '';
            vm.paterno = '';
            vm.materno = '';
            vm.ci = '';
            vm.telefono = '';
            vm.complemento = '';
            vm.fecha_nacimiento = '';
            vm.lugar_nacimiento_id = '';
            vm.expedido_id = '';
            vm.editar = false;
            vm.errors = {};
            $('#frmzafrero').modal('show');
        },
        showZafrero(id) {
            axios.get(datos_zafrero + '/' + id)
                .then(response => {
                    vm.modelo = response.data.data;

                    $('#frmverzafrero').modal('show');
                }).catch(error => {
                    Swal.fire(error.response.data.message, { icon: 'error' });
                });
        },
        cambiopassword(id) {
            $('#frmverzafrero').modal('hide');
            $('#frmverpassword').modal('show');
        },
        changePassword() {
            vm.password.Persona = vm.persona.id;
            axios.post(urlChangePasswordPersona, vm.password)
                .then(response => {
                    if (response.data.success) {
                        toastr.success(response.data.msg, 'Correcto!');
                        $('#frmverpassword').modal('hide');
                        $('#frmverzafrero').modal('show');
                    } else {
                        toastr.error(response.msg, 'Oops!');
                    }
                })
                .catch(error => {
                    toastr.error('Error al guardar el registro', 'Oops!');
                    vm.errorBag = error.response.data.errors;
                })
        },
        editZafrero(id) {
            var temporal;
            vm.editar = true;
            vm.errors = {};
            axios
                .get(datos_zafrero + '/' + id)
                .then(response => {
                    temporal = response.data.data;
                    vm.id = temporal.id;
                    vm.nombres = temporal.nombres;
                    vm.paterno = temporal.paterno;
                    vm.materno = temporal.materno;
                    vm.ci = temporal.ci;
                    vm.telefono = temporal.telefono;
                    vm.complemento = temporal.complemento;
                    vm.expedido_id = temporal.expedido.id;
                    vm.fecha_nacimiento = temporal.fecha_nacimiento;
                    vm.lugar_nacimiento_id = temporal.lugar_nacimiento.id;
                    vm.observaciones = temporal.observaciones;

                    $('#frmzafrero').modal('show');
                    $('#frmverzafrero').modal('hide');
                });
        },
        storeZafrero() {
            vm.errors = {};
            vm.modelo = {
                id: vm.id,
                nombres: vm.nombres,
                paterno: vm.paterno,
                materno: vm.materno,
                ci: vm.ci,
                telefono: vm.telefono,
                fecha_nacimiento: vm.fecha_nacimiento,
                lugar_nacimiento_id: vm.lugar_nacimiento_id,
                complemento: vm.complemento,
                expedido_id: vm.expedido_id,
            };
            //inicializamos una variable tipo FormData para las imagenes
            const modelo = new FormData();
            modelo.append('foto', vm.foto);
            //recorremos y asignamos todas las variables incluyendo las de tipo File al modelo
            for (let key in vm.modelo) {
                Array.isArray(vm.modelo[key]) ?
                    vm.modelo[key].forEach(value => modelo.append(key + '[]', value)) :
                    modelo.append(key, vm.modelo[key]);
            }

            axios
                .post(guardar_zafrero, modelo, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    $('#frmzafrero').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Los datos de la Zafrero se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var tablaPrincipal = $('#tabla-zafrero').DataTable();
                    tablaPrincipal.draw();
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                })

        },
        //los dos funcionan para recuperar los datos del archivo File y las asignamos a las variables
        select_foto(event) {
            vm.foto = event.target.files[0];
        },
        deleteZafrero(id) {
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
                        axios
                            .delete(eliminar_zafrero + '/' + id)
                            .then(response => {
                                if (response.data.success) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: response.data.mensaje,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    var personaTabla = $('#tabla-zafrero').DataTable();
                                    personaTabla.draw();
                                    $('#frmverzafrero').modal('hide');
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: response.data.mensaje,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Hubo un problema, contactese con el administrador',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            })
                    }
                });
        },
        activateZafrero(id) {
            Swal.fire({
                title: "Estas seguro que deseas activar esta persona?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Activar'
            })
                .then((response) => {
                    if (response.isConfirmed) {
                        axios
                            .post(activar_zafrero + '/' + id)
                            .then(response => {
                                if (response.data.success) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: response.data.mensaje,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    var personaTabla = $('#tabla-zafrero').DataTable();
                                    personaTabla.draw();
                                    $('#frmverzafrero').modal('hide');
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: response.data.mensaje,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Hubo un problema, contactese con el administrador',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            })
                    }
                });
        },
    }
});

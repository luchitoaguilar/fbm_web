
var vm = new Vue({
    el: '#reporte-app',
    data: {
        auth: auth,
        errorBag: {},
        modelo: {},
        isEditing: false,
        password: {},
        arroba: true,
        fecha_inicio : '',
        fecha_fin : '',
        tipoReporte : '',
        personal: {},
    },
    created: function () {
        axios
            .get(get_personal)
            .then(response => {
                this.personal = response.data.data;
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
        reporteDiario() {
            if (vm.fecha_inicio && vm.fecha_fin && vm.tipoReporte) {
                vm.modelo = {
                    fecha_fin: vm.fecha_fin,
                    fecha_inicio: vm.fecha_inicio,
                    tipoReporte: vm.tipoReporte,
                };
                if(vm.tipoReporte == 'Diario'){
                    axios
                    .post(imprimir_reporte_diario, vm.modelo)
                    .then(response => {
                        Swal.fire('Su Reporte fue generado con exito..!!','No ve el archivo?...quizas tenga que autorizar las ventanas emergentes en este navegador',)
                        var url = response.data.data.url;

                        var a = document.createElement("a");
                        a.href = url;
                        a.target = "_blank";
                        a.click();
                        //swal(response.data.message, {icon: 'success'});
                    }).catch(error => {
                        Swal.fire('hubo un error al crear el archivo', { icon: 'error' });
                        // $('#frmverpersona').modal('show');
                    });
                }
                    

            } else {
                Swal.fire('Debe seleccionar todos los datos por favor')
            }

        },
        reporteDiarioZafrero() {
            if (vm.fecha_inicio && vm.fecha_fin && vm.tipoReporte && vm.personal_zafra_id) {
                vm.modelo = {
                    fecha_fin: vm.fecha_fin,
                    fecha_inicio: vm.fecha_inicio,
                    tipoReporte: vm.tipoReporte,
                    personal_zafra_id: vm.personal_zafra_id,
                };
                console.log(vm.modelo);
                if(vm.tipoReporte == 'Diario'){
                    axios
                    .post(imprimir_reporte_diario_zafrero, vm.modelo)
                    .then(response => {
                        Swal.fire('Su Reporte fue generado con exito..!!','No ve el archivo?...quizas tenga que autorizar las ventanas emergentes en este navegador',)
                        var url = response.data.data.url;

                        var a = document.createElement("a");
                        a.href = url;
                        a.target = "_blank";
                        a.click();
                        //swal(response.data.message, {icon: 'success'});
                    }).catch(error => {
                        Swal.fire('hubo un error al crear el archivo', { icon: 'error' });
                        // $('#frmverpersona').modal('show');
                    });
                }
                    

            } else {
                Swal.fire('Debe seleccionar todos los datos por favor')
            }

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
                        'Accept': 'multipart/form-data',
                        "Content-Type": "multipart/form-data",
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

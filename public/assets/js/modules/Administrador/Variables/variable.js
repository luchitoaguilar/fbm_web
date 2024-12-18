
var vm = new Vue({
    el: '#variables-app',
    data: {
        auth: auth,
        errors: {},
        modelo: {},
        arroba: true,
        editar: false,
        precio_pago_zafrero: '',
        gerente_cofadena: '',
        cargo_gerente_cofadena: '',
        gerente_upab: '',
        cargo_gerente_upab: '',
        jefe_prod_upab: '',
        cargo_jefe_prod_upab: '',
        aux_prod_upab: '',
        cargo_aux_prod_upab: '',
        gestion: '',
    },
    created: function () {
        // Ladda.bind('.ladda-button');
        axios
            .get(listar_variables)
            .then(response => {
                this.modelo = response.data.data;
            });
    },
    methods: {
        newVariables() {
            axios
                .get(listar_variables)
                .then(response => {
                    temporal = response.data.data;
                    vm.precio_pago_zafrero = temporal.precio_pago_zafrero;
                    vm.gerente_cofadena = temporal.gerente_cofadena;
                    vm.cargo_gerente_cofadena = temporal.cargo_gerente_cofadena;
                    vm.gerente_upab = temporal.gerente_upab;
                    vm.cargo_gerente_upab = temporal.cargo_gerente_upab;
                    vm.jefe_prod_upab = temporal.jefe_prod_upab;
                    vm.cargo_jefe_prod_upab = temporal.cargo_jefe_prod_upab;
                    vm.aux_prod_upab = temporal.aux_prod_upab;
                    vm.cargo_aux_prod_upab = temporal.cargo_aux_prod_upab;
                    vm.gestion = temporal.gestion;
                });

            vm.errors = {};
            $('#frmvariables').modal('show');

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
        storeVariables() {
            vm.errors = {};
            var temporal;

            vm.modelo = {
                precio_pago_zafrero: vm.precio_pago_zafrero,
                gerente_cofadena: vm.gerente_cofadena,
                cargo_gerente_cofadena: vm.cargo_gerente_cofadena,
                gerente_upab: vm.gerente_upab,
                cargo_gerente_upab: vm.cargo_gerente_upab,
                jefe_prod_upab: vm.jefe_prod_upab,
                cargo_jefe_prod_upab: vm.cargo_jefe_prod_upab,
                aux_prod_upab: vm.aux_prod_upab,
                cargo_aux_prod_upab: vm.cargo_aux_prod_upab,
                gestion: vm.gestion,
            };

            axios
                .post(guardar_variables, vm.modelo, {
                    headers: {
                        'Accept': 'multipart/form-data',
                        "Content-Type": "multipart/form-data",
                    }
                })
                .then(response => {
                    vm.modelo = {};
                    vm.errors = {};
                    axios
                        .get(listar_variables)
                        .then(response => {
                            this.modelo = response.data.data;
                        });
                    $('#frmvariables').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Los datos Principales del sistema se ha guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
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

$(function () {

    $('#nestable').nestable().on('change', function () {
        const data = {
            dependencia: window.JSON.stringify($('#nestable').nestable('serialize')),
            _token: $('input[name=_token]').val()
        };
        $.ajax({
            url: 'reparticiones/guardar-orden',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (respuesta) {
            }
        });
    });
});
var vm = new Vue({
    el: '#reparticion-app',
    data: {
        errorBag: {},
        isLoading: false,
        reparticion: {},
        unidades: {},

    },
    methods: {

        sincronizarSOA() {
            swal({
                title: "Estas seguro que deseas migrar las reparticiones",
                text: "Esta accion es irreversible!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.get('/Reparticion/sincronizar')
                            .then(result => {
                                response = result.data;
                                toastr.success(response.msg, 'Correcto!');
                                setTimeout(() => window.location.reload(), 1000);

                                //location.reload();


                            })
                            .catch(error => {
                                vm.errorBag = error.data.errors;
                            });
                    } else {
                    }
                });
        },
        getUnidades() {
            axios.get('/Unidad/list')
                .then(result => {
                    response = result.data;
                    vm.unidades = response.data;
                    console.log(vm.unidades);
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getReparticion(id) {
            axios.get(get_reparticion + '/' + id)
                .then(result => {
                    response = result.data;
                    vm.reparticion = response.data;
                    console.log(vm.unidades);
                })
                .catch(error => {
                    console.log(error);
                })
        },
        newreparticion() {
            this.getUnidades();
            vm.reparticion = {};
            $('#frmreparticion').modal('show');
        },
        showreparticion(id) {
            axios.post(urlShowreparticion, {id: id})
                .then(result => {
                    response = result.data;
                    vm.reparticion = response.data;
                    $('#frmverreparticion').modal('show');
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editreparticion(id) {
            this.getReparticion(id);
            $('#frmreparticion').modal('show');
            $('#frmverreparticion').modal('hide');
        },
        savereparticion() {
            axios
                .post(urlSavereparticion, vm.reparticion)
                .then(response => {
                    toastr.success(response.data.msg, 'Correcto!');
                    //$('#view-consulta').modal('show');
                    $('#frmreparticion').modal('hide');
                    Swal.fire('Creado Existosamente!',{
                    }).then(function(){
                        location.reload();
                    });
                })
                .catch(error => {
                    vm.errorBag = error.data.errors;
                });
        },
        deletereparticion(id) {
            this.getReparticion(id);
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
                        axios.post(urlDestroyreparticion, {id: vm.reparticion.id})
                            .then(result => {
                                response = result.data;
                                toastr.success(response.msg, 'Correcto!');
                                $('#frmverreparticion').modal('hide');
                                Swal.fire('Eliminado Existosamente!',{
                                }).then(function(){
                                    location.reload();
                                });
                            })
                            .catch(error => {
                                console.log(error);
                            })
                    } else {

                    }
                });
        }
    },
    mounted() {
        this.getUnidades();
    }
});

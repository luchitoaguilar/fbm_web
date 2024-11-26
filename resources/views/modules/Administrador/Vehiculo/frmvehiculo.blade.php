<!-- begin modal dialog -->

<div class="modal fade" id="frmvehiculo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 v-if="editar" class="modal-title">{{ __('messages.botones.editar') }} {{ __('validation.attributes.zafra') }}</h4>
                <h4 v-else class="modal-title">{{ __('messages.botones.agregar') }} {{ __('validation.attributes.zafra') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    @csrf
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" name="placa" v-model="placa" >
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.placa"><li class="parsley-required">@{{ errors.placa }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="vehiculo">Vehiculo</label>
                        <input type="text" class="form-control" name="vehiculo" v-model="vehiculo" >
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.vehiculo"><li class="parsley-required">@{{ errors.vehiculo }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="cod_vehiculo">Codigo Vehiculo</label>
                        <input type="number" class="form-control" name="cod_vehiculo" v-model="cod_vehiculo" >
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.cod_vehiculo"><li class="parsley-required">@{{ errors.cod_vehiculo }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="tara">Tara</label>
                        <input type="number" class="form-control" name="tara" v-model="tara">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.tara"><li class="parsley-required">@{{ errors.tara }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="gestion">Gestion</label>
                        <template v-if="editar">
                        <input type="number" class="form-control" name="gestion" v-model="gestion" readonly>
                        </template>
                        <template v-else>
                            <input type="number" class="form-control" name="gestion" v-model="gestion">
                        </template>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.gestion"><li class="parsley-required">@{{ errors.gestion }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones (opcional)</label>
                        <input type="text" class="form-control" name="observaciones" v-model="observaciones">
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.observaciones"><li class="parsley-required">@{{ errors.observaciones }}</li></ul>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Foto (opcional)</label>
                        <template v-if="archivo">
                            <div><img class=" ml-5 rounded" :src="modelo.archivo" width="50px"></div>
                        </template>
                        <div class="form-group">
                            <input type="file" @change="select_archivo" class="filestyle" id="archivo" name="archivo" data-buttonname="btn-primary" data-buttontext="Seleccionar..." >
                        </div>
                        <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="errors.archivo"><li class="parsley-required">@{{ errors.archivo }}</li></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <template v-if="editar">
                    <a href="#" @click.prevent="storeVehiculo()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.actualizar') }}</a>
                </template>
                <template v-else>
                <a href="#" @click.prevent="storeVehiculo()" class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.botones.guardar') }}</a>
                </template>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-window-close"></i> {{ __('messages.botones.cerrar')}} </button>
            </div>
        </div>
    </div>
</div>


<!-- end modal dialog -->

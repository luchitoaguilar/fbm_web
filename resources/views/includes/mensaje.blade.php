@if (session("mensaje"))
<div class="alert alert-success" data-auto-dismiss="3000">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Mensaje sistema COFADENA</h4>
    <ul>
        <li>{{ session("mensaje") }}</li>
    </ul>
</div>
{{--
    <div class="alert alert-warning alert-dismissible" role="alert" id="alert_template" data-auto-dismiss="3000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Mensaje sistema UEE Cbba</h4>
        <ul>
            <li>{{ session("mensaje") }}</li>
        </ul>
      </div>  --}}
@endif

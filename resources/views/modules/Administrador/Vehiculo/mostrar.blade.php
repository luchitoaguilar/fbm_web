{{--@if($noticia->archivo)--}}
{{--    <div class="box-body">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <embed src="{{ asset($noticia->imagen_0) }}" width="100%" height="700px" />--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@elseif ($noticia->archivo)--}}
<div class="box-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <embed src="{{ asset($noticia->archivo) }}" type="application/pdf" width="100%" height="700px" />
        </div>
    </div>
</div>
{{--@endif--}}
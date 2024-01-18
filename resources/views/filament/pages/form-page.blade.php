<x-filament-panels::page>
    {{-- @php
        $record=\App\Models\Program::find(request('record'));
    @endphp
    <script src="{{asset('/ajax/libs/jquery/2.1.3/jquery.min.js')}}"></script>
    <script src="{{asset('/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/assets/js/form-render.min.js')}}"></script>
    <form action="{{URL('save-form-values')}}/{!!$record->id!!}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="fb-form"></div>
        <input type="submit" value="أرسال" style="width:100%;background-color:#35136a;color:white;padding:8px;border-radius:7px;cursor: pointer;">
    </form>
    <script>
        $('#fb-form').formRender({
            formData: {!!$record->fields!!}
        })
    // let x={!!$record->fields!!};
    // console.log(x[0].label);
    </script> --}}
</x-filament-panels::page>

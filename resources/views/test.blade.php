{{-- <x-filament-panels::page> --}}
    @php
        $program=\App\Models\Program::find($record);
        $applicant=\App\Models\Applicant::where('user_id',Auth()->user()->id)->first();
        $application=\App\Models\Application::where('program_id',$program->id)->where('applicant_id',$applicant->id)->count();
    @endphp
    @if (!$application)
    <script src="{{asset('/ajax/libs/jquery/2.1.3/jquery.min.js')}}"></script>
    <script src="{{asset('/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/assets/js/form-render.min.js')}}"></script>
    <button onclick='toggles1(this)'  style="width:100%;background-color:#fe8c45;color:white;padding:8px;border-radius:7px;cursor: pointer;" id="appto">تقديم</button>
<div id="cusform" style="display:none">
    <form action="{{URL('save-form-values')}}/{!!$program->id!!}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div id="fb-form"></div>
        <input type="submit" value="أرسال" style="width:100%;background-color:#35136a;color:white;padding:8px;border-radius:7px;cursor: pointer;">
    </form>
    <button onclick='toggles2(this)'  style="width:100%;background-color:white;color:black;padding:8px;border-radius:7px;cursor: pointer;margin-top:16px;border:1px solid gray;">الغاء</button>
</div>


    <script>
               function toggles1(ele){
            ele.style.display="none";
            document.getElementById('cusform').style.display="block";
        }
        function toggles2(ele){
            document.getElementById('appto').style.display="block";
            document.getElementById('cusform').style.display="none";
        }
        
        $('#fb-form').formRender({
            formData: {!!$program->fields!!}
        })
 
    </script>
    @else
        <h2>شكرا لتسجيلك في البرنامج</h2>
    @endif

{{-- </x-filament-panels::page> --}}

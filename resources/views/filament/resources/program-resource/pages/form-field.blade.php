<x-filament-panels::page>
    {{-- <link rel="stylesheet" href="{{asset('/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css')}}"> --}}
    <script src="{{asset('/ajax/libs/jquery/2.1.3/jquery.min.js')}}"></script>
    <script src="{{asset('/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js')}}"></script>
    <script src="{{asset('/assets/js/form-builder.min.js')}}"></script>

    <div id="build-wrap"></div>
    <script>
        jQuery($ => {
            var options = {
                onSave: function(evt, formData) {
                   saveForm(formData);
                },
                i18n: {
                    locale: 'ar-SA',
                    location:"{{asset('/assets/lang/')}}"
                    //location: 'http://languagefile.url/directory/'
                    //extension: '.ext'
                    //override: {
                    //    'en-US': {...}
                    //}
                }

        }
        const fbTemplate = document.getElementById('build-wrap');
        var formBuilder=$(fbTemplate).formBuilder(options);
        formBuilder.promise.then(function () {
            // var formData = formBuilder.actions.getData();
            // var formData = '[{"type":"text","label":"Full Name","subtype":"text","className":"form-control","name":"text-1476748004559"},{"type":"select","label":"Occupation","className":"form-control","name":"select-1476748006618","values":[{"label":"Street Sweeper","value":"option-1","selected":true},{"label":"Moth Man","value":"option-2"},{"label":"Chemist","value":"option-3"}]},{"type":"textarea","label":"Short Bio","rows":"5","className":"form-control","name":"textarea-1476748007461"}]';
            // formBuilder.actions.setData('[{"type": "select","required": false,"label": "حقل تحديد","className": "form-control","name": "select-1704276213235-0","access": false,"multiple": false,"values": [{"label": "خيار 1","value": "1","selected": true},{"label": "خيار 2","value": "2","selected": false},{"label": "خيار 3","value": "3","selected": false}]}]');
            // console.log(data.replaceAll("&quot;",""))
            
            // let data="{{$record->fields}}";
            // let data="{{json_encode($record->fields)}}";
            // let strData = JSON.stringify(data.toString().replaceAll("&quot;",""))
            // let list = JSON.parse(strData);
            // let list2 = JSON.stringify(list);
            // console.log(list2);
        // console.log({{json_encode($record->fields)}})
// console.log({!! json_encode($record->fields) !!})
// console.log(@json($record->fields))
            formBuilder.actions.setData({!! json_encode($record->fields) !!});
        });
        
    })
    function saveForm(form){
        $.ajax(
            {
                type:'post',
                headers:{
                    'Authorization':'Bearer'+localStorage.getItem('token')
                },
                url: '{{URL('sava-form-fields')}}'+"/"+{!!$record->id!!},
                data: {
                    "fields": form,
                    "_token":"{{csrf_token()}}"
                },
                success:function(data){
                    location.href="/app/programs/"+"{!!$record->id!!}"+"/field";
                }
            }
        )
    }
    </script>
</x-filament-panels::page>
<?php

use App\Http\Controllers\TestController;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Faq;
use App\Models\Program;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//route [1] landing page
Route::get('/', function () {
    $program_count = Program::count();
    $applicant_count = Applicant::count();
    $application_count = Application::count();
    $accept_applications = Application::where('status_id', '5')->count();
    $available_program = Program::where('is_published', '1')->count();
    $programs = Program::orderBy('created_at', 'desc')->take(4)->get();
    $faqs = Faq::all();

    return view('landing_page', [
        'program_count' => $program_count,
        'applicant_count' => $applicant_count,
        'application_count' => $application_count,
        'accept_applications' => $accept_applications,
        'available_program' => $available_program,
        'programs' => $programs,
        'faqs' => $faqs,
    ]);
});

//route [2] to save form structure to program_fields
Route::post('sava-form-fields/{id}', function (Request $request, $id) {
    $program = App\Models\Program::find($id);
    $program->fields = $request->fields;
    $program->update();
});
//route [3] to save form values to application_values
Route::post('save-form-values/{id}', function (Request $request, $id) {

    $dataArray = $request->except('_token');
    $fields = Program::find($id)->fields;
    $jsonArray = json_decode($fields, true);
    $keyMapping = [];

    foreach ($jsonArray ?? [] as $item) {
        $path = null;
        if ($request->hasFile($item['name'])) {
            $path = $request[$item['name']]->store('form_files');
        }
        $key = $item['label'];
        $keyMapping[$key] = $path ?? current($dataArray);
        next($dataArray);
    }

    $user_id = Auth()->user()->id;
    $applicant_id = Applicant::where('user_id', $user_id)->first()->id; //applicant id
    Application::create([
        'program_id' => $id,
        'applicant_id' => $applicant_id,
        'values' => $keyMapping,
        'status_id' => 1,
    ]);
    return redirect()->back()->with('success', 'شكرا لتسجيلك في البرنامج');
});

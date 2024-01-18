<?php

namespace App\Http\Controllers;

use App\Mail\notification;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Program;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class TestController extends Controller
{
    use HasRoles;
    public function index()
    {
        // $user = Auth()->user();
        // $user->assignRole('admin');
        // echo count(Auth()->user()->role('interviewer')->get());
        // echo "done";
        // Auth()->user()->assignRole('applicant');
        // $s = Applicant::find(2)->applications;
        // foreach ($s as $application) {
        //     // Access the status attribute
        //     $status = $application->status;
        //     dd($status);
        //     // Do something with $status
        // }
        // dd(Application::find(1)->load(['program', 'applicant']));
        Mail::to('a.3.shater@gmail.com')->send(new Notification('', '', ''));
        // Mail::send(new notification(''));
        // dd(Applicant::find(1)->programs);
        // $s = Applicant::find(2)->programs;
        // // $s=Applicant::with('programs')->get();
        // dd($s);
        return "test";
    }
    public function addUser()
    {
        return User::create([
            "name" => "ahmed",
            "email" => "ahmed@gmail.com",
            "password" => bcrypt("123"),
        ]);
    }
    public function add1()
    {
        return Applicant::create([
            "user_id" => 1,
            "name" => "",
            "email" => "",
            "contact_info" => "",
            "address" => "",
            "qualification" => "",
            "gender" => "",
        ]);
    }
    public function add2()
    {
        // return DB::table('applications')->insert(
        //     [
        //         "program_id" => 1,
        //         "applicant_id" => 1,
        //         "values" => "{}"
        //     ]
        // );
        return Application::create([
            "program_id" => 1,
            "applicant_id" => 1,
            "values" => "{}"
        ]);
    }
    public function add3()
    {
        return Program::create([
            "name" => "",
            "description" => "",
            "start_date" => new DateTime(),
            "end_date" => new DateTime(),
            "student_count" => "",
            "fields" => "",
        ]);
    }
}

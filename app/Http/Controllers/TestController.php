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
   
}

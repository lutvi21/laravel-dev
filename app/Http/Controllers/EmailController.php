<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Jobs\SendEmailJob;

class EmailController extends Controller
{
    //
    public function sendEmail()
    {
        $emailJob = (new SendEmailJob())->delay(5);
        dispatch($emailJob);

        echo 'email sent';
    }
}

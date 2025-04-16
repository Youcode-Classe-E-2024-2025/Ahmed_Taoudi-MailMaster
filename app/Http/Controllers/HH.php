<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

class HH{
    public function test(){
        $template = 'mail';  // Blade template name
        $email = 'ahmed.taoudi.28@gmail.com'; 
        Mail::send($template, [], function ($message) use ($email) {
            $message->to($email)  // Recipient's email
                    ->subject(' Special Discount on Magic Keyboard!');  // Static email subject
        });
    }
}
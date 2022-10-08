<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\NotifyMail;
use Exception;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ContactController extends Controller
{
    // public function index()
    // {
    //     $data=[
    //         'subject' => "SMART ASSISTANT GLASSES",
    //         'body'    => "sag123",
    //     ];
    //     try
    //     {
    //         Mail::to('01205082343ahmed@gmail.com')->send(new NotifyMail($data));
    //         return response()->json(['goood']);
    //     } 
    //     catch (Exception $th) {
    //         return response()->json(['baaaaaaaaaaaad']);

    //     }
     
    // } 


    // Mail::to('receiver-email-id')->send(new NotifyMail());
 
    // if (Mail::failures()) {
    //      return response()->Fail('Sorry! Please try again latter');
    // }else{
    //      return response()->success('Great! Successfully send in your mail');
    //    }
    // public function ContactForm()
    // {
    //     return view("ContactForm");
    // }
    // public function send(Request $request)
    // {
    //     $request->validate([
    //       'email'=>'Required|email'
    //     ]);
    //     if($this->isOnline())
    //     {
    //         // return "CONNECTED !";
    //         $mail_data =
    //         [
    //             'recipient' => 'ahmed.oraby.dev@gmail.com',
    //             'formEmail' => $request->email
    //         ];
    //           Mail::send('email-template',$mail_data , function($message) use ($mail_data ){
    //             $message->to($mail_data['recipient'])
    //             ->from($mail_data['formEmail']);
    //           });
    //     }
    //     else
    //     {
    //         return "NO CONNECTION !";
    //     }
    // }
    // public function isOnline($site ="https://youtube.com/")
    // {
    //    if(@fopen($site ,"r"))
    //    {
    //     return true;
    //    }
    //    else
    //    {
    //     return false;
    //    }
    // }
}

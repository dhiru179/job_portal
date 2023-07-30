<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class verfyUser extends Mailable
{
    use Queueable, SerializesModels;
    public $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($salt,$user_id,$request)
    {
        
        $hash_token = Hash::make($salt);
        $create_url_token = Crypt::encryptString($user_id . " " . $hash_token . " " . $request->password);
        $this->data = [
            'name'=>$request->user,
            "url" => route('users.verfy-url', "url=$create_url_token"),
        ];
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->view('job_portal.front.layout.email',$this->data);
    }
}

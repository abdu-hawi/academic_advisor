<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $data=[];

    /**
     * AdminResetPassword constructor.
     * @param array $dataArr
     */
    public function __construct($dataArr=[]){
        $this->data = $dataArr;
    }

    /**
     * @return AdminResetPassword
     */
    public function build(){
        return $this->markdown('admin.email.admin_reset_password')
            ->subject('Reset Admin Password')
            ->with('data',$this->data);
    }
}

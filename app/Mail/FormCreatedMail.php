<?php

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function build()
    {
        return $this->view('emails.form-created')
                    ->subject('New Form Created');
    }
}
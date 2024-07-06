<?php

namespace App\Jobs;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendFormCreationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function handle()
    {
        Mail::to('sanjithch95@gmail.com')->send(new FormCreatedMail($this->form));
    }
}
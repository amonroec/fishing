<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $obj;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($obj)
    {
        $this->obj = $obj;
        return $this->build();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('TESTING MPO')
                    ->view('test');

        foreach($this->obj->forms as $form) {
            // $email->addStringAttachment(file_get_contents(public_path() . $form));
            $email->attach(public_path() . $form, [
                        'as' => 'name.pdf',
                        'mime' => 'application/pdf',
                    ]);
        }
        return $email;
    }
}

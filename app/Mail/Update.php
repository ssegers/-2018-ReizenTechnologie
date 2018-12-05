<?php

namespace App\Mail;

use App\Traveller;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Update extends Mailable
{
    use Queueable, SerializesModels;

    private $aData = array();

    /**
     * Create a new message instance.
     *
     * @author Yoeri op't Roodt
     *
     * @return void
     */
    public function __construct($aData) {
        $this->aData = $aData;
    }

    /**
     * Build the message.
     *
     * @author Yoeri op't Roodt
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => config('mail.username')])
            ->replyTo(['address' => $this->aData['contactMail']])
            ->subject($this->aData['subject'])
            ->text('mails.update.text')
            ->with(['aData' => $this->aData]);
    }
}

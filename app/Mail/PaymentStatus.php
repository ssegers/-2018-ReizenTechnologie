<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $aMailData;
    public function __construct($aMailData)
    {
        $this->aMailData = $aMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => config('mail.username'), 'name' => config('app.name')])
            ->replyTo(['address' => $this->aMailData['email']])
            ->subject($this->aMailData['subject'])
            ->view('mails.paymentStatusMail')
            ->with([
                'sStudentNaam' => $this->aMailData['studentNaam'],
                'sReisNaam' => $this->aMailData['reisNaam'],
                'iBetaald' => $this->aMailData['betaald'],
                'iTeBetalen'=>$this->aMailData['teBetalen'],
                'sBegeleiderNaam'=>$this->aMailData['begeleider'],
            ]);
    }
}
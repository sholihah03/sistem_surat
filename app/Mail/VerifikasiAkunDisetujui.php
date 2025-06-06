<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifikasiAkunDisetujui extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $otp;
    public $link;

    public function __construct($nama, $otp, $link)
    {
        $this->nama = $nama;
        $this->otp = $otp;
        $this->link = $link;
    }

    public function build()
    {
        return $this->subject('Akun Anda Telah Diverifikasi')
                    ->view('email.verifikasiAkunDisetujui');
    }
}

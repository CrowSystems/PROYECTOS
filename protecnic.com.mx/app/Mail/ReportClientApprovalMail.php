<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportClientApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Report $report) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte de servicio '.$this->report->code.' — Confirma la aprobación',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client_approval',
            with: ['report' => $this->report],
        );
    }
}

<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Business;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessTeamInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $inviter;
    public Business $business;
    public string $role;
    public string $actionUrl;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $inviter
     * @param  \App\Models\Business  $business
     * @param  string  $role
     * @param  string  $actionUrl
     * @return void
     */
    public function __construct(User $inviter, Business $business, string $role, string $actionUrl)
    {
        $this->inviter = $inviter;
        $this->business = $business;
        $this->role = $role;
        $this->actionUrl = $actionUrl;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('You’ve been invited to join :business', ['business' => $this->business->name]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.business-invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

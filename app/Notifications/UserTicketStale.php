<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserTicketStale extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     *
     * @return mixed
     */
    public function __construct(private Ticket $ticket)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     */
    public function toMail($notifiable): \Illuminate\Notifications\Messages\MailMessage
    {
        return (new MailMessage())
                    ->cc($this->ticket->staff->email)
                    ->subject('Your ticket is still open')
                    ->line('This is a reminder that your ticket is still open')
                    ->action('View Ticket', \route('tickets.show', ['id' => $this->ticket->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}

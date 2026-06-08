<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NewProductNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $product;
    public $action;
    public $actor;


    public function __construct(Product $product, string $action, $actor)
    {
        $this->product = $product;
        $this->action = $action;
        $this->actor = $actor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

        if ($this->action == 'deleted') {
            $message = 'Delete Product : ';
            $url = route('products.trash');
        } elseif ($this->action == 'created') {
            $message = 'insert Product : ';
            $url = route('products.show', $this->product->slug);
        } elseif ($this->action == 'updated') {
            $message = 'Update Product : ';
            $url = route('products.show', $this->product->slug);
        } elseif ($this->action == 'restored') {
            $message = 'Restore Product : ';
            $url = route('products.show', $this->product->slug);
        }

        return [
            'message' => "{$this->actor->name} {$message}  {$this->product->name}",
            'product_id' => $this->product->id,
            'url' => $url,
        ];
    }
}

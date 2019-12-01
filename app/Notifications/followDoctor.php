<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class followDoctor extends Notification
{
    use Queueable;

    protected $follower;
    protected $byPhoto;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
       if($follower->photos()->where("status",1)->first()){
            $this->byPhoto = $this->follower->photos()->where('status',1)->first()->path;
        }else{
            $this->byPhoto = "";
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            'by' => $this->follower->owner->fullName,
            'byAccount' => $this->follower->owner_type,
            "byPhoto"   => $this->byPhoto,
            'byUsername' => $this->follower->username,
            'message' => "Started following you", 
            'type' => "follow",
        ];
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

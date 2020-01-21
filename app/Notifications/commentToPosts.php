<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class commentToPosts extends Notification
{
    use Queueable;
    protected $comment;
    protected $post;
    protected $byPhoto;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment,$post)
    {
        $this->comment = $comment; 
        $this->post = $post; 
        if($comment->comment_owner->photos()->where("status",1)->first()){
            $this->byPhoto = $this->comment->comment_owner->photos()->where('status',1)->first()->path;
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
        return ["database"];
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


    public function toDatabase($notifiable){
        return [
            "by" => $this->comment->comment_owner->owner->fullName,
            "byAccount" => $this->comment->comment_owner->owner_type,
            "byPhoto"   => $this->byPhoto,
            'post' => $this->post->id,
            'type' => "commentToPost",
            'message' => "commented on your post",
        ];
    }


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

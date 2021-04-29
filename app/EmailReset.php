<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\ChangeEmail;
use Illuminate\Notifications\Notifiable;


class EmailReset extends Model
{
    protected $fillable = [
        'user_id',
        'new_email',
        'token',
    ];

    public function sendEmailResetNotification($token)
    {
        $this->notify(new ChangeEmail($token));
    }

    /*
     * 新しいメールアドレスあてにメールを送信する
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
    */
    public function routeNotificationForMail($notification)
    {
        return $this->new_email;
    }
}

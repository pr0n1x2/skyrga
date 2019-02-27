<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Hash;

class UserUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        if (empty($user->password) || mb_strlen($user->password) > User::MAX_PASSWORD_LENGTH) {
            $user->password = $user->getOriginal('password');
        } else {
            $user->password = Hash::make($user->password);
        }

        if ($user->is_active != $user->getOriginal('is_active')) {
            $user->setRememberToken(str_random(60));
        }

        if ($user->photo instanceof UploadedFile) {
            User::removeUserPhoto($user->getOriginal('photo'));
            $user->photo = User::uploadUserPhoto($user->photo);
        }

        if (!$user->is_active) {
            $user->last_href_id = 0;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

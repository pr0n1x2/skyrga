<?php

namespace App;

use App\Events\UserCreating;
use App\Events\UserUpdating;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use ImageIntervention;

class User extends Authenticatable
{
    use Notifiable;

    const PATH_TO_PHOTO = '/img/users/';
    const PATH_TO_USER_ICON = '/img/user-icon.png';
    const MAX_PASSWORD_LENGTH = 25;
    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';
    const AUTHOR_ROLE = 'author';

    protected $dispatchesEvents = [
        'creating' => UserCreating::class,
        'updating' => UserUpdating::class,
    ];

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    private static $userRoles = [
        'admin' => 'Administrator',
        'user' => 'User',
        'author' => 'Author'
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public static function roles($role = null)
    {
        if (!$role) {
            return self::$userRoles;
        }

        return self::$userRoles[$role];
    }

    public static function uploadUserPhoto(UploadedFile $file)
    {
        $filename = uniqid() . '.' . $file->extension();
        $file->storeAs(self::PATH_TO_PHOTO, $filename);

        $photo = ImageIntervention::make(public_path() . self::PATH_TO_PHOTO . $filename);
        $photo->fit(200);
        $photo->save();

        return $filename;
    }

    public static function removeUserPhoto($filename)
    {
        Storage::delete(self::PATH_TO_PHOTO . $filename);
    }

    public function getUserPhotoPath()
    {
        return !empty($this->photo) ? self::PATH_TO_PHOTO . $this->photo : self::PATH_TO_USER_ICON;
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}

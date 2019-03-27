<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'domain', 'group_id', 'mail_account_id', 'reserve_mail_account_id', 'gmail', 'gmail_password',
        'gender', 'username', 'password', 'prefix', 'firstname', 'middlename', 'lastname', 'birthday', 'position',
        'url1', 'url2', 'url3', 'primary_domain_word', 'secondary_domain_word', 'alternative_firstname',
        'alternative_lastname', 'business_name', 'address1', 'address2', 'city', 'state', 'state_shortcode', 'zip',
        'phone', 'security_answer_mother', 'security_answer_pet', 'blog_name', 'about', 'anchor', 'main_anchor',
        'proxy', 'field1', 'field2', 'field3'
    ];

    public function group()
    {
        return $this->hasOne(Group::class);
    }

    public function email()
    {
        return $this->belongsTo(MailAccount::class, 'mail_account_id');
    }

    public function reserveEmail()
    {
        return $this->belongsTo(MailAccount::class, 'reserve_mail_account_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'profile_posts',
            'profile_id',
            'post_id'
        );
    }

    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'profile_images',
            'profile_id',
            'image_id'
        );
    }

    public function videos()
    {
        return $this->belongsToMany(
            Video::class,
            'profile_videos',
            'profile_id',
            'video_id'
        );
    }

    public function setIsDeletedAttribute($value)
    {
        $this->attributes['is_deleted'] = $value ? 0 : 1;
    }

    public function getNextPost()
    {
        $previous_post_id = $this->previous_post_id;

        do {
            $post = $this->posts()
                ->where('posts.id', '>', $previous_post_id)
                ->orderBy('posts.id', 'asc')
                ->first();

            $previous_post_id = 0;
        } while (is_null($post));

        $this->previous_post_id = $post->id;
        $this->save();

        return $post;
    }
}

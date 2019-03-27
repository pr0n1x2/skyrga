<?php

namespace App;

use App\Events\ProjectCreated;
use App\Events\ProjectCreating;
use App\Events\ProjectUpdating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    const PATH_TO_PROJECTS_FILES = '/files/projects/';

    protected $dispatchesEvents = [
        'creating' => ProjectCreating::class,
        'updating' => ProjectUpdating::class
    ];

    protected $fillable = [
        'domain_id', 'href_id', 'register_page', 'login_page', 'login_instructions', 'login_youtube',
        'is_login_by_himself', 'is_no_need_login', 'use_default_user_profile', 'sing_in_instructions',
        'sing_in_youtube', 'is_sing_in_by_himself', 'is_no_need_sing_in', 'post_instructions', 'post_youtube',
        'is_post_by_himself', 'is_no_need_post', 'is_use_single_account', 'account_id', 'is_use_proxy',
        'is_generate_address', 'is_same_username', 'is_same_password', 'is_easy_password', 'is_generate_phone',
        'is_use_email_as_username', 'is_use_domainword_as_username', 'is_use_main_anchor', 'is_use_post',
        'is_use_images', 'is_use_videos', 'paragraph_frame', 'heading_frame', 'link_frame', 'image_frame',
        'video_frame', 'paragraph_link', 'state_associations', 'materials', 'post_date', 'is_archive'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function href()
    {
        return $this->belongsTo(Href::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function proxies()
    {
        return $this->belongsToMany(
            Proxy::class,
            'project_proxies',
            'project_id',
            'proxy_id'
        );
    }

    public static function getRandomFileName()
    {
        return uniqid();
    }

    public static function uploadFile($filename, UploadedFile $file)
    {
        $filename = $filename . '.' . $file->getClientOriginalExtension();
        $file->storeAs(self::PATH_TO_PROJECTS_FILES, $filename);

        return $filename;
    }

    public static function removeFile($filename)
    {
        Storage::delete(self::PATH_TO_PROJECTS_FILES . $filename);
    }

    public function setCheckboxes($request)
    {
        $this->is_login_by_himself = !$request->is_login_by_himself ? 0 : 1;
        $this->is_no_need_login = !$request->is_no_need_login ? 0 : 1;
        $this->is_sing_in_by_himself = !$request->is_sing_in_by_himself ? 0 : 1;
        $this->is_no_need_sing_in = !$request->is_no_need_sing_in ? 0 : 1;
        $this->is_post_by_himself = !$request->is_post_by_himself ? 0 : 1;
        $this->is_no_need_post = !$request->is_no_need_post ? 0 : 1;
        $this->use_default_user_profile = !$request->use_default_user_profile ? 0 : 1;
        $this->is_use_single_account = !$request->is_use_single_account ? 0 : 1;
        $this->is_use_proxy = !$request->is_use_proxy ? 0 : 1;
        $this->is_generate_address = !$request->is_generate_address ? 0 : 1;
        $this->is_same_username = !$request->is_same_username ? 0 : 1;
        $this->is_same_password = !$request->is_same_password ? 0 : 1;
        $this->is_easy_password = !$request->is_easy_password ? 0 : 1;
        $this->is_generate_phone = !$request->is_generate_phone ? 0 : 1;
        $this->is_use_email_as_username = !$request->is_use_email_as_username ? 0 : 1;
        $this->is_use_domainword_as_username = !$request->is_use_domainword_as_username ? 0 : 1;
        $this->is_use_main_anchor = !$request->is_use_main_anchor ? 0 : 1;
        $this->is_use_post = !$request->is_use_post ? 0 : 1;
        $this->is_use_images = !$request->is_use_images ? 0 : 1;
        $this->is_use_videos = !$request->is_use_videos ? 0 : 1;
    }
}

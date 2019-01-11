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
    const PATH_TO_UBOT_FILES = '/files/ubots/';

    protected $dispatchesEvents = [
        'creating' => ProjectCreating::class,
        'created' => ProjectCreated::class,
        'updating' => ProjectUpdating::class
    ];

    protected $fillable = [
        'name', 'domain', 'register_page', 'login_page', 'login_file', 'singin_file', 'post_file',
        'is_generate_address', 'is_same_username', 'is_same_password', 'is_easy_password', 'is_generate_phone',
        'is_use_main_anchor', 'is_use_post', 'is_use_images', 'is_use_videos', 'paragraph_frame', 'link_frame',
        'image_frame', 'video_frame', 'paragraph_link', 'state_associations', 'post_date', 'is_archive'
    ];

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

    public static function getRegisterFilename($project_id)
    {
        return sprintf('%04d', $project_id) . '_register';
    }

    public static function getSingInFilename($project_id)
    {
        return sprintf('%04d', $project_id) . '_sing_in';
    }

    public static function getPostFilename($project_id)
    {
        return sprintf('%04d', $project_id) . '_post';
    }

    public static function uploadFile($filename, UploadedFile $file)
    {
        $filename = $filename . '.' . $file->extension();
        $file->storeAs(self::PATH_TO_UBOT_FILES, $filename);

        return $filename;
    }

    public static function renameFile($filename, $new_filename)
    {
        $new_filename = $new_filename . '.ubot';
        Storage::move(self::PATH_TO_UBOT_FILES . $filename, self::PATH_TO_UBOT_FILES . $new_filename);

        return $new_filename;
    }

    public static function removeFile($filename)
    {
        Storage::delete(self::PATH_TO_UBOT_FILES . $filename);
    }

    public function setCheckboxes($request)
    {
        $this->is_use_proxy = !$request->is_use_proxy ? 0 : 1;
        $this->is_generate_address = !$request->is_generate_address ? 0 : 1;
        $this->is_same_username = !$request->is_same_username ? 0 : 1;
        $this->is_same_password = !$request->is_same_password ? 0 : 1;
        $this->is_easy_password = !$request->is_easy_password ? 0 : 1;
        $this->is_generate_phone = !$request->is_generate_phone ? 0 : 1;
        $this->is_use_main_anchor = !$request->is_use_main_anchor ? 0 : 1;
        $this->is_use_post = !$request->is_use_post ? 0 : 1;
        $this->is_use_images = !$request->is_use_images ? 0 : 1;
        $this->is_use_videos = !$request->is_use_videos ? 0 : 1;
    }
}

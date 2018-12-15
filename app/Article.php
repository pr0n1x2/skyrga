<?php

namespace App;

use App\Events\ArticleCreated;
use App\Events\ArticleCreating;
use App\Events\ArticleDeleting;
use App\Events\ArticleUpdating;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    const PATH_TO_ATTACHES = '/files/articles/attaches/';
    const PATH_TO_ARTICLES = '/files/articles/';

    const ARTICLE_NEW = 0;
    const ARTICLE_VIEWED = 1;
    const ARTICLE_COMPLETED = 2;
    const ARTICLE_CORRECTION = 3;
    const ARTICLE_CONFIRMED = 4;

    private $statuses = [
        self::ARTICLE_NEW => 'New',
        self::ARTICLE_VIEWED => 'Viewed',
        self::ARTICLE_COMPLETED => 'Completed',
        self::ARTICLE_CORRECTION => 'On correction',
        self::ARTICLE_CONFIRMED => 'Confirmed',
    ];

    protected $dispatchesEvents = [
        'creating' => ArticleCreating::class,
        'created' => ArticleCreated::class,
        'updating' => ArticleUpdating::class,
        'deleting' => ArticleDeleting::class
    ];

    protected $fillable = ['user_id', 'theme', 'message', 'file_attache', 'price', 'deadline',
        'revision_date', 'file_result', 'file_revision'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id', 'admin_id');
    }

    public function messages()
    {
        return $this->hasMany(ArticleMessage::class);
    }

    public static function uploadFile(UploadedFile $file, $path)
    {
        $filename = uniqid() . '.' . $file->extension();
        $file->storeAs($path, $filename);

        return $filename;
    }

    public static function removeFile($filename)
    {
        Storage::delete($filename);
    }

    public function getArticleStatus($status)
    {
        switch ($status) {
            case 1:
                $label = 'label-primary';
                break;
            case 2:
                $label = 'label-warning';
                break;
            case 3:
                $label = 'label-danger';
                break;
            case 4:
                $label = 'label-success';
                break;
            default:
                $label = 'label-info';
                break;
        }

        return '<span class="label ' . $label . '"> ' . $this->statuses[$status] . ' </span>';
    }

    public function formatDeadline()
    {
        if ($this->status == self::ARTICLE_COMPLETED || $this->status == self::ARTICLE_CONFIRMED) {
            $date = empty($this->revision_date) ?
                Carbon::createFromFormat('Y-m-d', $this->deadline) :
                Carbon::createFromFormat('Y-m-d', $this->revision_date);

            return $date->format('F d, Y');
        } else {
            if (!empty($this->revision_date)) {
                $date = Carbon::createFromFormat('Y-m-d', $this->revision_date);
                $formatedDate = $date->format('F d, Y');
                $label = 'label-warning';

                if ($date->isToday()) {
                    $formatedDate = 'Today';
                } elseif ($date->isPast()) {
                    $label = 'label-danger';
                }

                return '<span class="label ' . $label . '"> ' . $formatedDate . ' </span>';
            } else {
                $date = Carbon::createFromFormat('Y-m-d', $this->deadline);
                $formatedDate = $date->format('F d, Y');
                $isSpan = true;

                if ($date->isFuture()) {
                    $isSpan = false;
                } elseif ($date->isToday()) {
                    $label = 'label-warning';
                    $formatedDate = 'Today';
                } else {
                    $label = 'label-danger';
                }

                return $isSpan ?
                    '<span class="label ' . $label . '"> ' . $formatedDate . ' </span>' :
                    $date->format('F d, Y');
            }
        }
    }
}

<?php

namespace App\Events;

use App\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        if ($article->file_attache instanceof UploadedFile) {
            Article::removeFile(Article::PATH_TO_ATTACHES . $article->getOriginal('file_attache'));
            $article->file_attache_name = $article->file_attache->getClientOriginalName();
            $article->file_attache = Article::uploadFile($article->file_attache, Article::PATH_TO_ATTACHES);
        }

        if ($article->file_result instanceof UploadedFile) {
            Article::removeFile(Article::PATH_TO_ARTICLES . $article->getOriginal('file_result'));
            $article->file_result_name = $article->file_result->getClientOriginalName();
            $article->file_result = Article::uploadFile($article->file_result, Article::PATH_TO_ARTICLES);
        }

        if ($article->file_revision instanceof UploadedFile) {
            Article::removeFile(Article::PATH_TO_ARTICLES . $article->getOriginal('file_revision'));
            $article->file_revision_name = $article->file_revision->getClientOriginalName();
            $article->file_revision = Article::uploadFile($article->file_revision, Article::PATH_TO_ARTICLES);
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

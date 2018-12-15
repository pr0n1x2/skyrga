<?php

namespace App\Events;

use App\Article;
use App\ArticleMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleDeleting
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        Article::removeFile(Article::PATH_TO_ATTACHES . $article->file_attache);
        Article::removeFile(Article::PATH_TO_ARTICLES . $article->file_result);
        Article::removeFile(Article::PATH_TO_ARTICLES . $article->file_revision);

        ArticleMessage::whereArticleId($article->id)->delete();
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

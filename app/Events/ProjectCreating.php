<?php

namespace App\Events;

use App\Project;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProjectCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        if ($project->login_file instanceof UploadedFile) {
            $project->login_file = Project::uploadFile(Project::getRandomFileName(), $project->login_file);
        }

        if ($project->singin_file instanceof UploadedFile) {
            $project->singin_file = Project::uploadFile(Project::getRandomFileName(), $project->singin_file);
        }

        if ($project->post_file instanceof UploadedFile) {
            $project->post_file = Project::uploadFile(Project::getRandomFileName(), $project->post_file);
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

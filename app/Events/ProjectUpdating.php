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

class ProjectUpdating
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
            Project::removeFile($project->getOriginal('login_file'));
            $project->
            login_file = Project::uploadFile(Project::getRegisterFilename($project->id), $project->login_file);
        }

        if ($project->singin_file instanceof UploadedFile) {
            Project::removeFile($project->getOriginal('singin_file'));
            $project->
            singin_file = Project::uploadFile(Project::getSingInFilename($project->id), $project->singin_file);
        }

        if ($project->post_file instanceof UploadedFile) {
            Project::removeFile($project->getOriginal('post_file'));
            $project->
            post_file = Project::uploadFile(Project::getPostFilename($project->id), $project->post_file);
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

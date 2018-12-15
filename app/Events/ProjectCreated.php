<?php

namespace App\Events;

use App\Project;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProjectCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        if (!empty($project->login_file)) {
            $project->
            login_file = Project::renameFile($project->login_file, Project::getRegisterFilename($project->id));
        }

        if (!empty($project->singin_file)) {
            $project->
            singin_file = Project::renameFile($project->singin_file, Project::getSingInFilename($project->id));
        }

        if (!empty($project->post_file)) {
            $project->
            post_file = Project::renameFile($project->post_file, Project::getPostFilename($project->id));
        }

        $project->save();
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

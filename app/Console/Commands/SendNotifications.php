<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Notifications\NewPost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notifications To users with new posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::where('is_notifications_sent', 0)->get();
        foreach ($posts as $post) {
            Notification::send($post->website->subscribers, new NewPost($post));
            $post->is_notifications_sent = true;
            $post->save();
        }
        return 1;
    }
}

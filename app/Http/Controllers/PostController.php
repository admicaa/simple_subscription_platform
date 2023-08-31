<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Websites;
use App\Models\WebsiteSubscribers;
use App\Notifications\NewPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'body' => [
                Rule::requiredIf(!request()->link)
            ],
            'link' => [
                Rule::requiredIf(!request()->body),
                'url'
            ],
            'website' => [
                'required',
                Rule::exists('websites', 'domain')->whereNull('deleted_at')
            ]
        ]);
        $website = Websites::where('domain', request()->website)->firstOrFail();
        $post = Post::create([
            'website_id' => $website->id,
            'title' => request()->title,
            'body' => request()->body,
            'link' => request()->link,

        ]);

        // send the notifications to the users
        if (config('app.send_notifications_directly')) {

            Notification::send($website->subscribers, new NewPost($post));
            $post->is_notifications_sent = true;
            $post->save();
        }
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

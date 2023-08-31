<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSubscribers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{


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
            'domain' => [
                'required',
                Rule::exists('websites', 'domain')->whereNull("deleted_at")
            ],
            'email' => [
                'required',
                'email'
            ]
        ]);
        $subscriber = WebsiteSubscribers::firstOrCreate([
            'domain' => request()->domain,
            'email' => request()->email
        ], [
            'cancel_token' => \Str::random(50)
        ]);
        return $subscriber;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($token)
    {
        //
        $subscriber = WebsiteSubscribers::where('cancel_token', $token)->firstOrFail();
        $subscriber->delete();
        return redirect("https://" . $subscriber->domain);
    }
}

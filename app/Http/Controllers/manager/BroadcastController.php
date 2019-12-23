<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
/*use NotificationChannels\PusherPushNotifications\PusherChannel;
use NotificationChannels\PusherPushNotifications\PusherMessage;
use Illuminate\Notifications\Notification;*/
use App\Broadcast;

class BroadcastController extends Controller //Notification
{
	/*public function via($notifiable)
    {
        return [PusherChannel::class];
    }

    public function toPushNotification($notifiable)
    {
        return PusherMessage::create()
            ->iOS()
            ->badge(1)
            ->sound('success')
            ->body("Your {$notifiable->service} account was approved!");
    }

    public function toPushNotification($notifiable)
	{
	    $message = "Your {$notifiable->service} account was approved!";

	    return PusherMessage::create()
	        ->iOS()
	        ->badge(1)
	        ->body($message)
	        ->withAndroid(
	            PusherMessage::create()
	                ->title($message)
	                ->icon('icon')
	        );
	}*/

    public function broadcastView()
    {
        $user_id = session()->get('user_id');
        return view('manager.broadcast.broadcast',compact('user_id'));
    }
    public function broadcastSave(Request $request)
    {    	
        $validator = Validator::make($request->all(),[
            'title_name' => 'required',
            'description' => 'required'
        ]);
        if(!$validator->fails()){
            $broadcast = new Broadcast();
            $broadcast->user_id = request('user_id');
            $broadcast->title = request('title_name');
            $broadcast->description = request('description');
            $broadcast->save();
            return response($broadcast);
            // return redirect::back()->with('success', 'Broadcast Succes');
            
        }
        else {
            return Redirect::back()->withErrors($validator)->withInput($request->input());
        }
    }
}

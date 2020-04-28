<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use App\Chat;
class NewMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;
    //public $book;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Chat $chat)
    {
        $this->chat=$chat;
       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('book.'.$this->chat->book->id);
    }
    // public function broadcastWith(){
    //     return[
    //         "message"=>
    //     ];
    // }

    // public function broadcastAs(){
    //     return 'new-message';
    // }

    public function broadcastWith(){
        //this customizes the data sent to websocket,overiides what get sent
        return [
            "message"=>$this->chat->message,
            "created_at"=>$this->chat->created_at->toFormattedDateString(),
            "user"=>[
                'fullname'=>$this->chat->user->fullname,
                'avatar'=>'http://lorempixel/50/50'
            ]
        ];
    }
}

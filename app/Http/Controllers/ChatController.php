<?php

namespace App\Http\Controllers;
use App\Chat;
use App\Book;
use App\Events\NewMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
	//this is chat for doctor
    public function index(Book $book){
    	return response()->json($book->chats()->with('user')->get());
    }

    public function store(Request $request,Book $book){
    	$chat=$book->chats()->create([
            "message"=>$request->message,
            "user_id"=>auth()->user()->id,
            
        ]);

        $chat=Chat::where('id',$chat->id)->with('user')->first();

        broadcast(new NewMessage($chat))->toOthers();
        //dd($comment);
        return $chat->toJson();
    }
}

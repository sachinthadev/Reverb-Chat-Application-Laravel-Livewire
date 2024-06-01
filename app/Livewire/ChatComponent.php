<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\Message;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $user;
    public $sender_id;
    public $reciever_id;
    public $message='';
    public $messages = [];


    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount($user_id){
        $this->sender_id = auth()->user()->id;
        $this->reciever_id = $user_id;

        $messages = Message::where(function($query){
            $query->where('sender_id',$this->sender_id)
            ->where('reciever_id',$this->reciever_id);
        })->orWhere(function($query){
            $query->where('sender_id',$this->reciever_id)
            ->where('reciever_id',$this->sender_id);
        })->with('sender:id,name','reciever:id,name')->get();

       foreach($messages as $message){
        $this->chatMessage($message);

       }
       $this->user = User::find($user_id);

    }


    public function sendMessage(){
      
        $message = new Message();
        $message->sender_id = $this->sender_id;
        $message->reciever_id = $this->reciever_id;
        $message->message = $this->message;
        $message->save();
        $this->chatMessage($message);


        broadcast(new MessageSendEvent($message))->toOthers();


        $this->message='';

    }


    #[On('echo-private:chat-channel.{sender_id},MessageSendEvent')]
    public function listnenForMessage($event){
        $chatMessage = Message::whereId($event['message']['id'])->with('sender:id,name','reciever:id,name')->first();
        $this->chatMessage($chatMessage);


    }


    public function chatMessage($message){
      $this->messages[] =[
            'id'=>$message->id,
            'message'=>$message->message,
            'sender'=>$message->sender->name,
            'reciever'=>$message->reciever->name,
        ];
        }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\User;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function listChat(){
        $status = false;
        $message = "";
        $result = array();

        $chat = Chat::join('users', 'users.id', '=', 'chats.userid')
        ->select('chats.*', 'users.nama_lengkap')
        ->get();

        if(!$chat->isEmpty()){
            $status = true;
            $message = "Berhasil";
            $result = $chat;
        }

        return response()->json(array("status" => $status, "message" => $message, "result" => $result));
    }

    public function addChat(Request $request){
        $status = false;
        $message = "";
        $result = array();

        $insert = Chat::create($request->all());
        if($insert){
            $status = true;
            $message = "Berhasil menambahkan chat";
            $result = Chat::join('users', 'users.id', '=', 'chats.userid')
            ->select('chats.*', 'users.nama_lengkap')
            ->get();
        }

        return response()->json(array("status" => $status, "message" => $message, "result" => $result));
    }

}
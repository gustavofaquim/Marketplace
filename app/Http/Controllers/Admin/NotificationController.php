<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    
    public function notifications(){
        $naoLidas = auth()->user()->unreadNotifications;
        //dd($naoLidas);
        return view("admin.notifications",["naoLidas" => $naoLidas]);
    }

    public function readAll(){
        $naoLidas = auth()->user()->unreadNotifications;

        $naoLidas->each(function($notification){
            $notification->markAsRead();
        });

        //Back retorna para a página que estava
        return redirect()->back()->with('msg', 'Notificações lidas com sucesso');
    }

    public function read($id){
        $naoLidas = auth()->user()->unreadNotifications()->find($id);
        
        $naoLidas->markAsRead();

        
        return redirect()->back()->with('msg', 'Notificação lida com sucesso');

    }
}

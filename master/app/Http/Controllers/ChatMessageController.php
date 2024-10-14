<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Models\Salon;

class ChatMessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'salon_id' => 'required|exists:salons,id',
        ]);

        ChatMessage::create([
            'content' => $request->message,
            'salon_id' => $request->salon_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function indexForOwner($salon_id)
    {
        $salon = Salon::findOrFail($salon_id);
        $messages = ChatMessage::with('user')->where('salon_id', $salon_id)->get();

        return view('send_message_owner', compact('messages', 'salon'));
    }

    public function indexForUser($salon_id)
    {
        $salon = Salon::findOrFail($salon_id);
        $messages = ChatMessage::with('user')->where('salon_id', $salon_id)->get();

        return view('send_message_user', compact('messages', 'salon'));
    }
}


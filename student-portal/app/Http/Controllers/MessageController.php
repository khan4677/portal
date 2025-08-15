<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('sender')->latest()->paginate(20);
        return view('messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        $message->load('sender');
        return view('messages.show', compact('message'));
    }

    public function reply(Request $request, Message $message)
    {
        $data = $request->validate([
            'reply_body' => 'required|string',
        ]);

        $message->update([
            'reply_body' => $data['reply_body'],
            'status' => 'answered',
            'replied_by' => $request->user()->id,
            'replied_at' => now(),
        ]);

        return redirect()->route('messages.index')->with('status','Replied successfully');
    }
}

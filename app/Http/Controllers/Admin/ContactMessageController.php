<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.contact-message.index', compact('messages'));
    }

    /**
     * Display the specified contact message and mark as read.
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json([
            'status' => 'success',
            'data' => $message,
        ]);
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Contact message deleted successfully!',
        ]);
    }
}


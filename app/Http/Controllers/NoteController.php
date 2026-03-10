<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Sınıfa / Kursa göre notları çek (Instagram tarzı feed)
        $notes = Note::with('user')
            ->where('course', $user->course)
            ->latest()
            ->get();
            
        return view('dashboard', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'note_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $path = $request->file('note_file')->store('notes', 'public');

        Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price ?? 0,
            'course' => Auth::user()->course,
            'file_path' => $path,
        ]);

        return redirect()->route('dashboard')->with('success', 'Not başarıyla paylaşıldı!');
    }
}

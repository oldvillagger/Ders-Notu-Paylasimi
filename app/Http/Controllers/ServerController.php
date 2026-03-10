<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ServerController extends Controller
{
    public function index()
    {
        $allServers = Server::withCount('users')->get();
        $myServers = Auth::user()->servers;
        return view('servers.index', compact('allServers', 'myServers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $server = Server::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => Auth::id()
        ]);
        
        $server->users()->attach(Auth::id());

        return redirect()->route('servers.show', $server->id)->with('success', 'Sunucu oluşturuldu!');
    }

    public function show(Server $server)
    {
        if (!$server->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('servers.index')->with('error', 'Bu sunucuya yetkiniz yok, önce katılmalısınız.');
        }

        $messages = $server->messages()->with('user')->oldest()->get();
        return view('servers.show', compact('server', 'messages'));
    }

    public function join(Server $server)
    {
        if (!$server->users()->where('user_id', Auth::id())->exists()) {
            $server->users()->attach(Auth::id());
            return redirect()->route('servers.show', $server->id)->with('success', 'Sunucuya katıldınız!');
        }

        return redirect()->route('servers.show', $server->id);
    }

    public function message(Request $request, Server $server)
    {
        $request->validate(['body' => 'required|string']);
        
        if (!$server->users()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        Message::create([
            'user_id' => Auth::id(),
            'server_id' => $server->id,
            'body' => $request->body
        ]);

        return redirect()->back();
    }
}

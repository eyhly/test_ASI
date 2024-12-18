<?php

namespace App\Http\Controllers;

use App\Models\MyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class MyClientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'slug' => 'required|string|max:100|unique:my_client',
            'client_logo' => 'nullable|image',
        ]);

        $client_logo = null;
        if ($request->hasFile('client_logo')) {
            $client_logo = $request->file('client_logo')->store('client_logos');
        }

        $client = MyClient::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'client_logo' => $client_logo ?? 'no-image.jpg',
            'is_project' => $request->is_project ?? '0',
            'self_capture' => $request->self_capture ?? '1',
            'client_prefix' => $request->client_prefix,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
        ]);

        Redis::set($client->slug, json_encode($client));

        return redirect()->route('clients.index');
    }

    public function index()
    {
        $clients = MyClient::all();

        return view('clients.index', compact('clients'));
    }

    public function edit($slug)
    {
        $client = MyClient::where('slug', $slug)->firstOrFail();
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $slug)
    {
        $client = MyClient::where('slug', $slug)->firstOrFail();

        if ($request->hasFile('client_logo')) {
            Storage::delete($client->client_logo);
            $client_logo = $request->file('client_logo')->store('client_logos');
        } else {
            $client_logo = $client->client_logo;
        }

        $client->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'client_logo' => $client_logo,
            'is_project' => $request->is_project ?? '0',
            'self_capture' => $request->self_capture ?? '1',
            'client_prefix' => $request->client_prefix,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
        ]);

        Redis::del($slug); 
        Redis::set($client->slug, json_encode($client)); 
        return redirect()->route('clients.index');
    }

    public function destroy($slug)
    {
        $client = MyClient::where('slug', $slug)->firstOrFail();

        $client->delete();
        Storage::delete($client->client_logo);
        Redis::del($slug);

        return redirect()->route('clients.index');
    }
}

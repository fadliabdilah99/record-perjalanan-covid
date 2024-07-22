<?php

namespace App\Http\Controllers;

use App\Models\history;
use Illuminate\Http\Request;

class historyController extends Controller
{

    public function index()
    {
        $data['history'] = history::with('users')->get();
        // dd($data['history']);
        return view('admin.history.index')->with($data);
    }


    public function createHistory(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required',
            'suhu' => 'required',
        ]);

        history::create($request->all());

        

        return redirect()->back()->with('success', 'History telah di tambahkan');
    }
}

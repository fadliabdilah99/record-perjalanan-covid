<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tempatController extends Controller
{
    public function index()
    {

        $data['tempat'] = User::where('role', 'tempat')
            ->with(['checkin' => function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->month);
            }])
            ->get();



        return view('admin.tempat.index')->with($data);
    }

    public function tempat()
    {
        $data['tempat'] = history::where('checkin', Auth::user()->id)->with('users')->get();


        return view('tempat.index')->with($data);
    }
}

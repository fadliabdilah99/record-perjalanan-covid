<?php

namespace App\Http\Controllers;

use App\Models\history;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index_home(Request $request)
    {
        if(!empty($request->bulan)){
            $bulan = $request->bulan;
        }else{
            $bulan = Carbon::now()->month;
        }
        // dd($bulan);
        if (Auth::check()) {
            $history = History::where('user_id', Auth::user()->id)->whereMonth('tanggal', $bulan)->get();

            foreach ($history as $item) {
                if ($item->suhu <= 34) {
                    $item->suhubg = 'bg-success';
                } elseif ($item->suhu <= 36) {
                    $item->suhubg = 'bg-warning';
                } else {
                    $item->suhubg = 'bg-danger';
                }
            }

            $data['history'] = $history;
        } else {
            $data['history'] = collect();
        }
        $data['bulan'] = $bulan;
        return view('home.index', $data);
    }

    public function index_admin()
    {
        return view('admin.index');
    }
}

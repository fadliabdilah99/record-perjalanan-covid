<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class authController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function registers()
    {
        return view('auth.register');
    }
    public function validasi(Request $request)
    {
        $request->validate([
            'NIK' => 'required|numeric',
            'password' => 'required|string',
        ]);

        $credentials = [
            'NIK' => $request->NIK,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect('admin');
            }elseif(Auth::user()->role == 'tempat'){
                return redirect('tempat');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('login')->with('failed', 'NIK atau Password salah');
        }
    }


    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'Nik' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'Nik' => $request->Nik,
            'password' => Hash::make($request->password), // Menggunakan kolom 'password' dan melakukan hashing
        ];

        if (!empty($request->role)) {
            $data['role'] = $request->role;
        }

        User::create($data);


        $login = [
            'Nik' => $request->Nik,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect('login');
        } else {
            return redirect('register')->with('failed', 'Nik atau password salah');
        }
    }

    protected $attributes = [];
    public function flush()
    {
        $this->attributes = [];
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',   
            'Nik' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'Nik' => $request->Nik,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect('user')->with('success', 'Data Berhasilsil Ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        user::where('id', $id)->update([
            'name' => $request->name,
            'Nik' => $request->Nik,
            'role' => $request->role
        ]);

        return redirect('user')->with('success', 'Data Berhasilsil Diubah');
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('user')->with('success', 'Data Berhasilsil Dihapus');
    }
}

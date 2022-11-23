<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;
use Redirect; //untuk redirect
use App\User;
use DB;

class AuthController extends Controller
{
    public function index() {
        // dd(auth());
        // if (auth()->check()) {
        //     return redirect('dashboard');
        // } 
        
        return view('login');
    }

    public function authenticated(Request $request) {
        // dd($request->all());
        if(Auth::attempt($request->only('email','password'))) {
            $akun = DB::table('users')->where('email', $request->email)->first();
            // dd($akun);
            if($akun->role =='Administrator'){
                Auth::guard('administrator')->LoginUsingId($akun->id);

                return redirect('dashboard')->with('message','Anda Berhasil Login');
            } else if($akun->role =='Users'){
                Auth::guard('users')->LoginUsingId($akun->id);

                return redirect('users')->with('message','Anda Berhasil Login');
            } 
    	}
    	return back()->with('error','Akun Belum Terdaftar');
    }

    public function logout() {
        if(Auth::guard('administrator')->check()){
            Auth::guard('administrator')->logout();
        } else if(Auth::guard('users')->check()){
            Auth::guard('users')->logout();
        }

    	return redirect('/')->with('sukses','Anda Telah Logout');
    }
}

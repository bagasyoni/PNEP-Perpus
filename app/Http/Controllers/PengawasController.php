<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voting;
use App\User;
use App\Tps;
use Auth;

class PengawasController extends Controller
{
    public function index() {
        return view('pengawas');
    }

    public function upload(Request $request) {
        $userid     =   Auth::user()->id;
        $cek        =   Tps::where('user_id', $userid)->count();
        if($cek > 0) {
            $gettps     =   Tps::where('user_id', $userid)->first();
            $tpsid      =   $gettps->id;
            $jumlah     =   $request->input('jumlah');
            $file       =   time().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('files'), $file);

            Voting::create([
                'tps_id'    =>  $tpsid,
                'jumlah'    =>  $jumlah,
                'file'      =>  $file,
                'status'    =>  'Waiting'
            ]);
        } else {

        }
    }

    public function viewProfile(Request $request) {
        $data           =   [];
        $data['user']   =   Auth::user();

        return view('profile', $data);
    }

    public function update(Request $request) {
        $id         =   $request->input('id');
        $email      =   $request->input('email');
        $name       =   $request->input('name');
        $password   =   $request->input('password');

        User::where('id', $id)->update([
            'email'     =>  $email,
            'name'      =>  $name,
            'password'  =>  bcrypt($password)
        ]);
    }
}

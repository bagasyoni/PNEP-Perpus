<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Http\Request;
use App\Tps;
use App\User;
use App\Buku;
use App\Voting;
use App\Genre;
use App\Member;
use App\Pinjam;
use Carbon\Carbon;
use DB;
use URL;
use Auth;

class AdminController extends Controller
{
    public function index() {
        $data               =   [];

        return view('dashboard', $data);
    }

    public function cek(Request $request) {
        $totalBuku      = Buku::count();
        $totalMember    = Member::count();
        $dataChartBuku  = DB::table('pinjam')
                            ->select(DB::raw('MONTH(tgl) as month, COUNT(id_buku) as total_buku, COUNT(na_member) as total_member'))
                            ->groupBy('month')
                            ->get();
        $respond = [];
        $i = 0;
        foreach ($dataChartBuku as $row) {
            $respond['month'][$i]   =   $row->month;
            $respond['total_buku'][$i]   =   $row->total_buku;
            $respond['total_member'][$i] =   $row->total_member;
            $i++;
        }

        echo json_encode($respond);
    }

    public function viewUser() {
        $users  =   User::all();

        $data   =   [];
        $data['users']  =   $users;

        return view('users', $data);
    }

    public function addUser(Request $request) {
        $email      =   $request->input('email');
        $name       =   $request->input('name');
        $password   =   $request->input('password');
        $role       =   $request->input('role');
        
        User::create([
            'email'     =>  $email,
            'name'      =>  $name,
            'password'  =>  bcrypt($password),
            'role'      =>  $role
        ]);

        return response()->json(['status' => 'success', 'message' => 'User berhasil ditambahkan']);
    }

    public function getUser(Request $request) {
        $id     =   $request->input('id');
        $user   =   User::where('id', $id)->first();

        return response()->json($user);
    }

    public function updateUser(Request $request) {
        $id         =   $request->input('id');
        $email      =   $request->input('email');
        $name       =   $request->input('name');
        $password   =   $request->input('password');
        $role       =   $request->input('role');

        User::where('id', $id)->update([
            'email'     =>  $email,
            'name'      =>  $name,
            'password'  =>  $password,
            'role'      =>  $role
        ]);

        return response()->json(['status' => 'success', 'message' => 'User berhasil dirubah']);
    }

    public function deleteUser(Request $request) {
        $id     =   $request->input('id');
        User::where('id', $id)->delete();

        return response()->json(['status' => 'success', 'message' => 'User berhasil dihapus']);
    }

    //=== Start Buku ===//
    public function viewBuku() {
        $genre = Genre::all();
        $buku  =   Buku::all();

        $data   =   [];
        $data['buku']  = $buku;
        $data['genre'] = $genre;

        return view('buku', $data);
    }

    public function addBuku(Request $request) {
        $kd_buku   =   $request->input('kd_buku');
        $na_buku   =   $request->input('na_buku');
        $na_genre  =   $request->input('na_genre');
        $usrnm     =   Auth::user()->name;

        
        Buku::create([
            'kd_buku'   =>  $kd_buku,
            'na_buku'   =>  $na_buku,
            'na_genre'  =>  $na_genre,
            'usrnm'  =>  $usrnm
        ]);

        return response()->json(['status' => 'success', 'message' => 'Buku berhasil ditambahkan']);
    }

    public function getBuku(Request $request) {
        $no_id  =   $request->input('no_id');
        $buku   =   Buku::where('no_id', $no_id)->first();

        
        return response()->json($buku);
    }

    public function updateBuku(Request $request) {
        $no_id     =   $request->input('no_id');
        $kd_buku   =   $request->input('kd_buku');
        $na_buku   =   $request->input('na_buku');
        $na_genre  =   $request->input('na_genre');
        $usrnm     =   Auth::user()->name;

        Buku::where('no_id', $no_id)->update([
            'kd_buku'   =>  $kd_buku,
            'na_buku'   =>  $na_buku,
            'na_genre'  =>  $na_genre,
            'usrnm'     =>  $usrnm,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Buku berhasil diupdate']);
    }

    public function deleteBuku(Request $request) {
        $no_id     =   $request->input('no_id');
        Buku::where('id', $no_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Buku berhasil dihapus']);
    }
    //=== end buku ===//

    //=== Start Genre ===//
    public function viewGenre() {
        $genre  =   Genre::all();

        $data   =   [];
        $data['genre']  =   $genre;
        return view('genre', $data);
    }

    public function addGenre(Request $request) {
        $kd_genre   =   $request->input('kd_genre');
        $na_genre   =   $request->input('na_genre');
        $usrnm      =   Auth::user()->name;
        
        Genre::create([
            'kd_genre'   =>  $kd_genre,
            'na_genre'   =>  $na_genre,
            'usrnm'      =>  $usrnm

        ]);

        return response()->json(['status' => 'success', 'message' => 'Genre berhasil ditambahkan']);
    }

    public function getGenre(Request $request) {
        $no_id     =   $request->input('no_id');
        $genre   =   Genre::where('no_id', $no_id)->first();

        return response()->json($genre);
    }

    public function updateGenre(Request $request) {
        $no_id     =   $request->input('no_id');
        $kd_genre  =   $request->input('kd_genre');
        $na_genre  =   $request->input('na_genre');
        $usrnm     =   Auth::user()->name;

        Genre::where('no_id', $no_id)->update([
            'kd_genre'   =>  $kd_genre,
            'na_genre'   =>  $na_genre,
            'usrnm'      =>  $usrnm
        ]);

        return response()->json(['status' => 'success', 'message' => 'Genre berhasil diupdate']);
    }

    public function deleteGenre(Request $request) {
        $no_id     =   $request->input('no_id');
        Genre::where('no_id', $no_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Genre berhasil dihapus']);
    }
    //=== end genre ===//

    //=== Start Member ===//
    public function viewMember() {
        $member  =   Member::all();

        $data   =   [];
        $data['member']  =   $member;

        return view('member', $data);
    }

    public function addMember(Request $request) {
        $kd_member   =   $request->input('kd_member');
        $na_member   =   $request->input('na_member');
        $alamat      =   $request->input('alamat');
        $kontak      =   $request->input('kontak');
        $usrnm       =   Auth::user()->name;
        
        Member::create([
            'kd_member'   =>  $kd_member,
            'na_member'   =>  $na_member,
            'alamat'      =>  $alamat,
            'kontak'      =>  $kontak,
            'usrnm'       =>  $usrnm
        ]);

        return response()->json(['status' => 'success', 'message' => 'Member berhasil ditambahkan']);
    }

    public function getMember(Request $request) {
        $no_id    =   $request->input('no_id');
        $member   =   Member::where('no_id', $no_id)->first();

        return response()->json($member);
    }

    public function updateMember(Request $request) {
        $no_id       =   $request->input('no_id');
        $kd_member   =   $request->input('kd_member');
        $na_member   =   $request->input('na_member');
        $alamat      =   $request->input('alamat');
        $kontak      =   $request->input('kontak');
        $usrnm       =   Auth::User()->name;

        Member::where('no_id', $no_id)->update([
            'kd_member'   =>  $kd_member,
            'na_member'   =>  $na_member,
            'alamat'      =>  $alamat,
            'kontak'      =>  $kontak,
            'usrnm'       =>  $usrnm,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Member berhasil diupdate']);
    }

    public function deleteMember(Request $request) {
        $no_id     =   $request->input('no_id');
        Member::where('no_id', $no_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Member berhasil dihapus']);
    }
    //=== end member ===//

    //=== Start Pinjam ===//
    public function viewPinjam() {
        $member    =  Member::all();
        $buku      =  Buku::all();
        $pinjam    =  DB::table('pinjam')
                        ->join('buku','pinjam.id_buku','buku.no_id')
                        ->select('pinjam.no_id','pinjam.no_bukti','pinjam.kd_member','pinjam.na_member','pinjam.tgl','pinjam.keterangan','buku.na_buku')
                        ->where('pinjam.status', '0')
                        ->get();
        $data   =   [];
        $data['pinjam']   =   $pinjam;
        $data['buku']     =   $buku;
        $data['member']   =   $member;

                    
        return view('pinjam', $data);
    }

    public function addPinjam(Request $request) {
        $select_bukti       =   DB::table('pinjam')
                            ->select('no_bukti')
                            ->orderBy('no_bukti', 'DESC')
                            ->limit(1)
                            ->get();
        $bulan          =   date("mY");
        $nomor          =   substr($select_bukti, 23, -3);
        $no_bukti       =   "BP". $bulan. "-". str_pad($nomor + 1, 4, '0', STR_PAD_LEFT);
        $kd_member      =   $request->input('kd_member');
        $na_member      =   $request->input('na_member');
        $tgl            =   Carbon::now()->format('Y-m-d');
        $id_buku        =   $request->input('id_buku');
        $keterangan     =   $request->input('keterangan');
        $usrnm          =   Auth::User()->name;
        
        Pinjam::create([
            'no_bukti'    =>  $no_bukti,
            'kd_member'   =>  $kd_member,
            'na_member'   =>  $na_member,
            'tgl'         =>  $tgl,
            'id_buku'     =>  $id_buku,
            'keterangan'  =>  $keterangan,
            'usrnm'       =>  $usrnm
        ]);
        dd($no_bukti);
        return response()->json(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
    }

    public function getPinjam(Request $request) {
        $no_id     =   $request->input('no_id');
        $pinjam    =   Pinjam::where('no_id', $no_id)->first();

        return response()->json($pinjam);
    }

    public function updatePinjam(Request $request) {
        $no_id     =   $request->input('no_id');
        $no_bukti  =   $request->input('no_bukti');
        $na_peg    =   $request->input('na_peg');
        $devisi    =   $request->input('devisi');
        $tgl       =   $request->input('tgl');
        $keterangan=   $request->input('keterangan');
        $buku_id   =   $request->input('buku_id');
        $usrnm     =   $request->input('usrnm');
        $tg_smp    =   $request->input('tg_smp');

        Pinjam::where('no_id', $no_id)->update([
            'no_bukti' =>  $no_bukti,
            'na_peg'   =>  $na_peg,
            'devisi'    =>  $devisi,
            'tgl'       =>  $tgl,
            'keterangan'      =>  $keterangan,
            'buku_id'  =>  $buku_id,
            'usrnm'    =>  $usrnm,
            'tg_smp'   =>  $tg_smp
        ]);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate']);
    }

    public function deletePinjam(Request $request) {
        $no_id     =   $request->input('no_id');
        Pinjam::where('no_id', $no_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
    //=== end pinjam ===//

    public function getChart(){
        $totalBuku      = Buku::count();
        $totalPegawai   = Pegawai::count();
        $dataChart     = DB::table('keluar')
                            ->join('buku','keluar.buku_id','buku.no_id')
                            ->select('keluar.no_id','keluar.no_bukti','keluar.na_peg','keluar.devisi','keluar.tgl','keluar.ket','buku.na_buku')
                            ->whereMonth('keluar.tgl','=', '11')
                            ->get();
        dd($dataChart);
    }
}

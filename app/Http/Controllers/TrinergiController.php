<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Pelanggan;
use App\Group;
use App\Peran;
use App\Trx_PBM;
Use Session;
Use DB;
Use stdClass;

class TrinergiController extends Controller
{    
    public function dashboard() {
        // return Session::all();
        // if (Session::get('peran_id') === 1 || Session::get('peran_id') === 2 || Session::get('peran_id') === 3 || Session::get('peran_id') === 4) {
        //     $notif_pbm_masuk = Trx_PBM::all()->where('level','=',0)->count();
        //     return view('dashboard',compact('notif_pbm_masuk'));
        // }

        $statik_pbm_jan = DB::select('SELECT COUNT(trx_pbm_id) as pbm_jan FROM tbl_trx_pbm where MONTH(tgl_pbm_masuk) = 01 AND YEAR(tgl_pbm_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbm_feb = DB::select('SELECT COUNT(trx_pbm_id) as pbm_feb FROM tbl_trx_pbm where MONTH(tgl_pbm_masuk) = 02 AND YEAR(tgl_pbm_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbm_mar = DB::select('SELECT COUNT(trx_pbm_id) as pbm_mar FROM tbl_trx_pbm where MONTH(tgl_pbm_masuk) = 03 AND YEAR(tgl_pbm_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbm_apr = DB::select('SELECT COUNT(trx_pbm_id) as pbm_apr FROM tbl_trx_pbm where MONTH(tgl_pbm_masuk) = 04 AND YEAR(tgl_pbm_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbk_jan = DB::select('SELECT COUNT(trx_pbk_id) as pbk_jan FROM tbl_trx_pbk where MONTH(tgl_pbk_masuk) = 01 AND YEAR(tgl_pbk_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbk_feb = DB::select('SELECT COUNT(trx_pbk_id) as pbk_feb FROM tbl_trx_pbk where MONTH(tgl_pbk_masuk) = 02 AND YEAR(tgl_pbk_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbk_mar = DB::select('SELECT COUNT(trx_pbk_id) as pbk_mar FROM tbl_trx_pbk where MONTH(tgl_pbk_masuk) = 03 AND YEAR(tgl_pbk_masuk) = YEAR(CURRENT_TIME)');
        $statik_pbk_apr = DB::select('SELECT COUNT(trx_pbk_id) as pbk_apr FROM tbl_trx_pbk where MONTH(tgl_pbk_masuk) = 04 AND YEAR(tgl_pbk_masuk) = YEAR(CURRENT_TIME)');

        //return $statik_pbk_jan;
        // else {
            return view('dashboard', compact('statik_pbm_jan','statik_pbm_feb','statik_pbm_mar','statik_pbm_apr','statik_pbk_jan','statik_pbk_feb','statik_pbk_mar','statik_pbk_apr'));
        // }
    }

    public function login(){

        if (Session::get('token') === 'SPSBNI' &&  Session::get('status') === 'LOGGED' && Session::get('username') !== NULL) {
            return redirect('dashboard');   
        }

        return view('login_form');
    }
     
    public function loginCheck(Request $request) {
        $user = User::where('username', $request->username)->where('password', md5($request->password))->first();
 
        if ($user){
            if($user->peran_id === 6) {
                $data_pelanggan = Pelanggan::where('pelanggan_id','=',$user->pelanggan_id)->first();
                $nama_peran = $data_pelanggan->nama_pelanggan;
                $pelanggan_id = $data_pelanggan->pelanggan_id;

                if(strlen($nama_peran > 20)) {
                    $nama_peran = substr($nama_peran, 0 ,20) . ' ...';
                }
           }

           else {
               $data_peran = Peran::where('peran_id','=',$user->peran_id)->first();
               $nama_peran = $data_peran->nama_peran;
               $pelanggan_id = NULL;
           }

            Session::put([
                'user_id' => $user->user_id,
                'nama' => $user->nama,
                'nama_peran' => $nama_peran,
                'username' => $user->username,
                'peran_id' => $user->peran_id,
                'pelanggan_id' => $pelanggan_id,
                'token' => 'SPSBNI',
                'status' => 'LOGGED'
            ]);

            return redirect('dashboard');
        }

        else {
            $pesan = '<div style="text-align:center;" class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Kesalahan!</strong> Username atau Password salah!</div>';
            return redirect('/')->with(['pesan' => $pesan]);
        }
    
    }
    
    public function logout() {
        Session::flush();
        return redirect('/');
    }

    public function gantipassword() {
        return view('Trinergi/form_ganti_password');
    }

    public function updatepassword(Request $request) {
        $id = Session::get('user_id');

        $validator = Validator::make($request->all(),['password_lama' => 'required|min:6','password_baru' => 'required|min:6','ulangi_password' => 'same:password_baru']);

        $data_user = User::findOrFail($id);
        if(md5($request->password_lama) !=$data_user->password) {
            $validator->errors()->add('password_lama', 'Password lama tidak cocok!');
            return back()->withErrors($validator);
        }

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data_user->password          = md5($request->password_baru);
        $data_user->peubah            = Session::get('user_id');
        $data_user->update();
       
        $pesan = 'Password berhasil diubah';
        return redirect('dashboard')->with(['pesan' => $pesan]);
      
    }

}

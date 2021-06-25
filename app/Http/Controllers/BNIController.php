<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Session;
use App\Supplier;
use App\Pelanggan;
use App\KategoriBarang;
use App\Jenis_Layanan;
use App\Barang;
use App\Divisi;
use App\Tarif;
Use App\Trx_PBM;
use App\Trx_PBM_Detail;
Use App\Trx_PBK;
use App\Trx_PBK_Detail;
use App\Kota_Tujuan;
use DB;


class BNIController extends Controller
{

// Supplier CRUD
    public function formsupplier() {

        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
       
        if (Session::get('peran_id') <> 6) {
            return view('BNI/Supplier/form_supplier',compact('data_pel'));
        }

        else {
            $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku')->where('pelanggan_id','=',Session::get('pelanggan_id'))->orderBy('nama_kategori','ASC')->get();
            return view('BNI/Supplier/form_supplier');
        }
        
    }

    public function inputsupplier(Request $request){
        
        $data_sup                   = new Supplier;

        if (Session::get('peran_id') <> 6) {
            $data_sup->pelanggan_id = $request->pelanggan_id;
        }

        else {
            $data_sup->pelanggan_id = Session::get('pelanggan_id');
        }

        $data_sup->nama_supplier    = $request->nama_supplier;
        $data_sup->alamat_supplier  = $request->alamat_supplier;
        $data_sup->telp_supplier    = $request->telp_supplier;
        $data_sup->email_supplier   = $request->email_supplier;
        $data_sup->pembuat          = Session::get('user_id');
        $data_sup->save();

        $pesan = $data_sup->nama_supplier.', berhasil ditambahkan';
        return redirect('listsupplier')->with(['pesan' => $pesan]);
    }

    public function listsupplier() {

        if (Session::get('peran_id') <> 6) {
            $data_sup = DB::table('tbl_supplier')
            ->join('tbl_pelanggan','tbl_supplier.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->select('tbl_supplier.supplier_id','tbl_supplier.nama_supplier','tbl_supplier.alamat_supplier','tbl_supplier.telp_supplier','tbl_supplier.email_supplier','tbl_supplier.PIC','tbl_pelanggan.nama_pelanggan','tbl_supplier.created_at')
            ->orderBy('created_at','DESC')
            ->get();
        }

        else {
            $data_sup = DB::table('tbl_supplier')
            ->join('tbl_pelanggan','tbl_supplier.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->select('tbl_supplier.supplier_id','tbl_supplier.nama_supplier','tbl_supplier.alamat_supplier','tbl_supplier.telp_supplier','tbl_supplier.email_supplier','tbl_supplier.PIC','tbl_supplier.created_at')
            ->where('tbl_supplier.pelanggan_id','=',Session::get('pelanggan_id'))
            ->orderBy('created_at','DESC')
            ->get();
        }

        return view('BNI/Supplier/list_supplier',compact('data_sup'));

    }

    public function deletesupplier($id) {
        $data_sup = Supplier::findOrFail($id);
        $data_sup->delete();
        $pesan = $data_sup->nama_supplier.', berhasil dihapus';
        return redirect('listsupplier')->with(['pesan' => $pesan]);

    }

    public function editsupplier($id) {
        $data_sup = Supplier::findOrFail($id);
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
        return view('BNI/Supplier/edit_supplier', compact('data_sup','data_pel'));
    
    }

    public function viewsupplier($id) {
        $data_sup = Supplier::findOrFail($id);
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
        return view('BNI/Supplier/view_supplier', compact('data_sup','data_pel'));
    
    }

    public function updatesupplier(Request $request) {
        $data_sup = Supplier::findOrFail($request->supplier_id);
        $data_sup->nama_supplier    = $request->nama_supplier;
        $data_sup->alamat_supplier  = $request->alamat_supplier;
        $data_sup->telp_supplier    = $request->telp_supplier;
        $data_sup->email_supplier   = $request->email_supplier;
        $data_sup->PIC              = $request->PIC;
        $data_sup->peubah           = Session::get('user_id');
        $data_sup->update();
        
        $pesan = 'Data berhasil diubah';
        return redirect('listsupplier')->with(['pesan' => $pesan]);
    }

// Barang CRUD
    public function minta_kategori($id) {
        $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku')->where('pelanggan_id',$id)->orderBy('nama_kategori','ASC')->get();
        return json_encode($data_kat);
        
    }

    public function formbarang() {

        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
       
        if (Session::get('peran_id') <> 6 ) {
            return view('BNI/Barang/form_barang',compact('data_pel'));
        }

        else {
            $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku')->where('pelanggan_id','=',Session::get('pelanggan_id'))->orderBy('nama_kategori','ASC')->get();
            return view('BNI/Barang/form_barang',compact('data_kat'));   
        }
    }
    
    public function inputbarang(Request $request){
        $data_bar                   = new Barang;
        $data_bar->nama_barang      = $request->nama_barang;
        
        if (Session::get('peran_id') <> 6){
            $data_bar->pelanggan_id = $request->pelanggan_id;
        }

        else {
            $data_bar->pelanggan_id = Session::get('pelanggan_id');
        }

        $data_bar->kategori_id      = $request->kategori_id;
        $data_bar->SKU              = $request->SKU;
        $data_bar->harga            = str_replace(',', '', $request->harga);
        $data_bar->spesifikasi_barang  = $request->spesifikasi_barang;
       
        if($request->foto_barang != NULL ) {
            $validator = Validator::make($request->all(),['foto_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            
            if($validator->fails()) {
                return back()->withErrors($validator);
            }
            
            $file = $request->file('foto_barang');
            $nama_file = date('d-m-yy').'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('foto_barang',$nama_file);
            $data_bar->foto_barang       = $nama_file;
        }

        $data_bar->tahun            = str_replace('_', '0', $request->tahun);
        $data_bar->pembuat          = Session::get('user_id');
        $data_bar->save();

        $pesan = $data_bar->nama_barang.', berhasil ditambahkan';
        return redirect('listbarang')->with(['pesan' => $pesan]);

    }
 
    public function listbarang() {
        if (Session::get('peran_id') === 6) {
            $data_bar = DB::table('tbl_barang')
            ->join('tbl_pelanggan','tbl_barang.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
            ->select('tbl_barang.barang_id', 'tbl_barang.nama_barang', 'tbl_kategori_barang.nama_kategori', 'tbl_kategori_barang.kode_sku', 'tbl_barang.SKU', 'tbl_barang.harga', 'tbl_barang.tahun', 'tbl_barang.spesifikasi_barang', 'tbl_barang.foto_barang','tbl_barang.created_at')
            ->where('tbl_barang.pelanggan_id','=',Session::get('pelanggan_id'))
            ->orderBy('created_at','DESC')
            ->get();
        }

        else {
            $data_bar = DB::table('tbl_barang')
            ->join('tbl_pelanggan','tbl_barang.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
            ->select('tbl_barang.barang_id', 'tbl_barang.nama_barang', 'tbl_kategori_barang.nama_kategori', 'tbl_kategori_barang.kode_sku', 'tbl_barang.SKU', 'tbl_barang.harga', 'tbl_barang.tahun', 'tbl_barang.spesifikasi_barang', 'tbl_barang.foto_barang','tbl_pelanggan.nama_pelanggan','tbl_barang.created_at')
            ->orderBy('created_at','DESC')
            ->get();
        }

        return view('BNI/Barang/list_barang',compact('data_bar'));

    }

    public function deletebarang($id) {
        $data_bar = Barang::findOrFail($id);
        $data_bar->delete();
       
        $pesan = $data_bar->nama_barang.', berhasil dihapus';
        return redirect('listbarang')->with(['pesan' => $pesan]);

    }

    public function editbarang($id) {
        $data_bar = Barang::findOrFail($id);
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->where('pelanggan_id','=',$data_bar->pelanggan_id)->first();
        $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku')->where('pelanggan_id','=',$data_bar->pelanggan_id)->orderBy('nama_kategori','ASC')->get();
        
        return view('BNI/Barang/edit_barang', compact('data_kat','data_pel','data_bar'));  
    
    }

    public function viewbarang($id) {
        $data_bar = Barang::findOrFail($id);
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->where('pelanggan_id','=',$data_bar->pelanggan_id)->first();
        $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku')->where('pelanggan_id','=',$data_bar->pelanggan_id)->orderBy('nama_kategori','ASC')->get();
        
        return view('BNI/Barang/view_barang', compact('data_kat','data_pel','data_bar'));  
    
    }

    public function updatebarang(Request $request) {
        $data_bar = Barang::findOrFail($request->barang_id);
        $data_bar_check = Barang::findOrFail($request->barang_id);
        $lokasi_foto = $data_bar_check->foto_barang;

        if ($request->hapus_foto == NULL){
            
            if ($request->foto_barang != NULL) {
                
                if(File::exists(public_path('/gambar/'.$lokasi_foto))) {
                    File::delete(public_path('/gambar/'.$lokasi_foto));
                }
    
                $validator = Validator::make($request->all(),['foto_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);

                if($validator->fails()) {
                    return back()->withErrors($validator);
                }
    
                $file = $request->file('foto_barang');
                $nama_file = date('d-m-yy').'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->move('gambar',$nama_file);
                $data_bar->foto_barang = $nama_file;
            }
        }
        
        else {

            if(File::exists(public_path('/gambar/'.$lokasi_foto))) {
                File::delete(public_path('/gambar/'.$lokasi_foto));
            }

            $data_bar->foto_barang = NULL;
        }

        $data_bar->nama_barang      = $request->nama_barang;
        $data_bar->kategori_id      = $request->kategori_id;
        $data_bar->SKU              = $request->SKU;
        $data_bar->harga            = str_replace(',', '', $request->harga);
        $data_bar->tahun            = $request->tahun;
        $data_bar->spesifikasi_barang  = $request->spesifikasi_barang;
        $data_bar->tahun            = str_replace('_', '0', $request->tahun);
        $data_bar->peubah           = Session::get('user_id');
        $data_bar->update();

        $pesan = 'Data berhasil diubah';
        return redirect('listbarang')->with(['pesan' => $pesan]);

    }

 // Form PMB
    public function incrementIDpbm($opsi = NULL) {
        $max = Trx_PBM::max('trx_pbm_id');
           
            if($opsi == "str") {
                $panjang = 6;
                $new = strval($max + 1);
            
                for($i = strlen($new); $i < $panjang; $i++) {
                    $new = '0'.$new;
                }
                return $new;
            }

            else{
                return $max + 1;
            }
    }

    public function formpbm() {
        $kode_pbm = "PBM - " .$this->incrementIDpbm("str");
        $data_bar = DB::table('tbl_barang')
        ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        ->select('tbl_barang.barang_id','tbl_barang.nama_barang','tbl_barang.SKU','tbl_kategori_barang.kode_sku')
        ->where('tbl_barang.pelanggan_id','=',Session::get('pelanggan_id'))
        ->orderBy('tbl_barang.nama_barang','ASC')
        ->get();

        $data_sup = Supplier::select('supplier_id','nama_supplier')
        ->where('pelanggan_id','=',Session::get('pelanggan_id'))
        ->orderBy('nama_supplier','ASC')
        ->get();

        return view('BNI/PBM/form_pbm_BNI', compact('data_bar','data_sup','kode_pbm'));
    }


    public function inputpbm(Request $request) {
        $kode_trx_pbm               = $this->incrementIDpbk("str");
        $id                         = $this->incrementIDpbm();
        $data_pbm                   = new Trx_PBM;
        $data_pbm->trx_pbm_id       = $id;
        $data_pbm->kode_trx_pbm     = $kode_trx_pbm;
        $data_pbm->tgl_pbm          = date('Y-m-d H:i:s');
        $data_pbm->tgl_pbm_masuk    = $request->tgl_pbm_masuk;
        $data_pbm->keterangan       = $request->keterangan;
        $data_pbm->level            = 1;
        $data_pbm->status           = $request->status;
        $data_pbm->pelanggan_id     = Session::get('pelanggan_id');
        $data_pbm->pembuat          = Session::get('user_id');
        
        $data_pbm->save();

        for ($i = 1; $i <= $request->max_indeks_array; $i++){ //Bisa diganti dengan foreach.

            if(isset($request->data[$i])) {
                $data_pbm_detail                     = new Trx_PBM_Detail;
                $data_pbm_detail->trx_pbm_id         = $id;
                $data_pbm_detail->barang_id          = $request->data[$i]['barang_id'];
                $data_pbm_detail->supplier_id        = $request->data[$i]['supplier_id'];
                $data_pbm_detail->qty                = $request->data[$i]['kuantitas'];
                $data_pbm_detail->save();
            }

        }
        $pesan = 'Transaksi PBM - '.$kode_trx_pbm.', berhasil ditambahkan!';
        return redirect('listpbm')->with(['pesan' => $pesan]);
    }

    public function listpbm() {
        $data_list_pbm = DB::select('select tbl_trx_pbm.status, tbl_trx_pbm.level, tbl_trx_pbm.trx_pbm_id as id_utama, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.tgl_pbm_masuk, tbl_trx_pbm.created_at, ( SELECT SUM(qty) FROM tbl_trx_pbm_detail WHERE tbl_trx_pbm_detail.trx_pbm_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_barang on tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_supplier ORDER BY nama_supplier SEPARATOR ", " ) AS supplier FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_supplier on tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as supplier FROM tbl_trx_pbm WHERE tbl_trx_pbm.pelanggan_id = '.Session::get("pelanggan_id").' ORDER BY tbl_trx_pbm.created_at DESC;');
        //Rubah ke ORM Query Builder Nanti

        return view('BNI/PBM/list_pbm_BNI',compact('data_list_pbm'));
    }

    public function deletepbm($id) {
        $data_pbm_detail = Trx_PBM_Detail::where('trx_pbm_id',$id)->get();
        $data_pbm_detail->each->delete();
        $data_pbm = Trx_PBM::findOrFail($id);
        $data_pbm->delete();
        $pesan = 'PBM - '.$data_pbm->kode_trx_pbm.', berhasil dihapus';
        return redirect('listpbm')->with(['pesan' => $pesan]);
    }

    public function editpbm($id) {
        $data_pbm = Trx_PBM::findOrFail($id);
        $data_pbm_detail = Trx_PBM_Detail::where('trx_pbm_id',$id)->get();
        $data_bar = DB::select('SELECT tbl_barang.barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU FROM `tbl_barang` INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id WHERE tbl_barang.pelanggan_id = '.Session::get('pelanggan_id').' ORDER BY tbl_barang.nama_barang ASC;'); 
        $data_sup = Supplier::select('supplier_id','nama_supplier')->where('pelanggan_id','=',Session::get('pelanggan_id'))->orderBy('nama_supplier','ASC')->get();
        return view('BNI/PBM/edit_pbm_BNI', compact('data_pbm','data_pbm_detail','data_bar','data_sup'));
    }

    public function updatepbm(Request $request) {
        $data_pbm                   = Trx_PBM::findOrFail($request->trx_id);
        $data_pbm->tgl_pbm_masuk    = $request->tgl_pbm_masuk;
        $data_pbm->keterangan       = $request->keterangan;
        $data_pbm->status           = $request->status;
        $data_pbm->peubah           = Session::get('user_id');
        $data_pbm->update();
        $data_pbm_detail = Trx_PBM_Detail::where('trx_pbm_id', $request->trx_id)->get();
        $data_pbm_detail->each->delete();
        $index = $request->max_indeks_array;
      
        for ($i = 1; $i <= $index; $i++){
            
            if(isset($request->data[$i])) {
                $validator = Validator::make($request->data[$i],['kuantitas' => 'required']);
    
                if($validator->fails()) {
                    return back()->withErrors($validator);
                }
                $data_pbm_detail                     = new Trx_PBM_Detail;
                $data_pbm_detail->trx_pbm_id         = $request->trx_id;
                $data_pbm_detail->barang_id          = $request->data[$i]['barang_id'];
                $data_pbm_detail->supplier_id        = $request->data[$i]['supplier_id'];
                $data_pbm_detail->qty                = $request->data[$i]['kuantitas'];
             
                $data_pbm_detail ->save();
            }

        }
        $pesan = 'Data berhasil diubah';
        return redirect('listpbm')->with(['pesan' => $pesan]);
    }

    public function incrementIDpbk($opsi = NULL) {
        $max = Trx_PBK::max('trx_pbk_id');
           
            if($opsi == "str") {
                $panjang = 6;
                $new = strval($max + 1);
            
                for($i = strlen($new); $i < $panjang; $i++) {
                    $new = '0'.$new;
                }
                return $new;
            }

            else{
                return $max + 1;
            }
    }

    public function formpbk() {
        $kode_pbk = "PBK - " .$this->incrementIDpbk("str");

        $data_bar = DB::select('SELECT * FROM ( SELECT t.barang_id, t.nama_barang, t.kode_sku, t.SKU, t.pelanggan_id, t.aktual, ( select sum( tbl_trx_pbm_alokasi.alokasi_akt ) from tbl_trx_pbm_alokasi INNER JOIN tbl_trx_pbm_detail ON tbl_trx_pbm_detail.trx_pbm_detail_id = tbl_trx_pbm_alokasi.trx_pbm_detail_id INNER JOIN tbl_barang ON tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id where tbl_trx_pbm_detail.barang_id = t.barang_id ) as gudang FROM ( SELECT tbl_barang.barang_id as barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU, tbl_barang.pelanggan_id, SUM(tbl_trx_pbm_terima.aktual) AS aktual FROM tbl_trx_pbm_detail INNER JOIN tbl_barang ON tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id INNER JOIN tbl_kategori_barang ON tbl_barang.kategori_id = tbl_kategori_barang.kategori_id LEFT JOIN tbl_trx_pbm_terima ON tbl_trx_pbm_terima.trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id GROUP BY tbl_barang.barang_id ) as t WHERE t.pelanggan_id = '.Session::get('pelanggan_id').' ) as tabel WHERE aktual IS NOT NULL AND gudang IS NOT NULL');
        //Rubah ke ORM Query Builder Nanti

        $data_kota = Kota_Tujuan::select('kota_id','kota_tujuan')
        ->orderBy('kota_tujuan','ASC')
        ->get();

        $data_layanan = Jenis_Layanan::select('layanan_id','nama_layanan')
        ->get();

        // $data_sup = Supplier::select('supplier_id','nama_supplier')
        // ->where('pelanggan_id','=',Session::get('pelanggan_id'))
        // ->orderBy('nama_supplier','ASC')
        // ->get();

        return view('BNI/PBK/form_pbK_BNI', compact('kode_pbk','data_bar','data_kota', 'data_layanan'));
        // return view('BNI/PBK/form_pbK_BNI', compact('data_bar','data_sup','kode_pbm'));


        // $kode_pbk = "PBK - " .$this->incrementIDpbm("str");
        // $kota_tujuan = Tarif::select('tarif_id','kota_tujuan')->get();
        // $data_bar = DB::select('SELECT tbl_barang.barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU FROM `tbl_barang` INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id WHERE tbl_barang.pelanggan_id = '.Session::get('pelanggan_id').' ORDER BY tbl_barang.nama_barang ASC;'); 
        // return view('BNI/PBK/form_pbk_BNI', compact('kode_pbk','data_bar','kota_tujuan'));
        
    }

    public function cektarif(Request $request) {
        $tarif = Tarif::select('tarif', 'leadtime')
        ->where('pelanggan_id', Session::get('pelanggan_id'))
        ->where('kota_id', $request->kota_id)
        ->where('layanan_id', $request->layanan_id)
        ->first();
        return response()->json($tarif);
    }

    public function cekstok(Request $request) {
        $stock = DB::select('SELECT * FROM ( SELECT t.id_barang as barang_id, t.nama_barang, t.kode_sku, t.SKU, t.harga, t.tahun, t.foto_barang, t.nama_supplier, t.pelanggan_id, t.nama_pelanggan, t.aktual, ( select sum( tbl_trx_pbm_alokasi.alokasi_akt ) from tbl_trx_pbm_alokasi INNER JOIN tbl_trx_pbm_detail ON tbl_trx_pbm_detail.trx_pbm_detail_id = tbl_trx_pbm_alokasi.trx_pbm_detail_id INNER JOIN tbl_barang ON tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id where tbl_trx_pbm_detail.barang_id = t.id_barang ) as gudang FROM ( SELECT tbl_barang.barang_id as id_barang, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU, tbl_barang.harga, tbl_barang.tahun, tbl_barang.foto_barang, tbl_barang.pelanggan_id, tbl_pelanggan.nama_pelanggan, SUM(tbl_trx_pbm_terima.aktual) AS aktual, REPLACE( GROUP_CONCAT(tbl_supplier.nama_supplier), ",", ", " ) AS nama_supplier FROM tbl_trx_pbm_detail INNER JOIN tbl_barang ON tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id INNER JOIN tbl_kategori_barang ON tbl_barang.kategori_id = tbl_kategori_barang.kategori_id LEFT JOIN tbl_supplier ON tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id LEFT JOIN tbl_trx_pbm_terima ON tbl_trx_pbm_terima.trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id LEFT JOIN tbl_pelanggan on tbl_barang.pelanggan_id = tbl_pelanggan.pelanggan_id GROUP BY tbl_barang.barang_id ) as t WHERE t.pelanggan_id = '.Session::get('pelanggan_id').' and t.id_barang = '.$request->barang_id.' ) as tabel WHERE aktual IS NOT NULL AND gudang IS NOT NULL');
          //Rubah ke ORM Query Builder Nanti
        return response()->json($stock);
    }

    public function listinventory() {
        $data_list_inventori_pbk = DB::select('SELECT * FROM ( SELECT t.id_barang, t.nama_barang, t.kode_sku, t.SKU, t.harga, t.tahun, t.foto_barang, t.nama_supplier, t.pelanggan_id, t.nama_pelanggan, t.aktual, ( select sum( tbl_trx_pbm_alokasi.alokasi_akt ) from tbl_trx_pbm_alokasi INNER JOIN tbl_trx_pbm_detail ON tbl_trx_pbm_detail.trx_pbm_detail_id = tbl_trx_pbm_alokasi.trx_pbm_detail_id INNER JOIN tbl_barang ON tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id where tbl_trx_pbm_detail.barang_id = t.id_barang ) as gudang FROM ( SELECT tbl_barang.barang_id as id_barang, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU, tbl_barang.harga, tbl_barang.tahun, tbl_barang.foto_barang, tbl_barang.pelanggan_id, tbl_pelanggan.nama_pelanggan, SUM(tbl_trx_pbm_terima.aktual) AS aktual, REPLACE( GROUP_CONCAT(tbl_supplier.nama_supplier), ",", ", " ) AS nama_supplier FROM tbl_trx_pbm_detail INNER JOIN tbl_barang ON tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id INNER JOIN tbl_kategori_barang ON tbl_barang.kategori_id = tbl_kategori_barang.kategori_id LEFT JOIN tbl_supplier ON tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id LEFT JOIN tbl_trx_pbm_terima ON tbl_trx_pbm_terima.trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id LEFT JOIN tbl_pelanggan on tbl_barang.pelanggan_id = tbl_pelanggan.pelanggan_id GROUP BY tbl_barang.barang_id ) as t WHERE t.pelanggan_id = '.Session::get('pelanggan_id').' ) as tabel WHERE aktual IS NOT NULL AND gudang IS NOT NULL');
        return view('BNI/PBK/list_inventori',compact('data_list_inventori_pbk'));
          //Rubah ke ORM Query Builder Nanti
    }

    public function inputpbk (Request $request) {
        //  return $request;
        $kode_trx_pbk               = $this->incrementIDpbk("str");
        $id                         = $this->incrementIDpbk();
        $data_pbk                   = new Trx_PBK;
        $data_pbk->trx_pbk_id       = $id;
        $data_pbk->kode_trx_pbk     = $kode_trx_pbk;
        $data_pbk->tgl_pbk          = date('Y-m-d H:i:s');
        $data_pbk->tgl_pbk_masuk    = $request->tgl_pbk_masuk;
        $data_pbk->nama_pemesan     = $request->nama_pemesan;
        $data_pbk->nama_tujuan      = $request->nama_tujuan;
        $data_pbk->alamat_tujuan    = $request->alamat;
        $data_pbk->layanan_id       = $request->jenis_layanan;
        $data_pbk->kota_id          = $request->kota_tujuan;
        $data_pbk->tarif_harga      = $request->tarif_harga;
        $data_pbk->lead_time        = $request->lead_time;
        $data_pbk->nama_program     = $request->nama_program;
        $data_pbk->keterangan       = $request->keterangan;
        $data_pbk->level            = 1;
        $data_pbk->status           = $request->status;
        $data_pbk->pelanggan_id     = Session::get('pelanggan_id');
        $data_pbk->pembuat          = Session::get('user_id');
        
        $data_pbk->save();

        for ($i = 1; $i <= $request->max_indeks_array; $i++){ //Bisa diganti dengan foreach.

            if(isset($request->data[$i])) {
                $data_pbk_detail                     = new Trx_PBK_Detail;
                $data_pbk_detail->trx_pbk_id         = $id;
                $data_pbk_detail->barang_id          = $request->data[$i]['barang_id'];
                $data_pbk_detail->qty                = $request->data[$i]['qty'];
                $data_pbk_detail->stock              = $request->data[$i]['stock'];
                $data_pbk_detail->sisa               = $request->data[$i]['perkiraan'];
                $data_pbk_detail->save();
            }
        }
        $pesan = 'Transaksi PBK - '.$kode_pbm.', berhasil ditambahkan!';
        return redirect('listpbk')->with(['pesan' => $pesan]);
    }

    public function listpbk() {
        $data_list_pbk = DB::select('select tbl_trx_pbk.status, tbl_trx_pbk.level, tbl_trx_pbk.trx_pbk_id as id_utama, tbl_trx_pbk.kode_trx_pbk, tbl_trx_pbk.tgl_pbk_masuk, tbl_trx_pbk.nama_tujuan, tbl_trx_pbk.alamat_tujuan, tbl_master_kota.kota_tujuan, tbl_trx_pbk.created_at, ( SELECT SUM(qty) FROM tbl_trx_pbk_detail WHERE tbl_trx_pbk_detail.trx_pbk_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbk INNER JOIN tbl_trx_pbk_detail on tbl_trx_pbk.trx_pbk_id = tbl_trx_pbk_detail.trx_pbk_id INNER JOIN tbl_barang on tbl_trx_pbk_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbk.trx_pbk_id = id_utama GROUP BY tbl_trx_pbk.trx_pbk_id ORDER BY tbl_trx_pbk_detail.trx_pbk_id ASC ) as barang FROM tbl_trx_pbk INNER JOIN tbl_master_kota on tbl_trx_pbk.kota_id = tbl_master_kota.kota_id WHERE tbl_trx_pbk.pelanggan_id = '.Session::get('pelanggan_id').' ORDER BY tbl_trx_pbk.created_at DESC;');
        //Rubah ke ORM Query Builder Nanti

        //return $data_list_pbk;
        return view('BNI/PBK/list_pbk_BNI',compact('data_list_pbk'));
    }
    
    public function deletepbk($id) {
        $data_pbm_detail = Trx_PBK_Detail::where('trx_pbk_id',$id)->get();
        $data_pbm_detail->each->delete();
        $data_pbm = Trx_PBK::findOrFail($id);
        $data_pbm->delete();
        $pesan = 'PBK - '.$data_pbm->kode_trx_pbm.', berhasil dihapus';
        return redirect('listpbk')->with(['pesan' => $pesan]);
    }

    public function editpbk($id) {
        $data_pbm = Trx_PBK::findOrFail($id);
        $data_pbm_detail = Trx_PBM_Detail::where('trx_pbk_id',$id)->get();
        $data_bar = DB::select('SELECT tbl_barang.barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU FROM `tbl_barang` INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id WHERE tbl_barang.pelanggan_id = '.Session::get('pelanggan_id').' ORDER BY tbl_barang.nama_barang ASC;'); 
        return view('BNI/PBM/edit_pbm_BNI', compact('data_pbm','data_pbm_detail','data_bar'));
    }

    public function updatepbk(Request $request) {
        $data_pbm                   = Trx_PBM::findOrFail($request->trx_id);
        $data_pbm->tgl_pbm_masuk    = $request->tgl_pbm_masuk;
        $data_pbm->keterangan       = $request->keterangan;
        $data_pbm->status           = $request->status;
        $data_pbm->peubah           = Session::get('user_id');
        $data_pbm->update();
        $data_pbm_detail = Trx_PBM_Detail::where('trx_pbm_id', $request->trx_id)->get();
        $data_pbm_detail->each->delete();
        $index = $request->max_indeks_array;
      
        for ($i = 1; $i <= $index; $i++){
            
            if(isset($request->data[$i])) {
                $validator = Validator::make($request->data[$i],['kuantitas' => 'required']);
    
                if($validator->fails()) {
                    return back()->withErrors($validator);
                }
                $data_pbm_detail                     = new Trx_PBM_Detail;
                $data_pbm_detail->trx_pbm_id         = $request->trx_id;
                $data_pbm_detail->barang_id          = $request->data[$i]['barang_id'];
                $data_pbm_detail->supplier_id        = $request->data[$i]['supplier_id'];
                $data_pbm_detail->qty                = $request->data[$i]['kuantitas'];
             
                $data_pbm_detail ->save();
            }

        }
        $pesan = 'Data berhasil diubah';
        return redirect('listpbm')->with(['pesan' => $pesan]);
    }

}


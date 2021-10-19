<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
//use App\Http\Controllers\TrinergiController;
use App\Imports\TarifImport;
use Maatwebsite\Excel\Facades\Excel;
use App\KategoriBarang;
use App\Supplier;
use App\Gudang;
use App\Pelanggan;
use App\User;
use App\Barang;
use App\Peran;
use App\Trx_PBM;
use App\Trx_PBM_Acc;
use App\Trx_PBM_Terima;
use App\Trx_PBM_Alokasi;
use App\Trx_PBM_Detail;
use App\Trx_PBK;
use App\Tarif;
Use Session;
use DB;

class SPSController extends Controller
{

    public function formgudang() {
        return view('SPS/Gudang/form_gudang');
    }

    public function inputgudang(Request $request){
        $data_gud                   = new Gudang;
        $data_gud->nama_gudang      = $request->nama_gudang;
        $data_gud->alamat_gudang    = $request->alamat_gudang;
        $data_gud->pembuat          = Session::get('user_id');
        $data_gud->save();

        $pesan = $data_gud->nama_gudang.', berhasil ditambahkan';
        return redirect('listgudang')->with(['pesan' => $pesan]);
    }

    public function listgudang() {

        $data_gud = Gudang::orderBy("nama_gudang",'asc')->get();
        return view('SPS/Gudang/list_gudang',compact('data_gud'));

    }

    public function deletegudang($id) {
        $data_gud = Gudang::findOrFail($id);
        $data_gud->delete();

        $pesan = $data_gud->nama_gudang.', berhasil dihapus';
        return redirect('listgudang')->with(['pesan' => $pesan]);

    }

    public function editgudang($id) {
        $data_gud = Gudang::where('gudang_id',$id)->first();
        return view('SPS/Gudang/edit_gudang', compact('data_gud'));
    
    }

    public function updategudang(Request $request) {
        $data_gud = Gudang::findOrFail($request->gudang_id);
        $data_gud->nama_gudang      = $request->nama_gudang;
        $data_gud->alamat_gudang    = $request->alamat_gudang;
        $data_gud->peubah           = Session::get('user_id');
        $data_gud->update();

        $pesan = 'Data berhasil diubah';
        return redirect('listgudang')->with(['pesan' => $pesan]);
    }


    // pelanggan CRUD
    public function formpelanggan() {
        return view('SPS/Pelanggan/form_pelanggan');
    }

    public function inputpelanggan(Request $request){
        $data_pel                     = new Pelanggan;
        $data_pel->nama_pelanggan     = $request->nama_pelanggan;
        $data_pel->alamat_pelanggan   = $request->alamat_pelanggan;
        $data_pel->telp_pelanggan     = $request->telp_pelanggan;
        $data_pel->email_pelanggan    = $request->email_pelanggan;
        $data_pel->PIC                = $request->PIC;
        $data_pel->pembuat            = Session::get('user_id');
        $data_pel->save();
        
        $pesan = $data_pel->nama_pelanggan.', berhasil ditambahkan';
        return redirect('listpelanggan')->with(['pesan' => $pesan]);
    }

    public function listpelanggan() {
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan','alamat_pelanggan','telp_pelanggan','email_pelanggan','PIC','created_at')->orderBy("created_at",'DESC')->get();
        return view('SPS/Pelanggan/list_pelanggan',compact('data_pel'));

    }

    public function deletepelanggan($id) {
        $data_pel = Pelanggan::findOrFail($id);
        $data_pel->delete();

        $pesan = $data_pel->nama_pelanggan.', berhasil dihapus';
        return redirect('listpelanggan')->with(['pesan' => $pesan]);

    }

    public function editpelanggan($id) {
        $data_pel = Pelanggan::where('pelanggan_id',$id)->first();
        return view('SPS/Pelanggan/edit_pelanggan', compact('data_pel'));
    
    }

    public function viewpelanggan($id) {
        $data_pel = Pelanggan::where('pelanggan_id',$id)->first();
        return view('SPS/Pelanggan/view_pelanggan', compact('data_pel'));
    
    }

    public function updatepelanggan(Request $request) {
        $data_pel                      = pelanggan::findOrFail($request->pelanggan_id);
        $data_pel->nama_pelanggan      = $request->nama_pelanggan;
        $data_pel->alamat_pelanggan    = $request->alamat_pelanggan;
        $data_pel->telp_pelanggan      = $request->telp_pelanggan;
        $data_pel->email_pelanggan     = $request->email_pelanggan;
        $data_pel->PIC                 = $request->PIC;
        $data_pel->peubah              = Session::get('user_id');
        $data_pel->update();

        $pesan = 'Data berhasil diubah';
        return redirect('listpelanggan')->with(['pesan' => $pesan]);
    }

    // kategoribarang CRUD
    public function formkategoribarang() {
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
        return view('SPS/Kategori_Barang/form_kategori_barang', compact('data_pel'));
    }

    public function inputkategoribarang(Request $request) {
        $data_kat                        = new KategoriBarang;
        $data_kat->nama_kategori         = $request->nama_kategori;
        $data_kat->kode_sku              = str_replace('_','', $request->kode_sku);
        $data_kat->pelanggan_id          = $request->pelanggan_id;
        $data_kat->pembuat               = Session::get('user_id');
        $data_kat->save();
        $pesan = $data_kat->nama_kategori.', berhasil ditambahkan';
        return redirect('listkategoribarang')->with(['pesan' => $pesan]);
    }

    public function listkategoribarang() {
        $data_kat = DB::table('tbl_kategori_barang')
        ->join('tbl_pelanggan','tbl_pelanggan.pelanggan_id','=','tbl_kategori_barang.pelanggan_id')
        ->select('tbl_kategori_barang.kategori_id','tbl_kategori_barang.nama_kategori','tbl_kategori_barang.kode_sku','tbl_pelanggan.nama_pelanggan','tbl_kategori_barang.created_at')
        ->orderBy('tbl_pelanggan.created_at','DESC')
        ->get();

        return view('SPS/Kategori_Barang/list_kategori_barang',compact('data_kat'));
    }

    public function deletekategoribarang($id) {
        $data_kat = KategoriBarang::findOrFail($id);;
        $data_kat->delete();
        $pesan = $data_kat->nama_kategori.', berhasil dihapus';
        return redirect('listkategoribarang')->with(['pesan' => $pesan]);
    }

    public function editkategoribarang($id) {
        $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku','pelanggan_id')->where('kategori_id',$id)->first();
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
        return view('SPS/Kategori_Barang/edit_kategori_barang', compact('data_kat','data_pel'));
    }

    public function viewkategoribarang($id) {
        $data_kat = KategoriBarang::select('kategori_id','nama_kategori','kode_sku','pelanggan_id')->where('kategori_id',$id)->first();
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
        return view('SPS/Kategori_Barang/view_kategori_barang', compact('data_kat','data_pel'));
    }   

    public function updatekategoribarang(Request $request) {
        $data_kat                        = KategoriBarang::findOrFail($request->kategori_id);
        $data_kat->nama_kategori         = $request->nama_kategori;
        $data_kat->kode_sku              = str_replace('_','', $request->kode_sku);
        $data_kat->pelanggan_id          = $request->pelanggan_id;
        $data_kat->peubah                = Session::get('user_id');
        $data_kat->update();
        $pesan = 'Data berhasil diubah';
        return redirect('listkategoribarang')->with(['pesan' => $pesan]);
    }
    
     // pbmsps CRUD
     public function listpbmspsacc() {
        $data_list_pbm_acc = DB::select('select tbl_trx_pbm.status, tbl_trx_pbm.level, tbl_trx_pbm.trx_pbm_id as id_utama, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.tgl_pbm_masuk, tbl_pelanggan.nama_pelanggan, tbl_pelanggan.created_at, ( SELECT SUM(qty) FROM tbl_trx_pbm_detail WHERE tbl_trx_pbm_detail.trx_pbm_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_barang on tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_supplier ORDER BY nama_supplier SEPARATOR ", " ) AS supplier FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_supplier on tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as supplier FROM tbl_trx_pbm INNER JOIN tbl_pelanggan on tbl_trx_pbm.pelanggan_id = tbl_pelanggan.pelanggan_id WHERE tbl_trx_pbm.status = 1 AND tbl_trx_pbm.level = 1 ORDER BY tbl_trx_pbm.tgl_pbm_masuk DESC;'); 
        //Rubah ke ORM Query Builder Nanti

        return view('SPS/PBM/list_pbm_sps_acc',compact('data_list_pbm_acc')); 
    }

    public function mintainfopbm($id) {
        $data_list_informasi_pbm = Trx_PBM::select('tbl_trx_pbm.trx_pbm_id','tbl_trx_pbm.level','tbl_trx_pbm.tgl_pbm_masuk','tbl_trx_pbm_detail.qty','tbl_barang.nama_barang','tbl_kategori_barang.kode_sku','tbl_barang.SKU','tbl_supplier.nama_supplier')
        ->join('tbl_trx_pbm_detail','tbl_trx_pbm.trx_pbm_id','=','tbl_trx_pbm_detail.trx_pbm_id')
        ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
        ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
        //->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        ->where('tbl_trx_pbm.trx_pbm_id','=',$id)
        ->get();
        return $data_list_informasi_pbm;
        //Harus Rubah ke format JSON untuk keamanan
    }

    public function updatepbmspsacc(Request $request){
        //Kurang Exception Required Value diview
        $data_trx_pbm_acc = new Trx_PBM_Acc;
        $data_trx_pbm_acc->trx_pbm_id = $request->trx_pbm_id;
        $data_trx_pbm_acc->catatan_acc = $request->catatan;
        $data_trx_pbm_acc->tgl_acc = date('Y-m-d H:i:s');
        $data_trx_pbm_acc->pembuat = Session::get('user_id');
        $data_trx_pbm_acc->save();

        $data_trx_pbm = Trx_PBM::findOrFail($request->trx_pbm_id);
        $data_trx_pbm->level = 2;
        $data_trx_pbm->update();

        $pesan = 'PBM - '.$request->kode_pbm.', berhasil dikonfirmasi dan masuk ke tahap Penerimaan Barang';
        return redirect('listpbmspsacc')->with(['pesan' => $pesan]);
    }

    public function listpbmspsterima() {
        $data_list_pbm_terima = DB::select('select tbl_trx_pbm.status, tbl_trx_pbm.level, tbl_trx_pbm.trx_pbm_id as id_utama, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.tgl_pbm_masuk, tbl_pelanggan.nama_pelanggan, tbl_trx_pbm.created_at, ( SELECT SUM(qty) FROM tbl_trx_pbm_detail WHERE tbl_trx_pbm_detail.trx_pbm_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_barang on tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_supplier ORDER BY nama_supplier SEPARATOR ", " ) AS supplier FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_supplier on tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as supplier FROM tbl_trx_pbm INNER JOIN tbl_pelanggan on tbl_trx_pbm.pelanggan_id = tbl_pelanggan.pelanggan_id WHERE tbl_trx_pbm.status = 1 AND tbl_trx_pbm.level = 2 ORDER BY tbl_trx_pbm.tgl_pbm_masuk DESC;'); //Rubah ke ORM Query Builder Nanti

        return view('SPS/PBM/list_pbm_barang_terima',compact('data_list_pbm_terima'));
    }

      public function formpbmspsterima($id) {
        $data_pbm = Trx_PBM::select('tbl_trx_pbm.trx_pbm_id','tbl_trx_pbm.kode_trx_pbm','tbl_trx_pbm.tgl_pbm_masuk','tbl_trx_pbm.keterangan','tbl_trx_pbm.level','tbl_trx_pbm.status','tbl_trx_pbm.pelanggan_id','tbl_trx_pbm.created_at','tbl_pelanggan.nama_pelanggan')
        ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        ->where('tbl_trx_pbm.trx_pbm_id','=',$id)
        ->first();

        $data_pbm_detail = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm_detail.trx_pbm_id','tbl_barang.nama_barang','tbl_kategori_barang.kode_sku','tbl_barang.SKU','tbl_barang.kategori_id','tbl_supplier.nama_supplier','tbl_trx_pbm_detail.qty','tbl_trx_pbm_detail.created_at')
        ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
        ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
        ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        ->where('tbl_trx_pbm_detail.trx_pbm_id','=',$id)
        ->orderBy('tbl_trx_pbm_detail.trx_pbm_id')
        ->get();    

        $data_bar = Barang::select('tbl_barang.barang_id','tbl_barang.nama_barang','tbl_kategori_barang.kode_sku','tbl_barang.SKU','tbl_barang.pelanggan_id')
        ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        ->where('tbl_barang.pelanggan_id','=',$data_pbm->pelanggan_id)
        ->orderBy('tbl_barang.nama_barang','ASC')
        ->get();

        $data_sup = Supplier::select('supplier_id','nama_supplier')->where('pelanggan_id','=',$data_pbm->pelanggan_id)->orderBy('nama_supplier','ASC')->get();
        
        //Lebih baik dijoin jadi satu data saja
        return view('SPS/PBM/form_pbm_barang_terima',compact('data_pbm','data_pbm_detail','data_bar','data_sup'));
    }

    public function updatepbmspsterima(Request $request){
        //return $request->data[1]['trx_pbm_detail_id'];
        for ($i = 1; $i <= $request->max_indeks_array; $i++){ //Bisa diganti dengan foreach
            $data_trx_pbm_terima                     = new Trx_PBM_Terima;
            $data_trx_pbm_terima->trx_pbm_detail_id  = $request->data[$i]['trx_pbm_detail_id'];
            $data_trx_pbm_terima->aktual             = $request->data[$i]['aktual'];
            $data_trx_pbm_terima->tgl_terima         = date('Y-m-d H:i:s');
            $data_trx_pbm_terima->catatan_penerimaan = $request->data[$i]['catatan_penerimaan'];
            $data_trx_pbm_terima->flag_terima_pertama  = 1;
            $data_trx_pbm_terima->pembuat            = Session::get('user_id');
            $data_trx_pbm_terima->save();
        }

        $pesan = 'PBM ['.$request->kode_pbm.'] ';
        $level = 4;

        foreach ($request->data as $check_lunas_transaksi){
            $data_trx_pbm_detail_check = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm.kode_trx_pbm','tbl_barang.nama_barang','tbl_kategori_barang.kode_sku',DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as check_kurang'))
            ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
            ->join('tbl_trx_pbm','tbl_trx_pbm.trx_pbm_id','=','tbl_trx_pbm_detail.trx_pbm_id')
            ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
            ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
            ->where('tbl_trx_pbm_detail.trx_pbm_detail_id','=',$check_lunas_transaksi['trx_pbm_detail_id'])
            ->first();

            if ($data_trx_pbm_detail_check->check_kurang != 0 ){
                $pesan .= 'Barang '. $data_trx_pbm_detail_check->nama_barang.' ['.$data_trx_pbm_detail_check->kode_sku.'] '.$data_trx_pbm_detail_check->SKU.' PBM - '.$request->kode_pbm.', masih memiliki kekurangan penerimaan sebesar : '.$data_trx_pbm_detail_check->check_kurang;
                $level = 3;
            }
        }

        if ($level ==  4) {
            $pesan .= 'sudah lengkap dan sesuai dengan PBM';
        }

        $data_trx_pbm = Trx_PBM::findOrFail($request->trx_pbm_id);
        $data_trx_pbm->level = $level;
        $data_trx_pbm->update();
        
        return redirect('listpbmspsterima')->with(['pesan' => $pesan]);
    }

    public function listpbmspskekurangan() {
        $data_list_pbm_kekurangan = DB::table('tbl_trx_pbm_detail')->select('tbl_trx_pbm_terima.trx_pbm_terima_id','tbl_trx_pbm_terima.trx_pbm_detail_id','tbl_trx_pbm.kode_trx_pbm','tbl_trx_pbm.tgl_pbm_masuk','tbl_pelanggan.nama_pelanggan','tbl_trx_pbm_detail.trx_pbm_id','tbl_barang.nama_barang','tbl_supplier.nama_supplier','tbl_trx_pbm_detail.qty',DB::raw('sum(tbl_trx_pbm_terima.aktual) as aktual'),DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual)  as kekurangan'))//,DB::Raw('tbl_trx_pbm_detail.qty - total_aktual as hasil'))
        ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
        ->join('tbl_trx_pbm','tbl_trx_pbm_detail.trx_pbm_id','=','tbl_trx_pbm.trx_pbm_id')
        ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
        ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
        ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        // ->where('kekurangan','!=',0)
        ->where('tbl_trx_pbm.level','=','3' )
        ->havingraw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) <> ?',[0])
        //->whereRaw('tbl_trx_pbm_detail.qty - tbl_trx_pbm_terima.aktual <> 0')
        ->groupBy('tbl_trx_pbm_detail.trx_pbm_detail_id')
        ->orderBy('tbl_trx_pbm.tgl_pbm_masuk')
        ->get();

        //return $data_list_pbm_kekurangan;

        // $data_list_pbm_kekurangan = TRX_PBM_Detail::Select('tbl_trx_pbm_terima.trx_pbm_terima_id','tbl_trx_pbm_terima.trx_pbm_detail_id','tbl_trx_pbm.kode_trx_pbm','tbl_trx_pbm.tgl_pbm_masuk','tbl_pelanggan.nama_pelanggan','tbl_trx_pbm_detail.trx_pbm_id','tbl_barang.nama_barang','tbl_supplier.nama_supplier','tbl_trx_pbm_detail.qty',DB::raw('SUM(tbl_trx_pbm_terima.aktual) as total_aktual'))//,DB::Raw('tbl_trx_pbm_detail.qty - total_aktual as hasil'))
        // ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
        // ->join('tbl_trx_pbm','tbl_trx_pbm_detail.trx_pbm_id','=','tbl_trx_pbm.trx_pbm_id')
        // ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
        // ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
        // ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        // // ->where('kekurangan','!=',0)
        // ->whereRaw('tbl_trx_pbm_detail.qty - tbl_trx_pbm_terima.aktual != 0')
        // ->groupBy('tbl_trx_pbm_detail.trx_pbm_detail_id'')
        // ->get();


        // $data_list_pbm_kekurangan = Trx_PBM_Terima::select('tbl_trx_pbm_terima.trx_pbm_terima_id','tbl_trx_pbm_terima.trx_pbm_detail_id',DB::raw('select SUM (tbl_trx_pbm_terima.aktual) as jumlah'))
        // ->groupBy('tbl_trx_pbm_terima.trx_pbm_detail_id')
        // ->get(); 

        //return $data_list_pbm_kekurangan;

        return view('SPS/PBM/list_pbm_barang_kekurangan',compact('data_list_pbm_kekurangan'));
    }

    public function formpbmspskekurangan($id){
        // $data_trx_pbm_terima = Trx_PBM_Terima::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm_terima.trx_pbm_terima_id','tbl_trx_pbm_terima.trx_pbm_detail_id','tbl_trx_pbm.trx_pbm_id','tbl_trx_pbm.kode_trx_pbm','tbl_kategori_barang.kode_sku','tbl_pelanggan.nama_pelanggan','tbl_trx_pbm_detail.qty','tbl_trx_pbm_terima.aktual','tbl_trx_pbm_terima.catatan_penerimaan','tbl_barang.nama_barang','tbl_barang.SKU','tbl_supplier.nama_supplier',DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as kekurangan'))
        // ->join('tbl_trx_pbm_detail','tbl_trx_pbm_terima.trx_pbm_detail_id','=','tbl_trx_pbm_detail.trx_pbm_detail_id')
        // ->join('tbl_trx_pbm','tbl_trx_pbm_detail.trx_pbm_id','=','tbl_trx_pbm.trx_pbm_id')
        // ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
        // ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
        // ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        // ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        // ->where('tbl_trx_pbm_terima.trx_pbm_terima_id','=',$id)
        // ->first();
        
       $data_trx_pbm_detail = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm_detail.trx_pbm_id','tbl_trx_pbm.kode_trx_pbm','tbl_barang.nama_barang','tbl_barang.SKU','tbl_pelanggan.nama_pelanggan','tbl_kategori_barang.nama_kategori','tbl_kategori_barang.kode_sku','tbl_supplier.nama_supplier','tbl_trx_pbm_terima.catatan_penerimaan','tbl_trx_pbm_detail.qty',DB::raw('sum(tbl_trx_pbm_terima.aktual) as aktual'),DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as kekurangan'))
       ->join('tbl_trx_pbm','tbl_trx_pbm_detail.trx_pbm_id','=','tbl_trx_pbm.trx_pbm_id')
       ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
       ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
       ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
       ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
       ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
       ->where('tbl_trx_pbm_detail.trx_pbm_detail_id','=',$id)
       ->groupBy('tbl_trx_pbm_detail.trx_pbm_detail_id')
       ->first();

       return view('SPS/PBM/form_pbm_barang_kekurangan',compact('data_trx_pbm_detail'));
    }

    public function updatepbmspskekurangan (Request $request){
        $data_trx_pbm_terima                     = new Trx_PBM_Terima;
        $data_trx_pbm_terima->trx_pbm_detail_id  = $request->trx_pbm_detail_id;
        $data_trx_pbm_terima->aktual             = $request->aktual;
        $data_trx_pbm_terima->tgl_terima         = date('Y-m-d H:i:s');
        $data_trx_pbm_terima->catatan_penerimaan = $request->catatan_penerimaan;
        $data_trx_pbm_terima->flag_terima_pertama  = 0;
        $data_trx_pbm_terima->pembuat            = Session::get('user_id');
        $data_trx_pbm_terima->save();

        // $data_trx_pbm_detail_check = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id',DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as check_kurang'))
        // ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
        // ->where('tbl_trx_pbm_detail.trx_pbm_detail_id','=',$request->trx_pbm_detail_id)
        // ->first();
 
        $data_trx_pbm_detail_check = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm.kode_trx_pbm','tbl_barang.nama_barang','tbl_kategori_barang.kode_sku',DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as check_kurang'))
        ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
        ->join('tbl_trx_pbm','tbl_trx_pbm.trx_pbm_id','=','tbl_trx_pbm_detail.trx_pbm_id')
        ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
        ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        ->where('tbl_trx_pbm_detail.trx_pbm_detail_id','=',$request->trx_pbm_detail_id)
        ->first();

        if ($data_trx_pbm_detail_check->check_kurang == 0) {
            $pesan = 'PBM ['.$request->kode_pbm.'] - Barang '.$data_trx_pbm_detail_check->nama_barang.' ['.$data_trx_pbm_detail_check->kode_sku.'] '.$data_trx_pbm_detail_check->SKU.', sudah lengkap tahap penerimaan barang';
        
        
            $data_trx_pbm_detail = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm_detail.trx_pbm_id','tbl_trx_pbm.kode_trx_pbm','tbl_trx_pbm.tgl_pbm_masuk','tbl_barang.nama_barang','tbl_barang.SKU','tbl_pelanggan.nama_pelanggan','tbl_kategori_barang.nama_kategori','tbl_kategori_barang.kode_sku','tbl_supplier.nama_supplier','tbl_trx_pbm_terima.catatan_penerimaan','tbl_trx_pbm_detail.qty',DB::raw('sum(tbl_trx_pbm_terima.aktual) as aktual'),DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as kekurangan'))
            ->join('tbl_trx_pbm','tbl_trx_pbm_detail.trx_pbm_id','=','tbl_trx_pbm.trx_pbm_id')
            ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
            ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
            ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
            ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
            ->where('tbl_trx_pbm.trx_pbm_id','=',$request->trx_pbm_id)
            ->groupBy('tbl_trx_pbm_detail.trx_pbm_detail_id')
            ->orderBy('tbl_trx_pbm.tgl_pbm_masuk')
            ->get();
    
            $level = 4;
            foreach($data_trx_pbm_detail as $check_lunas_transaksi) {
                if ($check_lunas_transaksi->kekurangan != 0) {
                    $level = 3;
                    break;
                }
            }
            
            $data_trx_pbm = Trx_PBM::findOrFail($request->trx_pbm_id); 
            $data_trx_pbm->level = $level;
            $data_trx_pbm->update();
        }

        else {
            $pesan = 'PBM ['.$request->kode_pbm.'] - Barang '.$data_trx_pbm_detail_check->nama_barang.' ['.$data_trx_pbm_detail_check->kode_sku.'] '.$data_trx_pbm_detail_check->SKU.' PBM - '.$request->kode_pbm.', masih memiliki kekurangan sebesar : '.$data_trx_pbm_detail_check->check_kurang;
        }

        return redirect('listpbmspskekurangan')->with(['pesan' => $pesan]);
    }

    public function listpbmspsalokasi() {
        $data_list_pbm_alokasi = DB::select('SELECT *, total_terima - total_alokasi as kekurangan FROM ( SELECT tbl_trx_pbm_detail.trx_pbm_detail_id, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.level, tbl_trx_pbm.tgl_pbm_masuk, tbl_pelanggan.nama_pelanggan, tbl_barang.nama_barang, tbl_kategori_barang.nama_kategori, tbl_supplier.nama_supplier, tbl_trx_pbm_detail.qty, IFNULL( ( SELECT SUM(tbl_trx_pbm_terima.aktual) FROM tbl_trx_pbm_terima WHERE trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id ), 0 ) AS total_terima, IFNULL( ( SELECT SUM( tbl_trx_pbm_alokasi.alokasi_akt ) FROM tbl_trx_pbm_alokasi WHERE trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id ), 0 ) AS total_alokasi FROM tbl_trx_pbm_detail INNER JOIN tbl_trx_pbm ON tbl_trx_pbm.kode_trx_pbm = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_pelanggan ON tbl_trx_pbm.pelanggan_id = tbl_pelanggan.pelanggan_id INNER JOIN tbl_barang ON tbl_barang.barang_id = tbl_trx_pbm_detail.barang_id INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id INNER JOIN tbl_supplier ON tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id ORDER by tbl_trx_pbm.tgl_pbm_masuk ASC ) as data WHERE total_terima - total_alokasi <> 0'); 

        //return $data_list_pbm_alokasi;
        //Rubah ke ORM Query Builder Nanti

        //return $data_list_pbm_alokasi;
        return view('SPS/PBM/list_pbm_alokasi_barang',compact('data_list_pbm_alokasi'));
    }
 
    public function formpbmspsalokasi($id) {
       //return $id;

       $data_trx_pbm_detail = Trx_PBM_Detail::select('tbl_trx_pbm_detail.trx_pbm_detail_id','tbl_trx_pbm_detail.trx_pbm_id','tbl_trx_pbm.kode_trx_pbm','tbl_trx_pbm_terima.tgl_terima','tbl_barang.nama_barang','tbl_barang.SKU','tbl_pelanggan.nama_pelanggan','tbl_kategori_barang.nama_kategori','tbl_kategori_barang.kode_sku','tbl_supplier.nama_supplier','tbl_trx_pbm_terima.catatan_penerimaan','tbl_trx_pbm_detail.qty',DB::raw('sum(tbl_trx_pbm_terima.aktual) as aktual'),DB::raw('tbl_trx_pbm_detail.qty - sum(tbl_trx_pbm_terima.aktual) as kekurangan'))
       ->join('tbl_trx_pbm','tbl_trx_pbm_detail.trx_pbm_id','=','tbl_trx_pbm.trx_pbm_id')
       ->join('tbl_barang','tbl_trx_pbm_detail.barang_id','=','tbl_barang.barang_id')
       ->join('tbl_pelanggan','tbl_trx_pbm.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
       ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
       ->join('tbl_supplier','tbl_trx_pbm_detail.supplier_id','=','tbl_supplier.supplier_id')
       ->join('tbl_trx_pbm_terima','tbl_trx_pbm_detail.trx_pbm_detail_id','=','tbl_trx_pbm_terima.trx_pbm_detail_id')
       ->where('tbl_trx_pbm_detail.trx_pbm_detail_id','=',$id)
       ->groupBy('tbl_trx_pbm_detail.trx_pbm_detail_id')
       ->first();
       
       $data_gudang = Gudang::select('gudang_id','nama_gudang')->get();

       $batas_pengisian = DB::select('SELECT *, total_terima - total_alokasi as kurang_alokasi FROM ( SELECT tbl_trx_pbm_detail.trx_pbm_detail_id, tbl_trx_pbm.trx_pbm_id, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.level, tbl_trx_pbm_detail.qty, IFNULL( ( SELECT SUM(tbl_trx_pbm_terima.aktual) FROM tbl_trx_pbm_terima WHERE trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id ), 0 ) AS total_terima, IFNULL( ( SELECT SUM(tbl_trx_pbm_alokasi.alokasi_akt) FROM tbl_trx_pbm_alokasi WHERE trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id ), 0 ) AS total_alokasi FROM tbl_trx_pbm_detail INNER JOIN tbl_trx_pbm ON tbl_trx_pbm.kode_trx_pbm = tbl_trx_pbm_detail.trx_pbm_id WHERE tbl_trx_pbm_detail.trx_pbm_detail_id = '.$id.' ) AS Data'); 
        //Rubah ke ORM Query Builder Nanti
    
       return view('SPS/PBM/form_pbm_alokasi_barang',compact('data_trx_pbm_detail','data_gudang','batas_pengisian'));
    }

    // pbksps CRUD

    public function updatepbmspsalokasi(Request $request){
        //return $request;
        if ($request->total<=$request->aktual) {   
            for($i=1;$i<=$request->max_indeks_array;$i++) {
                
                if(isset($request->data[$i])) {
                    $data_alokasi[$i] = new TRX_PBM_Alokasi;
                    $data_alokasi[$i]->trx_pbm_detail_id = $request->trx_pbm_detail_id;
                    $data_alokasi[$i]->tgl_alokasi = date('Y-m-d H:i:s');
                    $data_alokasi[$i]->alokasi_akt = $request->data[$i]['kuantitas'];
                    $data_alokasi[$i]->gudang_id = $request->data[$i]['gudang_id'];
                    $data_alokasi[$i]->catatan_alokasi = $request->data[$i]['catatan_alokasi'];
                    $data_alokasi[$i]->pembuat = Session::get('user_id');
                    $data_alokasi[$i]->save();
                }
            }

            $data_trx_pbm_check = DB::select('SELECT sum(qty) as qty, sum(total_alokasi) as total_alokasi, sum(total_terima) as total_terima FROM ( SELECT tbl_trx_pbm_detail.trx_pbm_detail_id, tbl_trx_pbm.trx_pbm_id, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.level, tbl_trx_pbm.tgl_pbm_masuk, tbl_pelanggan.nama_pelanggan, tbl_barang.nama_barang, tbl_kategori_barang.nama_kategori, tbl_supplier.nama_supplier, tbl_trx_pbm_detail.qty, IFNULL( ( SELECT SUM(tbl_trx_pbm_terima.aktual) FROM tbl_trx_pbm_terima WHERE trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id ), 0 ) AS total_terima, IFNULL( ( SELECT SUM(tbl_trx_pbm_alokasi.alokasi_akt) FROM tbl_trx_pbm_alokasi WHERE trx_pbm_detail_id = tbl_trx_pbm_detail.trx_pbm_detail_id ), 0 ) AS total_alokasi FROM tbl_trx_pbm_detail INNER JOIN tbl_trx_pbm ON tbl_trx_pbm.kode_trx_pbm = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_pelanggan ON tbl_trx_pbm.pelanggan_id = tbl_pelanggan.pelanggan_id INNER JOIN tbl_barang ON tbl_barang.barang_id = tbl_trx_pbm_detail.barang_id INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id INNER JOIN tbl_supplier ON tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = '.$request->trx_pbm_id.' ) AS DATA');
            //Rubah ke ORM Query Builder Nanti

            //return $data_trx_pbm_check;
 
            if($data_trx_pbm_check[0]->qty == $data_trx_pbm_check[0]->total_terima && $data_trx_pbm_check[0]->qty == $data_trx_pbm_check[0]->total_alokasi) {
                $pesan = 'Berhasil mengalokasikan '.$request->total.' barang'.'dan transaksi PBM sudah lengkap'; //<- tambahkan detail barang dsb
                $data_trx_pbm = Trx_PBM::findOrFail($request->trx_pbm_id); 
                $data_trx_pbm->level = 5;
                $data_trx_pbm->update();
            }

            else {
                $pesan = 'Berhasil mengalokasikan '.$request->total.' barang'.'dan transaksi PBM belum seluruhnya lengkap'; //<- tambahkan detail barang dsb
            }
        }
        return redirect('listpbmspsalokasi')->with(['pesan' => $pesan]);
    }
    
    public function inventorimaster() {
        
        
        //$data_test = DB::select('');

        //return $data_test;


        // public function listbarang() {
        //     if (Session::get('peran_id') === 6) {
        //         $data_bar = DB::table('tbl_barang')
        //         ->join('tbl_pelanggan','tbl_barang.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        //         ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        //         ->select('tbl_barang.barang_id', 'tbl_barang.nama_barang', 'tbl_kategori_barang.nama_kategori', 'tbl_kategori_barang.kode_sku', 'tbl_barang.SKU', 'tbl_barang.harga', 'tbl_barang.tahun', 'tbl_barang.spesifikasi_barang', 'tbl_barang.foto_barang','tbl_barang.created_at')
        //         ->where('tbl_barang.pelanggan_id','=',Session::get('pelanggan_id'))
        //         ->orderBy('created_at','DESC')
        //         ->get();
        //     }
    
        //     else {
        //         $data_bar = DB::table('tbl_barang')
        //         ->join('tbl_pelanggan','tbl_barang.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        //         ->join('tbl_kategori_barang','tbl_barang.kategori_id','=','tbl_kategori_barang.kategori_id')
        //         ->select('tbl_barang.barang_id', 'tbl_barang.nama_barang', 'tbl_kategori_barang.nama_kategori', 'tbl_kategori_barang.kode_sku', 'tbl_barang.SKU', 'tbl_barang.harga', 'tbl_barang.tahun', 'tbl_barang.spesifikasi_barang', 'tbl_barang.foto_barang','tbl_pelanggan.nama_pelanggan','tbl_barang.created_at')
        //         ->orderBy('created_at','DESC')
        //         ->get();
        //     }
    
        //     return view('BNI/Barang/list_barang',compact('data_bar'));
    
        // }

        return view('SPS/Inventori/list_inventori_master');
    }
        
    public function listpbkspsacc() {
        $data_list_pbk_acc = DB::select('select tbl_trx_pbk.status, tbl_trx_pbk.level, tbl_pelanggan.nama_pelanggan, tbl_trx_pbk.trx_pbk_id as id_utama, tbl_trx_pbk.kode_trx_pbk, tbl_trx_pbk.tgl_pbk_masuk, tbl_trx_pbk.tgl_pbk, tbl_trx_pbk.nama_tujuan, tbl_trx_pbk.alamat_tujuan, tbl_master_kota.kota_tujuan, tbl_jenis_layanan.nama_layanan, tbl_trx_pbk.kota_id as id_kota, tbl_trx_pbk.layanan_id as id_layanan, tbl_trx_pbk.pelanggan_id as id_pelanggan, tbl_trx_pbk.tarif_harga, tbl_trx_pbk.lead_time, ( SELECT tbl_tarif.tarif FROM tbl_tarif WHERE tbl_tarif.layanan_id = id_layanan AND tbl_tarif.kota_id = id_kota AND tbl_tarif.pelanggan_id = id_pelanggan ) AS tarif_real, ( SELECT tbl_tarif.leadtime FROM tbl_tarif WHERE tbl_tarif.layanan_id = id_layanan AND tbl_tarif.kota_id = id_kota AND tbl_tarif.pelanggan_id = id_pelanggan ) AS lead_time_real, ( SELECT SUM(qty) FROM tbl_trx_pbk_detail WHERE tbl_trx_pbk_detail.trx_pbk_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbk INNER JOIN tbl_trx_pbk_detail on tbl_trx_pbk.trx_pbk_id = tbl_trx_pbk_detail.trx_pbk_id INNER JOIN tbl_barang on tbl_trx_pbk_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbk.trx_pbk_id = id_utama GROUP BY tbl_trx_pbk.trx_pbk_id ORDER BY tbl_trx_pbk_detail.trx_pbk_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_gudang ORDER BY nama_gudang SEPARATOR ", " ) AS gudang FROM tbl_trx_pbk INNER JOIN tbl_trx_pbk_detail on tbl_trx_pbk.trx_pbk_id = tbl_trx_pbk_detail.trx_pbk_id INNER JOIN tbl_barang on tbl_trx_pbk_detail.barang_id = tbl_barang.barang_id INNER JOIN tbl_trx_pbm_detail ON tbl_trx_pbk_detail.barang_id = tbl_trx_pbm_detail.barang_id INNER JOIN tbl_trx_pbm_alokasi ON tbl_trx_pbm_detail.trx_pbm_detail_id = tbl_trx_pbm_alokasi.trx_pbm_detail_id INNER JOIN tbl_gudang ON tbl_trx_pbm_alokasi.gudang_id = tbl_gudang.gudang_id WHERE tbl_trx_pbk.trx_pbk_id = id_utama ORDER BY tbl_trx_pbk_detail.trx_pbk_id ASC ) as gudang, tbl_trx_pbk.created_at FROM tbl_trx_pbk INNER JOIN tbl_master_kota on tbl_trx_pbk.kota_id = tbl_master_kota.kota_id INNER JOIN tbl_pelanggan on tbl_trx_pbk.pelanggan_id = tbl_pelanggan.pelanggan_id INNER JOIN tbl_jenis_layanan on tbl_trx_pbk.layanan_id = tbl_jenis_layanan.layanan_id WHERE tbl_trx_pbk.status = 1 AND tbl_trx_pbk.level = 1 ORDER BY tbl_trx_pbk.created_at DESC;'); // Rubah ke ORM Model nanti
        //return $data_list_pbk_acc; 
        return view('SPS/PBK/list_pbk_sps_acc',compact('data_list_pbk_acc'));
    }

    public function mintainfopbk(Request $request) {
        $data_list_informasi_pbk = DB::select('SELECT tbl_trx_pbk.trx_pbk_id AS id_utama, tbl_trx_pbk_detail.barang_id as id_barang, tbl_barang.SKU, tbl_kategori_barang.kode_sku, tbl_barang.nama_barang, ( SELECT sum(tbl_trx_pbm_alokasi.alokasi_akt) FROM tbl_trx_pbm_detail INNER JOIN tbl_trx_pbm_alokasi ON tbl_trx_pbm_detail.trx_pbm_detail_id = tbl_trx_pbm_alokasi.trx_pbm_detail_id WHERE tbl_trx_pbm_detail.barang_id = id_barang ) AS stock_akt, tbl_trx_pbk_detail.stock, tbl_trx_pbk_detail.qty, tbl_trx_pbk_detail.sisa, (SELECT GROUP_CONCAT( DISTINCT nama_gudang ORDER BY nama_gudang SEPARATOR ", " ) AS gudang FROM tbl_trx_pbk INNER JOIN tbl_trx_pbk_detail on tbl_trx_pbk.trx_pbk_id = tbl_trx_pbk_detail.trx_pbk_id INNER JOIN tbl_barang on tbl_trx_pbk_detail.barang_id = tbl_barang.barang_id INNER JOIN tbl_trx_pbm_detail ON tbl_trx_pbk_detail.barang_id = tbl_trx_pbm_detail.barang_id INNER JOIN tbl_trx_pbm_alokasi ON tbl_trx_pbm_detail.trx_pbm_detail_id = tbl_trx_pbm_alokasi.trx_pbm_detail_id INNER JOIN tbl_gudang ON tbl_trx_pbm_alokasi.gudang_id = tbl_gudang.gudang_id WHERE tbl_trx_pbk.trx_pbk_id = id_utama ORDER BY tbl_trx_pbk_detail.trx_pbk_id ASC ) as gudang FROM tbl_trx_pbk INNER JOIN tbl_trx_pbk_detail ON tbl_trx_pbk.trx_pbk_id = tbl_trx_pbk_detail.trx_pbk_id INNER JOIN tbl_barang ON tbl_trx_pbk_detail.barang_id = tbl_barang.barang_id INNER JOIN tbl_kategori_barang ON tbl_barang.kategori_id = tbl_kategori_barang.kategori_id WHERE tbl_trx_pbk.trx_pbk_id = '.$request->id_pbk);
        return response()->json($data_list_informasi_pbk);
        //Harus Rubah ke format JSON untuk keamanan
    }

    public function updatepbkspsacc(Request $request){
        return $request;
        //Kurang Exception Required Value diview
        $data_trx_pbm_acc = new Trx_PBM_Acc;
        $data_trx_pbm_acc->trx_pbm_id = $request->trx_pbm_id;
        $data_trx_pbm_acc->catatan_acc = $request->catatan;
        $data_trx_pbm_acc->tgl_acc = date('Y-m-d H:i:s');
        $data_trx_pbm_acc->pembuat = Session::get('user_id');
        $data_trx_pbm_acc->save();

        $data_trx_pbm = Trx_PBM::findOrFail($request->trx_pbm_id);
        $data_trx_pbm->level = 2;
        $data_trx_pbm->update();

        $pesan = 'PBk - '.$request->kode_pbk.', berhasil dikonfirmasi dan masuk ke tahap Penerimaan Barang';
        return redirect('listpbmspsacc')->with(['pesan' => $pesan]);
    }

    public function formpbksps2() {
        $kode_pbm = "PBK - 00001";
        $data_bar = DB::select('SELECT tbl_barang.barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU FROM `tbl_barang` INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id ORDER BY tbl_barang.nama_barang ASC;');
        $data_sup = Supplier::select('supplier_id','nama_supplier')->orderBy('nama_supplier','ASC')->get();
        return view('SPS/PBK/form_cek_stok',compact('data_bar','data_sup','kode_pbm'));
    }

    public function listpbksps2() {
        $data_list_pbm = DB::select('select tbl_trx_pbm.status, tbl_trx_pbm.trx_pbm_id as id_utama, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.tgl_pbm_masuk, tbl_trx_pbm.status, ( SELECT SUM(qty) FROM tbl_trx_pbm_detail WHERE tbl_trx_pbm_detail.trx_pbm_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_barang on tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_supplier ORDER BY nama_supplier SEPARATOR ", " ) AS supplier FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_supplier on tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as supplier FROM tbl_trx_pbm WHERE tbl_trx_pbm.status = 1 ORDER BY tbl_trx_pbm.tgl_pbm_masuk DESC;');
        return view('SPS/PBK/list_pbk_cek_stok',compact('data_list_pbm'));
        //Rubah ke ORM Query Builder Nanti

    }

    public function formpbksps3() {
        $kode_pbm = "PBK - 00001";
        $data_bar = DB::select('SELECT tbl_barang.barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU FROM `tbl_barang` INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id ORDER BY tbl_barang.nama_barang ASC;');
        $data_sup = Supplier::select('supplier_id','nama_supplier')->orderBy('nama_supplier','ASC')->get();
        $kota_tujuan = Tarif::all();
        return view('SPS/PBK/form_kirim_barang',compact('kota_tujuan','data_bar','data_sup','kode_pbm'));
    }

    public function listpbksps3() {
        $data_list_pbm = DB::select('select tbl_trx_pbm.status, tbl_trx_pbm.trx_pbm_id as id_utama, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.tgl_pbm_masuk, tbl_trx_pbm.status, ( SELECT SUM(qty) FROM tbl_trx_pbm_detail WHERE tbl_trx_pbm_detail.trx_pbm_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_barang on tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_supplier ORDER BY nama_supplier SEPARATOR ", " ) AS supplier FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_supplier on tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as supplier FROM tbl_trx_pbm WHERE tbl_trx_pbm.status = 1 ORDER BY tbl_trx_pbm.tgl_pbm_masuk DESC;');
        return view('SPS/PBK/list_pbk_kirim_barang',compact('data_list_pbm'));
        //Rubah ke ORM Query Builder Nanti

    }

    public function listpbksps4() {
        $data_list_pbm = DB::select('select tbl_trx_pbm.status, tbl_trx_pbm.trx_pbm_id as id_utama, tbl_trx_pbm.kode_trx_pbm, tbl_trx_pbm.tgl_pbm_masuk, tbl_trx_pbm.status, ( SELECT SUM(qty) FROM tbl_trx_pbm_detail WHERE tbl_trx_pbm_detail.trx_pbm_id = id_utama ) AS total_qty, ( SELECT GROUP_CONCAT( DISTINCT nama_barang ORDER BY nama_barang SEPARATOR ", " ) AS barang FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_barang on tbl_trx_pbm_detail.barang_id = tbl_barang.barang_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as barang, ( SELECT GROUP_CONCAT( DISTINCT nama_supplier ORDER BY nama_supplier SEPARATOR ", " ) AS supplier FROM tbl_trx_pbm INNER JOIN tbl_trx_pbm_detail on tbl_trx_pbm.trx_pbm_id = tbl_trx_pbm_detail.trx_pbm_id INNER JOIN tbl_supplier on tbl_trx_pbm_detail.supplier_id = tbl_supplier.supplier_id WHERE tbl_trx_pbm.trx_pbm_id = id_utama GROUP BY tbl_trx_pbm.trx_pbm_id ORDER BY tbl_trx_pbm_detail.trx_pbm_id ASC ) as supplier FROM tbl_trx_pbm WHERE tbl_trx_pbm.status = 1 ORDER BY tbl_trx_pbm.tgl_pbm_masuk DESC;');
        return view('SPS/PBK/list_pbk_terima_tujuan',compact('data_list_pbm'));
         //Rubah ke ORM Query Builder Nanti

    }

    
    public function formpbksps4() {
        $kode_pbm = "PBM - 00001";
        $data_bar = DB::select('SELECT tbl_barang.barang_id, tbl_barang.nama_barang, tbl_kategori_barang.kode_sku, tbl_barang.SKU FROM `tbl_barang` INNER JOIN tbl_kategori_barang on tbl_barang.kategori_id = tbl_kategori_barang.kategori_id ORDER BY tbl_barang.nama_barang ASC;');
        //Rubah ke ORM Query Builder Nanti
        
        $data_sup = Supplier::select('supplier_id','nama_supplier')->orderBy('nama_supplier','ASC')->get();
        return view('SPS/PBK/form_terima_tujuan',compact('data_bar','data_sup','kode_pbm'));
    }

    public function minta_pelanggan() {
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
        return json_encode($data_pel);   
    }

    // Akun CRUD
    public function formakun() {
        $data_pel = Peran::select('peran_id','nama_peran')->orderBy('nama_peran','ASC')->get();
        return view('SPS/Akun/form_akun', compact('data_pel'));
    }

    public function inputakun(Request $request) { 
        $validator = Validator::make($request->all(),['password' => 'required_with:ulangi_password|min:6','ulangi_password' => 'same:password']);
            
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data_user = User::where('username',$request->email_pengguna)->exists();
        if($data_user == 1) {
            $validator->errors()->add('email', 'Email telah terdaftar!');
            return back()->withErrors($validator);
        }

        $data_user                    = new User;
        $data_user->username          = $request->email_pengguna;
        $data_user->nama              = $request->nama_pengguna;
        $data_user->peran_id          = $request->peran_id;

        if ($request->peran_id == 6) {
            $data_user->pelanggan_id  = $request->pelanggan_id;
        }
        /*
            if($request->foto_akun != NULL ) {
            $validator = Validator::make($request->all(),['foto_akun' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            
            if($validator->fails()) {
                return back()->withErrors($validator);
            }
            
            $file = $request->file('foto_akun');
            $nama_file = $request->nama_pengguna.'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('foto_akun',$nama_file);
            $data_user->foto_akun       = $nama_file;
        }
        */

        $data_user->password          = md5($request->password);
        $data_user->pembuat           = Session::get('user_id');
        $data_user->save();

        $pesan = $data_user->nama.', berhasil ditambahkan';
        return redirect('listakun')->with(['pesan' => $pesan]);
    }

    public function listakun() {
        if (Session::get('peran_id') === 1) {
            $data_user = DB::table('tbl_user')
            ->leftjoin('tbl_pelanggan','tbl_user.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->join('tbl_peran','tbl_user.peran_id','=','tbl_peran.peran_id')
            ->select('tbl_user.user_id','tbl_user.username','tbl_user.nama','tbl_peran.peran_id','tbl_peran.nama_peran','tbl_pelanggan.nama_pelanggan')
            ->orderBy('tbl_user.created_at','DESC')
            ->get();
        }

        elseif(Session::get('peran_id') <> 1 && Session::get('peran_id') != 6 ) { 
            $data_user = DB::table('tbl_user')
            ->join('tbl_pelanggan','tbl_user.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
            ->join('tbl_peran','tbl_user.peran_id','=','tbl_peran.peran_id')
            ->select('tbl_user.user_id','tbl_user.username','tbl_user.nama','tbl_peran.peran_id','tbl_peran.nama_peran','tbl_pelanggan.nama_pelanggan')
            ->where('tbl_user.peran_id','=','6')
            ->orderBy('tbl_user.created_at','DESC')
            ->get();
        }

        return view('SPS/Akun/list_akun',compact('data_user'));
    }

    public function editakun($id) { 
        $data_user = User::leftjoin('tbl_pelanggan','tbl_user.pelanggan_id','=','tbl_pelanggan.pelanggan_id')
        ->join('tbl_peran','tbl_user.peran_id','=','tbl_user.peran_id')
        ->select('tbl_user.user_id','tbl_user.username','tbl_user.nama','tbl_user.peran_id','tbl_pelanggan.pelanggan_id')
        ->where('tbl_user.user_id','=',$id)
        ->first();

        $data_peran = Peran::select('peran_id','nama_peran')->orderBy('nama_peran')->get();
      
        $data_pel = Pelanggan::select('pelanggan_id','nama_pelanggan')->orderBy('nama_pelanggan','ASC')->get();
    
        return view('SPS/Akun/edit_akun', compact('data_user','data_peran','data_pel'));
    }

    public function updateakun(Request $request) { 
        $data_user                    = User::findOrFail($request->user_id);
        $data_user->nama              = $request->nama_pengguna;

        if (Session::get('peran_id') === 1) {

            if($request->password != NULL || $request->ulangi_password !=NULL) {
                $validator = Validator::make($request->all(),['password' => 'required_with:ulangi_password|min:6','ulangi_password' => 'same:password']);

                if($validator->fails()) {
                    return back()->withErrors($validator);
                }
                
                $data_user->password      = md5($request->password);
            }
        }
     
        $data_user_lama = User::findOrFail($request->user_id);
        if($request->email_pengguna != $data_user_lama->username) {

            $data_user_baru = User::where('username','<>',$data_user_lama->username)->where('username',$request->email_pengguna)->exists();
            if($data_user_baru == 1) {
                $validator = Validator::make($request->all(),[]);
                $validator->errors()->add('email', 'Email telah terdaftar!');
                return back()->withErrors($validator);
            }
        }
    
        $data_user->username          = $request->email_pengguna;
        $data_user->peran_id          = $request->peran_id;

        if ($request->peran_id == 6) {
            $data_user->pelanggan_id  = $request->pelanggan_id;
        }

        else {
            $data_user->pelanggan_id  = NULL;
        }
        /*
            if($request->foto_akun != NULL ) {
            $validator = Validator::make($request->all(),['foto_akun' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            
            if($validator->fails()) {
                return back()->withErrors($validator);
            }
            
            $file = $request->file('foto_akun');
            $nama_file = $request->nama_pengguna.'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('foto_akun',$nama_file);
            $data_user->foto_akun       = $nama_file;
        }
        */
       
        $data_user->peubah           = Session::get('user_id');
        $data_user->update();

        $pesan = $data_user->nama.', berhasil ditambahkan';
        return redirect('listakun')->with(['pesan' => $pesan]);
    }

    public function deleteakun($id) {
        $data_user = User::findOrFail($id);;
        $data_user->delete();
        $pesan = 'Pengguna '.$data_user->nama.', berhasil dihapus';
        return redirect('listakun')->with(['pesan' => $pesan]);
    }


    public function formtarif(){
        return view ('SPS/Excel/upload_tarif');
    }

    public function inputtarif(Request $request) { 
        $data_tarif = new Tarif;

        $validator = Validator::make($request->all(),['file_excel' => 'required|max:2048']);
        
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $file = $request->file('file_excel');
        $nama_file = date('d-m-yy').'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $file->move('excel',$nama_file);

        Excel::import(new TarifImport, public_path('/excel/'.$nama_file));
  
        $pesan = 'Data tarif berhasil ditambahkan';
        return $pesan;
    }

}
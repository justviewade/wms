<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Default Router

Route::get('/','TrinergiController@login');

Route::post('/logincheck','TrinergiController@logincheck');

Route::get('/logout','TrinergiController@logout');

Route::get('/dashboard','TrinergiController@dashboard')->middleware('ceksession');

// Default Router


// Supplier Function

Route::get('/formsupplier','BNIController@formsupplier')->middleware('ceksession');

Route::get('/listsupplier','BNIController@listsupplier')->middleware('ceksession');

Route::post('/inputsupplier','BNIController@inputsupplier')->middleware('ceksession');

Route::delete('/deletesupplier/{id}','BNIController@deletesupplier')->middleware('ceksession');

Route::get('/editsupplier/{id}','BNIController@editsupplier')->middleware('ceksession');

Route::get('/viewsupplier/{id}','BNIController@viewsupplier')->middleware('ceksession');

Route::post('/updatesupplier','BNIController@updatesupplier')->middleware('ceksession');

// Supplier Function


// Gudang Function ---

Route::get('/formgudang','SPSController@formgudang')->middleware('ceksession');

Route::get('/listgudang','SPSController@listgudang')->middleware('ceksession');

Route::post('/inputgudang','SPSController@inputgudang')->middleware('ceksession');

Route::delete('/deletegudang/{id}','SPSController@deletegudang')->middleware('ceksession');

Route::get('/editgudang/{id}','SPSController@editgudang')->middleware('ceksession');

Route::post('/updategudang','SPSController@updategudang')->middleware('ceksession');

// Gudang Function


// Barang Function ---

Route::get('/formbarang','BNIController@formbarang')->middleware('ceksession');

Route::get('/listbarang','BNIController@listbarang')->middleware('ceksession');

Route::post('/inputbarang','BNIController@inputbarang')->middleware('ceksession');

Route::delete('/deletebarang/{id}','BNIController@deletebarang')->middleware('ceksession');

Route::get('/editbarang/{id}','BNIController@editbarang')->middleware('ceksession');

Route::post('/updatebarang','BNIController@updatebarang')->middleware('ceksession');

Route::get('/viewbarang/{id}','BNIController@viewbarang')->middleware('ceksession');

Route::get('/mintakategori/{id}','BNIController@minta_kategori')->middleware('ceksession');

// Barang Function


// Pelanggan Function ---

Route::get('/formpelanggan','SPSController@formpelanggan')->middleware('ceksession');

Route::get('/listpelanggan','SPSController@listpelanggan')->middleware('ceksession');

Route::post('/inputpelanggan','SPSController@inputpelanggan')->middleware('ceksession');

Route::delete('/deletepelanggan/{id}','SPSController@deletepelanggan')->middleware('ceksession');

Route::get('/editpelanggan/{id}','SPSController@editpelanggan')->middleware('ceksession');

Route::get('/viewpelanggan/{id}','SPSController@viewpelanggan')->middleware('ceksession');

Route::post('/updatepelanggan','SPSController@updatepelanggan')->middleware('ceksession');

// Pelanggan Function


// PMB Function ---
    
    //BNI

    Route::get('/formpbm','BNIController@formpbm')->middleware('ceksession');

    Route::post('/inputpbm','BNIController@inputpbm')->middleware('ceksession');

    Route::get('/listpbm','BNIController@listpbm')->middleware('ceksession');

    Route::delete('/deletepbm/{id}','BNIController@deletepbm')->middleware('ceksession');

    Route::get('/editpbm/{id}','BNIController@editpbm')->middleware('ceksession');

    Route::post('/updatepbm','BNIController@updatepbm')->middleware('ceksession');

    Route::get('/formpbk','BNIController@formpbk')->middleware('ceksession');

    Route::get('/listpbk','BNIController@listpbk')->middleware('ceksession');

    //BNI

    //SPS

    Route::get('/listpbmspsacc','SPSController@listpbmspsacc')->middleware('ceksession');

    Route::get('/mintainfopbm/{id}','SPSController@mintainfopbm')->middleware('ceksession');

    Route::post('/updatepbmspsacc','SPSController@updatepbmspsacc')->middleware('ceksession');
   
    Route::get('/listpbmspsterima','SPSController@listpbmspsterima')->middleware('ceksession');
    
    Route::get('/formpbmspsterima/{id}','SPSController@formpbmspsterima')->middleware('ceksession');

    Route::post('/updatepbmspsterima','SPSController@updatepbmspsterima')->middleware('ceksession');

    Route::get('/listpbmspskekurangan','SPSController@listpbmspskekurangan')->middleware('ceksession');
    
    Route::get('/formpbmspskekurangan/{id}','SPSController@formpbmspskekurangan')->middleware('ceksession');

    Route::post('/updatepbmspskekurangan','SPSController@updatepbmspskekurangan')->middleware('ceksession');
    
    Route::get('/listpbmspsalokasi','SPSController@listpbmspsalokasi')->middleware('ceksession');

    Route::get('/formpbmspsalokasi/{id}','SPSController@formpbmspsalokasi')->middleware('ceksession');

    Route::post('/updatepbmspsalokasi','SPSController@updatepbmspsalokasi')->middleware('ceksession');
    

    //SPS

// PMB Function ---


// PBK Function ---
    
    //BNI

    Route::get('/formpbk','BNIController@formpbk')->middleware('ceksession');

    Route::post('/inputpbk','BNIController@inputpbk')->middleware('ceksession');

    Route::get('/listinventory','BNIController@listinventory')->middleware('ceksession'); 

    Route::get('/listpbk','BNIController@listpbk')->middleware('ceksession');

    Route::delete('/deletepbk/{id}','BNIController@deletepbk')->middleware('ceksession');

    Route::get('/editpbk/{id}','BNIController@editpbk')->middleware('ceksession');

    Route::post('/updatepbk','BNIController@updatepbk')->middleware('ceksession');

    Route::post('/cektarif','BNIController@cektarif')->middleware('ceksession');

    Route::post('/cekstok','BNIController@cekstok')->middleware('ceksession');

    //BNI

    //SPS

    Route::get('/listpbkspsacc','SPSController@listpbkspsacc')->middleware('ceksession');

    Route::post('/mintainfopbk','SPSController@mintainfopbk')->middleware('ceksession'); //Done Ubah Ke Metode Post

    Route::post('/updatepbkspsacc','SPSController@updatepbkspsacc')->middleware('ceksession');
   
    Route::get('/listpbksps2','SPSController@listpbksps2')->middleware('ceksession');

    Route::get('/formpbksps2','SPSController@formpbksps2')->middleware('ceksession');

    Route::get('/listpbksps3','SPSController@listpbksps3')->middleware('ceksession');
    
    Route::get('/formpbksps3','SPSController@formpbksps3')->middleware('ceksession');

    Route::get('/listpbksps4','SPSController@listpbksps4')->middleware('ceksession');

    Route::get('/formpbksps4','SPSController@formpbksps4')->middleware('ceksession');

    //SPS

// PBK Function ---


// Invetori Function ---

    //BNI

    Route::get('/invetoripelanggan','BNIController@invetoripelanggan')->middleware('ceksession');

    //BNI


    //SPS

    Route::get('/inventorimaster','SPSController@inventorimaster')->middleware('ceksession');

    //SPS

// Inventori Funciton ---


// Kategori Barang Function ---

Route::get('/formkategoribarang','SPSController@formkategoribarang')->middleware('ceksession');

Route::post('/inputkategoribarang','SPSController@inputkategoribarang')->middleware('ceksession');

Route::get('/listkategoribarang','SPSController@listkategoribarang')->middleware('ceksession');

Route::delete('/deletekategoribarang/{id}','SPSController@deletekategoribarang')->middleware('ceksession');

Route::get('/editkategoribarang/{id}','SPSController@editkategoribarang')->middleware('ceksession');

Route::get('/viewkategoribarang/{id}','SPSController@viewkategoribarang')->middleware('ceksession');

Route::post('/updatekategoribarang','SPSController@updatekategoribarang')->middleware('ceksession');

// Kategori Barang Function ---


// Ganti Password Function ---

Route::get('/gantipassword','TrinergiController@gantipassword')->middleware('ceksession');

Route::post('/updatepassword','TrinergiController@updatepassword')->middleware('ceksession');

// Ganti Password Function ---


// Akun Function ---

Route::get('/formakun','SPSController@formakun')->middleware('ceksession');

Route::post('/inputakun','SPSController@inputakun')->middleware('ceksession');

Route::get('/listakun','SPSController@listakun')->middleware('ceksession');

Route::get('/editakun/{id}','SPSController@editakun')->middleware('ceksession');

Route::post('/updateakun','SPSController@updateakun')->middleware('ceksession');

Route::delete('/deleteakun/{id}','SPSController@deleteakun')->middleware('ceksession');

Route::get('/mintapelanggan','SPSController@minta_pelanggan')->middleware('ceksession');

// Route::post('/inputpelanggan','SPSController@inputpelanggan')->middleware('ceksession');

// Route::get('/editpelanggan/{id}','SPSController@editpelanggan')->middleware('ceksession');

// Akun Function


// Upload Excel

Route::get('/formtarif','SPSController@formtarif')->middleware('ceksession');

Route::post('/inputtarif','SPSController@inputtarif')->middleware('ceksession');

// Upload Excel
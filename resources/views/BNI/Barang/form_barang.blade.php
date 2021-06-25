@extends('template')
@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="container">
        <div class="container">
            <br>
            <div>
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                    <li class="breadcrumb-item">{{Session::get('nama_peran')}}</li>
                    <li class="breadcrumb-item">Formulir</li>
                    <li class="breadcrumb-item active"><a href="{{url('formbarang')}}">Data Barang</a></li>
                </ol>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Formulir Data Barang</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ url('inputbarang')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(Session::get('peran_id') <> 6)
                                <div class="form-group mb-4">
                                <label>Pelanggan</label><br>
                                <select id="admin_pelanggan_id" name="pelanggan_id" class="selectpicker" data-live-search="true" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($data_pel as $tampil)
                                        <option value="{{$tampil->pelanggan_id}}">{{$tampil->nama_pelanggan}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group mb-4">
                                <label>Kategori Barang</label><br>
                                <select id="admin_kategori_id" name="kategori_id" class="selectpicker" data-live-search="true" required disabled>
                                     <option value="">-- Pilih Pelanggan --</option>
                                </select>
                                </div>
                                @endif
                                <div class="form-group mb-4">
                                    <label>Nama Barang</label>
                                    <input name="nama_barang" class="form-control" placeholder="Contoh : Baju Polo" required>
                                </div>
                                @if(Session::get('peran_id') === 6)
                                <div class="form-group mb-4">
                                <label>Kategori Barang</label><br>
                                <select id="admin_kategori_id" name="kategori_id" class="selectpicker" data-live-search="true" required {{($data_kat->isEmpty()) ? 'disabled' : ''}}>
                                    <option value="">{{($data_kat->isEmpty()) ? 'Kategori Kosong' : '-- Pilih Kategori --'}}</option>
                                    @foreach($data_kat as $tampil)
                                        <option value="{{$tampil->kategori_id}}">{{$tampil->nama_kategori}} - {{$tampil->kode_sku}}</option>
                                    @endforeach
                                </select>
                                </div>
                                @endif
                                <div class="form-group mb-4">
                                    <label>Kode SKU</label>
                                    <input name="SKU" class="form-control" placeholder="Contoh : 019000" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Harga Satuan(Rp)</label>
                                    <input name="harga" id="money" class="form-control" placeholder="Contoh : 90,000">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tahun Pengadaan</label>
                                    <input name="tahun" id="date4" class="form-control" placeholder="Contoh : 2020" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Spesifikasi Barang</label>
                                    <textarea name="spesifikasi_barang" class="form-control"  rows="3" placeholder="Contoh : [Ukuran] Panjang : 15cm Lebar : 2cm"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Foto Barang (Opsional) :</label>
                                    <div>
                                        <input type="file" name="foto_barang">
                                        </p class="text-warning"> [Ektensi file : jpg, jpeg, png, gif dan ukuran maksimal 2 megabyte]</p>
                                    </div>
                                    @error('foto_barang')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></div>
                                <input type="submit" value="Tambah" class="mt-4 mb-4 btn btn-primary">
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listbarang')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Formulir Data Barang</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
@endsection

@section('scripttop')
    <link href="{{asset ('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"> 
    <script src="{{asset ('assets/js/ajax/jquery.1.9.1.js')}}"></script>
@endsection

@section('scriptbuttom')
    <script src="{{asset ('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset ('plugins/jquery-mask/jquery.mask.min.js')}}"></script>
    <script src="{{asset ('plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset ('assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset ('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script>
        $("#date4").inputmask("9999");
        $('#money').mask("000,000,000,000,000", {reverse: true});
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
                jQuery('#admin_pelanggan_id').on('change',function(){
                $('#admin_pelanggan_id').children('option[value=""]').remove();
                $('#admin_pelanggan_id').selectpicker('refresh');
                var pelangganID = jQuery(this).val();
                console.log(pelangganID);
                if(pelangganID){
                    jQuery.ajax({
                        url : 'mintakategori/'+pelangganID,
                        type : "GET",
                        dataType : "json",
                        success:function(data) {
                            
                            if (data.length == 0) {
                                $('#admin_kategori_id').empty();
                                $('#admin_kategori_id').prop('disabled',true);
                                $('#admin_kategori_id').append('<option value="">Kategori Kosong!</option>').selectpicker('refresh');
                            }

                            else {
                                $('#admin_kategori_id').empty();
                                $('#admin_kategori_id').prop('disabled',false);;
                                jQuery.each(data, function(key,value){
                                    key = key+1;
                                    $('#admin_kategori_id').append('<option value="'+value.kategori_id+'">'+value.nama_kategori+' - '+value.kode_sku+'</option>').selectpicker('refresh');

                                });
                            }
                        }
                        
                    });
                }
                else {
                  $('#admin_kategori_id').empty().selectpicker('refresh');
                }
                });
        });
        </script>
@endsection 
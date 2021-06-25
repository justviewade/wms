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
                    <li class="breadcrumb-item active"><a href="{{url('formgudang')}}">Data Kategori Barang</a></li>
                </ol>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Formulir Data Kategori Barang</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ url('inputkategoribarang')}}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label>Nama Kategori Barang</label>
                                    <input name="nama_kategori" class="form-control" placeholder="Contoh : Premium" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Kode Kategori</label>
                                    <input id="kode" name="kode_sku" class="form-control" placeholder="Contoh : PRE [Maksimal 4 Digit]" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pelanggan</label>
                                    <select name="pelanggan_id" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($data_pel as $tampil)
                                        <option value="{{$tampil->pelanggan_id}}">{{$tampil->nama_pelanggan}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></div>
                                <input type="submit" value="Tambah" class="mt-4 mb-4 btn btn-primary">
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listkategoribarang')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Formulir Kategori Barang</h4>
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
@endsection

@section('scriptbuttom')
    <script src="{{asset ('plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset ('assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset ('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset ('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset ('plugins/jquery-mask/jquery.mask.min.js')}}"></script>
    <script>
        $("#kode").inputmask("A|9A|9A|9A|9");
    </script>
@endsection
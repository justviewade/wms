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
                    <li class="breadcrumb-item">Data Master</li>
                    <li class="breadcrumb-item"><a href="{{url('listbarang')}}">Data Master Barang</a></li>
                    <li class="breadcrumb-item active">Lihat Data Barang - {{$data_bar->nama_barang}}</li>
                </ol>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Lihat Data Barang - {{$data_bar->nama_barang}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form id="update" action="{{ url('updatebarang')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="barang_id" value="{{$data_bar->barang_id}}">
                                @if(Session::get('peran_id') === 1 || Session::get('peran_id') === 2)
                                <div class="form-group mb-4">
                                    <label>Nama Pelanggan</label>
                                    <input name="nama_pelanggan" class="form-control" value="{{$data_pel->nama_pelanggan}}" disabled>
                                </div>
                                @endif
                                <div class="form-group mb-4">
                                    <label>Nama Barang</label>
                                    <input name="nama_barang" class="form-control" value="{{$data_bar->nama_barang}}" disabled>
                                </div>
                                <div class="form-group mb-4">
                                <label>Kategori Barang</label><br>
                                <select name="kategori_id" class="selectpicker" data-live-search="true" disabled>
                                    @foreach($data_kat as $tampil)
                                    <option {{($data_bar->kategori_id==$tampil->kategori_id) ? 'selected' : ''}} value="{{$tampil->kategori_id}}">{{$tampil->nama_kategori}} - {{$tampil->kode_sku}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Kode SKU</label>
                                    <input name="SKU" class="form-control" value="{{$data_bar->SKU}}" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Harga Satuan(Rp)</label>
                                    <input name="harga" id="money" class="form-control" value="{{$data_bar->harga}}" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tahun Pengadaan</label>
                                    <input name="tahun" id="date4" class="form-control" value="{{$data_bar->tahun}}" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Spesifikasi Barang</label>
                                    <textarea disabled name="spesifikasi_barang" class="form-control"  rows="3">{{$data_bar->spesifikasi_barang}}</textarea>
                                </div>
                                 @if($data_bar->foto_barang !== NULL) 
                                <div class="form-group mb-4">
                                    <label>Foto Barang (Opsional) :</label>
                                    <div>
                                        <div data-toggle="tooltip" title="Lihat Foto"><img class="foto" foto_src="{{asset('foto_barang').'/'.$data_bar->foto_barang}}" foto_nama="{{$data_bar->nama_barang}}" src="{{asset('foto_barang').'/'.$data_bar->foto_barang}}" width="80px" height="80px" alt="Foto {{$data_bar->nama_barang}}" class=""></div>
                                    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                                </div>
                                @endif
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listbarang')}}">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Lihat Data Barang</h4>
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

    <link href="{{asset ('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset ('plugins/sweetalerts/promise-polyfill.js')}}"></script>
    <link href="{{asset ('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
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

    <script src="{{asset ('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset ('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <script src="{{asset ('assets/js/edit-custom.js')}}"></script>
@endsection 
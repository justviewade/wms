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
                    <li class="breadcrumb-item"><a href="{{url('listgudang')}}">Data Master Gudang</a></li>
                    <li class="breadcrumb-item active">Ubah Data Gudang - {{$data_gud->nama_gudang}}</li>
                </ol>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Ubah Data Gudang - {{$data_gud->nama_gudang}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form id="update" action="{{ url('updategudang')}}" method="POST">
                                @csrf
                                <input type="hidden" name="gudang_id" value="{{$data_gud->gudang_id}}">
                                <div class="form-group mb-4">
                                    <label>Nama Gudang</label>
                                    <input name="nama_gudang" class="form-control" value="{{$data_gud->nama_gudang}}" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat Gudang</label>
                                    <textarea name="alamat_gudang" class="form-control"  rows="3">{{$data_gud->alamat_gudang}}</textarea>
                                </div>
                                <div style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></div>
                                <a id="simpan" class="mt-4 mb-4 btn btn-primary">Simpan</a>
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listgudang')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Ubah Data Gudang</h4>
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
    <link rel="stylesheet" type="text/css" href="{{asset ('plugins/bootstrap-select/bootstrap-select.min.css')}}"> 

    <link href="{{asset ('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset ('plugins/sweetalerts/promise-polyfill.js')}}"></script>
    <link href="{{asset ('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scriptbuttom')
    <script src="{{asset ('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
   
    <script src="{{asset ('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset ('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <script src="{{asset ('assets/js/edit-custom.js')}}"></script>
@endsection
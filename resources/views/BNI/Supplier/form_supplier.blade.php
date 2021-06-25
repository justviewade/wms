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
                    <li class="breadcrumb-item active"><a href="{{url('formsupplier')}}">Data Supplier</a></li>
                </ol>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Formulir Data Supplier</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ url('inputsupplier')}}" method="POST">
                                @csrf
                                @if(Session::get('peran_id') === 1 || Session::get('peran_id') === 2)
                                <div class="form-group mb-4">
                                <label>Pelanggan</label><br>
                                <select id="admin_pelanggan_id" name="pelanggan_id" class="selectpicker" data-live-search="true" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($data_pel as $tampil)
                                        <option value="{{$tampil->pelanggan_id}}">{{$tampil->nama_pelanggan}}</option>
                                    @endforeach
                                </select>
                                </div>
                                @endif
                                <div class="form-group mb-4">
                                    <label>Nama Supplier</label>
                                    <input name="nama_supplier" class="form-control" placeholder="Contoh : PT. Ratu Permata, Tbk" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat Supplier</label>
                                    <textarea name="alamat_supplier" class="form-control"  rows="3" placeholder="Contoh : Jl. Bekasi Timur, Jakarta 13465"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat Email</label>
                                    <input name="email_supplier" type ="email" class="form-control" placeholder="Contoh : admin@sukmaputrasarana.com">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nomor Telp</label>
                                    <input name="telp_supplier" class="form-control" placeholder="Contoh : 081222433465">
                                </div>
                                <div class="form-group mb-4">
                                    <label style="font-style: italic;">Person In Charge (PIC)</label>
                                    <input name="PIC" type ="text" class="form-control" placeholder="Contoh : Bpk. Noerdin Bahar">
                                </div>
                                <div style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></div>
                                <input type="submit" value="Tambah" class="mt-4 mb-4 btn btn-primary">
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listsupplier')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Formulir Data Supplier</h4>
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
@endsection

@section('scriptbuttom')
    <script src="{{asset ('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
@endsection
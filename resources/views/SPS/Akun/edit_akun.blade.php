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
                    <li class="breadcrumb-item">{{Session::get('nama_peran')}}</a></li>
                    <li class="breadcrumb-item">Akun</li>
                    <li class="breadcrumb-item active"><a href="{{url('formpelanggan')}}">Ubah Akun - {{$data_user->nama}}</a></li>
                </ol>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Ubah Akun - {{$data_user->nama}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ url('updateakun')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$data_user->user_id}}">
                                <div class="form-group mb-4">
                                    <label>Nama Pengguna</label>
                                    <input name="nama_pengguna" class="form-control" value="{{$data_user->nama}}" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat Email (Untuk Login)</label>
                                    <input name="email_pengguna" type ="email" class="form-control" value="{{$data_user->username}}">
                                    @error('email')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                @if(Session::get('peran_id') === 1) 
                                <div class="form-group mb-4">
                                    <label>Password</label>
                                    <input name="password" type ="password" class="form-control">
                                    @error('password')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label>Ulangi Password </label>
                                    <input name="ulangi_password" type ="password" class="form-control">
                                    @error('ulangi_password')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                @endif
                                <div class="form-group mb-4">
                                    <label>Peran</label><br>
                                    <select id="selector_peran" name="peran_id" class="selectpicker" data-live-search="true" required>
                                    @foreach($data_peran as $tampil)
                                        <option {{($data_user->peran_id === $tampil->peran_id) ? 'selected' : ''}} value="{{$tampil->peran_id}}">{{$tampil->nama_peran}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pelanggan BNI</label><br>
                                    <select id="selector_pelanggan" name="pelanggan_id" class="selectpicker" data-live-search="true" {{($data_user->peran_id === 6) ? '' : 'disabled'}}>
                                    @if($data_user->peran_id === 6)
                                        @foreach($data_pel as $tampil)
                                            <option {{($data_user->pelanggan_id==$tampil->pelanggan_id) ? 'selected' : ''}} value="{{$tampil->pelanggan_id}}">{{$tampil->nama_pelanggan}}</option>
                                        @endforeach
                                    @else
                                        <option value="">-- Peran Pelanggan  --</option>
                                    @endif
                                    </select>
                                </div>
                               <!-- <div class="form-group mb-4">
                                    <label>Foto Profile (Opsional) :</label>
                                    <div>
                                        <input type="file" name="foto_akun">
                                        </p class="text-warning"> [Ektensi file : jpg, jpeg, png, gif dan ukuran maksimal 2 megabyte]</p>
                                    </div>
                                    @error('foto_barang')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>-->
                                <div style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></div>
                                <input type="submit" value="Simpan" class="mt-4 mb-4 btn btn-primary">
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listakun')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Formulir Data Akun</h4>
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
    <script src="{{asset ('assets/js/ajax/jquery.1.9.1.js')}}"></script>
@endsection

@section('scriptbuttom')
    <script src="{{asset ('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
                jQuery('#selector_peran').on('change',function(){
                $('#selector_peran').selectpicker('refresh');
                pilihan = $('#selector_peran').children('option:selected' ).val();
                if(pilihan == 6){
                    jQuery.ajax({
                        url : '{{url('mintapelanggan')}}',
                        type : "GET",
                        dataType : "json",
                        success:function(data) {
                            
                            if (data.length == 0) {
                                $('#selector_pelanggan').empty();
                                $('#selector_pelanggan').prop('disabled',true);
                                $('#selector_pelanggan').append('<option value="">Pelanggan Kosong!</option>').selectpicker('refresh');
                            }

                            else {
                                $('#selector_pelanggan').empty();
                                $('#selector_pelanggan').prop('disabled',false);;
                                jQuery.each(data, function(key,value){
                                    key = key+1;
                                    $('#selector_pelanggan').append('<option value="'+value.pelanggan_id+'">'+value.nama_pelanggan+'</option>').selectpicker('refresh');

                                });
                            }
                        }
                        
                    });
                }
                else {
                  $('#selector_pelanggan').prop('disabled',true);
                  $('#selector_pelanggan').empty();
                  $('#selector_pelanggan').append('  <option value="">-- Peran Pelanggan  --</option>').selectpicker('refresh');
                }
                });
        });
        </script>
@endsection
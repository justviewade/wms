@extends('template')
@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="container" style="max-width:100% !important;">
        <div class="container">
            <br>
            <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item">{{Session::get('nama_peran')}}</li>
                <li class="breadcrumb-item">Proses PBM</li>
                <li class="breadcrumb-item"><a href="{{url('listpbmspsterima')}}">List Penerimaan Barang</a></li>
                <li class="breadcrumb-item active">Peneriman Barang Masuk - {{$data_pbm->kode_trx_pbm}}</li>
            </ol>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Penerimaan Barang Masuk</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form  id="dynamic" action="{{ url('updatepbmspsterima')}}" method="POST">
                                @csrf
                                <input type="hidden" name="trx_pbm_id" value="{{$data_pbm->trx_pbm_id}}">
                                <div class="form-group mb-4">
                                    <label>Kode PBM : </label>
                                    <input name="kode_pbm" class="form-control" value="{{$data_pbm->kode_trx_pbm}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tgl dan Waktu Perkiraan Barang Masuk</label>
                                    <input name="tgl_pbm_masuk" class="form-control" value="{{$data_pbm->tgl_pbm_masuk}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pembuat</label>
                                    <input name="pembuat" class="form-control" value="{{$data_pbm->nama_pelanggan}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Keterangan PBM</label>
                                    <textarea name="keterangan" class="form-control" rows="3" disabled>{{$data_pbm->keterangan}}</textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label>List Barang</label><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th class="text-center align-middle">Barang</th>
                                                        <th class="text-center align-middle">Supplier</th>
                                                        <th class="text-center align-middle">Barang Aktual</th>
                                                        <th class="text-center align-middle">Permintaan Penerimaan</th>
                                                        <th class="text-center align-middle">Retur / Kekurangan</th>
                                                        <th class="text-center align-middle">Catatan Per Barang</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data_pbm_detail as $tampil_utama)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$tampil_utama->nama_barang}} - {{$tampil_utama->kode_sku}} {{$tampil_utama->SKU}}</td>
                                                        <td>{{$tampil_utama->nama_supplier}}  </td>
                                                        <input type="hidden" name="data[{{$loop->iteration}}][trx_pbm_detail_id]" value="{{$tampil_utama->trx_pbm_detail_id}}">
                                                        <td><input class="form-control" name="data[{{$loop->iteration}}][aktual]" type="number" placeholder="Cth : 100" min="1" max="{{$tampil_utama->qty}}" data-cell="A{{$loop->iteration}}" data-format="0,0" required></td>
                                                        <td><input class="form-control" name="data[{{$loop->iteration}}][permintaan]" type="number" value="{{$tampil_utama->qty}}" data-cell="B{{$loop->iteration}}" data-format="0,0" required readonly></td>
                                                        <td><input class="form-control" name="data[{{$loop->iteration}}][kekurangan]" type="number" data-formula="IF(A{{$loop->iteration}}>=B{{$loop->iteration}},0,B{{$loop->iteration}}-A{{$loop->iteration}})" data-cell="C{{$loop->iteration}}" data-format="0,0" required readonly></td>
                                                        <td><input class="form-control" name="data[{{$loop->iteration}}][catatan_penerimaan]" type="text" placeholder=""></td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td>Jumlah Masuk:</td>
                                                        <td><input class="form-control" type="number" data-cell="A{{$data_pbm_detail->count()+1}}" data-formula="SUM(A1:A{{$data_pbm_detail->count()}})" data-format="0,0"  readonly></td>
                                                        <td><input class="form-control" type="number" data-cell="B{{$data_pbm_detail->count()+1}}" data-formula="SUM(B1:B{{$data_pbm_detail->count()}})" data-format="0,0" readonly></td>
                                                        <td><input class="form-control" type="number" data-cell="C{{$data_pbm_detail->count()+1}}" data-formula="SUM(C1:C{{$data_pbm_detail->count()}})" data-format="0,0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> 
                                </div>
                                <input id="max_array" type="hidden" name="max_indeks_array" value="{{$data_pbm_detail->count()}}">
                                <button style="display:none;" id="button_simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</button>
                                <a id="simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</a>
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listpbmspsterima')}}">Batal</a> 
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Permohonan Barang Masuk - Penerimaan Barang</h4>
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
    <link href="{{asset ('plugins/jquery-datetimepicker/jquery.datetimepicker.css')}}" rel="stylesheet" type>

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
    <script src="{{asset ('assets/js/calx-2/jquery-calx-2.2.6.min.js') }}"></script>
    <script src="{{asset ('plugins/jquery-datetimepicker/jquery.datetimepicker.js')}}"></script>
    <script src="{{asset ('plugins/jquery-datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>

    <script src="{{asset ('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset ('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <script src="{{asset ('assets/js/edit-custom.js')}}"></script>
    <script>
        $("#date4").inputmask("9999");
        $('#money').mask("000,000,000,000,000", {reverse: true});

        $('#datetimepicker').datetimepicker({
            format:'Y-m-d H:i:s',
            timepicker:true,
            minDate: 0,
            enabledHours: [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
            stepping: 30
        });
    </script>
    <script>

    // Calx 2 Dynamic
    $('#dynamic').calx();
    
    $('#simpan').on('click', function () {
        swal({
            title: 'Yakin data PBM sudah benar?',
            text: 'Data tidak dapat diubah kembali',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $('#button_simpan').click();
            }
        })
    })
    </script>
@endsection 
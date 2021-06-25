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
                <li class="breadcrumb-item"><a href="{{url('listpbmsps3')}}">List Penerimaan Barang Retur</a></li>
                <li class="breadcrumb-item active">Peneriman Barang Retur - PBM - {{$data_trx_pbm_detail->kode_trx_pbm}}</li>
            </ol>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Penerimaan Retur Barang - [{{$data_trx_pbm_detail->nama_barang}}] {{$data_trx_pbm_detail->SKU}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form  id="dynamic" action="{{ url('updatepbmspskekurangan')}}" method="POST">
                                @csrf
                                <input type="hidden" name="trx_pbm_id" value="{{$data_trx_pbm_detail->trx_pbm_id}}">
                                <input type="hidden" name="trx_pbm_detail_id" value="{{$data_trx_pbm_detail->trx_pbm_detail_id}}">
                                <div class="form-group mb-4">
                                    <label>Kode PBM : </label>
                                    <input name="kode_pbm" class="form-control" value="{{$data_trx_pbm_detail->kode_trx_pbm}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tgl Penerimaan Barang Kurang</label>
                                    <input name="tgl_retur" class="form-control" value="{{date('Y-m-d H:i:s')}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pelenggan</label>
                                    <input name="pelanggan" class="form-control" value="{{$data_trx_pbm_detail->nama_pelanggan}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Catatan Penerimaan Awal </label>
                                    <textarea name="catatan_penerimaan" class="form-control" rows="2" disabled>{{$data_trx_pbm_detail->catatan_penerimaan}}</textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Catatan Penerimaan Penerimaan</label>
                                    <textarea name="catatan_penerimaan" class="form-control" rows="2"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-4">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center align-middle">Nama Barang</th>
                                                    <th class="text-center align-middle">Supplier</th>
                                                    <th class="text-center align-middle">Jumalah Retur Barang</th>
                                                    <th class="text-center align-middle">Sisa Kekurangan</th>
                                                    <th class="text-center align-middle">Stok Gudang Saat Ini</th>
                                                    <th class="text-center align-middle">Permohonan Barang Masuk</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                <tr>
                                                    <td>{{$data_trx_pbm_detail->nama_barang}} - [{{$data_trx_pbm_detail->kode_sku}}] {{$data_trx_pbm_detail->SKU}}</td>
                                                    <td>{{$data_trx_pbm_detail->nama_supplier}}  </td>
                                                    <td><input class="form-control" name="aktual" type="number" placeholder="Cth : 100" min="1" max="{{$data_trx_pbm_detail->kekurangan}}" data-cell="A1" data-format="0,0" required></td>
                                                    <td>
                                                    <input type="hidden" name="jumlah_kekurangan" value="{{$data_trx_pbm_detail->kekurangan}}" data-cell="B1" data-format="0,0">
                                                    <input class="form-control" name="selisih_kekurangan" type="number" data-formula="IF(A1>=B1,0,B1-A1)" data-cell="B2" data-format="0,0" required readonly>
                                                    </td>
                                                    <td><input class="form-control" name="jumalah_kekurangan" type="number" data-formula="" value="{{$data_trx_pbm_detail->aktual}}" data-cell="C1" data-format="0,0" required readonly></td>
                                                    <td><input class="form-control" name="jumalah_kekurangan" type="number" data-formula="" value="{{$data_trx_pbm_detail->qty}}" data-cell="D1" data-format="0,0" required readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                <button style="display:none;" id="button_simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</button>
                                <a id="simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</a>
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listpbmspskekurangan')}}">Batal</a> 
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Permohonan Barang Masuk - Penerimaan Barang Barang</h4>
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
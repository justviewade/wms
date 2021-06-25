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
                <li class="breadcrumb-item"><a href="{{url('listpbmspsalokasi')}}">Form Alokasi Barang</a></li>
                <li class="breadcrumb-item active">Alokasi Zona Gudang</li>
            </ol>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Alokasi Gudang</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form  id="dynamic" action="{{ url('updatepbmspsalokasi')}}" method="POST">
                                @csrf
                                <table>
                                    <tr>
                                        <td>
                                            <label>Kode PBM</label>
                                        </td>
                                        <td><label>:</label></td>
                                        <td>
                                            <label>PBM - {{$data_trx_pbm_detail->kode_trx_pbm}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Pelanggan</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            <label>{{$data_trx_pbm_detail->nama_pelanggan}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nama Barang</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            <label>[{{$data_trx_pbm_detail->kode_sku}}] {{$data_trx_pbm_detail->nama_barang}} [{{$data_trx_pbm_detail->SKU}}]</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Pembuat</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            <label>{{Session::get('nama')}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Qty</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            <label>{{$data_trx_pbm_detail->qty}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Diterima</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            <label>{{$data_trx_pbm_detail->aktual}}</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Kekurangan</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            {!!($data_trx_pbm_detail->kekurangan != 0) ? '<label class="text-danger">'.$data_trx_pbm_detail->kekurangan.'</label>' : '<label class="text-success">Tidak ada</label>'!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Belum Alokasi</label>
                                        </td>
                                        <td>
                                            <label>:</label>
                                        </td>
                                        <td>
                                            {!!($batas_pengisian[0]->kurang_alokasi != 0) ? '<label class="text-danger">'.$batas_pengisian[0]->kurang_alokasi.'</label>' : '<label class="text-success">Tidak ada</label>'!!}
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td>
                                            <label>Catatan Gudang</label>
                                        </td>
                                        <td><label>:</label></td>
                                        <td></td>
                                    </tr> -->
                                </table>
                                  <!-- <div class="form-group mb-4">   
                                     <textarea name="catatan_alokasi" class="form-control"  rows="3"></textarea>
                                </div> -->
                                <div class="form-group mb-4">
                                    <br>
                                    <!-- <label>Alokasi Penyimpanan</label><br> -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="text-center align-middle">
                                                            <div id="add_item" class="btn btn-success btn-sm rounded-circle">+</div>
                                                        </th> -->
                                                        <th>Aksi</th>
                                                        <th class="text-center align-middle">QTY</th>
                                                        <th class="text-center align-middle">Lokasi Barang</th>
                                                        <th class="text-center align-middle">Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemlist">
                                                    <tr>
                                                        <td class="text-center align-middle">
                                                            <div id="add_item" class="btn btn-success btn-sm rounded-circle">+</div>
                                                        </td>
                                                        <td><input class="form-control" name="data[1][kuantitas]" type="number" placeholder="Cth : 100" data-cell="A1" data-format="0,0" required></td>
                                                        <td>
                                                            <select id="opsigudang_master" name="data[1][gudang_id]" class="form-control selectpicker" data-live-search="true" required>
                                                                <option value="">-- Pilih Lokasi Gudang --</option>
                                                            @foreach($data_gudang as $tampil)
                                                                <option class="pilihan" value="{{$tampil->gudang_id}}">{{$tampil->nama_gudang}}</option>
                                                            @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <textarea rows="1" name="data[1][catatan_alokasi]" class="form-control"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr id="total">
                                                        <td style="text-align:center">Jumlah</td>
                                                        <td><input id="check_total" type="number" name="total" data-cell="G1" data-format="0,0" data-formula="SUM(A1:A1)" class="form-control" readonly></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr id="kurang">
                                                        <td id="kurang" style="text-align:center">Belum Alokasi</td>
                                                        <td><input type="number" name="kekurangan" data-cell="H1" data-format="0,0" data-formula="IF(G1>={{$batas_pengisian[0]->kurang_alokasi}},0,{{$batas_pengisian[0]->kurang_alokasi}}-G1)" class="form-control" readonly></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> 
                                </div>
                                <input id="max_array" type="hidden" name="max_indeks_array" value="1">
                                <input id="aktual" type="hidden" name="aktual" value="{{$data_trx_pbm_detail->aktual}}">
                                <input type="hidden" name="trx_pbm_detail_id" value="{{$data_trx_pbm_detail->trx_pbm_detail_id}}">
                                <input type="hidden" name="trx_pbm_id" value="{{$data_trx_pbm_detail->trx_pbm_id}}">
                                <button style="display:none;" id="button_simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</button>
                                <a id="simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</a>
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listpbmspsalokasi')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Permohonan Barang Masuk - Alokasi Gudang</h4>
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
    $form       = $('#dynamic').calx();
    $itemlist   = $('#itemlist');
    $total      = $('#total');
    $counter    = 1;

    $('#add_item').click(function(e){
        e.preventDefault();
        var i = ++$counter;
        $total.before('<tr>\
                            <td class="text-center align-middle">\
                                <div class="btn btn-danger btn-sm rounded-circle btn-remove">-</div>\
                            </td>\
                            <td><input class="form-control" name="data['+i+'][kuantitas]" type="number" placeholder="Cth : 100" data-cell="A'+i+'" data-format="0,0" required></td>\
                            <td>\
                                <select id="opsigudang-'+i+'" name="data['+i+'][gudang_id]" class="form-control selectpicker" data-live-search="true" required>\
                                </select>\
                            </td>\
                            <td>\
                                <textarea rows="1" name="data['+i+'][catatan_alokasi]" class="form-control"></textarea>\
                            </td>\
                     </tr>\
        ');

        $('#opsigudang_master > option').clone().appendTo('#opsigudang-'+i);
        $('#opsigudang-'+i).selectpicker('refresh');

        $form.calx('update');
        $form.calx('getCell', 'G1').setFormula('SUM(A1:A'+i+')');
        $form.calx('getCell', 'H1').setFormula('IF(G1>={{$data_trx_pbm_detail->aktual}},0,{{$data_trx_pbm_detail->aktual}}-G1)');

        $("#max_array").val($counter);  
    });

    $('#simpan').on('click', function () {
        if($(("#check_total")).val() <= {{$batas_pengisian[0]->kurang_alokasi}}) {
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
        }
        else {
            swal({
                type: 'error',
                title: 'Kesalahan',
                text: 'Jumlah alokasi memlebihi jumlah barang!',
                padding: '2em'
             })
        }
    })

    $('#itemlist').on('click', '.btn-remove', function(){
        $(this).parent().parent().remove();
        $form.calx('update');
        $form.calx('getCell', 'G1').calculate();
    });

    </script>
@endsection 
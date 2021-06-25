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
                <li class="breadcrumb-item">Proses PBK</li>
                <li class="breadcrumb-item"><a href="{{url('listpbmsps2')}}">List Packing & Kirim Barang</a></li>
                <li class="breadcrumb-item active"><a href="{{url('formpbmsps2')}}">Packing & Kirim Barang</a></li>
            </ol>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Pengiriman Barang</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form  id="dynamic" action="{{ url('inputpbm')}}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label>Kode PBK : </label>
                                    <input name="kode_pbm" class="form-control" value="{{$kode_pbm}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tgl Penerimaan</label>
                                    <input name="tgl_pbm" class="form-control" value="{{date('Y-m-d H:i:s')}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pembuat</label>
                                    <input name="pembuat" class="form-control" value="{{Session::get('nama')}}" readonly>
                                </div>
                                   <div class="form-group mb-4">
                                    <label>No. STT (Surat Jalan)</label>
                                    <input name="tgl_pbm" class="form-control" value="" >
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pelayanan</label>
                                    <select id="pelayanan" name="data[1][barang_id]" class="form-control selectpicker" onchange="checktarif()" data-live-search="true" required>
                                        <option value="">-- Pilih Pelayanan --</option>
                                        <!-- <option value="">Package</option> -->
                                        <option value="tarif_normal">Reguler</option>
                                        <option value="tarif_urgent">Urgent</option>
                                        <option value="tarif_ons">ONS</option>
                                        <!-- <option value="">Same Day Service</option> -->
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Kota Tujuan</label>
                                    <select id="kota_tujuan" name="kota_tujuan" class="selectpicker form-control" onchange="checktarif()" data-live-search="true">
                                        <option value="">-- Pilih Kota --</option>
                                        @foreach($kota_tujuan as $tampil)
                                        <option {{($tampil->tarif_id === 139) ? 'selected' : ''}} value="{{$tampil->tarif_id}}">{{$tampil->kota_tujuan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tgl Kirim</label>
                                    <input id="tgl_kirim" name="tgl_pbm" class="form-control datetimepicker" onchange="checktarif()" value="{{date('Y-m-d H:i:s')}}" >
                                </div>
                                <div class="form-group mb-4">
                                    <label><i>Lead Time</i></label>
                                    <input id="lead_time" name="tgl_lead_time" class="form-control datetimepicker" type="text" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nama Ekspedisi</label>
                                    <input name="tgl_pbm" class="form-control" value="" >
                                </div>
                                <div class="form-group mb-4">
                                    <label>PIC Pengirim</label>
                                    <input name="tgl_pbm" class="form-control" value="MCM BNI - Marketing Comunication" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>PIC Tujuan</label>
                                    <input name="tgl_pbm" class="form-control" value="">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Jumlah Koli (<i>Packaging</i>)</label>
                                    <input name="tgl_pbm" class="form-control" type="number" value="">
                                </div>
                                 <div class="form-group mb-4">
                                    <label>Jalur Ekspedisi</label>
                                    <select id="opsi" name="data[1][barang_id]" class="form-control selectpicker" data-live-search="true" required>
                                         <option value="1">Udara</option>
                                         <option value="2">Darat</option>
                                         <option value="3">Kereta</option>
                                     </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Berat Nyata (<i>Real</i> [Kg])</label>
                                    <input name="tgl_pbm" class="form-control" type="number" value="">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Berat Volume (<i>PxLxT</i> [Kg])</label>
                                    <input name="tgl_pbm" class="form-control" type="number" value="">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Harga/Kg</label>
                                    <input name="tgl_pbm" class="form-control" type="number" value="" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Total Berat (<i>Real</i> [Kg])</label>
                                    <input name="tgl_pbm" class="form-control" type="number" value="" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Total Harga</label>
                                    <input name="tgl_pbm" class="form-control" type="number" value="" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Catatan</label>
                                    <textarea name="keterangan" class="form-control"  rows="3"></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label>List Barang</label><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="text-center align-middle">
                                                            <div id="add_item" class="btn btn-success btn-sm rounded-circle">+</div>
                                                        </th> -->
                                                        <th>No</th>
                                                        <th class="text-center align-middle">Barang</th>
                                                        <th class="text-center align-middle">Supplier</th>
                                                        <th class="text-center align-middle">Jumlah Barang</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemlist">
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <select id="opsi" name="data[1][barang_id]" class="form-control selectpicker" data-live-search="true" required disabled>
                                                                <option value="">Baju Polos BNI [PNE 001]</option>
                                                                <!-- <option value="">-- Pilih Barang --</option>
                                                            @foreach($data_bar as $tampil)
                                                                <option class="pilihan" value="{{$tampil->barang_id}}">{{$tampil->nama_barang}} [{{$tampil->kode_sku}} - {{$tampil->SKU}}]</option>
                                                            @endforeach -->
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="opsi2" name="data[1][supplier_id]" class="form-control selectpicker" data-live-search="true" required disabled>
                                                                <!--<option value="">-- Pilih Supplier --</option>-->
                                                            @foreach($data_sup as $tampil)
                                                                <option class="pilihan2" value="{{$tampil->supplier_id}}">{{$tampil->nama_supplier}}</option>
                                                            @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="text" name="siswa" data-cell="G1" data-format="0,0" data-formula="50-A1" class="form-control" readonly></td>
                                                    </tr>
                                                    <tr id="total">
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total Barang :</td>
                                                        <td><input type="text" name="total" data-cell="G2" data-format="0,0" data-formula="G1" class="form-control" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> 
                                </div>
                                <input id="max_array" type="hidden" name="max_indeks_array" value="1">
                                <input id="status" type="hidden" name="status" value="0">
                                <button style="display:none;" id="button_simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</button>
                                <a id="simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</a>
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listpbksps3')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Permohonan Barang Keluar - Pengiriman Barang </h4>
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

        $('.datetimepicker').datetimepicker({
            format:'Y-m-d H:i:s',
            timepicker:true,
            minDate: 0,
            enabledHours: [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
            stepping: 30
        });

        function checktarif() {
            $pelayanan = $('#pelayanan').val();
            $kota_tujuan = $('#kota_tujuan').val();
            var date = new Date($('#tgl_kirim').val());
            date.setDate(date.getDate() + 3);
            
            var year    = '' + date.getFullYear();
            var month   = '' + (date.getMonth() + 1);
            var day     = '' + date.getDate();
            if (month.length < 2) {
                month = '0' + month;
            }
            if (day.length < 2) {
                day = '0' + day;
            }

            var lead_time = year + '-' + month + '-' + day;

            $('#lead_time').val(lead_time);
        }
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
                        <td>\
                            <div class="btn btn-danger btn-sm rounded-circle btn-remove">-</div>\
                        </td>\
                            <td>\
                                <select id="listbarang-'+i+'" name="data['+i+'][barang_id]" class="form-control selectpicker" data-live-search="true" required>\
                                </select>\
                            </td>\
                            <td>\
                                <select id="listsupplier-'+i+'" name="data['+i+'][supplier_id]" class="form-control selectpicker" data-live-search="true" required>\
                                </select>\
                            </td>\
                            <td><input class="form-control" name="data['+i+'][kuantitas]" type="number" placeholder="Cth : 100" data-cell="A'+i+'" data-format="0,0" required></td>\
                      </tr>\
        ');

        $('#opsi > option').clone().appendTo('#listbarang-'+i);
        $('#listbarang-'+i).selectpicker('refresh');

        $('#opsi2 > option').clone().appendTo('#listsupplier-'+i);
        $('#listsupplier-'+i).selectpicker('refresh');

        $form.calx('update');
        $form.calx('getCell', 'G1').setFormula('SUM(A1:A'+i+')');

        $("#max_array").val($counter);  
    });

    $('#simpan').on('click', function () {
        swal({
            title: 'Yakin data PBK sudah benar?',
            text: 'PBK akan diproses oleh pihak SPS',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $("#status").val('1');  
                $('#button_simpan').click();
            }
        })
    })

    $('#draf').click(function() {
        $("#status").val('0');  
        $('#dynamic').submit();
    });

    $('#itemlist').on('click', '.btn-remove', function(){
        $(this).parent().parent().remove();
        $form.calx('update');
        $form.calx('getCell', 'G1').calculate();
    });

    </script>
@endsection 
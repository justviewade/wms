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
                <li class="breadcrumb-item"><a href="{{url('listpbk')}}">Pengeluaran Barang</a></li>
                <li class="breadcrumb-item active"><a href="{{url('listpbk')}}">Ubah Permohonan Barang Keluar - PBK - {{$data_pbm->kode_trx_pbk}} </a></li>
            </ol>
            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Ubah Permohonan Barang Keluar</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form  id="dynamic" action="{{ url('updatepbk')}}" method="POST" autocomplete="off">
                                @csrf
                                <input type="hidden" name="trx_id" value="{{$data_pbk->trx_pbk_id}}">
                                <div class="form-group mb-4">
                                    <label>Kode PBK : </label>
                                    <input name="kode_pbk" class="form-control" value="{{$data_pbk->kode_pbk}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tgl Pembuatan Form</label>
                                    <input name="tgl_pbk" class="form-control" value="{{$data_pbk->tgl_pbk}}" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Tgl dan Waktu Pengeluaran Barang</label>
                                    <input id="datetimepicker" name="tgl_pbk_masuk" type="text" class="form-control" value="{{$data_pbk->tgl_pbk_masuk}}" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nama Pemesan</label>
                                    <input name="nama_pemesan" class="form-control" value="{{$data_pbk->nama_pemesan}}" required> 
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nama Tujuan</label>
                                    <input name="nama_tujuan" class="form-control" value="{{$data_pbk->nama_tujuan}}" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control">{{$data_pbk->alamat_tujuan}}</textarea required>
                                </div>
                                  <div class="form-group mb-4">
                                    <label>Kota Tujuan</label>
                                    <select id="kota_tujuan" name="kota_tujuan" class="selectpicker form-control" data-live-search="true" onchange="tarifCek()" required>
                                        @foreach($data_kota as $tampil)
                                        <option {{($data_pbk->kota_id==$tampil->kota_id) ? 'selected' : ''}} value="{{$tampil->kota_id}}">{{$tampil->kota_tujuan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Pelayanan</label>
                                    <select id="jenis_layanan" name="jenis_layanan" class="form-control selectpicker" data-live-search="true" onchange="tarifCek()" required> 
                                        @foreach ($data_layanan as $tampil)
                                            <option {{($data_pbk->layanan_id==$tampil->layanan_id) ? 'selected' : ''}} value="{{ $tampil->layanan_id }}">{{ $tampil->nama_layanan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Perkiraan Harga (Rp)- Minimal Berat 10Kg</label>
                                    <input name="tarif_harga" id="tarif_harga" class="form-control" value="{{$data_pbk->tarif_harga}}" readonly required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Lead Time</label>
                                    <input name="lead_time" id="lead_time" class="form-control" value="{{$data_pbk->lead_time}}" readonly required>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nama Program</label>
                                    <input name="nama_program" class="form-control" value="{{$data_pbk->nama_program}}">
                                </div>
                                <div class="form-group mb-4">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control">{{$data_pbk->keterangan}}</textarea required>
                                </div>
                               
                                <div class="form-group mb-4">
                                    <label>List Barang</label><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-4">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">
                                                            <div id="add_item" class="btn btn-success btn-sm rounded-circle">+</div>
                                                        </th>
                                                        <th class="text-center align-middle">Barang</th>
                                                        <th class="text-center align-middle">QTY</th>
                                                        <th class="text-center align-middle">Stock Gudang</th>
                                                        <th class="text-center align-middle">Perkiraan Sisa Barang</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="itemlist">
                                                    @foreach($data_pbm_detail as $tampil_utama)
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <select id="listbarang-1" name="data[{{$loop->iteration}}][barang_id]" class="form-control selectpicker opsi-bawaan" data-live-search="true" onchange="cekGudang($loop->iteration)" required>
                                                                    @foreach($data_bar as $tampil)
                                                                        <option class="pilihan" {{($tampil_utama->barang_id==$tampil->barang_id) ? 'selected' : ''}} value="{{$tampil->barang_id}}">{{$tampil->nama_barang}} [{{$tampil->kode_sku}} - {{$tampil->SKU}}]</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td><input class="form-control" name="data[{{$loop->iteration}}][qty]" type="number" value="{{$tampil->qty}}" data-cell="A{{$loop->iteration}}" data-format="0,0" required readonly></td>
                                                            <td><input class="form-control cekqty" name="data[{{$loop->iteration}}][stock]" type="number" value="" placeholder="Cek Stok ..." data-cell="B{{$loop->iteration}}" data-format="0,0" required readonly></td>
                                                            <td><input class="form-control" name="data[{{$loop->iteration}}][perkiraan]" type="number" data-cell="C{{$loop->iteration}}" data-format="0,0" data-formula="SUM(B{{$loop->iteration}}-A{{$loop->iteration}})"  readonly></td>
                                                        </tr>
                                                        <tr id="total">
                                                            <td></td>
                                                            <td>Jumlah Pengeluaran :</td>
                                                            <td><input type="text" name="total" data-cell="G1" data-format="0,0" data-formula="SUM(A{{$loop->iteration}}:A{{$loop->iteration}})" class="form-control" readonly></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align:center;" class="text-warning"><b>Perhatikan semua data yang akan dimasukan, pastikan data benar.</b></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> 
                                </div>
                                <input id="max_array" type="hidden" name="max_indeks_array" value="1">
                                <input id="status" type="hidden" name="status" value="0">
                                <button style="display:none;" id="button_simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</button>
                                <a id="simpan" type="submit" class="mt-4 mb-4 btn btn-primary">Simpan</a>
                                <a id="draf" type="submit" class="mt-4 mb-4 btn btn-secondary">Draf</a>
                                <a class="mt-4 mb-4 btn btn-primary" href="{{ url('listpbm')}}">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="form_grid_layouts" class="col-lg-12">
                    <div class="seperator-header">
                        <h4 class="">Ubah Permohonan Barang Keluar</h4>
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
        $( document ).ready(function() {
            $('.cekqty').each() {

            }

            $('.opsi-bawaan').selectpicker('refresh');
        });

      
    </script>
    <script>
        function tarifCek() {
            $('#kota_tujuan option[value=""]').remove();
            $('#kota_tujuan').selectpicker('refresh');
            $('#jenis_layanan option[value=""]').remove();
            $('#jenis_layanan').prop('disabled',false);
            $('#jenis_layanan').selectpicker('refresh');

            var information = {
                kota_id: $('#kota_tujuan').val() || 0,
                layanan_id : $('#jenis_layanan').val() || 0
            };

            var saveData = $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('cektarif')}}",
                data: information,
                dataType: "json",
                success: function(data) {
                    if (data.tarif == null && data.leadtime == null) {
                        $('#tarif_harga').val('Layanan Tidak Tersedia');
                        $('#lead_time').val('Layanan Tidak Tersedia');
                    } else {
                        $('#tarif_harga').val(data.tarif);
                        $('#lead_time').val(data.leadtime);
                    }
                }
            });
        }
    </script>
    <script>
        //$("#date4").inputmask("9999"); ->Usang tidak terpakai
        $('#money').mask("000,000,000,000,000", {reverse: true});
        $('#datetimepicker').datetimepicker({
            format:'Y-m-d H:i:s',
            timepicker:true,
            minDate: 0,
            enabledHours: [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
            stepping: 30
        });
        $('#opsi').on('change',function(){
            $('#yahoo').val("122")
        });
    </script>
    <script>
    // Calx 2 Dynamic
    $form       = $('#dynamic').calx();
    $itemlist   = $('#itemlist');
    $total      = $('#total');
    $counter    = {{$data_pbm_detail->count()}};

    $('#add_item').click(function(e){
        e.preventDefault();
        var i = ++$counter;
        $total.before('<tr>\
                            <td>\
                                <div class="btn btn-danger btn-sm rounded-circle btn-remove">-</div>\
                            </td>\
                            <td>\
                                <select id="listbarang-'+i+'" name="data['+i+'][barang_id]" class="form-control selectpicker" data-live-search="true" onchange="cekGudang('+i+')" required>\
                                </select>\
                            </td>\
                            <td><input class="form-control" name="data['+i+'][qty]" type="number" placeholder="- Pilih Barang -" data-cell="A'+i+'" data-format="0,0" required readonly></td>\
                            <td><input class="form-control" name="data['+i+'][stock]" type="number" placeholder="- Pilih Barang -" data-cell="B'+i+'" data-format="0,0" required readonly></td>\
                            <td><input class="form-control" name="data['+i+'][perkiraan]" type="number" data-cell="C'+i+'" data-format="0,0" data-formula="SUM(B'+i+'-A'+i+')"  readonly></td>\
                        </tr>\
        ');

        $('#listbarang-1 > option').clone().appendTo('#listbarang-'+i);
        $('#listbarang-'+i).selectpicker('refresh');

        $form.calx('update');
        $form.calx('getCell', 'G1').setFormula('SUM(A1:A'+i+')');

        $("#max_array").val($counter);  
    });
    
    function cekGudang(a) {
        barang_id = $('select[id=listbarang-'+a+']').val();
        // barang_id = $(a).val();
        information = {barang_id:barang_id};
        var saveData = $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('cekstok')}}",
            data: information,
            dataType: "json",
            success: function(data) {
                $('input[name="data['+a+'][stock]"]').val(data[0].aktual);
                $('input[name="data['+a+'][qty]"]').prop('readonly',false);
                $('input[name="data['+a+'][qty]"]').val(0);
                $form.calx('update');
                // $("input[name='data[]']").
                // $('#lead_time').val('Layanan Tidak Tersedia');
            }
        });

        // $('#artist').change(function(){
        //     $.ajax({
        //         url: "artist_field.php",
        //         dataType:"html",
        //         type: "post",
        //         success: function(data){
        //         $('#artist').append(data);
        //         }
        //     });
        // });
        };

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
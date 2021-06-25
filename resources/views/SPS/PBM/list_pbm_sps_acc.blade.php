@extends('template')
@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <br>
        <div>
            <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
                <li class="breadcrumb-item">{{Session::get('nama_peran')}}</li>
                <li class="breadcrumb-item">Proses PBM</li>
                <li class="breadcrumb-item active"><a href="{{url('listpbmspsacc')}}">List Persetujuan PBM</a></li>
            </ol>
        </div>
        <br>
        <div class="row" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="widget-header">
                        <div class="row">
                            <span class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h5 style="color:grey;"><strong>Persetujuan Permohonan Barang Masuk</strong></h5>
                            </span>                      
                        </div>
                    </div>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="alter_pagination" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode PBM</th>
                                    <th>Tgl Barang Masuk</th>
                                    <th>List Barang</th>
                                    <th>List Supplier</th>
                                    <th>Kuantitas</th>
                                    <th>Pelanggan</th>
                                    <th>Status</th>
                                    <th class="text-center">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_list_pbm_acc as $tampil)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tampil->kode_trx_pbm}}</td>
                                    <td>{{$tampil->tgl_pbm_masuk}}</td>
                                    <td>{{$tampil->barang}}</td>
                                    <td>{{$tampil->supplier}}</td>
                                    <td>{{$tampil->total_qty}}</td>
                                    <td>{{$tampil->nama_pelanggan}}</td>
                                    <td>
                                        <span class="badge badge-info">Menuggu Proses Konfirmasi</span>
                                    </td>
                                    <td><button onclick="actionbtn('{{$tampil->kode_trx_pbm}}',{{$tampil->id_utama}},'{{$tampil->nama_pelanggan}}','{{$tampil->tgl_pbm_masuk}}')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#actionModal">Proses</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode PBM</th>
                                    <th>Tgl Barang Masuk</th>
                                    <th>List Barang</th>
                                    <th>List Supplier</th>
                                    <th>Kuantitas</th>
                                    <th>Pelanggan</th>
                                    <th>Status</th>
                                    <th class="text-center">Pilihan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal content-->
<div id="actionModal" class="modal animated fadeInLeft custo-fadeInLeft" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="judul-modal" class="modal-title">PBM - ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="actionForm" action="" method="post">
                    @csrf
                    <input type="hidden" id="modal-trx_pbm_id" name="trx_pbm_id" value="">
                    <input type="hidden" id="modal-kode_pbm" name="kode_pbm" value="">
                    <!-- <br> -->
                    <table border="0px">
                        <tr>
                            <td>
                                <label style="font-size:12px;">Nama Pelanggan</label>
                            </td>
                            <td><label style="font-size:12px;">:</label></td>
                            <td>
                                <label id="info1" style="font-size:12px;"></label>
                            </td>
                        </tr>
                        <tr>  
                            <td>
                                <label style="font-size:12px;">Tgl & Waktu PBM</label>
                            </td>
                            <td><label style="font-size:12px;">:</label></td>
                            <td>
                                <label id="info2" style="font-size:12px;"></label>
                            </td>
                        </tr>
                    </table>
                    <!-- <br> -->
                    <!-- <p style="color:grey;"><strong>List Barang</strong></p> -->
                    <div class="table-responsive">
                        <table id="tabel_informasi" class="table table-bordered table-hover table-striped mb-4" style="display:none;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Supplier</th>
                                    <th>QTY</th>
                                </tr>
                            </thead>
                            <tbody id="row_barang">

                            </tbody>
                        </table> 
                    </div>
                    <div class="form-group">
                        <label for="status">Jawaban </label>
                        <select name="jawaban" class="form-control" required>
                            <option value="">-- Pilih Jawaban --</option>
                            <option value="1">Terima</option>
                            <!-- <option value="2">Tolak</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Catatan</label>
                        <textarea name="catatan" cols="30" rows="2" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer md-button">
            <button type="button" onclick="event.preventDefault(); document.getElementById('actionForm').submit();" class="btn btn-primary">Simpan</button>
            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal content-->

<!--  END CONTENT AREA  -->
@endsection

@section('scripttop')
<link rel="stylesheet" type="text/css" href="{{asset ('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('plugins/table/datatable/dt-global_style.css')}}">

<link href="{{asset ('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset ('plugins/sweetalerts/promise-polyfill.js')}}"></script>
<link href="{{asset ('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset ('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset ('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset ('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
<link href="{{asset ('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
<style>
    #row_barang td {
        font-size: 12px !important;
    }
</style>
@endsection

@section('scriptbuttom')
 <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
 <script src="{{asset ('plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#alter_pagination').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Cari ...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );

        function actionbtn(judul,id,nama_pelanggan,tgl_pbm_masuk) {

            $('#row_barang').empty();
            jQuery.ajax({
                url : 'mintainfopbm/'+id,
                type : "GET",
                dataType : "json",
                success:function(data) {
                        jQuery.each(data, function(key,value){
                                $key = key++;
                                $('#row_barang').append('<tr><td>'+key+'</td><td>'+value.nama_barang+' ['+value.kode_sku+' - '+value.SKU +']</td><td>'+value.nama_supplier+'</td><td>'+value.qty+'</td></tr>');
                        });
                }
             });
            $('#info1').text(nama_pelanggan);
            $('#info2').text(tgl_pbm_masuk);
            $('#tabel_informasi').css('display','block');
            $('#judul-modal').text('PBM - '+judul);
            $('#modal-trx_pbm_id').val(id);
            $('#modal-kode_pbm').val(judul);
            $('#actionForm').attr('action', '{{ url("updatepbmspsacc") }}');
        
         }
    </script>

    <script src="{{asset ('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset ('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <script src="{{asset ('assets/js/list-custom.js')}}"></script>
     <script src="{{asset ('assets/js/scrollspyNav.js')}}"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>

    <script>
    @if($pesan = Session::get('pesan'))
        swal({
            title: 'Informasi',
            text: '{{$pesan}}',
            timer: 3000,
            padding: '2em',
            onOpen: function () {
                swal.showLoading()
            }
        })
    @endif
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
@endsection
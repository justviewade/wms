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
                <li class="breadcrumb-item">Akun</li>
                <li class="breadcrumb-item active"><a href="{{url('listgudang')}}">Manajemen Akun</a></li>
            </ol>
        </div>
        <br>
        <div class="row" id="cancel-row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="widget-header">
                        <div class="row">
                            <span class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h5 style="color:grey;"><strong>Manajemen Akun</strong></h5>
                            </span>       
                            <span class="col-xl-6 col-md-6 col-sm-6 col-6" style="text-align:right;">
                                <button class="btn btn-primary" onclick="window.location.href='{{ url('formakun')}}'">Daftar Akun Baru</button>
                            </span>                   
                        </div>
                    </div>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="alter_pagination" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Peran</th>
                                    <th>Group Pelanggan</th>
                                    <th class="text-center">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_user as $tampil)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tampil->username}}</td>
                                    <td>{{$tampil->nama}}</td> 
                                    <td>{{$tampil->nama_peran}}</td>
                                    <td>{{$tampil->nama_pelanggan}}</td>
                                    <td class="text-center">
                                        <a href="{{url ('viewuser/'.$tampil->user_id)}}" data-toggle="tooltip" data-placement="top" title="Lihat"><svg color="#1B55E2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                        <a href="{{url ('editakun/'.$tampil->user_id)}}" data-toggle="tooltip" data-placement="top" title="Ubah"><svg color="#1B55E2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    @if($tampil->peran_id <> 1)
                                        <a class="hapus" data-toggle="tooltip" data-placement="top" hapus_id="{{$tampil->user_id}}" hapus_nama="{{$tampil->nama}}" title="Hapus"><svg color="#1B55E2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                        <form action="{{url ('deleteakun/'.$tampil->user_id)}}" id="hapus-{{$tampil->user_id}}" method="POST" >
                                            @method('delete')
                                            @csrf
                                        </form>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Peran</th>
                                    <th>Group Pelanggan</th>
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
    </script>

    <script src="{{asset ('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset ('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <script src="{{asset ('assets/js/list-custom.js')}}"></script>

    <script>
    @if($pesan = Session::get('pesan'))
        swal({
            title: 'Informasi',
            text: '{{$pesan}}',
            timer: 2500,
            padding: '2em',
            onOpen: function () {
                swal.showLoading()
            }
        })
    @endif
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
@endsection
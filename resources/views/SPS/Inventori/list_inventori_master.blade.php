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
                    <li class="breadcrumb-item">{{Session::get('nama_peran')}}</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item active"><a href="{{url('intentorimaster')}}">Inventori</a></li>
                </ol>
            </div>
            <br>    
                <div class="row" id="cancel-row">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                        <div class="widget-header">
                            <div class="row">
                                <span class="col-xl-6 col-md-6 col-sm-6 col-6">
                                    <h5 style="color:grey;"><strong>Inventori Barang</strong></h5>
                                </span>                 
                            </div>
                        </div>
                        <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist" style="height=51px;">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Profile <svg> ... </svg></a>
                                <   div class="dropdown-menu">
                                    <a class="dropdown-item" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Action</a>
                                    <a class="dropdown-item"  id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Another action</a>
                                </div>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Testing</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="simpletabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row" id="cancel-row">
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <div class="widget-content widget-content-area br-6">
                                            <div class="table-responsive mb-4 mt-4">
                                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Barang</th>
                                                            <th>SKU</th>
                                                            <th>Harga Satuan</th>
                                                            <th>Tahun</th>
                                                            <th>Foto</th>
                                                            <th>Kuantitas Gudang</th>
                                                            <th>Kartu Barang</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td>61</td>
                                                            <td>2011/04/25</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="usr-img-frame mr-2 rounded-circle">
                                                                        <img alt="avatar" class="img-fluid rounded-circle" src="assets/img/90x90.jpg">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                                    <a class="dropdown-item" href="#">Action</a>
                                                                    <a class="dropdown-item" href="#">Another action</a>
                                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="media">
                                    <img class="mr-3" src="assets/img/90x90.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                <p class="">
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p class="">
                                    Dalam Pengembangan
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
<!--  END CONTENT AREA  -->
@endsection

@section('scripttop')
<link rel="stylesheet" type="text/css" href="{{asset ('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('plugins/table/datatable/custom_dt_html5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset ('plugins/table/datatable/dt-global_style.css')}}">

<link href="{{asset ('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset ('plugins/sweetalerts/promise-polyfill.js')}}"></script>
<link href="{{asset ('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset ('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset ('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset ('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset ('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('scriptbuttom')
 <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{asset ('plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset ('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset ('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>    
    <script src="{{asset ('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset ('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
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
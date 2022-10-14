@extends('master')
@section('title')
    Tenants
@endsection

@section('custom_link_css')
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: linen">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tenants</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('index')}}">Beranda</a></li>
              <li class="breadcrumb-item active">Tenants</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="#" title="Add" class="btn btn-primary col-2 btn-add-tenant"><i class="fa solid fa-plus"></i></a>
                  {{-- <a href="#" title="Add" class="btn btn-success col-2 btn-import-tenant"><i class="fa solid fa-file-import"></i></a> --}}
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('failure'))
                    <div class="alert alert-danger mt-2">
                        {{ session()->get('failure') }}
                    </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="table">
                    <thead>
                      <tr>
                        <th>Kode Tenant</th>
                        <th>Nama Tenant</th>
                        <th>Barcode</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tenants as $tenant)
                            <tr>
                                <td>{{$tenant->tr_id}}</td>
                                <td>{{$tenant->tr_name}}</td>
                                <td>{{$tenant->tr_code}}</td>
                                <td>
                                  <a href="#" tenant-id="{{$tenant->tr_id}}" title="" class="btn btn-warning btn-edit-tenant"><i class="fas fa-edit"></i></a>
                                  <a href="#" tenant-id="{{$tenant->tr_id}}" data-tenant="{{$tenant->tr_name}}" title="" class="btn btn-danger btn-delete-tenant"><i class="fas fa-trash"></i></a>
                                  
                                  </td>
                            </tr>
                            @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

{{-- <div class="modal fade in" id="modal-import-tenant" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('tenant.upload')}}" method="post" accept-charset="utf-8" id="form-import" enctype="multipart/form-data">
        @csrf
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Import Data tenant</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <p><font color="red">* Format file harus .xlsx atau .xls</font></p>
          <a class="btn btn-sm btn-info" href="{{asset('/assets/template/pic_template.xlsx')}}">Download Template</a><br><br>
          <label for="name">Pilih File</label>
          <input type="file" name="file" class="name" id="name" accept=".xlsx, .xls" required >
          <span id="errorName" class="text-red"></span>
        </div>
      </div>

        <div class="modal-footer">
          <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
        </form>
      </div>
    </div>
</div> --}}

<!-- The Modal -->
<div class="modal fade in" id="modalCreatetenant" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post" accept-charset="utf-8" id="form-signup">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Buat tenant Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <label for="tr_id">Kode Tenant</label>
            <input type="text" name="tr_id" id="tr_id" class="form-control"required>
            <span id="errorKode" class="text-red"></span>
          </div>
        <div class="form-group">
          <label for="tr_name">Nama Tenant</label>
          <input type="text" name="tr_name" id="tr_name" class="form-control" required>
          <span id="errortr_name" class="text-red"></span>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal fade in" id="modalEdittenant" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="javascript:void(0)" method="post" accept-charset="utf-8" id="form-edit">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah tenant</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id" class="form-control">
      <!-- Modal body -->  
      <div class="modal-body">
        <div class="form-group">
            <label for="tr_id">Kode</label>
            <input type="text" name="tr_id" id="tr_id_update" class="form-control" required>
            <span id="errorKode" class="text-red"></span>
          </div>
        <div class="form-group">
          <label for="tr_name">Nama Depan</label>
          <input type="text" name="tr_name" id="tr_name_update" class="form-control" required>
          <span id="errortr_name" class="text-red"></span>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal fade in" id="modalDeletetenant" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post" accept-charset="utf-8" id="form-delete">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Hapus tenant</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="id" id="id_delete" class="form-control">

      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data <span></span> ini ?</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('custom_script_js')
<!-- DataTables  & Plugins -->
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        // $('.btn-import-tenant').click(function(){
        //     $('#modal-import-tenant').modal('show');
        //   });

        //   $('#submit').click(function(){
        //     $('#modal-import-tenant').modal('hide');
        //               $('#loader').modal ('show');
        //             });

        $('.btn-add-tenant').click(function(){
            $('#modalCreatetenant').modal('show');

            $('#form-signup').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreatetenant');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('tenant.create')}}",
                    type:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success create');
                        location.reload();
                    },
                    error:function(response){
                        // $('#errorKode').text(response.responseJSON.errors.tr_id);
                        // $('#errortr_name').text(response.responseJSON.errors.tr_name);

                        modal_id.find('.modal-footer button').prop('disabled',false);
                        modal_id.find('.modal-header button').prop('disabled',false);
                    }
                })
            })
        })


        jQuery("body").on("click", ".btn-edit-tenant", function(e) {
            $('#modalEdittenant').modal('show');
            var tenantID = $(this).attr('tenant-id');
            // var id = $('#id').val(tenantID);
                $.ajax({
                    url:"{{route('tenant.edit')}}",
                    type:'POST',
                    data:{
                      tr_id:tenantID,
                    },
                    success:function(data){
                        console.log('success edit');
                        $('#tr_id_update').val(data.tr_id);
                        $('#tr_name_update').val(data.tr_name);
                    },
                    error:function(response){
                        // $('#errorKode').text(response.responseJSON.errors.tr_id);
                        // $('#errortr_name').text(response.responseJSON.errors.tr_name);
                    }
                    
                })

                $('#form-edit').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalEdittenant');
                var formData = new FormData(this);
                $.ajax({
                    url:"{{route('tenant.update')}}",
                    type:'POST',
                    data:formData,
                    data:{
                      id:tenantID,
                      tr_name:$('#tr_name_update').val(),
                      tr_id:$('#tr_id_update').val(),
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success update');
                        location.reload();
                    },
                    error:function(response){
                        $('#errorKode').text(response.responseJSON.errors.tr_id);
                        $('#errortr_name').text(response.responseJSON.errors.tr_name);

                        modal_id.find('.modal-footer button').prop('disabled',false);
                        modal_id.find('.modal-header button').prop('disabled',false);
                    }
                })
            })
        })

          jQuery("body").on("click", ".btn-delete-tenant", function(e) {
          $('#modalDeletetenant').find('.modal-body span').text($(this).data("tenant"));
          $('#modalDeletetenant').modal('show');
          var usrID = $(this).attr('tenant-id');
          var id = $('#id_delete').val(usrID);
          $('#form-delete').submit(function(e){
                e.preventDefault();
                let modal_id = $('#modalCreatetenant');
                $.ajax({
                    url:"{{route('tenant.delete')}}",
                    type:'POST',
                    data:{
                      id:usrID,
                    },
                    beforeSend: function() {
                      modal_id.find('.modal-footer button').prop('disabled',true);
                      modal_id.find('.modal-header button').prop('disabled',true);
                    },
                    success:function(data){
                        console.log('success deleted');
                        location.reload()
                    },
                    error:function(response){
                        console.log('success failed');
                        location.reload()
                    }
                })
            })
        })
    })
</script>
@endsection
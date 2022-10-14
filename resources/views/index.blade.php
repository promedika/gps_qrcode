@extends('master')
@section('title')
    Dashboard
@endsection
@section('content')
<style>
    .select2-container--default .select2-selection--single {
            height: auto;
            padding: 0.375rem 0;
            border: 1px solid #ced4da;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
        }
        .btn-gps {
            width: 100%;
            margin-top: 16px;
            color: #ffffff;
            background-color: #ff8e3c;
        }
        .btn-gps:hover {
            color: #ffffff;
            background-color: #ffa461;
        }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: linen;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Permintaan Label  </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Beranda</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content-wrapper" style="background: linen">
  	<div class="container-fluid">
  		<div class="row">
            <form id="qrForm" target="_blank" action="{{route('qrcode.print')}}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="outlet">Nama Outlet</label>
                    </div>
                    <div class="col-md-8">
                        <select id="inputNama" class="form-control" name="outlet">
                            <option></option> 
                            <?php 
                            foreach ($tenants as $key => $value) {
                                $val = $value['tr_id']."|".$value['tr_code'];
                                $name = $value['tr_name'];
                                echo '<option value="'.$val.'">'.$name.'</option>';
                            }
                            ?>
                        </select>
                        <input type="hidden" class="nama-rs" name="nama"> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="nomor">Kode</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="nomor" id="inputNomor" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="kuantitas">Jumlah</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" value="1" min="1" id="inputKuantitas" name="kuantitas" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="requestby">Nama Pemohon</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="requestby" id="inputrequestby" class="form-control">
                    </div>
                </div>
                <div id="lastHistory" class="form-text mb-3">
                </div>
                <button class="btn btn-gps">
                    Generate
                </button>
            </form>
        </div>
        <!-- /.row -->
  	</div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@section('custom_script_js')
<script>
    $(document).ready(function() {
            $('#inputNama').select2({
                placeholder: 'Search',
                width: '100%'
            });

            $('#inputNama').on('change', function() {
                console.log('test');
                var data = $("#inputNama option:selected").text();
                var txt_val = $(this).val();
                var txt_val = txt_val.split('|');
                var txt_tr_code = txt_val[1];
                $(".nama-rs").val(data);
                $("#inputNomor").val(txt_tr_code)
            });
        });
</script>

@endsection
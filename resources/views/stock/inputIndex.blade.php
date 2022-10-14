@extends('master')
@section('title')
    Input Inventaris
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
          <h1 class="m-0">Input Inventaris</h1>
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
  <section class="content-wrapper" style="background:linen">
        <div class="container-fluid">
            <div class="row">
                <form id="qrForm" target="_blank" action="{{route('stock.input')}}" method="post">
                    @csrf

                    @if(session()->has('message'))
                        <div class="alert alert-danger mt-2">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                                    
                    <div class="row mb-3">
                        <div class="col-md-4 flex-label">
                            <label for="outlet">Nama Barang</label>
                        </div>
                        <div class="col-md-8">
                            <select id="inputNamaBarang" class="form-control" name="stock">
                                <option></option> 
                                <?php 
                                foreach ($inventories as $key => $value) {
                                    $val = $value['id'];
                                    $name = $value['inv_name'];
                                    echo '<option value="'.$val.'">'.$name.'</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" class="nama-stock" name="nama-stock"> 
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
                    <button class="btn btn-gps">
                        Submit
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

            $('#inputNamaBarang').on('change', function() {
                console.log('test');
                var data = $("#inputNamaBarang option:selected").text();
                var txt_val = $(this).val();
                var txt_val = txt_val.split('|');
                var txt_tr_code = txt_val[1];
                $(".nama-stock").val(data);
            });
        });
</script>

@endsection
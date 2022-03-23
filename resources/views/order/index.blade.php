@extends('layouts.admin')

@section('css')
  <style media="screen">
  #table_daily {
    /* overflow-x: auto;
    overflow-y: visible; */
  }

  .select2 {
    width: 100% !important;
  }

  .racikan:hover {
    cursor: not-allowed !important;
  }
  </style>
@endsection

@section('main-content')

  @if (session('message'))
    <div class="alert alert-success" role="alert">
      {{ session('message') }}
    </div>
  @endif
    <!-- Page Heading -->
    <div class="row">
      <div class="col">
        <h1 class="h3 mb-4 text-gray-800">Data Order</h1>
      </div>
      <div class="col">
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-body">
            <form action="{{ route('order.tambah') }}" method="POST">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>NIK</label>
                    <select class="form-control select-pilihan" name="user_id" id="user_id" onchange="getUser();">
                      <option>-</option>
                      @foreach ($user as $users)
                        <option value="{{ $users->id }}">{{ $users->nik }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" readonly>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Departemen</label>
                    <input type="text" name="dept_name" id="dept_name" class="form-control" readonly>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Tanggal Permintaan</label>
                    <input type="date" name="tgl_order" id="tgl_order" class="form-control">
                  </div>
                </div>
              </div>
              <input type="hidden" name="temp_barang" id="temp_barang" value="1">
              <div id="row_barang" style="padding-top: 2px; padding-bottom: 2px;">
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_lihat_barang" name="button_lihat_barang"><i class="fa fa-file" aria-hidden="true"></i> Cek Barang</button>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_barang" name="button_barang"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Barang</button>
                  <button type="button" class="btn btn-danger" name="button_batal" onclick="refreshPage();"><i class="fa fa-times" aria-hidden="true"></i> Batal</button>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-primary float-right" name="button_simpan"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="table_daily">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Order</th>
                    <th scope="col">Nama</th>
                    @if (auth()->user()->level == '1')
                      <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($order as $data)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $data->order_id }}</td>
                      <td>{{ $data->name }}</td>
                      @if (auth()->user()->level == '1')
                        <td>
                          <button data-toggle="modal" data-target="#detail_modal{{ $data->order_id }}" class="btn btn-primary btn-sm" onclick="showDetail('{{ $data->order_id }}')" name="button_detai"><i class="fa fa-book" aria-hidden="true"></i> Detail</button>
                          <button class="btn btn-success btn-sm" onclick="showDetail('{{ $data->order_id }}')" name="button_cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                        </td>
                      @endif
                    </tr>
                    @php
                      $no++;
                    @endphp

                    <div class="modal fade" id="detail_modal{{ $data->order_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="{{route('order.update', $data->order_id)}}" method="get">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              @csrf
                              <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}" readonly>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_lihat_barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <!-- <form action=""> -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              @include('order.barang')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form action=""> -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Barang</label>
                <select class="form-control select-pilihan" name="brg_id" id="brg_id" onchange="getDataBarang();">
                  <option>-</option>
                  @foreach ($barang as $barangs)
                    <option value="{{ $barangs->brg_id }}">{{ $barangs->brg_nama }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="satuan_ket" id="satuan_ket">
                <input type="hidden" name="lokasi_ket" id="lokasi_ket">
              </div>
              <div class="form-group">
                <label>Qty</label>
                <input type="text" name="qty" id="qty" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="addBarang();">Tambahkan</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_edit_barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <form action=""> -->
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Obat</label>
                <select class="form-control select-pilihan" name="barang_edit_id" id="barang_edit_id">
                  <option>-</option>
                  @foreach ($barang as $barangs)
                    <option value="{{ $barangs->brg_id }}">{{ $barangs->brg_nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Qty</label>
                <input type="text" name="qty_edit" id="qty_edit" class="form-control">
                <input type="hidden" name="temp_id" id="temp_id">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="updateBarang();">Ubah</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>

@endsection

@section('js')
  <script type="text/javascript">
  $(document).ready( function () {
    $('#table_daily').DataTable({
      responsive: true,
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });

    $('#table_barang').DataTable({
      responsive: true,
      sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    });

    $('#temp_barang').val(1);
  });

  function refreshPage() {
    window.location.reload();
  }

  function addBarang() {
    var temp_barang = $('#temp_barang').val();
    var the_temp = parseInt(1) + parseInt(temp_barang);
    var konten = "";
    konten += '<div class="form-group row">' +
                '<div class="col-sm-3">' +
                  '<input type="text" class="form-control" id="brg_nama' + the_temp + '" name="brg_nama' + the_temp + '" readonly>' +
                  '<input type="hidden" id="brg_id' + the_temp + '" name="brg_id' + the_temp + '">' +
                '</div>' +
                '<div class="col-sm">' +
                  '<input type="text" class="form-control" id="qty' + the_temp + '" name="qty' + the_temp + '">' +
                '</div>' +
                '<div class="col-sm-2">' +
                  '<input type="text" class="form-control" id="satuan' + the_temp + '" name="satuan' + the_temp + '" readonly>' +
                '</div>' +
                '<div class="col-sm-3">' +
                  '<input type="text" class="form-control" id="lokasi' + the_temp + '" name="lokasi' + the_temp + '" readonly>' +
                '</div>' +
                '<div class="col-sm-3">' +
                  '<div class="float-right">' +
                    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_barang" name="button_edit_barang' + the_temp + '" id="button_edit_barang' + the_temp + '" onclick="editBarang(' + the_temp + ')">Edit</button>' +
                    '<button type="button" class="btn btn-danger" name="button_delete_barang' + the_temp + '" id="button_delete_barang' + the_temp + '" onclick="deleteBarang(' + the_temp + ')">Hapus</button>' +
                  '</div>' +
                '</div>' +
              '</div>';
    $('#temp_barang').val(the_temp);
    $('#row_barang').append(konten);
    $('#brg_nama' + the_temp).val($('#select2-brg_id-container').text());
    $('#brg_id' + the_temp).val($('#brg_id').val());
    $('#qty' + the_temp).val($('#qty').val());
    $('#satuan' + the_temp).val($('#satuan_ket').val());
    $('#lokasi' + the_temp).val($('#lokasi_ket').val());
    $('#select2-brg_id-container').text("");
    $('#select2-brg_id-container').remove('title');
    $('#qty').val("");    
  }

  function editBarang(id) {
    $('#select2-barang_edit_id-container').text($('#brg_nama' + id).val());
    $('#barang_edit_id').val($('#brg_id' + id).val());
    $('#qty_edit').val($('#qty' + id).val());
    $('#temp_id').val(id);
  }

  function updateBarang() {
    var temp_id = $('#temp_id').val();
    $('#brg_nama' + temp_id).removeAttr('value');
    $('#brg_id' + temp_id).removeAttr('value');
    $('#qty' + temp_id).removeAttr('value');    
    $('#brg_nama' + temp_id).val($('#select2-barang_edit_id-container').text());
    $('#brg_id' + temp_id).val($('#barang_edit_id').val());
    $('#qty' + temp_id).val($('#qty_edit').val());
    $('#select2-barang_edit_id-container').text("");
    $('#qty_edit').val("");
  }

  function deleteBarang(id) {
    $('#brg_nama' + id).remove();
    $('#brg_id' + id).remove();
    $('#qty' + id).remove();
    $('#button_edit_barang' + id).remove();
    $('#button_delete_barang' + id).remove();
  }

  function getUser() {
    $('#user_name').val();
    $('#dept_name').val();
    var id = $('#user_id').val();
    $.ajax({
      url: <?php echo json_encode(url('/')); ?> + "/getUserData/" + id,
      type: 'GET',
      dataType: 'JSON',
      success: function(res){
        $('#user_name').val(res[0].name);
        $('#dept_name').val(res[0].dept_name);
      }
    });
  }

  function getDataBarang() {
    $('#satuan_ket').val();
    $('#lokasi_ket').val();
    var id = $('#brg_id').val();
    $.ajax({
      url: <?php echo json_encode(url('/')); ?> + "/getDataBarang/" + id,
      type: 'GET',
      dataType: 'JSON',
      success: function(res){
        $('#satuan_ket').val(res[0].satuan_ket);
        $('#lokasi_ket').val(res[0].lokasi_ket);
      }
    });
  }

  $('.select-pilihan').select2();
  </script>
@endsection

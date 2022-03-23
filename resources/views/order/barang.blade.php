<div class="row justify-content-center">

    <div class="col-lg-12">

        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="table_barang">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($barang as $data)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $data->brg_nama }}</td>
                      <td>{{ $data->brg_stok * 1 }}</td>
                      <td>{{ $data->lokasi_ket }}</td>
                      <td>{{ $data->status_ket }}</td>
                    </tr>
                    @php
                      $no++;
                    @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready( function () {
    // $('#table_barang').DataTable({
    //   responsive: true,
    //   sDom: 'r<"H"lf><"datatable-scroll"t><"F"ip>',
    // });
  });
</script>
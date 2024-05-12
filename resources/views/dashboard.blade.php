@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <div class="row mt-4">
    @foreach ($array_result as $brng)
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card" style="background: green">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-lg-12">
                <div class="d-flex flex-column h-100">
                  <center>
                    <h2 class="font-weight-bolder" style="color: white">{{$brng['jenis_biji_kopi']}}</h2>
                    <h2 class="font-weight-bolder" style="color: white">Stok : {{$brng['stok_barang']}}</h2>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    
  </div>
  <div class="row mt-2">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 mb-2">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Reorder Point</h5>
                    </div>
                </div>
            </div>
            <div class="card-body px-3 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="myDataTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    NO
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kode Barang
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama Barang
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Stok Safety
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Stok
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nilai Reorder Point
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Quantity to Order
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($array_result as $item)
                            <tr>
                                    
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                <td class="text-center">
                                    {{ $item['kode_biji_kopi'] }}
                                </td>
                                <td class="text-center">
                                    {{ $item['jenis_biji_kopi'] }}
                                </td>
                                <td class="text-center">
                                    {{ $item['safety_Stock'] }}
                                </td>
                                <td class="text-center">
                                    {{ $item['stok_barang'] }}
                                </td>
                                <td class="text-center">
                                    {{ $item['reorder_point'] }}
                                </td>
                                <td class="text-center">
                                    {{ $item['quantity_to_order'] }}
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $item['status'] == 'Aman' ? 'bg-success' : 'bg-danger' }}"> {{ $item['status'] }}</span>
                                   
                                </td>
                                
                            </tr>
                        @endforeach

                       

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="row mt-2 mb-5">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header pb-0 mb-2">
          <div class="d-flex flex-row justify-content-between">
              <div>
                  <h5 class="mb-0">Barang Masuk</h5>
              </div>
          </div>
      </div>
        <div class="card-body">
          <div class="table-responsive p-0">
            <table id="myDataTable2" class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            NO
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nama Supplier                                    
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Jenis Biji Kopi
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Qty
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Tanggal
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang_masuk as $item)
                        <tr>
                                
                            <td class="ps-4">
                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                            </td>
                            <td class="text-center">
                                @php
                                    $supplierData = \App\Models\DataSupplier::where('id',$item->id_supplier)->first() ?? '';
                                @endphp
                                {{ $supplierData->nama_supplier ?? '' }}
                            </td>
                          
                            <td class="text-center">
                                @php
                                    $jenis = \App\Models\DataBarang::where('id',$item->id_barang)->first() ?? '';
                                @endphp
                                {{ $jenis->nama_barang ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                            <td class="text-center">
                                {{ $item->tanggal }}
                            </td>
                            <td class="text-center">
                                {{ $item->keterangan }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header pb-0 mb-2">
            <div class="d-flex flex-row justify-content-between">
                <div>
                    <h5 class="mb-0">Barang Keluar</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive p-0">
              <table id="myDataTable3" class="table align-items-center mb-0">
                  <thead>
                      <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              NO
                          </th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Jenis Biji Kopi
                          </th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Qty
                          </th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Tanggal
                          </th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Keterangan
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($barang_keluar as $item)
                      <tr>
                              
                          <td class="ps-4">
                              <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                          </td>
                          <td class="text-center">
                              @php
                                  $jenis = \App\Models\DataBarang::where('id',$item->id_barang)->first() ?? '';
                              @endphp
                              {{ $jenis->nama_barang ?? '' }}
                          </td>
                          <td class="text-center">
                              {{ $item->qty }}
                          </td>
                          <td class="text-center">
                              {{ $item->tanggal }}
                          </td>
                          <td class="text-center">
                              {{ $item->keterangan }}
                          </td>
                      </tr>
                  @endforeach

                

                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>

 


@endsection
@push('dashboard')




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


  <script>


$(document).ready(function () {
        $('#myDataTable').DataTable();
        $('#myDataTable2').DataTable();
        $('#myDataTable3').DataTable();
    });

$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  </script>
@endpush


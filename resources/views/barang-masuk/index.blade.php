@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<div>
 
    @if($errors->any())
        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
            <span class="alert-text text-white">
            {{$errors->first()}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    @if(session('success'))
        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
            <span class="alert-text text-white">
            {{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    @if(session('failed'))
        <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
            <span class="alert-text text-white">
            {{ session('failed') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0 mb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $page_title ?? '' }}</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+&nbsp; New {{ $page_title ?? '' }}</a>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New {{ $page_title ?? '' }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form role="form text-left" method="POST" action="{{ route('tambah-barang-masuk') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Jenis Supplier</label>
                                            <select class="form-control" name="id_supplier" id="id_supplier" required>
                                                <option value="">Pilih Supplier</option>
                                                @foreach ($supplier as $sp)
                                                    <option value="{{ $sp->id }}">{{ $sp->nama_supplier }}</option>
                                                @endforeach
                                            </select>
                                             @error('id_supplier')
                                               <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                             @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Jenis Biji Kopi</label>
                                            <select class="form-control" name="id_barang" id="id_barang" required>
                                                <option value="">Pilih Biji Kopi</option>
                                                @foreach ($biji_kopi as $bj)
                                                    <option value="{{ $bj->id }}">{{ $bj->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                             @error('id_barang')
                                               <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                             @enderror
                                        </div>


                                        <div class="mb-3">
                                        <label for="">Qty</label>
                                            <input type="number" class="form-control" placeholder="Qty" name="qty" id="qty" required>
                                            @error('qty')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                        <label for="">Tanggal</label>
                                            <input type="date" class="form-control" placeholder="tanggal" name="tanggal" id="tanggal" required>
                                            @error('tanggal')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" required id="" cols="30" rows="10"></textarea>
                                             @error('keterangan')
                                               <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                             @enderror
                                        </div>
                                       
                                </div>
                                
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                              </form>
                                </div>
                            </div>
                            </div>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
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
                                    <td class="text-center">
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#modaledit{{ $item->id }}">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="{{ route('delete-barang-masuk',$item->id) }}" type="button" >
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
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
</div>

@foreach ($barang_masuk as $item2)
<div class="modal fade" id="modaledit{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $page_title ?? '' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('update-barang-masuk',$item2->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                    @csrf
                <div class="mb-3">
                    <label for="">Jenis Supplier</label>
                    <select class="form-control" name="id_supplier" id="id_supplier" required>
                        <option value="">Pilih Supplier</option>
                        @foreach ($supplier as $sp)
                            <option value="{{ $sp->id }}" {{ $item2->id_supplier == $sp->id ? 'selected' : '' }}>{{ $sp->nama_supplier }}</option>
                        @endforeach
                    </select>
                    @error('id_supplier')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Jenis Biji Kopi</label>
                    <select class="form-control" name="id_barang" id="id_barang" readonly>
                        <option value="">Pilih Biji Kopi</option>
                        @foreach ($biji_kopi as $bj)
                            <option value="{{ $bj->id }}" {{ $bj->id_barang == $item2->id ? 'selected' : '' }}>{{ $bj->nama_barang }}</option>
                        @endforeach
                    </select>
                    @error('id_barang')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-3">
                <label for="">Qty</label>
                    <input type="number" class="form-control" placeholder="Qty" value="{{ $item2->qty }}" name="qty" id="qty" readonly>
                    @error('qty')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                <label for="">Tanggal</label>
                    <input type="date" class="form-control" placeholder="tanggal" value="{{ $item2->tanggal }}" name="tanggal" id="tanggal" required>
                    @error('tanggal')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" class="form-control" required id="" cols="30" rows="10">{{ $item2->keterangan }}</textarea>
                     @error('keterangan')
                       <p class="text-danger text-xs mt-2">{{ $message }}</p>
                     @enderror
                </div>
            </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        </div>
    </div>
    </div>
</div>
@endforeach

 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myDataTable').DataTable();
    });
</script>

@endsection
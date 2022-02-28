@extends('layout.v_template')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Riwayat Beli</h3>
             <div class="container">
                @if (count($errors) > 0)
            <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
            </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
                </div>
            @endif
            </div>
            </div>
                <div class="text-center">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah">Tambah Data</a>
                <a href="/riwayatbeli/printer_riwayatbeli" target="_blank" class="btn btn-sm bg-maroon">Print To Printer</a>
                <a href="/riwayatbeli/printpdf_riwayatbeli" target="_blank" class="btn btn-sm bg-navy">Print To PDF</a>
                </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">Rekening ID</th>
                <th class="text-center">Ikan ID</th>
                <th class="text-center">Jumlah Beli</th>
                <th class="text-center">Kwitansi</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; ?>
                @foreach ($riwayatbeli as $data)
                    <tr>
                        <td class="text-center">{{ $data->rekening_id}}</td>
                        <td class="text-center">{{ $data->ikan_id}}</td>
                        <td class="text-center">{{ $data->jumlah_beli}}</td>
                        <td class="text-center">{{ $data->kwitansi}}</td>
                        <td class="text-center">{{ $data->created_at}}</td>
                        <td class="text-center">{{ $data->updated_at}}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#detail{{ $data->id}}">Detail</a>
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{ $data->id}}">Edit</a>
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                 <div class="modal fade" id="tambah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title">TAMBAH DATA</h5>
                        </div>
                        <form action="/riwayatbeli/insert_riwayatbeli" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Rekening ID</label>
                                <input name="rekening_id" class="form-control" value="{{old('rekening_id')}}">
                                <div class="text-danger">
                                    @error('rekening_id')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ikan ID</label>
                                <input name="ikan_id" class="form-control" value="{{old('ikan_id')}}">
                                <div class="text-danger">
                                    @error('ikan_id')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group">
                                <label>Jumlah Beli</label>
                                <input name="jumlah_beli" class="form-control" value="{{old('jumlah_beli')}}">
                                <div class="text-danger">
                                    @error('jumlah_beli')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                                    <div class="form-group">
                                <label>Kwitansi</label>
                                <input name="kwitansi" class="form-control" value="{{old('kwitansi')}}">
                                <div class="text-danger">
                                    @error('kwitansi')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                @foreach ($riwayatbeli as $data)
                  <div class="modal fade" id="edit{{ $data->id}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title">EDIT DATA {{ $data->id}}</h5>
                        </div>
                        <form action="/riwayatbeli/update_riwayatbeli" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Rekening ID</label>
                                    <input name="rekening_id" class="form-control" value="{{$data->rekening_id}}">
                                    <div class="text-danger">
                                        @error('rekening_id')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ikan ID</label>
                                    <input name="ikan_id" class="form-control" value="{{$data->ikan_id}}">
                                    <div class="text-danger">
                                        @error('ikan_id')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Beli </label>
                                    <input name="jumlah_beli" class="form-control" value="{{$data->jumlah_beli}}">
                                    <div class="text-danger">
                                        @error('jumlah_beli')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kwitansi</label>
                                    <input name="kwitansi" class="form-control" value="{{$data->kwitansi }}">
                                    <div class="text-danger">
                                        @error('kwitansi')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Save Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach

                @foreach ($riwayatbeli as $data)
                  <div class="modal modal-success fade" id="detail{{ $data->id}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Detail Data {{ $data->id}}</h4>
                        </div>
                          <div class="modal-body">
                           <p>Rekening ID : {{ $data->rekening_id }}</p>
                           <p>Ikan ID : {{ $data->ikan_id }}</p>
                           <p>Jumlah Beli :{{ $data->jumlah_beli }} </p>
                           <p>Kwitansi : {{ $data->kwitansi}}</p>
                          </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                @foreach ($riwayatbeli as $data)
                  <div class="modal modal-danger fade" id="delete{{ $data->id}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">{{ $data->id}}</h4>
                        </div>
                          <div class="modal-body">
                           <p>Apakah anda yakin ingin menghapus data ini???</p>
                          </div>
                        <div class="modal-footer">
                          <a href="/riwayatbeli/delete_riwayatbeli/{{ $data->id}}" class="btn btn-outline pull-left">Yes</a>
                          <a class="btn btn-outline" data-dismiss="modal">No</a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection

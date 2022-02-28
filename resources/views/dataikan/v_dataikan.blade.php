@extends('layout.v_template')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Ikan</h3>
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
                <a href="/dataikan/printer_dataikan" target="_blank" class="btn btn-sm bg-maroon">Print To Printer</a>
                <a href="/dataikan/printpdf_dataikan" target="_blank" class="btn btn-sm bg-navy">Print To PDF</a>
                </div>
            <div class="box-body">
            <table class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">Nama Ikan</th>
                <th class="text-center">Jenis Ikan</th>
                <th class="text-center">Harga Ikan</th>
                <th class="text-center">Stock Ikan</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>

                @foreach ($dataikan as $data)
                    <tr>
                        <td class="text-center">{{ $data->nama_ikan}}</td>
                        <td class="text-center">{{ $data->jenis_ikan}}</td>
                        <td class="text-center">{{ $data->harga_ikan}}</td>
                        <td class="text-center">{{ $data->stock_ikan}}</td>
                        <td class="text-center">{{ $data->created_at}}</td>
                        <td class="text-center">{{ $data->updated_at}}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#detail{{ $data->id}}">Detail</a>
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#update{{ $data->id}}">Update</a>
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id}}">Delete</a>
                        </td>
                    </tr>
                </div>
                @endforeach
                <div class="modal fade" id="tambah">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title">TAMBAH DATA</h5>
                        </div>
                        <form action="/dataikan/insert_dataikan" method="GET" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Ikan</label>
                                <input name="nama_ikan" id="nama_ikan" class="form-control" value="{{old('nama_ikan')}}">
                                <div class="text-danger">
                                    @error('nama_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Ikan</label>
                                <input name="jenis_ikan" id="jenis_ikan" class="form-control" value="{{old('jenis_ikan')}}">
                                <div class="text-danger">
                                    @error('jenis_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Ikan</label>
                                <input name="harga_ikan" id="harga_ikan" class="form-control" value="{{old('harga_ikan')}}">
                                <div class="text-danger">
                                    @error('harga_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group" >
                                <label>Stock Ikan</label>
                                <input name="stock_ikan" id="stock_ikan" class="form-control" value="{{old('stock_ikan')}}">
                                <div class="text-danger">
                                    @error('stock_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Save Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                @foreach ($dataikan as $data)
                  <div class="modal modal-success fade" id="detail{{ $data->id}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Detail Data {{ $data->id}}</h4>
                        </div>
                          <div class="modal-body">
                           <p>Nama Ikan : {{ $data->nama_ikan }}</p>
                           <p>Jenis Ikan : {{ $data->jenis_ikan }}</p>
                           <p>Harga Ikan : {{ $data->harga_ikan}}</p>
                           <p>Stock Ikan : {{ $data->stock_ikan}}</p>
                          </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                @foreach ($dataikan as $data)
                  <div class="modal fade" id="update{{ $data->id}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title">UPDATE DATA {{ $data->id}}</h5>
                        </div>
                        <form action="/dataikan/update_dataikan/" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                <label>Nama Ikan</label>
                                <input name="nama_ikan" class="form-control" value="{{$data->nama_ikan}}">
                                <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                                <div class="text-danger">
                                    @error('nama_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group">
                                <label>Jenis Ikan</label>
                                <input name="jenis_ikan" class="form-control" value="{{$data->jenis_ikan}}">
                                <div class="text-danger">
                                    @error('jenis_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga Ikan</label>
                                <input name="harga_ikan" class="form-control" value="{{$data->harga_ikan}}">
                                <div class="text-danger">
                                    @error('harga_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group" >
                                <label>Stock Ikan</label>
                                <input name="stock_ikan" class="form-control" value="{{$data->stock_ikan}}">
                                <div class="text-danger">
                                    @error('stock_ikan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Update Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
                @foreach ($dataikan as $data)
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
                          <a href="/dataikan/delete_dataikan/{{ $data->id}}" class="btn btn-outline pull-left">Yes</a>
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

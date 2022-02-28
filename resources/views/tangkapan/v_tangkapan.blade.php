@extends('layout.v_template')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tangkapan</h3>
            </div>
                <div class="text-center">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah">Tambah Data</a>
                <a href="/tangkapan/printer_tangkapan" target="_blank" class="btn btn-sm bg-maroon">Print To Printer</a>
                <a href="/tangkapan/printpdf_tangkapan" target="_blank" class="btn btn-sm bg-navy">Print To PDF</a>
                </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">Source ID</th>
                <th class="text-center">Date</th>
                <th class="text-center">Hasil Tangkapan</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; ?>
                @foreach ($tangkapan as $data)
                    <tr>
                        <td class="text-center">{{ $data->source_id}}</td>
                        <td class="text-center">{{ $data->date}}</td>
                        <td class="text-center">{{ $data->hasil_tangkapan}}</td>
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
                        <form action="/tangkapan/insert_tangkapan" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Source ID</label>
                                <input name="source_id" class="form-control" value="{{old('source_id')}}">
                                <div class="text-danger">
                                    @error('source_id')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input name="date" type="date" class="form-control" value="{{old('date')}}">
                                <div class="text-danger">
                                    @error('date')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hasil Tangkapan</label>
                                <input name="hasil_tangkapan" class="form-control" value="{{old('hasil_tangkapan')}}">
                                <div class="text-danger">
                                    @error('hasil_tangkapan')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Save Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                @foreach ($tangkapan as $data)
                  <div class="modal fade" id="edit{{ $data->id}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title">EDIT DATA {{ $data->id}}</h5>
                        </div>
                        <form action="/tangkapan/update_tangkapan" method="PUT" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                <label>Source ID</label>
                                <input name="source_id" class="form-control" value="{{$data->source_id}}">
                                <div class="text-danger">
                                    @error('source_id')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group">
                                <label>Date</label>
                                <input name="date" type="date" class="form-control" value="{{$data->date}}">
                                <div class="text-danger">
                                    @error('date')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                    <label>Hasil Tangkapan </label>
                                    <input name="hasil_tangkapan" class="form-control" value="{{$data->hasil_tangkapan}}">
                                    <div class="text-danger">
                                        @error('hasil_tangkapan')
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
                @foreach ($tangkapan as $data)
                  <div class="modal modal-success fade" id="detail{{ $data->id}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Detail Data {{ $data->id}}</h4>
                        </div>
                          <div class="modal-body">
                           <p>Source ID : {{ $data->source_id}}</p>
                           <p>Tanggal : {{ $data->date}}</p>
                           <p>Hasil Tangkapan : {{ $data->hasil_tangkapan}}</p>
                          </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                @foreach ($tangkapan as $data)
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
                          <a href="/tangkapan/delete_tangkapan/{{ $data->id}}" class="btn btn-outline pull-left">Yes</a>
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

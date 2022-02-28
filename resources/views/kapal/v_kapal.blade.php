@extends('layout.v_template')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Kapal</h3>
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
            </div>
                <div class="text-center">
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah">Tambah Data</a>
                <a href="/kapal/printer_kapal" target="_blank" class="btn btn-sm bg-maroon">Print To Printer</a>
                <a href="/kapal/printpdf_kapal" target="_blank" class="btn btn-sm bg-navy">Print To PDF</a>
                </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">Source ID</th>
                <th class="text-center">Pemilik Kapal</th>
                <th class="text-center">Foto Kapal</th>
                <th class="text-center">Crew</th>
                <th class="text-center">Contact</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; ?>
                @foreach ($kapal as $data)
                    <tr>
                        <td class="text-center">{{ $data->source_id}}</td>
                        <td class="text-center">{{ $data->pemilik_kapal}}</td>
                        <td class="text-center">
                            <img src="{{ asset('foto_kapal/'.$data->foto_kapal) }}" alt='' style="width:150px">
                        </td>
                        <td class="text-center">{{ $data->crew}}</td>
                        <td class="text-center">{{ $data->contact}}</td>
                        <td class="text-center">{{ $data->created_at}}</td>
                        <td class="text-center">{{ $data->updated_at}}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#detail{{ $data->id}}">Detail</a>
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{ $data->id}}">Edit</a>
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($kapal as $data)
                  <div class="modal modal-success fade" id="detail{{ $data->id}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Detail Data {{ $data->id}}</h4>
                        </div>
                          <div class="modal-body">
                           <p>Source ID : {{ $data->source_id }}</p>
                           <p>Pemilik Kapal : {{ $data->pemilik_kapal}}</p>
                           <p>Foto Kapal :{{ $data->foto_kapal}} </p>
                           <p>
                            <img src="{{ asset('foto_kapal/'.$data->foto_kapal) }}" alt='' style="width:150px">
                           </p>
                           <p>Crew : {{ $data->crew}}</p>
                           <p>Contact : {{ $data->contact}}</p>
                          </div>
                      </div>
                    </div>
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
                        <form action="/kapal/insert_kapal" method="GET" enctype="multipart/form-data">
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
                                <label>Pemilik Kapal</label>
                                <input name="pemilik_kapal" class="form-control" value="{{old('pemilik_kapal')}}">
                                <div class="text-danger">
                                    @error('pemilik_kapal')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                <label>Foto Kapal</label>
                                <input type="file" name="foto_kapal" class="form-control">
                                <div class="text-danger">
                                    @error('foto_kapal')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="form-group" >
                                <label>Crew</label>
                                <input name="crew" class="form-control" value="{{old('crew')}}">
                                <div class="text-danger">
                                    @error('crew')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group" >
                                <label>Contact</label>
                                <input name="contact" class="form-control" value="{{old('contact')}}">
                                <div class="text-danger">
                                    @error('contact')
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
                @foreach ($kapal as $data)
                  <div class="modal fade" id="edit{{ $data->id}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title">EDIT DATA {{ $data->id}}</h5>
                        </div>
                        <form action="/kapal/update_kapal" method="POST" enctype="multipart/form-data">
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
                                <label>Pemilik Kapal</label>
                                <input name="pemilik_kapal" class="form-control" value="{{old('pemilik_kapal')}}">
                                <div class="text-danger">
                                    @error('pemilik_kapal')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div>
                                    <img src="{{ asset('foto_kapal/'.$data->foto_kapal) }}" alt='' style="width:150px">
                                </div>
                            <div>
                                <div class="form-group">
                                    <label> Ganti Foto Kapal</label>
                                    <input type="file" name="foto_kapal" class="form-control">
                                    <div class="text-danger">
                                        @error('foto_kapal')
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <label>Crew</label>
                                <input name="crew" class="form-control" value="{{old('crew')}}">
                                <div class="text-danger">
                                    @error('crew')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                             <div class="form-group">
                                <label>Contact</label>
                                <input name="contact" class="form-control" value="{{old('contact')}}">
                                <div class="text-danger">
                                    @error('contact')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Updade Data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach

                @foreach ($kapal as $data)
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
                          <a href="/kapal/delete_kapal/{{ $data->id}}" class="btn btn-outline pull-left">Yes</a>
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

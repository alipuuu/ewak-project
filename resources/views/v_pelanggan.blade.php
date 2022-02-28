@extends('layout.v_template')
@section('title','Pelanggan')

@section('content')
 <!-- Main content -->
 <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Id</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Source ID</th>
                  <th class="text-center">Crew</th>
                  <th class="text-center">Dest ID</th>
                  <th class="text-center">Lat</th>
                  <th class="text-center">Longitude</th>
                  <th class="text-center">Message</th>
                  <th class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>
                <!-- /.buat isi data -->
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  <!-- /.content -->
@endsection

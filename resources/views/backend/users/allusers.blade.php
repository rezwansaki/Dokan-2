@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Users
      <small>All Users</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
      <li class="active">All User</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
   
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">All User</h3>
              </div><!-- /.box-header -->
              
              {{-- start data table --}}
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Photo</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_users as $row)
                    <tr>                        
                        <td> {{ $row->name }} </td>
                        <td> {{ $row->email }} </td>
                        <td> {{ $row->phone }} </td>
                        <td> {{ $row->address }} </td>
                        <td> <img src="{{ $row->photo }}" style="width:58px; height:58px;"> </td>
                        <td> 
                            <?php
                            $user_role = $row->role;
                            if($user_role == 2){
                            ?>
                                <span class="badge" style="background-color:aqua; color:#333">Super Admin</span>
                            <?php
                            }elseif($user_role == 1){
                            ?>
                                <span class="badge" style="background-color:rgb(12, 206, 109); color:#333">Admin</span>
                            <?php
                            }else{
                            ?>
                                <span class="badge" style="background-color:rgb(230, 218, 50); color:#333">User</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td> 
                            <a href="{{url('/view-single-user/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('/edit-user/'.$row->id)}}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{url('/delete-user/'.$row->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div><!-- /.box-body -->
              {{-- end of data table --}}


            </div><!-- /.box -->        
          </div><!--/.col (left) -->         
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

{{-- DataTable --}}
<script>
     $(document).ready(function () {
         $('#example1').DataTable();
      });
</script>

{{-- Show the selected image on the form --}}
<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image')
            .attr('src', e.target.result)
            .width(80)
            .height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
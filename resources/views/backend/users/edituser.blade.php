@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Users
      <small>Edit User</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
      <li class="active">Edit User</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     {{-- to show errors --}}
     @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
     @endif
   
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ url('/update-user/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" value="{{ $user->name }}" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}"  name="email">
                  </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" class="form-control" id="exampleInputPhone" value="{{ $user->phone }}"  name="phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="text" class="form-control" id="exampleInputAddress" value="{{ $user->address }}"  name="address">
                  </div>
                  <div class="form-group">
                    <img id="image" src="#"/>
                    <label for="exampleInputPhoto">New Photo</label>
                    <input type="file" id="exampleInputPhoto" name="photo" accept="image/*" onchange="readURL(this);">
                  </div>
                  <div class="form-group">
                    <img src="{{ URL::to($user->photo) }}" style="width: 80px; height:80px;"/>
                    <input type="hidden" id="exampleInputPhoto" name="old_photo" value="{{$user->photo}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputRole">Role</label>
                    <input type="text" class="form-control" id="exampleInputRole" value="{{ $user->role }}"  name="role">
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div><!-- /.box -->        
       

          </div><!--/.col (left) -->         
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

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
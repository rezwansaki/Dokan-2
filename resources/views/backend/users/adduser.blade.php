@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Users
      <small>Add User</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
      <li class="active">Add User</li>
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
                <h3 class="box-title">Add User</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('store.user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Your Name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                  </div>
                  <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                  <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" class="form-control" id="exampleInputPhone" placeholder="Enter Your Phone Number" name="phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="text" class="form-control" id="exampleInputAddress" placeholder="Enter Your Address" name="address">
                  </div>
                  <div class="form-group">
                    <img id="image" src="#" />
                    <label for="exampleInputPhoto">Photo</label>
                    <input type="file" id="exampleInputPhoto" name="photo" accept="image/*" onchange="readURL(this);" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputRole">Role</label>
                    <select id="exampleInputRole" class="form-select" aria-label="Default select example" name="role" required>
                      <option value="0">User</option>
                      <option value="1" selected>Admin</option>
                      @if(Auth::user()->role == 2)
                      <option value="2">Super Admin</option>
                      @endif
                    </select>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Add User</button>
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
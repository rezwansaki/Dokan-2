@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Employee
      <small>Add Employee</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Employee</a></li>
      <li class="active">Add Employee</li>
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
                <h3 class="box-title">Add Employee</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('store.employee') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" class="form-control" id="exampleInputPhone" placeholder="Enter Your Phone Number" name="phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputNidNumber">NID Number</label>
                    <input type="text" class="form-control" id="exampleInputNidNumber" placeholder="Enter Your NID Number" name="nid_no">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="text" class="form-control" id="exampleInputAddress" placeholder="Enter Your Address" name="address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputCity">City</label>
                    <input type="text" class="form-control" id="exampleInputCity" placeholder="Enter Your City" name="city">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Salary</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Enter Your Salary" name="salary">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputVacation">Vacation</label>
                    <input type="text" class="form-control" id="exampleInputVacation" placeholder="Enter Your Vacation" name="vacation">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputExperience">Experience</label>
                    <input type="text" class="form-control" id="exampleInputExperience" placeholder="Enter Your Experience" name="experience">
                  </div>
                  <div class="form-group">
                    <img id="image" src="#" />
                    <label for="exampleInputPhoto">Photo</label>
                    <input type="file" id="exampleInputPhoto" name="photo" accept="image/*" onchange="readURL(this);" required>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Add Employee</button>
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

<script>
  $(document).ready(function() {
  $("select#exampleInputRole").change(function() {
    var selectedRole = $("#exampleInputRole option:selected").text();
    if (selectedRole == "Super Admin") {
      Swal.fire({
          title: 'You are selected Super Admin as an user role.',
          text: "Are you sure?",
          icon: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK!'
      })
    } 
  });
});
</script>
@endsection
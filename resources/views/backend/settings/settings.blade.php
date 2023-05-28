@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Settings
      <small>Edit Settings</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Settings</a></li>
      <li class="active">Edit Settings</li>
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
                <h3 class="box-title">Edit Settings</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ url('/update-settings/'.$settingsData->id) }}" method="POST">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputInstallTheProject">Install The Project</label>
                    @if($settingsData->install_the_project == 1)
                        <input type="text" class="form-control" id="exampleInputInstallTheProject" value="Finished" name="install_the_project" style="color:green; font-weight:bold;" disabled>
                    @else 
                        <input type="text" class="form-control" id="exampleInputInstallTheProject" value="Pending" name="install_the_project" style="color:red" disabled>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputShopName">Shop Name</label>
                    <input type="text" class="form-control" id="exampleInputShopName" value="{{ $settingsData->shop_name }}" name="shop_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputShopDescription">Shop Description</label>
                    <input type="text" class="form-control" id="exampleInputShopDescription" value="{{ $settingsData->shop_description }}" name="shop_description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputShopLocation">Shop Location</label>
                    <input type="text" class="form-control" id="exampleInputShopLocation" value="{{ $settingsData->shop_location }}" name="shop_location">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputUploadMaxiumFileSize">Upload Maximum File Size (in KB)</label>
                    <input type="text" class="form-control" id="exampleInputUploadMaxiumFileSize" value="{{ $settingsData->upload_max_filesize }}" name="upload_max_filesize">
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
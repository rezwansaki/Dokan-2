@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Product
      <small>Add Product</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Product</a></li>
      <li class="active">Add Product</li>
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
                <h3 class="box-title">Add Product</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputName">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Product Name" name="product_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Description</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Product Description" name="product_description">
                  </div>
                  <div class="form-group">
                    <img id="image" src="#" />
                    <label for="exampleInputPhoto">Product Image</label>
                    <input type="file" id="exampleInputPhoto" name="product_image" accept="image/*" onchange="readURL(this);" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputNidNumber">Buying Date</label>
                    <input type="date" class="form-control" id="exampleInputNidNumber" placeholder="Buying Date" name="buy_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputAddress">Expire Date</label>
                    <input type="date" class="form-control" id="exampleInputAddress" placeholder="Expire Date" name="expire_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputCity">Buying Price</label>
                    <input type="text" class="form-control" id="exampleInputCity" placeholder="Buying Price" name="buying_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Selling Price</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Selling Price" name="selling_price">
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Add Product</button>
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

{{-- <script>
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
</script> --}}
@endsection
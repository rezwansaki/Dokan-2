@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      product
      <small>Edit product</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> product</a></li>
      <li class="active">Edit product</li>
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
                <h3 class="box-title">Edit Product</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ url('/update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputName">Product Name</label>
                    <input type="text" class="form-control" id="exampleInputName" value="{{ $product->product_name }}" name="product_name">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Product Description</label>
                    <input type="text" class="form-control" id="exampleInputName" value="{{ $product->product_description }}" name="product_description">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Buy Date</label>
                    <input type="date" class="form-control" id="exampleInputName" value="{{date('Y-m-d', strtotime($product->buy_date))}}" name="buy_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Expire Date</label>
                    <input type="date" class="form-control" id="exampleInputName" value="{{date('Y-m-d', strtotime($product->expire_date))}}" name="expire_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Buying Price</label>
                    <input type="text" class="form-control" id="exampleInputName" value="{{number_format($product->buying_price, 2)}}" name="buying_price">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Selling Price</label>
                    <input type="text" class="form-control" id="exampleInputName" value="{{number_format($product->selling_price, 2)}}" name="selling_price">
                  </div>
                 

                  <div class="form-group">
                    <img id="image" src="#"/>
                    <label for="exampleInputPhoto">Product Image</label>
                    <input type="file" id="exampleInputPhoto" name="product_image" accept="image/*" onchange="readURL(this);">
                  </div>
                  <div class="form-group">
                    <img src="{{ URL::to($product->product_image) }}" style="width: 80px; height:80px;"/>
                    <input type="hidden" id="exampleInputPhoto" name="old_photo" value="{{$product->product_image}}">
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
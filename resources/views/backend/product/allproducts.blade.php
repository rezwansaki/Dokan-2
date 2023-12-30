@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Products
      <small>All Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
      <li class="active">All Products</li>
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
                <h3 class="box-title">All Products</h3>
              </div><!-- /.box-header -->
              
              {{-- start data table --}}
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Product Description</th>
                      <th>Buying Date</th>
                      <th>Expire Date</th>
                      <th>Buying Price</th>
                      <th>Selling Price</th>
                      <th>Product Image</th>                      
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $row)
                    <tr>                        
                        <td> {{ $row->id }} </td>
                        <td> {{ $row->product_name }} </td>
                        <td> {{ $row->product_description }} </td>
                        <td> {{date('d-M-Y', strtotime($row->buy_date))}} </td>
                        <td> {{date('d-M-Y', strtotime($row->expire_date))}} </td>
                        <td> {{number_format($row->buying_price, 2)}} </td>
                        <td> {{number_format($row->selling_price, 2)}} </td>
                        <td> <img src="{{ $row->product_image }}" style="width:58px; height:58px;"> </td>
                        <td> 
                            <a href="{{ url('/edit-product/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ url('/delete-product/'.$row->id) }}" class="btn btn-sm btn-danger" id="user-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
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

<script>
  $(document).on("click", "#user-delete", function(e){
      e.preventDefault();
      var link = $(this).attr("href");
      Swal.fire({
          title: 'Are you sure, you want to delete the user?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      })
      .then((result)=> {
          if (result.value) {
              window.location.href = link; 
          } else {
            swal.fire(
                'Cancelled',
                'Your data is safe :)',
                'error'
            )
          }
      });
  });
</script>


@endsection
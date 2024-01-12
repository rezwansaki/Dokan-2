@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Order Details
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Order Details</a></li>
      <li class="active">Order Details</li>
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
                <h3 class="box-title">Order Id: {{ $orderId }}</h3>
                <div>{{ App\Models\Order::find($orderId)->order_date}} || {{App\Models\Order::find($orderId)->order_status }} || Total Products: {{ App\Models\Order::find($orderId)->total_products }} || Total: {{ App\Models\Order::find($orderId)->total }} || Paid: {{ App\Models\Order::find($orderId)->pay }}</div>
              </div><!-- /.box-header -->
              
              {{-- start data table --}}
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Order Id</th>
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Unit Cost</th>
                      <th>Total</th>              
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orderdetails as $row)
                    <tr>                        
                        <td> {{ $row->id }} </td>
                        <td> {{ $row->order_id }} </td>                        
                        <td>
                            {{ $row->product_id }} 
                        </td>
                        <td>                            
                            {{ App\Models\Product::find($row->product_id)->product_name }} 
                        </td>
                        <td> {{ $row->quantity }} </td>
                        <td> {{ $row->unit_cost }} </td>
                        <td> {{ $row->total }} </td>
                        {{-- <td style="padding:0;"> 
                            <a href="{{ url('/edit-product/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ url('/delete-product/'.$row->id) }}" class="btn btn-sm btn-danger" id="user-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td> --}}
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
          title: 'Are you sure, you want to delete this product?',
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
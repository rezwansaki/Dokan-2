@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Orders
      <small>All Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Orders</a></li>
      <li class="active">All Orders</li>
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
                <h3 class="box-title">All Orders</h3>
              </div><!-- /.box-header -->
              
              {{-- start data table --}}
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Order Id</th>
                      <th>Order Date</th>
                      <th>Order Status</th>
                      <th>Total Products</th>
                      <th>Sub Total</th>
                      <th>Vat</th>
                      <th>Total</th>
                      <th>Payment Status</th>
                      <th>Pay</th>
                      <th>Due</th>                                            
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orders as $row)
                    <tr>                        
                        <td> {{ $row->id }} </td>
                        <td> {{date('d-M-Y', strtotime($row->order_date))}} </td>
                        <td> {{ $row->order_status }} </td>
                        <td> {{ $row->total_products }} </td>
                        <td> {{ $row->sub_total }} </td>
                        <td> {{ $row->vat }} </td>
                        <td> {{ $row->total }} </td>
                        <td> {{ $row->payment_status }} </td>                        
                        <td> {{ $row->pay }} </td>
                        <td> {{ $row->due }} </td>                       
                        <td style="padding:0;"> 
                            <a href="{{ url('/order-details/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
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
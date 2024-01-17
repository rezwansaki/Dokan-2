@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Purchase Product
    </h1>
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
                <h3 class="box-title">Purchase Product</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('purchase.product') }}" method="POST">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputName">Products</label>
                    <select class="form-control" name="product_id">
                      @foreach($products as $product)
                      <option value="{{$product->id}}">{{$product->product_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text" class="form-control" id="quantity" placeholder="Product Quantity" name="quantity">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputCity">Buying Price</label>
                    <input type="text" class="form-control" id="buyingprice" placeholder="Buying Price For A Single Product" name="buying_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputCity">Total Purchase Price</label>
                    <input type="text" class="form-control" id="totalpurchaseprice" placeholder="Total Purchase Price" name="total_purchase_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Selling Price</label>
                    <input type="text" class="form-control" id="sellingprice" placeholder="Selling Price For A Single Product" name="selling_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Total Selling Price</label>
                    <input type="text" class="form-control" id="totalsellingprice" placeholder="Total Selling Price" name="total_selling_price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Note</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Note" name="note">
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
                    <label for="exampleInputSalary">Supplier Name</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Supplier Name" name="supplier_name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Supplier Address</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Supplier Address" name="supplier_address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Supplier Phone</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Supplier Phone" name="supplier_phone">
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Purchase Product</button>
                </div>
              </form>
            </div><!-- /.box -->        
       

          </div><!--/.col (left) -->      
             
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<script>
    $(document).ready(function(){
    $("#buyingprice").bind('keyup mouseup', function() {
        var quantity = $('#quantity').val();
        var totalpurchaseprice = $(this).val() * quantity;
        $('#totalpurchaseprice').val(totalpurchaseprice);
    });

    $("#sellingprice").bind('keyup mouseup', function() {
        var quantity = $('#quantity').val();
        var totalsellingprice = $(this).val() * quantity;
        $('#totalsellingprice').val(totalsellingprice);
    });
});
</script>

@endsection
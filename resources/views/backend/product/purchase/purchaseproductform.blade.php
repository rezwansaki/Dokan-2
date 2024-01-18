@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
    <section class="content-header" style="background-color: aqua; padding:10px">
      <h1><i class="fa fa-shopping-cart"></i> Purchase Product</h1>
    </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

      {{-- Pos start here --}}
      <div class="col-sm-10">
        <div class="container-sm">
          <table class="table" style="border: 1px solid gray">
            <thead class="bg-info">
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Buying Price</th>
                <th>Total Purchase Price</th>
                <th>Selling Price</th>
                <th>Total Selling Price</th>
                <th>Note</th>
                <th>Buy Date</th>
                <th>Expire Date</th>
                <th>Update</th>
                <th>Remove</th>
              </tr>
            </thead>
            @php
            $cart_product  = Cart::content();    
            @endphp
            <tbody>
              @foreach ($cart_product as $prod)
              <tr>
                <td> {{ $prod->name }} , Id: {{ $prod->id }}</td>
                <th>
                  <form action="{{ url('/cart-update-to-purchase/'.$prod->rowId)}}" method="POST">
                    @csrf
                    <input id="qty" type="number" name="qty" value="{{ $prod->qty}}" style="width: 40px">
                    <input type="hidden" name="product_id" value="{{ $prod->id}}" style="width: 40px">                            
                </th>
                <th><input id="buying_price" name="buying_price" value="{{ $prod->price}}" style="width: 40px"></th>
                <th><input id="total_purchase_price" name="total_purchase_price" value="{{ $prod->price * $prod->qty}}" style="width: 40px"></th>
                <th><input id="selling_price" name="selling_price" value="{{ $prod->options->selling_price}}" style="width: 40px"></th>
                <th><input id="total_selling_price" name="total_selling_price" value="{{ $prod->options->selling_price * $prod->qty}}" style="width: 40px"></th>
                <th><input id="note" name="note" value="{{ $prod->options->note}}" style="width: 92px"></th>
                <th><input type="date" class="form-control" id="buy_date" name="buy_date"></th>
                <th><input type="date" class="form-control" id="expire_date" name="expire_date"></th>
                <th>
                    <button id="btn_qty_update" type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                  </form>
                </th>
                <th>
                  <a href="{{ url('cart-remove-to-purchase/'.$prod->rowId) }}" class="btn btn-sm btn-danger" id="pos-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="bg-primary text-center">
            <div>Quantity: {{ Cart::count() }}</div>
            <div>Sub Total (Exc. Vat): {{ Cart::subtotal() }}</div>
            <div>Vat: {{ Cart::tax() }}</div>
            <div><h2>Total: {{ Cart::total() }}</h2></div>
        <form action="{{ route('generate.invoice.to.purchase')}}" method="GET">
          </div>
          <div class="form-group">
            <label for="exampleInputName">Supplier's Name</label>
            <input id="supplier_name" type="text" class="form-control" placeholder="Enter Supplier Name" name="supplier_name" value="Unknown">
          </div>

          <div class="form-group">
            <label for="exampleInputName">Supplier's Address</label>
            <input id="supplier_address" type="text" class="form-control" placeholder="Enter Supplier Name" name="supplier_address">
          </div>      
          
          <div class="form-group">
            <label for="exampleInputName">Supplier's Phone</label>
            <input id="supplier_phone" type="text" class="form-control" placeholder="Enter Supplier Name" name="supplier_phone">
          </div>      
            @csrf
            <button type="submit" class="btn btn-success">Purchase Product</button>
        </div>
      </div><!-- ./col -->
      {{-- /Pos end here --}}
    </form>

      {{-- All products start here --}}
      <div class="col-sm-2">
       <div class="container-sm">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Product</th>               
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($product as $row)
            <tr>
             {{-- Add Cart To Purchase Product --}}
              <form action="{{ url('/add-cart-to-purchase') }}" method="POST">
                @csrf
                <input type="hidden" id="pid" name="id" value="{{ $row->id}}">
                <input type="hidden" name="name" value="{{ $row->product_name}}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="price" value="0">
                <input type="hidden" id="selling_price" name="selling_price" value="0" style="width: 40px">
                <td> {{ $row->product_name }} <br> Id: {{ $row->id }} - Stock: {{ $row->stock }}</td>
                <td><button type="submit" class="btn btn-info btn-sm"><i style="font-size: 20px" class="fa fa-plus-square" aria-hidden="true"></i></button></td>
              </form>
            </tr>
            @endforeach
          </tbody>
        </table>
       </div>
      </div><!-- ./col-->
      {{-- /All products end here --}}
    </div><!-- /.row -->
    <!-- Main row -->
    
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

{{-- DataTable --}}
<script>
  $(document).ready(function () {
      $('#example1').DataTable();
   });
</script>

@endsection
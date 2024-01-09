@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
    <section class="content-header" style="background-color: aqua; padding:10px">
        <h1>POS (Point of Sale)</h1>
        <ol class="breadcrumb">
            <li class="text-black" style="font-size: 15px"> {{ date('d-M-Y')}}</li>
        </ol>
    </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

      {{-- Pos start here --}}
      <div class="col-sm-4">
        <div class="container-sm">
          <table class="table" style="border: 1px solid gray">
            <thead class="bg-info">
              <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Sub Total</th>
                <th>Action</th>
              </tr>
            </thead>
            @php
            $cart_product  = Cart::content();    
            @endphp
            <tbody>
              @foreach ($cart_product as $prod)
              <tr>
                <th>{{ $prod->name}}</th>
                <th>
                  <form action="{{ url('/cart-update/'.$prod->rowId)}}" method="POST">
                    @csrf
                    <input id="qty" type="number" name="qty" value="{{ $prod->qty}}" style="width: 40px">
                    <input type="hidden" name="product_id" value="{{ $prod->id}}" style="width: 40px">
                    <button id="btn_qty_update" type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                  </form>
                </th>                
                <th>{{ $prod->price}}</th>
                <th>{{ $prod->price * $prod->qty}}</th>
                <th>
                  <a href="{{ url('/cart-remove/'.$prod->rowId) }}" class="btn btn-sm btn-danger" id="pos-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
        <form action="{{ url('/create-invoice')}}" method="POST">
          </div>
            @csrf
            <button type="submit" class="btn btn-success">Create Invoice</button>
        </div>
      </div><!-- ./col -->
      {{-- /Pos end here --}}
    </form>

      {{-- All products start here --}}
      <div class="col-sm-8">
       <div class="container-sm">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Image</th>                      
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($product as $row)
            <tr>
             {{-- Add Cart --}}
              <form action="{{ url('/add-cart') }}" method="POST">
                @csrf
                <input type="hidden" id="pid" name="id" value="{{ $row->id}}">
                <input type="hidden" name="name" value="{{ $row->product_name}}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="price" value="{{ $row->selling_price}}">
                <td> {{ $row->id }} </td>
                <td> {{ $row->product_name }} </td>
                <td> {{ $row->selling_price }} </td>
                <td> {{ $row->stock }} </td>
                <td><img src="{{ $row->product_image }}" style="width:58px; height:58px;"></td>
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
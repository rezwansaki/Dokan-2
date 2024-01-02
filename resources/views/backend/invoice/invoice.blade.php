@extends('layouts.backend')

@section('content')

<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Dokan-2
            <small class="pull-right">Date: {{ date('d-M-Y')}}</small>
          </h2>
        </div><!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Admin, Inc.</strong><br>
            Mirpur, Dhaka-1216,<br>
            Bangladesh.<br>
            Phone: (804) 123-5432<br>
            Email: info@dokantwo.com
          </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 1<br>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @php
                $sl=1;
              @endphp
              @foreach ($cart_contents as $row)
              <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->qty }}</td>
                <td>{{ $row->price }}</td>
                <td>{{ $row->subtotal }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
            Hand Cash
          </p>
        </div><!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{ Cart::subtotal() }}</td>
              </tr>
              <tr>
                <th>Tax</th>
                <td>{{ Cart::tax() }}</td>
              </tr>
              <tr>
                <th><h2>Total:</h2></th>
                <td><h2>{{ Cart::total() }}</h2></td>
              </tr>
            </table>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-default"><i class="fa fa-credit-card"></i> Submit Payment</button>
          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
        </div>
      </div>
    </section><!-- /.content -->
    <div class="clearfix"></div>
  </div><!-- /.content-wrapper -->


{{-- modal input start here --}}
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Invoice for the customer <span style="font-size: 20px; color:black; float:right;">Total: {{ Cart::total() }}</span></h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{-- form start here --}}
      <form role="form" action="{{ route('final.invoice') }}" method="POST">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputName">Payment Status</label>
            <select class="form-select" aria-label="Default select example" name="payment_status">
              <option value="HandCash">HandCash</option>
              <option value="Cheque">Cheque</option>
              <option value="Due">Due</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputName">Pay</label>
            <input type="text" class="form-control" id="pay" placeholder="Paid Amount" name="pay">
          </div>

          <div class="form-group">
            <label for="exampleInputName">Due</label>
            <input type="text" class="form-control" id="due" placeholder="Due Amount" name="due">
          </div>
        </div><!-- /.box-body -->

        <input type="hidden" name="order_date" value="{{ date('d-M-Y') }}">
        <input type="hidden" name="order_status" value="pending">
        <input type="hidden" name="total_products" value="{{ Cart::count() }}">
        <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
        <input type="hidden" name="vat" value="{{ Cart::tax() }}">
        <input type="hidden" name="total" value="{{ Cart::total() }}">

        <div class="row">
          <div class="col-sm-6">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </form>
      {{-- form end here --}}
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> --}}
    </div>
  </div>
</div>
{{-- modal input end here --}}

@endsection
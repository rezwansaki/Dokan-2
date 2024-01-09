@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Expense
      <small>Add Expense</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Expense</a></li>
      <li class="active">Add Expense</li>
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
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Expense</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('store.expense') }}" method="POST">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputName">Expense Description</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Expense Description" name="exp_desc">
                  </div>

                 
                  <div class="form-group">
                    <label for="exampleInputNidNumber">Expense Date</label>
                    <input type="date" class="form-control" id="exampleInputNidNumber" placeholder="Expense Date" name="exp_date">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputCity">Expense Amount</label>
                    <input type="text" class="form-control" id="exampleInputCity" placeholder="Expense Amount" name="exp_amount">
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Add Expense</button>
                </div>
              </form>
            </div><!-- /.box -->        
          </div><!--/.col (left) -->         

          <!-- right column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">All Expense</h3>
              </div><!-- /.box-header -->
              
              {{-- start data table --}}
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Description</th>
                      <th>Amount</th>                      
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($expense as $row)
                    <tr>                        
                        <td> {{ $row->id }} </td>
                        <td> {{ $row->exp_desc }} </td>
                        <td> {{number_format($row->exp_amount, 2)}} </td>
                        <td> {{date('d-M-Y', strtotime($row->exp_date))}} </td>
                        <td> 
                            {{-- <a href="{{url('/view-single-employee/'.$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ url('/edit-employee/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="{{ url('/delete-employee/'.$row->id) }}" class="btn btn-sm btn-danger" id="user-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.box-body -->
              {{-- end of data table --}}
            </div><!-- /.box -->        
          </div><!--/.col (right) -->       
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

{{-- DataTable --}}
<script>
    $(document).ready(function () {
        $('#example1').DataTable();
     });
</script>
@endsection
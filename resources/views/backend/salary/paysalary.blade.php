@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Salary
      <small>Pay Salary</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Salary</a></li>
      <li class="active">Pay Salary</li>
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
                <h3 class="box-title">Pay Salary - Today is: {{date("d-M-Y")}}</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('store.salary') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">                  

                  <div class="form-group">
                    <label for="exampleInputName">Employee Name</label>
                    <select class="form-control form-select" aria-label="Default select example" id="employee_id" name="employee_id">
                      @foreach($employee as $row)
                      <option value="{{$row->id}}">{{$row->id}} - {{$row->name}} - (Salary: {{$row->salary}})</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputCity">Salary Year</label>
                    <input type="number" class="form-control" id="salary_year" min="2023" max="2099" step="1" value="{{date('Y')}}" name="salary_year">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Salary Month</label>
                    <select class="form-control form-select" aria-label="Default select example" name="salary_month">
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                    </select>
                  </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Pay Salary</button>
                </div>
              </form>
            </div><!-- /.box -->        
       

          </div><!--/.col (left) -->         
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

@endsection
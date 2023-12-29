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

        <section class="content">
   
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Pay Salary</h3>
                    <div class="pull-right">{{ date("F Y") }}</div>
                  </div><!-- /.box-header -->
                  
                  {{-- start data table --}}
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>EmpId</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>                      
                          <th>Address</th>
                          <th>Salary</th>
                          <th>Vacation</th>
                          <th>Photo</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($employees as $row)
                        <tr>                        
                            <td> {{ $row->id }} </td>
                            <td> {{ $row->name }} </td>
                            <td> {{ $row->email }} </td>
                            <td> {{ $row->phone }} </td>
                            <td> {{ $row->address }} </td>
                            <td> {{ $row->salary }} </td>
                            <td> {{ $row->vacation }} </td>
                            <td> <img src="{{ $row->photo }}" style="width:58px; height:58px;"> </td>
                            <td> 
                                <a href="{{URL::to('/pay-salary-done/'. $row->id)}}" class="btn btn-sm btn-warning">Pay Now</a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                      {{-- <tfoot>
                       
                      </tfoot> --}}
                        </form>
                    </table>
                  </div><!-- /.box-body -->
                  {{-- end of data table --}}
    
    
                </div><!-- /.box -->        
              </div><!--/.col (left) -->         
            </div>   <!-- /.row -->
        
        </section><!-- /.content -->

        {{-- <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">                
                <h3 class="box-title">Pay Salary</h3>
                <span class="pull-right">{{ date("F Y") }}</span>
              </div><!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{ route('pay.salary.done') }}" method="POST">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputempid">Employee Id</label>
                    <select id="emp_id" class="form-select" aria-label="Default select example" name="emp_id" required>
                      @foreach ($employees as $employee)
                      <option value="{{ $employee->id }}">{{ $employee->id }} - {{ $employee->name }} - {{ $employee->salary }}</option>                                    
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputRole">Month</label>
                    <select id="exampleInputRole" class="form-select" aria-label="Default select example" name="month" required>                      
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
                </div>
                  <div class="form-group">
                    <label for="exampleInputRole">Month</label>
                    <select id="exampleInputRole" class="form-select" aria-label="Default select example" name="month" required>                      
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
                  <button type="submit" class="btn btn-primary">Pay Now</button>
                </div>
              </form>
            </div><!-- /.box -->        
       

          </div><!--/.col (left) -->         
        </div>   <!-- /.row --> --}}
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection
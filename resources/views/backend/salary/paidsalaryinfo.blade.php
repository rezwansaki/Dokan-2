@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Salary
      <small>Paid Salary Information</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Salary</a></li>
      <li class="active">Paid Salary Information</li>
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
                <h3 class="box-title">Paid Salary Information</h3>
              </div><!-- /.box-header -->
              
              {{-- start data table --}}
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Emp_Id</th>
                      <th>Emp_Name</th>
                      <th>Salary Year</th>
                      <th>Salary Month</th>
                      <th>Paid Amount</th>
                      <th>Paid Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($salary as $row)
                    <tr>                        
                        <td> {{ $row->id }} </td>
                        <td> {{ $row->employee_id }} </td>
                        <td> {{ App\Models\Employee::find($row->employee_id)->name }} </td>
                        <td> {{ $row->salary_year }} </td>
                        <td> {{ $row->salary_month }} </td>
                        <td> {{ number_format($row->paid_amount) }} </td>
                        <td> {{ date('d-M-Y h:i a', strtotime($row->updated_at)) }} </td>
                                                
                        <td style="padding:0;"> 
                            <a href="{{ url('/delete-salary/'.$row->id) }}" class="btn btn-sm btn-danger" id="user-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<script>
    $(document).on("click", "#user-delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure, you want to delete this salary?',
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
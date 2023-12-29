@extends('layouts.backend')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Salary
            <small>Show Paid Salary</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Salary</a></li>
            <li class="active">Show Paid Salary</li>
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
                            <h3 class="box-title">Show Paid Salary</h3>
                        </div><!-- /.box-header -->

                        {{-- start data table --}}
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>EmpId</th>
                                        <th>Salary Year</th>
                                        <th>Salary Month</th>
                                        <th>Paid Amount</th>
                                        <th>Paid Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salaries as $row)                      
                                    <tr>
                                        <td> {{ $row->id }} </td>
                                        <td> {{ $row->salary_year }} </td>
                                        <td> {{ $row->salary_month }} </td>
                                        <td> {{ $row->paid_amount }} </td>
                                        <td> {{ date("d-F-Y h:i:sa", strtotime($row->updated_at)) }} </td>                                        
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
            </div> <!-- /.row -->

        </section><!-- /.content -->

</section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection
@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Employee
      <small>View Employee</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Employee</a></li>
      <li class="active">View Employee</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
   
        <div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">View Employee</h3>
              </div><!-- /.box-header -->  
               <!-- Profile Image -->
               <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{URL::to($employee->photo)}}" alt="Employee profile picture">
                <h3 class="profile-username text-center">{{$employee->name}}</h3>
                <div class="box-body">
                  <strong><i class="fa fa-id-card-o" aria-hidden="true"></i>  Employee Id</strong>
                  <p class="text-muted">
                    {{$employee->id}}
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                  <p class="text-muted">{{$employee->address}}</p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Email</strong>
                  <p class="text-muted">{{$employee->email}}</p>
                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> Phone</strong>
                  <p class="text-muted">{{$employee->phone}}</p>

                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> NID Number</strong>
                  <p class="text-muted">{{$employee->nid_no}}</p>

                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> City</strong>
                  <p class="text-muted">{{$employee->city}}</p>

                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> Salary</strong>
                  <p class="text-muted">{{$employee->salary}}</p>

                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> Vacation</strong>
                  <p class="text-muted">{{$employee->vacation}}</p>

                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> Experience</strong>
                  <p class="text-muted">{{$employee->experience}}</p>

                  <hr>


                  <strong><i class="fa fa-users" aria-hidden="true"></i> Member Since (y/m/d)</strong>
                  <p class="text-muted">{{$employee->created_at}}</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div><!--/.col (left) -->         
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection
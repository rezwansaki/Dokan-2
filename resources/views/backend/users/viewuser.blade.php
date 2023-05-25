@extends('layouts.backend')

@section('content')
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Users
      <small>View User</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
      <li class="active">View User</li>
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
                <h3 class="box-title">View User</h3>
              </div><!-- /.box-header -->  
               <!-- Profile Image -->
               <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{URL::to($user->photo)}}" alt="User profile picture">
                <h3 class="profile-username text-center">{{$user->name}}</h3>
                <p class="text-muted text-center">
                    <?php
                            $user_role = $user->role;
                            if($user_role == 2){
                            ?>
                                <span class="badge" style="background-color:aqua; color:#333">Super Admin</span>
                            <?php
                            }elseif($user_role == 1){
                            ?>
                                <span class="badge" style="background-color:rgb(12, 206, 109); color:#333">Admin</span>
                            <?php
                            }else{
                            ?>
                                <span class="badge" style="background-color:rgb(230, 218, 50); color:#333">User</span>
                            <?php
                            }
                            ?>
                  </p>
                <div class="box-body">
                  <strong><i class="fa fa-id-card-o" aria-hidden="true"></i>  User Id</strong>
                  <p class="text-muted">
                    {{$user->id}}
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                  <p class="text-muted">{{$user->address}}</p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Email</strong>
                  <p class="text-muted">{{$user->email}}</p>
                  <hr>

                  <strong><i class="fa fa-phone" aria-hidden="true"></i> Phone</strong>
                  <p class="text-muted">{{$user->phone}}</p>

                  <hr>

                  <strong><i class="fa fa-users" aria-hidden="true"></i> Member Since (y/m/d)</strong>
                  <p class="text-muted">{{$user->created_at}}</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div><!--/.col (left) -->         
        </div>   <!-- /.row -->
    
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection
@extends('layouts.app')

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
 <!-- left column -->
 <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create User </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('users.store')}}">
              @csrf
                <div class="card-body">
                <div class="row">

                  <div class="col-6">
                  <div class="form-group">
                    <label for="inputFirstname">First Name</label>
                    <input type="text" class="form-control" id="inputFirstname" placeholder="Enter first name" name="first_name" value="{{ old('first_name') }}">
                  </div>
                  </div>

                  <div class="col-6">
                  <div class="form-group">
                                      <label for="inputLastname">Last Name</label>
                                      <input type="text" class="form-control" id="inputLastname" placeholder="Enter last name" name="last_name" value="{{ old('last_name') }}">
                                    </div>
                  </div>
                </div>

                  <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                  </div>

                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="inputPhone" placeholder="Enter phone number" name="phone" value="{{ old('phone') }}">
                  </div>
                  <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id">
                          <option value=''>select</option>
                          @foreach($roles as $role)
                          <option value='{{$role->id}}'>{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  

                  <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword"  name="password">
                  </div>
                  <div class="form-group">
                    <label >Confirm Password</label>
                    <input type="password" class="form-control" id="confirm"  name="password_confirmation">
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
</div>
</div>
</section>
@endsection
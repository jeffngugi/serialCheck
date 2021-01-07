<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}">
        <img src="/images/logo.jpg"
             alt="AdminLTE Logo"
             class="brand-image elevation-1 m-0">
        </a>
    </div>
    @if(session()->get('error'))
    <div class="alert alert-danger alert-dismissible">
      {{ session()->get('error') }}  
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </div>
  @endif

    @if(session()->get('errors'))
    <div class="alert alert-danger alert-dismissible">
   {!! implode('', $errors->all('<div>:message</div>')) !!}
     
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

    </div>
  @endif

  @if(session()->get('error'))
    <div class="alert alert-danger alert-dismissible">
   {!! implode('', $errors->all('<div>:message</div>')) !!}
     
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

    </div>
  @endif
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Change Password to Continue</p>

            <form method="post" action="{{ url('/change') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="password"
                           name="old_password"
                           placeholder="Old Password"
                           class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    

                </div>
                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="New Password"
                           class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                        

                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password_confirmation"
                           placeholder="Confirm Password"
                           class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <p class="mb-1">
            <a href="{{ url('/logout') }}"> Not Me. Logout </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
`
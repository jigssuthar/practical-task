<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Admin Login</title>
</head>
<body>
  {{-- <div class="wrapper fadeInDown">
    <div id="formContent">
      <div class="fadeIn first">
        <h6><b>Admin Login</b></h6>
      </div>
      <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <input type="text" id="login" class="fadeIn second" name="email" placeholder="Enter email address">
        @error('email')
            <div>{{ $message }}</div>
        @enderror
        <input type="password" name="password" id="password" class="fadeIn third" name="login" placeholder="Enter password">
        @error('password')
            <div>{{ $message }}</div>
        @enderror
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>
  
      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="{{url('admin/register')}}">create new account?</a>
      </div>
  
    </div>
  </div> --}}
  <div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Admin Sign In Here</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                </div>     

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        
                      <form action="{{ route('admin.login') }}" class="form-horizontal" role="form" method="POST">
                        @csrf
                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="login-username" type="email" class="form-control" name="email" value="" placeholder="username or email">                                        
                                </div>
                                @error('email')
                                <div>{{ $message }}</div>
                            @enderror
                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                </div>
                                @error('password')
                                <div>{{ $message }}</div>
                            @enderror

                            
                        <div class="input-group">
                                  <div class="checkbox">
                                    <label>
                                      <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                    </label>
                                  </div>
                                </div>


                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">
                                  <button type="submit" class="btn btn-success"> Login  </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account! 
                                    <a href="{{url('admin/register')}}">
                                        Sign Up Here
                                    </a>
                                    </div>
                                </div>
                            </div>    
                        </form>     



                    </div>                     
                </div>  
    </div>
    
</div>
    </body>
</html>

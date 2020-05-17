<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{url('assets/library/template/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    
    <!-- Main css -->
    <link rel="stylesheet" href="{{url('assets/library/template/css/style_login.css')}}">
</head>
<body>

<div class="main">
    
    <!-- Sign in Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{url('assets/library/template/images/signin-image.jpg')}}" alt="sing up image"></figure>
                    <a href="{{url('/signup')}}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign in</h2>
                    <form method="POST" class="register-form" action="{{url('/login/action')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" placeholder="Password" required/>
                        </div>
                        <!-- <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div> -->
                        <div class="form-group form-button">
                            <input type="submit" class="form-submit" value="Login"/>
                        </div>
                    </form>
                    <!-- <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

</div>

    <!-- JS -->
    <script src="{{url('assets/library/jquery/jquery-3.4.1.js')}}"></script>
    <script src="{{url('assets/library/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>
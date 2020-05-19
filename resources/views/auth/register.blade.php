@extends('layouts.sign')


@section('content')
<section class="signup">
            <div class="container" style="margin-top:50px">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input id="re_pass" type="password" class="form-control" name="password_confirmation" placeholder="Repeat your password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color:red">{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="upload/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
        @endsection
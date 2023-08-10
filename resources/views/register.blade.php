<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <div class="container"><br>
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">FORM REGISTER USER</h3>
            <hr>
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
            @endif
            @if(Session::has('failed'))
            <div class="alert alert-danger">
                {{ Session::get('failed') }}
                @php
                    Session::forget('failed');
                @endphp
            </div>
            @endif
            
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
            </div>
            @endif
            
            @if (Session::has('error_validate'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (Session::get('error_validate') as $error)
                        @if(count($error) > 0)
                            @foreach($error as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{route('actionregister')}}" method="post">
            @csrf
                <div class="form-group">
                    <label><i class="fa fa-user"></i> Firstname</label>
                    <input type="text" name="firstname" class="form-control" placeholder="Firstname" required="" value="{{ old('firstname') }}">
                </div>
                <div class="form-group">
                    <label><i class="fa fa-user"></i> Lastname</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" required="" value="{{ old('lastname') }}">
                </div>
                <div class="form-group">
                    <label><i class="fa fa-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" required="" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label><i class="fa fa-key"></i> Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <div class="form-group">
                    <label><i class="fa fa-key"></i> Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Register</button>
                <hr>
                <p class="text-center">Sudah punya akun silahkan <a href="{{url('/')}}">Login Disini!</a></p>
            </form>
        </div>
    </div>
</body>
</html>

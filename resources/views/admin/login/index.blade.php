<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理后台登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/admin/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/font-awesome.css') }}" rel="stylesheet" />
    @yield('css')
</head>
<body style="background-color: #E2E2E2;">
<div class="container">
    <div class="row text-center " style="padding-top:100px;">
        <div class="col-md-12">
            <img src="{{ asset('images/admin/logo-invoice.png') }}" />
        </div>
    </div>
    <div class="row ">

        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

            <div class="panel-body">
                <form action="{{ url('auth/admin/login') }}" method="post">
                    <input class="hidden" type="checkbox" name="remember" checked>
                    {{ csrf_field() }}
                    <hr />
                    <h5>教育平台登录</h5>
                    <br />
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                        <input type="text" class="form-control" placeholder="Email" required="" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                        <input type="password" class="form-control" placeholder="Password" required="" name="password">
                    </div>
                    <div>
                        {{--成功或者错误提示--}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('alert-message'))
                            <div class="alert {{session('alert-class')}}">
                                <ul>
                                    <li>{{ session('alert-message') }}</li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <button class="btn btn-primary " type="submit">登录</button>

                </form>
            </div>

        </div>


    </div>
</div>

</body>


@yield('js')
</body>
</html>
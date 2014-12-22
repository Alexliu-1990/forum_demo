<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
    <title>forum demo</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="title.ico" type="image/x-icon" rel="shortcut icon"/>

    <!--FONT-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic' rel='stylesheet' type='text/css'>

    <!--CSS-->
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/skeleton.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('simditor/styles/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('simditor/styles/simditor.css')}}" />

</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <p id="title"><a href="{{URL::to('/')}}">light forum</a></p>
                <ul class="navprofile">
                    @if(Auth::check())
                        @if(Auth::user()->admin == 1)
                        <li><a href="{{URL::to('admin')}}">后台</a></li>
                        @endif
                        <li><a href="{{URL::to('logout')}}">注销</a></li>
                        <li>您好！{{Auth::user()->nickname}},</li>
                    @else
                        <li><a href="{{URL::to('login')}}">登录</a></li>
                        <li><a href="{{URL::to('register')}}">注册</a></li>
                    @endif
                </ul>
            </div>
            <nav class="navbar">
                <div class="container">
                    <hr>
                    <div class="row">
                        <ul class="navlist">
                            <li><a href="{{URL::route('catgory.show', array(Catgory::where('name', '=', 'entertainment1')->first()->id))}}">板块1</a></li>
                            <li><a href="{{URL::route('catgory.show', array(Catgory::where('name', '=', 'entertainment2')->first()->id))}}">板块2</a></li>
                            <li><a href="{{URL::route('catgory.show', array(Catgory::where('name', '=', 'entertainment3')->first()->id))}}">板块3</a></li>
                            <li><a href="{{URL::route('catgory.show', array(Catgory::where('name', '=', 'entertainment4')->first()->id))}}">板块4</a></li>
                        </ul>
                    </div>
                    <hr>
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        <div class="row forum">
            @if(Session::has('setErrors'))
                <p>{{Session::get('setErrors')}}</p>
            @endif
        </div>
        @yield('body')
    </div>
    <footer class="bottom">
        <div class="container">
            <div class="row">
                <ul>
                    <li><a href="#">定义1</a></li>
                    <li><a href="#">定义2</a></li>
                    <li><a href="#">定义3</a></li>
                    <li><a href="#">定义4</a></li>
                    <li><a href="#">定义5</a></li>
                </ul>
            </div>
            <div class="row foot">
                <p>Copyright &copy; 2014 AlexLiu</p>
            </div>
        </div>
    </footer>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('simditor/scripts/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('simditor/scripts/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('simditor/scripts/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('simditor/scripts/simditor.js')}}"></script>

    @yield('inclu')
</body>
</html>

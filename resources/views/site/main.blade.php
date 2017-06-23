<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BarCode</title>

    <link rel="shortcut icon" href="{{asset('images/front/icon_logo_16.png')}}" type="image/png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/bar.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">


    {{--<script src="//code.jquery.com/jquery-1.12.4.js"></script>--}}
   {{-- <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    <script src="{{asset('js/jquery-1.12.4.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>


</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Kittano</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li class="active"><a href="{{action('JurnalsController@test')}}">Test</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-database" aria-hidden="true"> БД </i><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{action('ArticlesController@index')}}"><i class="fa fa-newspaper-o" aria-hidden="true"> Ассортимент </i></a></li>
                        <li><a href="{{action('CategoriesController@index')}}"><i class="fa fa-folder-open" aria-hidden="true"> Категория </i></a></li>
                        <li><a href="{{action('GroupsController@index')}}"><i class="fa fa-object-group" aria-hidden="true"> Группа </i></a></li>
                        <li><a href="{{action('SkladController@index')}}"><i class="fa fa-home" aria-hidden="true"> Точка </i></a></li>
                        <li><a href="{{action('ContragentsController@index')}}"><i class="fa fa-male" aria-hidden="true"> Контрагенты </i></a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"> Действия </i><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{action('JurnalsController@purchase')}}"><i class="fa fa-arrow-down" aria-hidden="true"> Покупка </i></a></li>
                        <li><a href="{{action('JurnalsController@sale')}}"><i class="fa fa-arrow-up" aria-hidden="true"> Продажа </i></a></li>
                        <li><a href="{{action('JurnalsController@delivery')}}"><i class="fa fa-arrow-right" aria-hidden="true"> Выдача </i></a></li>
                        <li><a href="{{action('JurnalsController@receipt')}}"><i class="fa fa-arrow-left" aria-hidden="true"> Получение </i></a></li>
                        <li><a href="{{action('JurnalsController@refund')}}"><i class="fa fa-undo" aria-hidden="true"> Возврат </i></a></li>
                        <li><a href="{{action('JurnalsController@discard')}}"><i class="fa fa-reply-all" aria-hidden="true"> Брак </i></a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"> Состояние </i><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{action('JurnalsController@index')}}"><i class="fa fa-list" aria-hidden="true"> Журнал </i></a></li>
                        <li><a href="{{action('JurnalsController@balance')}}"><i class="fa fa-balance-scale" aria-hidden="true"> Наличие </i></a></li>
                        <li><a href="{{action('JurnalsController@balance')}}"><i class="fa fa-calculator" aria-hidden="true"> Отчёты </i></a></li>

                    </ul>
                </li>

            </ul>

            <div class="col-sm-3 col-md-3">
                <form class="navbar-form" role="search" method="POST" action="{{action('ArticlesController@find')}}" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Поиск" name="q22">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Sklad Links -->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Cookie::get('sklad') }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{action('HomeController@delsklad')}}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>

            </ul>
        </div>
    </div>
</nav>

<div id="content">
    @yield('content')
</div>
<br><br>
<div class="navbar-fixed-bottom row-fluid">
    <div class="navbar-inner">

            <div class="footer small">
                <i class="fa fa-cube" aria-hidden="true"> 2017</i>
            </div>


    </div>
</div>

<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap-filestyle.min.js')}}"></script>

<script src="{{asset('js/bar.js')}}"></script>
</body>
</html>

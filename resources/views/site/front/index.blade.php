@extends('site.main')
@section('content')
<div class="container">
    <div class="my-flex-container">
        <div class="my-flex-block">
            <figure>
                <a href=""><img class="img-responsive" alt="" src="{{asset('images/front/first_80.png')}}"></a>
                <figcaption>Покупка</figcaption>
            </figure>
        </div>
        <div class="my-flex-block">
            <figure>
                <a href=""><img class="img-responsive" alt="" src="{{asset('images/front/buy.png')}}"></a>
                <figcaption>Продажа</figcaption>
            </figure>
        </div>
        <div class="my-flex-block">
            <figure>
                <a href=""><img class="img-responsive" alt="" src="{{asset('images/front/sent.png')}}"></a>
                <figcaption>Выдать</figcaption>
            </figure>
        </div>
        <div class="my-flex-block">
            <figure>
                <a href=""><img class="img-responsive" alt="" src="{{asset('images/front/first_80.png')}}"></a>
                <figcaption>Продажа</figcaption>
            </figure>
        </div>
    </div>
</div>

@stop
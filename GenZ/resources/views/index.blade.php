@extends('layouts.app')
@section('content')
<!-- Styles -->
  <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>
            <h1> test {{ format_curency(100000000,'VND') }} VND</h1>

            <div class="links">
                <a href="https://laravel.com/docs">Documentation</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
@endsection
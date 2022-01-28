@extends('home.master')
@section('content')
<!--====================================================
 
<!--====================================================
                       HOME-P
======================================================-->
    <div id="home-p" class="home-p pages-head1 text-center" style="padding: 25px; margin: 10px 0 10px 0 ; background-color: rgb(0, 0, 0);">
      <div class="container">
        <p><small>{{$news_detail->news_name}}</small></p>
      </div><!--/end container-->
    </div> 

<!--====================================================
                        single-news-p1
======================================================--> 
    <section id="single-news-p1" class="single-news-p1">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
             <div class="single-news-desc m-0 pt-1 pb-0 px-0">
                <h3>{{$news_detail->news_name}}</h3>
                <ul class="list-inline">
                  <li>Posted: <span class="text-theme-colored2"> {{$news_detail->created_at}}</span></li>
                  <li>By: <span class="text-theme-colored2">Admin</span></li>
                  <li><i class="fa fa-comments-o"></i> 1 comments</li>
                </ul>
                <hr>
                <div class="bg-light-gray">
                  <div>
                    {!!$news_detail->news_content!!} 
                  </div> 
                </div> 
              </div>
          </div>
          <div class="col-md-4">
            <div class="small-news-box">
              @foreach($lasted_new as $item_news)
                <a href="">
                  <div class="right-side-sn-cont">
                    <img src="{{url('').$item_news->news_image}}" alt="" class="img-fluid">
                    <p>{!!$item_news->news_name!!}</p>
                    <small><fa class="fa-watch"> {{$item_news->created_at}}</fa></small>
                  </div>
                </a>
                @endforeach
                
              </div>
            </div> 
        </div>
      </div>
    </section>
@endsection
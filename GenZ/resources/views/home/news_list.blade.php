@extends('home.master')
@section('content')
<!--====================================================
 
<!--====================================================
                       HOME-P
======================================================-->
    <div id="home-p" class="home-p pages-head1 text-center" style="background:url({{url(''.$list_news->list_icon)}}); padding: 15px; margin: 10px 0 10px 0 ; background-color: rgb(0, 0, 0);">
      <div class="container">
        <h3 class="wow fadeInUp" data-wow-delay="0.1s" style="color: #ffffff;">{{$mod_item->mod_name}}</h3>
        <p><small>{{$list_news->list_name}}</small></p>
      </div><!--/end container-->
    </div> 

<!--====================================================
                        single-news-p1
======================================================--> 
    <section id="single-news-p1" class="single-news-p1">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            @if($news->count() >0)
            @foreach($news as $item)
            <div class="single-news-p1-cont" style="margin-bottom: 30px; box-shadow: 1px 1px 1px rgba(0,0,0,0.1);">
              <div class="single-news-img">
                <img src="{{url('').$item->news_image}}" alt="" class="img-fluid">
              </div>
              <div class="single-news-desc m-0 pt-1 pb-0 px-0">
                <h3>{{$item->news_name}}</h3>
                <ul class="list-inline">
                  <li>Posted: <span class="text-theme-colored2"> {{$item->created_at}}</span></li>
                  <li>By: <span class="text-theme-colored2">Admin</span></li>
                  <li><i class="fa fa-comments-o"></i> 1 comments</li>
                </ul>
                <hr>
                <div class="bg-light-gray">
                  <div>
                    {!!$item->news_intro!!} 
                  </div> 
                  <a href="{{url('/chi-tiet/'.$item->id.'-'.$item->news_slug)}}" class="mb-2">Xem chi tiết<i class="fa fa-long-arrow-right"></i></a>
                </div> 
              </div>
            </div>
            @endforeach
            @else
               <div class="single-news-desc" style="padding: 30px;">
                <h2>Hiện chưa có bản tin nào trong mục này.</h2>
               </div>
            @endif
  
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
@extends('layouts.site')

@section('child-ui')
<!-- Blog Details Hero Begin -->
<section class="blog-details-hero bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{$blog->title}}</h2>
                    <ul>
                        <li>{{$blog->author}}</li>
                        <li>{{$blog->created_at}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <h4>Tags</h4>
                        <ul>
                            <li><a href="#">{{$blog->tag}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <img src="{{url('public/frontend/img/blog')}}/{{$blog->img}}" alt="">
                    <p>{{$blog->description}}</p>

                </div>
                <div class="blog__details__content">
                    <div class="row">
           
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Tags: </span>{{$blog->tag}}</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Post You May Like</h2>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="row">
            @foreach($review as $item)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{url('public/frontend')}}/img/Blog/{{$item->img}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i>{{$item->created_at}}</li>
                        </ul>
                        <h5><a href="{{route('blogdetail', ['id' => $item->blog_id])}}">{{$item->title}}</a></h5>
                        <p>{{Str::limit($item->description, 100)}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
</section>
<!-- Related Blog Section End -->
@endsection
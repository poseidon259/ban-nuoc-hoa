@extends('layouts.site')

@section('child-ui')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Bài viết</h2>
                    <div class="breadcrumb__option">
                        <a href="./">Trang chủ</a>
                        <span>Bài viết</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__item">
                        <h4>Liên quan</h4>
                        <ul>
                            @foreach ($blog as $item)
                                <li><a>{{$item->tag}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach ($blog as $item)
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{url('public/frontend')}}/img/blog/{{$item->img}}" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i>{{$item->created_at}}</li>
                                    </ul>
                                    <h5><a>{{$item->title}}</a></h5>
                                    <p>{{Str::limit($item->description, 100)}}</p> </p>
                                    <a href="{{route('blogDetail', ['id' => $item->blog_id])}}" class="blog__btn">CHI TIẾT <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$blog->links()}}
            </div>

        </div>
    </div>
</section>
<!-- Blog Section End -->

@stop()

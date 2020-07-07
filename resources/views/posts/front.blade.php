@extends('layouts.front')
@section('title')
    show post
@endsection
@section('header')
<header class="header text-white h-fullscreen pb-80" style="background-image: url({{asset("storage/".$post->image)}});" data-overlay="9">
    <div class="container text-center">

    <div class="row h-100">
        <div class="col-lg-8 mx-auto align-self-center">

        <p class="opacity-70 text-uppercase small ls-1">{{$post->category->name}}</p>
        <h1 class="display-4 mt-7 mb-8">{{$post->title}}</h1>
        <p><span class="opacity-70 mr-1">By </span> <a class="text-white" href="#">{{$post->user->name}}</a></p>
        <p>{{$post->user->email}}</p>

        </div>

        <div class="col-12 align-self-end text-center">
        <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
        </div>

    </div>

    </div>
</header>

@endsection
@section('content')
<div class="container">

    <div class="mt-10 mb-10">
        <h3>content </h3>
        <p>{!! $post->content !!}</p>
    </div>
    <div class="mt-10 mb-10">
        <h4>description</h4>
        <p>{!! $post->description !!}</p>
    </div>
    <div class="gap-xy-2 mt-6   mb-10">
        @foreach ($post->tags as $tag)
        <a href="{{route('show.tag.posts',$tag->id)}}" class="badge badge-pill badge-secondary">{{$tag->name}}</a>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        
        @endforeach
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        
    </div>
    <div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5efe1b87c073544b"></script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_inline_share_toolbox"></div>
    </div>
    <div id="disqus_thread"></div>
    <script>


    var disqus_config = function () {
    this.page.url ="{{env('APP_URL')}}/show-post/{{$post->id}}";
    this.page.identifier = "{{$post->id}}";
    };

    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://saas-blog-tgzsmmfi6h.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

</div>


@endsection

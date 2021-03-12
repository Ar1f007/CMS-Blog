@extends('layouts.blog')

@section('title')
Blogosphere
@endsection

@section('header')
<!-- Header -->
<header class="header text-center text-white"
    style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
    <div class="container">

        <div class="row">
            <div class="col-md-8 mx-auto">

                <h1>Welcome to Blogosphere</h1>
                <p class="lead-2 opacity-90 mt-6">Let's read and get updated together</p>

            </div>
        </div>

    </div>
</header><!-- /.header -->
@endsection

@section('content')
<!-- Main Content -->
<main class="main-content">
    <div class="section bg-gray">
        <div class="container">
            <div class="row">


                <div class="col-md-8 col-xl-9">
                    <div class="row gap-y">
                        @forelse ($posts as $post)
                        <div class="col-md-6">
                            <div class="card border hover-shadow-6 mb-6 d-block">
                                <a href="{{ route('blog.show', $post->id) }}"><img class="card-img-top"
                                        src="{{ asset('/storage/' . $post->image)}}" alt="post image"></a>
                                <div class="p-6 text-center">
                                    <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400"
                                            href="">{{$post->category->name}}</a>
                                    </p>
                                    <h5 class="mb-0"><a class="text-dark"
                                            href="{{ route('blog.show', $post->id) }}">{{$post->title}}</a></h5>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-6">
                            <p class="lead-2 text-center mt-6">
                                No result found for <b>{{ request()->query('search') }}</b>
                            </p>
                        </div>
                        @endforelse

                    </div>

                    {{ $posts->appends(['search' => request()->query('search')])->links() }}
                </div>



                <div class="col-md-4 col-xl-3">
                    <div class="sidebar px-4 py-md-0">

                        <h6 class="sidebar-title">Search</h6>
                        <form class="input-group" action={{ route('welcome') }} method="GET">
                            <input type="text" class="form-control" name="search" placeholder="Search"
                                value={{ request()->query('search') }}>
                            <div class="input-group-addon">
                                <span class="input-group-text"><i class="ti-search"></i></span>
                            </div>
                        </form>

                        <hr>

                        <h6 class="sidebar-title">Categories</h6>
                        <div class="row link-color-default fs-14 lh-24">

                            @foreach ($categories as $category)
                            <div class="col-6"><a href="#">{{ $category->name }}</a></div>
                            @endforeach
                        </div>

                        <hr>

                        <h6 class="sidebar-title">Tags</h6>
                        <div class="gap-multiline-items-1">
                            @foreach ($tags as $tag)
                            <a class="badge badge-secondary" href="#">{{ $tag->name}}</a>
                            @endforeach
                        </div>

                        <hr>

                        <h6 class="sidebar-title">About</h6>
                        <p class="small-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium
                            aperiam fugit dolores. Asperiores incidunt eum voluptates vero, cupiditate soluta cum
                            quia, rem illo, cumque qui consectetur ipsum provident in ipsam.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection
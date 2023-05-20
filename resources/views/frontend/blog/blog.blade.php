@extends('layouts.frontend.base')
@section('title')
    Blogs
@endsection

@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('static/f/img/banner/blog.JPG') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text black_heading_text">
                        <h2>BLOG</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('front.blogs') }}">Home</a>
                            <span>Blog</span>
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
                        <div class="blog__sidebar__search">
                            <form action="{{ route('front.blogs') }}">
                                <input type="text" name="search" value="{{ request()->query('search') }}"
                                    placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="{{ route('front.blogs') }}">All</a></li>
                                @foreach (request()->categories as $category)
                                    @if ($category->blogs->count())
                                        <li><a @if ($category->slug == request()->query('category')) class="text-primary" @endif
                                                href="{{ route('front.blogs', ['category' => $category->slug]) }}">{{ $category['name_' . app()->getLocale()] }}
                                                ({{ $category->blogs->count() }})
                                            </a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Recent Blogs</h4>
                            <div class="blog__sidebar__recent">
                                @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(5)->get() as $blog)
                                    <a href="{{ route('front.single_blog', ['slug' => $blog->slug]) }}"
                                        class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="/static/f/img/blog/sidebar/sr-1.jpg" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{ $blog->title }}</h6>
                                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="/static/f/img/blog/blog-2.jpg" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('M d, Y') }}
                                            </li>
                                            <li><i class="fa fa-comment-o"></i> {{ $blog->views }}</li>
                                        </ul>
                                        <h5><a
                                                href="{{ route('front.single_blog', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                        </h5>
                                        <p>{!! Str::substr($blog->short_desc, 0, 100) . '...' !!} </p>
                                        <a href="{{ route('front.single_blog', ['slug' => $blog->slug]) }}"
                                            class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-12">
                            <div class="custom_pagination">
                                {{ $blogs->appends($_GET)->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            if ("{{ request()->query('search') }}".length > 3) {
                $('.blog__item__text h5 a, .blog__item__text p').each(function(index, element) {
                    var src_str = $(this).text();
                    var term = "{{ request()->query('search') }}";
                    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                    var pattern = new RegExp("(" + term + ")", "gi");

                    src_str = src_str.replace(pattern, "<mark>$1</mark>");
                    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,
                        "$1</mark>$2<mark>$4");

                    $(this).html(src_str);
                });
            };
        });
    </script>
@endpush

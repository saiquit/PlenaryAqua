@extends('layouts.frontend.base')
@section('title')
    Single
@endsection

@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="/static/f/img/blog/details/details-hero.jpg"
        style="background-image: url(/static/f/img/blog/details/details-hero.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{ $blog->title }}</h2>
                        <ul>
                            <li>By {{ $blog->author_name }}</li>
                            <li>{{ $blog->created_at->format('M d, Y') }}</li>
                            <li>{{ $blog->views }} {{ Str::plural('View', $blog->views) }}</li>
                        </ul>
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
                                @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(5)->get() as $r_blog)
                                    <a href="#" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img width="100" src="{{ url('storage/' . $blog->cover_img, []) }}"
                                                alt="">
                                            {{-- <img src="/static/f//static/f/img/blog/sidebar/sr-1.jpg" alt=""> --}}
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{ $r_blog->title }}</h6>
                                            <span>{{ $r_blog->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="{{ url('storage/' . $blog->cover_img, []) }}" width="100%" alt="">
                        {!! $blog->content !!}
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    {{-- <div class="blog__details__author__pic">
                                        <img src="/static/f/img/blog/details/details-author.jpg" alt="">
                                    </div> --}}
                                    <div class="blog__details__author__text pt-0">
                                        <h6>{{ $blog->author_name }}</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Categories:</span>
                                            @foreach ($blog->categories as $category)
                                                {{ $category['name_en'] }}
                                            @endforeach
                                        </li>
                                        {{-- <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li> --}}
                                    </ul>
                                    <div class="blog__details__social">
                                        <a target="_blank" rel="noopener noreferrer"
                                            href="https://www.facebook.com/Plenaryaqua5"><i class="fa fa-facebook"></i></a>

                                        <a target="_blank" rel="noopener noreferrer"
                                            href="https://www.instagram.com/plenaryaqua"><i class="fa fa-instagram"></i></a>
                                        {{-- <a href="#"><i class="fa fa-envelope"></i></a> --}}
                                    </div>
                                </div>
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

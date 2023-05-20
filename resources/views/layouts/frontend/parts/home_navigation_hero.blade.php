 <!-- Hero Section Begin -->
 <section class="hero">
     <div class="container">
         <div class="row">
             <div class="col-lg-3">
                 <div class="hero__categories">
                     <div class="hero__categories__all">
                         <i class="fa fa-bars"></i>
                         <span>All departments</span>
                     </div>
                     <ul class="main__cats">
                         @foreach (request()->categories as $category)
                             @if ($category->subcategory->count())
                                 <li class="@if (request()->query('category_id') == $category->id) active @endif">
                                     <a
                                         href="{{ route('front.shop', array_merge($_GET, ['category_id' => $category->id])) }}">{{ Str::ucfirst($category['name_' . app()->getLocale()]) }}</a>
                                     <ul class="sub__cats">
                                         @foreach ($category->subcategory as $subCat)
                                             <li class="@if (request()->query('category_id') == $subCat->id) active @endif">
                                                 <a
                                                     href="{{ route('front.shop', array_merge($_GET, ['category_id' => $subCat->id])) }}">{{ Str::ucfirst($subCat['name_' . app()->getLocale()]) }}</a>
                                         @endforeach
                                     </ul>
                                 </li>
                             @elseif (!$category->parent)
                                 <li class="@if (request()->query('category_id') == $category->id) active @endif">
                                     <a
                                         href="{{ route('front.shop', array_merge($_GET, ['category_id' => $category->id])) }}">{{ Str::ucfirst($category['name_' . app()->getLocale()]) }}</a>
                                 </li>
                             @endif
                         @endforeach
                     </ul>
                 </div>
             </div>
             <div class="col-lg-9">
                 <div class="hero__search">
                     <div class="hero__search__form">
                         <form action="{{ route('front.shop') }}" method="GET">
                             <div class="hero__search__categories">
                                 <b>
                                     @if (request()->query('category_id'))
                                         {{ request()->categories->find(request()->query('category_id'))['name_' . app()->getLocale()] }}
                                     @else
                                         All Categories
                                     @endif
                                 </b>
                                 <span class="arrow_carrot-down"></span>
                             </div>
                             <input type="text" name="product_name" value="{{ request()->query('product_name') }}"
                                 placeholder="What do yo u need?">
                             <input type="text" hidden value="{{ request()->query('category_id') }}"
                                 name="category_id" id="search_cat">
                             <button type="submit" class="site-btn">SEARCH</button>
                         </form>
                     </div>
                     <div class="hero__search__phone">
                         <div class="hero__search__phone__icon">
                             <a href="tel:+8801984955695">
                                 <i class="fa fa-phone"></i>
                             </a>
                         </div>
                         <div class="hero__search__phone__text">
                             <h5>01984955695</h5>
                             <span>support business hours</span>
                         </div>
                     </div>
                 </div>
                 <div class="categories_list">
                     <ul>
                         @foreach (request()->categories as $category)
                             <li data-id="{{ $category->id }}">{{ $category['name_' . app()->getLocale()] }}</li>
                         @endforeach
                     </ul>
                 </div>
                 <div class="hero__slider owl-carousel ">
                     @foreach (DB::table('slides')->orderBy('created_at', 'desc')->get() as $item)
                         @if ($item->active)
                             <img src="{{ url('storage/' . $item->image) }}" alt="">
                             {{-- <div class="hero__item set-bg" data-setbg="{{ }}"> --}}
                             {{-- <div class="hero__text">
                                     <span>{{ App\Models\Category::where('id', $item->category_id)->first()['name_' . app()->getLocale()] }}</span>
                                     <h2>{{ collect($item)['heading_' . app()->getLocale()] }}</h2>
                                     <p>{{ collect($item)['sub_heading_' . app()->getLocale()] }}</p>
                                     <a href="{{ route('front.shop', ['category_id' => $item->category_id]) }}"
                                         class="primary-btn">SHOP NOW</a>
                                 </div> --}}
                             {{-- </div> --}}
                         @endif
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Hero Section End -->

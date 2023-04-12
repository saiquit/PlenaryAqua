  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
          <a href="#"><img src="/static/f/img/logo.png" alt=""></a>
      </div>
      <div class="humberger__menu__cart">
          <ul>
              {{-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> --}}
              <li><a href="{{ route('front.cart') }}"><i class="fa fa-shopping-bag"></i>
                      <span>{{ session()->has('cart.items') ? count(session('cart.items')) : 0 }}</span></a></li>
          </ul>
          <div class="header__cart__price">item:
              <span>${{ session()->has('cart.subTotal') ? session('cart.subTotal') : 0 }}</span>
          </div>
      </div>
      <div class="humberger__menu__widget">
          <div class="header__top__right__language ">
              <div>
                  {{ App\Models\District::where('id', session('district'))->first()['name_' . app()->getLocale()] }}
              </div>
              <span class="arrow_carrot-down"></span>
              <ul>
                  <li>
                      <a href="{{ route('front.set_district', ['district' => 1]) }}">Dhaka</a>
                      <a href="{{ route('front.set_district', ['district' => 2]) }}">Khulna</a>
                  </li>
              </ul>
          </div>
          <div class="header__top__right__language ">
              <img src="{{ asset('static/f/img/' . app()->getLocale() . '.png') }}" alt="">
              <div>{{ Str::upper(session('locale')) }}</div>
              <span class="arrow_carrot-down"></span>
              <ul>
                  @foreach (Config::get('app.available_locales') as $key => $lang)
                      <li>
                          <a href="{{ route(Route::currentRouteName(), ['lang' => $lang]) }}">{{ $key }}</a>
                      </li>
                  @endforeach
                  {{-- <li><a href="#">English</a></li> --}}
              </ul>
          </div>
          <div class="header__top__right__auth">
              <a href="#"><i class="fa fa-user"></i> Login</a>
          </div>
      </div>
      <nav class="humberger__menu__nav mobile-menu">
          <ul>
              <li class="@if (request()->route()->getName() == 'front.home') active @endif"><a href="{{ route('front.home') }}">Home</a>
              </li>
              <li class="@if (request()->route()->getName() == 'front.shop') active @endif"><a href="{{ route('front.shop') }}">Shop</a>
              </li>
              <li><a href="#">Pages</a>
                  <ul class="header__menu__dropdown">
                      <li><a href="./shop-details.html">Shop Details</a></li>
                      <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                      <li><a href="./checkout.html">Check Out</a></li>
                      <li><a href="./blog-details.html">Blog Details</a></li>
                  </ul>
              </li>
              <li><a href="./blog.html">Blog</a></li>
              <li><a href="./contact.html">Contact</a></li>
          </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-pinterest-p"></i></a>
      </div>
      <div class="humberger__menu__contact">
          <ul>
              <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
              <li>Free Shipping for all Order of $99</li>
          </ul>
      </div>
  </div>
  <!-- Humberger End -->

  <!-- Header Section Begin -->
  <header class="header">
      <div class="header__top">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6">
                      <div class="header__top__left">
                          <ul>
                              <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                              <li>Free Shipping for all Order of $99</li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                      <div class="header__top__right">
                          {{-- <div class="header__top__right__social">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                              <a href="#"><i class="fa fa-pinterest-p"></i></a>
                          </div> --}}
                          <div class="header__top__right__language">
                              {{-- <img src="/static/f/img/language.png" alt=""> --}}
                              <div>
                                  {{ App\Models\District::where('id', session('district'))->first()['name_' . app()->getLocale()] }}
                              </div>
                              <span class="arrow_carrot-down"></span>
                              <ul>
                                  <li>
                                      <a href="{{ route('front.set_district', ['district' => 1]) }}">Dhaka</a>
                                      <a href="{{ route('front.set_district', ['district' => 2]) }}">Khulna</a>
                                  </li>
                              </ul>
                          </div>
                          <div class="header__top__right__language">
                              <img src="{{ asset('static/f/img/' . app()->getLocale() . '.png') }}" alt="">
                              <div>{{ Str::upper(session('locale')) }}</div>
                              <span class="arrow_carrot-down"></span>
                              <ul>
                                  @foreach (Config::get('app.available_locales') as $key => $lang)
                                      <li>
                                          @if (Route::is('front.single'))
                                              <a
                                                  href="{{ route(Route::currentRouteName(), ['slug' => request()->slug, 'lang' => $lang]) }}">{{ $key }}</a>
                                          @else{
                                              <a
                                                  href="{{ route(Route::currentRouteName(), ['lang' => $lang]) }}">{{ $key }}</a>

                                              }
                                          @endif
                                      </li>
                                  @endforeach
                              </ul>
                          </div>
                          @guest
                              <div class="header__top__right__auth">
                                  <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                              </div>
                          @else
                              <div class="header__top__right__auth">
                                  <a href="{{ route('front.profile', []) }}"><i class="fa fa-user"></i> Profile</a>
                              </div>
                          @endguest
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <div class="header__logo">
                      <a href="{{ route('front.home', []) }}"><img src="/static/f/img/logo.png" alt=""></a>
                  </div>
              </div>
              <div class="col-lg-6">
                  <nav class="header__menu">
                      <ul>
                          <li class="@if (Route::is('front.home')) active @endif"><a
                                  href="{{ route('front.home', []) }}">Home</a></li>
                          <li class="@if (Route::is('front.shop')) active @endif"><a
                                  href="{{ route('front.shop', []) }}">Shop</a></li>
                          <li><a href="#">Pages</a>
                              <ul class="header__menu__dropdown">
                                  <li><a href="./shop-details.html">Shop Details</a></li>
                                  <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                  <li><a href="./checkout.html">Check Out</a></li>
                                  <li><a href="./blog-details.html">Blog Details</a></li>
                              </ul>
                          </li>
                          <li><a href="./blog.html">Blog</a></li>
                          <li><a href="./contact.html">Contact</a></li>
                      </ul>
                  </nav>
              </div>
              <div class="col-lg-3">
                  <div class="header__cart">
                      <ul>
                          {{-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> --}}
                          <li>
                              <a href="{{ route('front.cart') }}">
                                  <i class="fa fa-shopping-bag"></i>
                                  <span>{{ session()->has('cart.items') ? count(session('cart.items')) : 0 }}</span>
                              </a>
                          </li>
                      </ul>
                      <div class="header__cart__price">item:
                          <span>${{ session()->has('cart.subTotal') ? session('cart.subTotal') : 0 }}</span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="humberger__open">
              <i class="fa fa-bars"></i>
          </div>
      </div>
  </header>
  <!-- Header Section End -->

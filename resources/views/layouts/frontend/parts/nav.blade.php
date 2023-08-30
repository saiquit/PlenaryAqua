  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
          <a href="#"><img src="{{ asset('/static/f/img/logo.png') }}" alt=""></a>
      </div>
      <div class="humberger__menu__cart">
          <ul>
              <li><a href="{{ route('front.love') }}"><i class="fa fa-heart"></i>
                      <span>
                          @auth
                              {{ auth()->user()->loved_products->count() }}
                          @else
                              0
                          @endauth
                      </span></a></li>
              <li><a href="{{ route('front.cart') }}"><i class="fa fa-shopping-bag"></i>
                      <span>{{ session()->has('cart.items') ? count(session('cart.items')) : 0 }}</span></a></li>
          </ul>
          <div class="header__cart__price">item:
              <span>৳{{ session()->has('cart.subTotal') ? session('cart.subTotal') : 0 }}</span>
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
          {{-- <div class="header__top__right__auth">
              <a href="#"><i class="fa fa-user"></i> Login</a>
          </div> --}}
      </div>
      <nav class="humberger__menu__nav mobile-menu">
          <ul>
              <li class="@if (request()->route()->getName() == 'front.home') active @endif"><a href="{{ route('front.home') }}">Home</a>
              </li>
              <li class="@if (request()->route()->getName() == 'front.shop') active @endif"><a href="{{ route('front.shop') }}">Shop</a>
              </li>
              <li class="@if (request()->route()->getName() == 'front.contact') active @endif"><a
                      href="{{ route('front.contact') }}">Contact</a></li>
              @auth
                  <a href="{{ route('front.orders') }}">
                      <li class="btn btn-outline-primary"><b>Orders</b></li>
                  </a>

              @endauth
              <li class="@if (request()->route()->getName() == 'front.blogs ') active @endif"><a href="{{ route('front.blogs') }}">Blog</a>
              </li>
              @guest
                  <li><a href="{{ route('login', []) }}">Login</a></li>
                  <li><a href="{{ route('register', []) }}">Register</a></li>
              @else
                  <li>
                      @if (auth()->user()->type == 'admin')
                          <a href="{{ route('admin.dashboard', []) }}"><i class="fa fa-user"></i> Admin</a>
                      @else
                          <a href="{{ route('front.profile', []) }}"><i class="fa fa-user"></i> Profile</a>
                      @endif
                  </li>
              @endguest
          </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
          <a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/Plenaryaqua5"><i
                  class="fa fa-facebook"></i></a>

          <a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/plenaryaqua"><i
                  class="fa fa-instagram"></i></a>
      </div>
      <div class="humberger__menu__contact">
          <ul>
              <li><i class="fa fa-envelope"></i> support@plenaryaqua.com </li>
              {{-- <li>Free Shipping for all Order of $99</li> --}}
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
                              <li><i class="fa fa-envelope"></i> <a
                                      href="mailto:support@plenaryaqua.com">support@plenaryaqua.com</a>
                              </li>
                              {{-- <li>Free Shipping for all Order of ৳99</li> --}}
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                      <div class="header__top__right">
                          <div class="header__top__right__social">
                              <a target="_blank" rel="noopener noreferrer"
                                  href="https://www.facebook.com/Plenaryaqua5"><i class="fa fa-facebook"></i></a>
                              <a target="_blank" rel="noopener noreferrer"
                                  href="https://www.instagram.com/plenaryaqua"><i class="fa fa-instagram"></i></a>

                              {{-- <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                              <a href="#"><i class="fa fa-pinterest-p"></i></a> --}}
                          </div>
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
                              <div class="header__top__right__auth dropdown">
                                  <a href="#" class="nav-item">Login</a>
                                  <div class="dropdown-menu">
                                      <form action="{{ route('login') }}" method="POST" class="px-4 py-3">
                                          @csrf
                                          <div class="form-group">
                                              <label for="login_email">Email address</label>
                                              <input type="email" name="email" class="form-control" id="login_email"
                                                  placeholder="email@example.com">
                                          </div>
                                          <div class="form-group">
                                              <label for="login_password">Password</label>
                                              <input type="password" name="password" class="form-control"
                                                  id="login_password" placeholder="Password">
                                          </div>
                                          <div class="form-group">
                                              <div class="form-check">
                                                  <input name="remember" type="checkbox" class="form-check-input"
                                                      id="dropdownCheck">
                                                  <label class="form-check-label" for="dropdownCheck">
                                                      Remember me
                                                  </label>
                                              </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary">Sign in</button>
                                      </form>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#"
                                          onclick="document.querySelector('#forget_button').submit()">Forgot password?</a>
                                      <form id="forget_button"
                                          action="{{ route('password.reset', ['token' => csrf_token()]) }}"
                                          method="get">
                                      </form>
                                  </div>
                              </div>
                              <div class="mx-3  border-right"></div>
                              <div class="header__top__right__auth dropdown">
                                  <a href="#" class="nav-item">Register</a>
                                  <div class="dropdown-menu">
                                      <form action="{{ route('register') }}" method="POST" class="px-4 py-3">
                                          @csrf
                                          <div class="form-group">
                                              <label for="register_name">Name</label>
                                              <input type="name" name="name" class="form-control"
                                                  id="register_name" placeholder="Your Name">
                                          </div>
                                          <div class="form-group">
                                              <label for="register_email">Email address</label>
                                              <input type="email" name="email" class="form-control"
                                                  id="register_email" placeholder="email@example.com">
                                          </div>
                                          <div class="form-group">
                                              <label for="register_phone">Phone Number</label>
                                              <input type="phone" name="phone" class="form-control"
                                                  id="register_phone" placeholder="017........">
                                          </div>
                                          <div class="form-group">
                                              <label for="register_password">Password</label>
                                              <input type="password" name="password" class="form-control"
                                                  id="register_password" placeholder="*********">
                                          </div>
                                          <div class="form-group">
                                              <label for="register_password_confirm">Confirm Password</label>
                                              <input type="password" name="password_confirmation" class="form-control"
                                                  id="register_password_confirm" placeholder="*********">
                                          </div>
                                          <button type="submit" class="btn btn-primary">Sign Up</button>
                                      </form>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#">New around here? Sign up</a>
                                      <a class="dropdown-item" href="#">Forgot password?</a>
                                  </div>
                              </div>
                          @else
                              <div class="header__top__right__auth">
                                  @if (auth()->user()->type == 'admin')
                                      <a href="{{ route('admin.dashboard', []) }}"><i class="fa fa-user"></i> Admin</a>
                                  @else
                                      <a href="{{ route('front.profile', []) }}"><i class="fa fa-user"></i> Profile</a>
                                  @endif
                              </div>
                              <div class="mx-3  border-right"></div>
                              <div class="header__top__right__auth">
                                  <a href="#" onclick="document.querySelector('#logout_form').submit();"> Logout</a>
                              </div>
                              <form id="logout_form" action="{{ route('logout', []) }}" method="post">
                                  @csrf
                              </form>
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
                      <a href="{{ route('front.home', []) }}"><img src="{{ asset('/static/f/img/logo.png') }}"
                              alt=""></a>
                  </div>
              </div>
              <div class="col-lg-6">
                  <nav class="header__menu">
                      <ul>
                          <li class="@if (Route::is('front.home')) active @endif"><a
                                  href="{{ route('front.home', []) }}">Home</a></li>
                          <li class="@if (Route::is('front.shop')) active @endif"><a
                                  href="{{ route('front.shop', []) }}">Shop</a></li>

                          <li class="@if (request()->route()->getName() == 'front.blogs') active @endif"><a
                                  href="{{ route('front.blogs') }}">Blog</a></li>
                          <li class="@if (request()->route()->getName() == 'front.contact') active @endif"><a
                                  href="{{ route('front.contact') }}">Contact</a></li>
                          @auth
                              <a href="{{ route('front.orders') }}">
                                  <li class="btn btn-outline-primary"><b>Orders</b></li>
                              </a>

                          @endauth
                      </ul>
                  </nav>
              </div>
              <div class="col-lg-3">
                  <div class="header__cart">
                      <ul>
                          <li><a href="{{ route('front.love') }}"><i class="fa fa-heart"></i>
                                  <span>
                                      @auth
                                          {{ auth()->user()->loved_products->count() }}
                                      @else
                                          0
                                      @endauth
                                  </span></a></li>
                          <li>
                              <a href="{{ route('front.cart') }}">
                                  <i class="fa fa-shopping-bag"></i>
                                  <span>{{ session()->has('cart.items') ? count(session('cart.items')) : 0 }}</span>
                              </a>
                          </li>
                      </ul>
                      <div class="header__cart__price">item:
                          <span>৳{{ session()->has('cart.subTotal') ? session('cart.subTotal') : 0 }}</span>
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

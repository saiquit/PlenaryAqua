   <!-- Footer Section Begin -->
   <footer class="footer spad">
       <div class="container">
           <div class="row">
               <div class="col-lg-3 col-md-6 col-sm-6">
                   <div class="footer__about">
                       <div class="footer__about__logo">
                           <a href="{{ route('front.home') }}"><img src="/static/f/img/logo.png" alt=""></a>
                       </div>
                       <ul>
                           <li>Address: Shop No 1, Nurani Madrasa Road, Mohammad Nagor</li>
                           <li>Phone: <a href="tel:+8801984955695">01984955695</a></li>
                           <li>Email: plenaryaqua@gmail.com </li>
                       </ul>
                   </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                   <div class="footer__widget">
                       <h6>Useful Links</h6>
                       <ul>
                           <li><a href="{{ route('front.about', []) }}">About Us</a></li>
                           {{-- <li><a href="#">About Our Shop</a></li> --}}
                           {{-- <li><a href="#">Secure Shopping</a></li> --}}
                           <li><a href="{{ route('front.terms', []) }}">Terms and Conditions</a></li>
                           <li><a href="{{ route('front.policy', []) }}">Return Policy</a></li>
                           {{-- <li><a href="#">Our Sitemap</a></li> --}}
                           <li><a href="{{ route('front.faq', []) }}">FAQ</a></li>
                           <li><a href="{{ route('front.projects', []) }}">Projects</a></li>
                           <li><a href="{{ route('front.contact', []) }}">Contact</a></li>
                       </ul>
                       <ul>
                           {{-- <li><a href="#">Our Services</a></li> --}}
                           {{-- <li><a href="#">Innovation</a></li> --}}
                           {{-- <li><a href="#">Testimonials</a></li> --}}
                       </ul>
                   </div>
               </div>
               <div class="col-lg-4 col-md-12">
                   <div class="footer__widget">
                       <h6>Join Our Newsletter Now</h6>
                       <p>Get E-mail updates about our latest shop and special offers.</p>
                       <form action="{{ route('front.store-sub') }}" method="POST">
                           @csrf
                           <input type="email" name="email" placeholder="Enter your mail">
                           <button type="submit" class="site-btn">Subscribe</button>
                       </form>
                       <div class="footer__widget__social">
                           <a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/Plenaryaqua5"><i
                                   class="fa fa-facebook"></i></a>

                           <a target="_blank" rel="noopener noreferrer" href="https://www.instagram.com/plenaryaqua"><i
                                   class="fa fa-instagram"></i></a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-3"></div>
               <div class="col-lg-6">
                   <div class="footer__copyright">
                       <div class="footer__copyright__text">
                           <p>
                               Copyright &copy;
                               <script>
                                   document.write(new Date().getFullYear());
                               </script> Plenary Aqua | All rights reserved.
                           </p>
                       </div>
                       {{-- <div class="footer__copyright__payment"><img src="/static/f/img/payment-item.png" alt=""> --}}
                       {{-- </div> --}}
                   </div>
               </div>
               <div class="col-3"></div>
           </div>
       </div>
   </footer>
   <!-- Footer Section End -->

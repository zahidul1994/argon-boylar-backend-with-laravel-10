@extends('layouts.app')
@push('css')


@endpush
@section('content')
  <!-- blog details section start -->
  <div class="blog__details__section ptb-120">
    <div class="container">
      <div class="row g-xxl-5 g-xl-5 g-0">
        <div class="col-xl-8">
          <div class="km_blog__main">
            @if($LatestBlog->isNotEmpty())
            @foreach ($LatestBlog as $blog)
            <div class="blog__one">
              <div class="blog__img img">
                <a href="{{url('blog',@$blog->slug)}}"><img src="{{ asset(@$blog->image)}}" alt="{{Str::words(@$blog->title,8)}}"
                    class="img-fluid"></a>
              </div>
              <div class="km__blog__content">
                <ul class="fc-list">
                  <li>
                    <i class="fa-regular fa-calendar"></i>
                    <span> {{ date('d-M-Y', strtotime(@$blog->created_at)) }}</span>
                  </li>
                  <li>
                    <i class="fa-regular fa-clock"></i>
                    <span> {{ date('h:iA', strtotime(@$blog->created_at)) }}</span>
                  </li>
                </ul>
                <div class="km__blog_content pt-3">
                  <a href="{{url('blog',@$blog->slug)}}">
                    <h2 class="mb-4">{{Str::words(@$blog->title,15)}}</h2>
                  </a>
                  <p class="mb-4">
                    {{Str::words(@$blog->short_description,20)}}
                  </p>
                  <a href="{{url('blog',@$blog->slug)}}" class="readmore__btn">
                    Read More
                    <span class="fs-14"><i class="fa-solid fa-angles-right"></i></span>
                  </a>
                </div>
              </div>
            </div>
            @endforeach
                        @else 
                        <div>
                            <h2 class="text-center">No Resule found</h2>
                        </div>
              @endif
              {{@$LatestBlog->withQueryString()->onEachSide(1)->links()}}
           
          </div>
        </div>
        <div class="col-xl-4">
          <div class="km__blog__sidebar">
            <div class="bl__sidebar__widget search__widget mb-4 mb-xl-5 mb-lg-5">
              <form action="{{url('/blog')}}" method="get" >
                <input  name="q" required type="search" placeholder="Search">
                <button type="submit" class="bl-submit-btn"><i class="fas fa-magnifying-glass"></i></button>
              </form>
            </div>
            <div class="bl__sidebar__widget elemontor__widget">
              <div class="bl__card">
                <div class="card__header mb-30">
                  <img src="{{asset('frontend/assets/images/blog/bl-1.png')}}" alt="images not founds" class="img-fluid">
                </div>
                <div class="card__body">
                  <h4 class="widger__title mb-30">Nicolas Markusa</h4>
                  <p class="m-0">Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
                  <ul class="bl_social d-flex align-items-center justify-content-center mt-30 gap-10">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="bl-sidebar-widget bl-category-widget mt-4 mt-xl-5 mt-lg-5">
              <h5 class="widget-title mb-3">Category</h5>
              <ul class="bl-ct-list">
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Blood Relation</a>
                </li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> AB- Blood Donor</a>
                </li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Keep Safe Blood</a>
                </li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Preserve Blood</a>
                </li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Solution</a></li>
              </ul>
            </div>
            <div class="bl-sidebar-widget bl-sidebar mt-4 mt-xl-5 mt-lg-5">
              <h5 class="widget-title mb-3">Recent Post</h5>
              <ul class="bl-rp-list">
                <li><a href="#">Donation is hope for poor helpless children</a></li>
                <li><a href="#">Don't Do This Activity After You Donating Your Blood</a></li>
                <li><a href="#">Donation is hope for poor helpless children</a></li>
                <li><a href="#">Don't Do This Activity After You Donating Your Blood</a></li>
              </ul>
            </div>
            <div class="bl-sidebar-widget bl-quick-link-widget mt-4 mt-xl-5 mt-lg-5">
              <h5 class="widget-title mb-3">Quick Link</h5>
              <ul class="bl-ct-list">
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Portfolio</a></li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Our Blog</a></li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> About</a></li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Our Team</a></li>
                <li><a href="#"><span class="me-2"><i class="fa-solid fa-arrow-right"></i></span> Contact</a></li>
              </ul>
            </div>
            <div class="bl-sidebar-widget bl-fllow-widget mt-4 mt-xl-5 mt-lg-5">
              <h5 class="widget-title mb-3">Follow Me</h5>
              <span class="spacer"></span>
              <ul class="bl-fl-list d-flex align-items-center gap-10">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
              </ul>
            </div>
            <div class="bl-sidebar-widget bl-excellence-widget mt-4 mt-xl-5 mt-lg-5">
              <div class="km__form__content custom-padding">
                <span class="sub__title mb-3 d-inline-block">Blood Excellence!</span>
                <h4 class="mb-30 text-white">Expanded Blood Donate Services Here</h4>
                <p class="form_des mb-40">
                  On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and
                  demoralized by the charms
                </p>
                <a href="#" class="customs__btn">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- blog details section ends -->



</section>
  
<!-- donate form start -->
@endsection
@push('js')

<script>


  </script>
@endpush

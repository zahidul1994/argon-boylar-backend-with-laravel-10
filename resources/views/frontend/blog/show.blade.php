@extends('layouts.app')
@push('css')
<style>
    .blod-info {
        display: flex
    }
  
    .blod-info li {
        padding-right: 20px;
        list-style: none;
        color: #aaa;
        display: flex;
        align-items: center
    }
  
    .blod-info li svg {
        margin-right: 5px
    }
  
    .blod-info li a {
        color: #aaa
    }
  
    .blod-info li a:hover {
        color: #00f
    }
  
    #social-links {
        display: inline-block
    }
  
    #social-links ul {
        margin-bottom: 0 !important;
        padding-left: 0 !important;
        margin-right: 10px
    }
  
    #social-links ul li {
        list-style: none
    }
  
    #social-links ul li a span {
        font-size: 22px;
        color: #0d6efd
    }
  
  
  
    .cke_editable {
        font-size: 16px;
        line-height: 1.6;
        word-wrap: break-word
    }
  
    blockquote {
        font-style: italic;
        font-family: Georgia, Times, "Times New Roman", serif;
        padding: 2px 0;
        border-style: solid;
        border-color: #ccc;
        border-width: 0
    }
  
    .cke_contents_ltr blockquote {
        padding-left: 20px;
        padding-right: 8px;
        border-left-width: 5px
    }
  
    .cke_contents_rtl blockquote {
        padding-left: 8px;
        padding-right: 20px;
        border-right-width: 5px
    }
  
    a {
        color: #0782c1
    }
  
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 400 !important;
        line-height: 1.2 !important
    }
  
    hr {
        border: 0;
        border-top: 1px solid #ccc
    }
  
    img.right {
        border: 1px solid #ccc;
        float: right;
        margin-left: 15px;
        padding: 5px
    }
  
    img.left {
        border: 1px solid #ccc;
        float: left;
        margin-right: 15px;
        padding: 5px
    }
  
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        -moz-tab-size: 4;
        tab-size: 4
    }
  
    .marker {
        background-color: #ff0 !important
    }
  
    span[lang] {
        font-style: italic
    }
  
    figure {
        text-align: center;
        border: solid 1px #ccc;
        border-radius: 2px;
        background: rgba(0, 0, 0, .05);
        padding: 10px;
        margin: 10px 20px;
        display: inline-block
    }
  
    figure>figcaption {
        text-align: center;
        display: block
    }
  </style>
@endpush
@section('content')
   <!-- section blog details start -->
   <section class="km__blog__details ptb-120">
    <div class="container">
      <div class="blog__img mb-30">
        <img src="{{ asset(@$blogDetails->image)}}" alt="{{Str::words(@$blogDetails->title,8)}}" class="img-fluid">
      </div>
      <ul class="fc-list mb-30">
        <li>
            <i class="fa-regular fa-calendar"></i>
            <span> {{ date('d-M-Y', strtotime(@$blog->created_at)) }}</span>
          </li>
          <li>
            <i class="fa-regular fa-clock"></i>
            <span> {{ date('h:iA', strtotime(@$blog->created_at)) }}</span>
          </li>
      </ul>
      <div class="km__blog_content">
        <h2 class="mb-30">{{@$blogDetails->title}}</h2>
        <p class="mb-30">
            {!! @$blogDetails->long_description !!}
        </p>
      </div>
      
      <div class="tags d-flex align-items-center flex-wrap gap-10 mb-30">
        <h6 class="me-3">Post Tags</h6>
        
        <a href="#" class="km__donation tags__btn">Donation</a>
        <a href="#" class="km__blood tags__btn">Blood</a>
        <a href="#" class="km__happy tags__btn">Happy</a>
        <a href="#" class="km__people tags__btn">People</a>
      </div>
      <span class="spacer"></span>
      <div class="Share d-flex align-items-center gap-20 flex-wrap mt-30">
        <h6 class="me-3 fs-20">Share:</h6>
        {!! Share::currentPage()->facebook() !!}
        {!! Share::currentPage()->twitter() !!}
        {!! Share::currentPage()->linkedin() !!}
        {!! Share::currentPage()->whatsapp() !!}
      </div>
      <div class="km__blockquote__box mt-60">
        <div class="d-flex wrap gap-20">
          <div class="imgbx">
            <img src="{{asset('frontend/assets/images/blog-details/client.jpg')}}" alt="images not founds" class="w-100">
          </div>
          <div class="content">
            <h6 class="mb-20">Atikul Rhaman</h6>
            <p class="mb-20">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
              nulla pariatur. Excepteur sint occaecat cupidatat proident, sunt in culpa qui officia deserunt mollit anim
              id est laborum.</p>
            <ul class="social__icons d-flex align-items-center gap-10">
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="next__btn d-flex mt-60">
        <div class="prev text-start">
          <span class="d-flex align-items-center gap-10">
            <i class="fa-solid fa-arrow-left"></i>
            Previous Post
          </span>
          <p class="m-0">Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt utdolore magna
            suspendisse ultrices gravida.</p>
        </div>
        <div class="next">
          <span class="d-flex align-items-center justify-content-end gap-10">
            next Post
            <i class="fa-solid fa-arrow-right"></i>
          </span>
          <p class="m-0">Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt utdolore magna
            suspendisse ultrices gravida.</p>
        </div>
      </div>
      <div class="km__comments__Sectios mt-60">
        <div class="km__comment__heading">
          <h4 class="mb-30">Comments</h4>
          
          <div class="fb-comments" data-href="{{Request::url()}}" data-width="100%" data-numposts="5"></div>
          <span id="fb-root"></span>
        </div>
        
      </div>
    </div>
  </section>
  <!-- section blog details ends -->
</section>
  
<!-- donate form start -->
@endsection
@push('js')
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=209201484717774&autoLogAppEvents=1"
    nonce="iyZZ3sn3">
</script>
<script>
    $(document).ready(function () {
        $(".cke_editable img").each(function(i) {
                $(this).addClass("img-fluid");
                   
            });

    });
</script>

@endpush
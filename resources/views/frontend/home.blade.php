@extends('layouts.app')
@push('css')

@endpush
@section('content')
<section class="register_donate gray_bg ptb-115">
    <div class="container">
      <div class="row mb-5 ">
        <div class="col-12">
          <div class="common_title text-center">
            <p>Blood BD</p>
            <h2>Well Come to 
              {{@Auth::user()->name}}
        </h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
          <div class="register_donate_item">
            <div class="donate_item_top">
              <div class="donate_img">
                <img src="assets/images/r1.jpg" alt="">
              </div>
              <div class="donate_content text-center">
                <span><img src="assets/images/icon/d1.png" alt=""></span>
                <a href="service-details.html">
                  <h5>Search Donor</h5>
                </a>
                <p>If Need Bolld Search Doner</p>
              </div>
            </div>
            <a href="{{url('blood-search')}}" class="d-block black_bg text-center">Search Now</a>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
          <div class="register_donate_item">
            <div class="donate_item_top">
              <div class="donate_img">
                <img src="assets/images/r2.jpg" alt="">
              </div>
              <div class="donate_content text-center">
                <span><img src="assets/images/icon/d2.png" alt=""></span>
                <a href="service-details.html">
                  <h5>Why give blood?</h5>
                </a>
                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was
                  born and I will give</p>
              </div>
            </div>
            <a href="service-details.html" class="d-block black_bg text-center">Read More</a>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="register_donate_item">
            <div class="donate_item_top">
              <div class="donate_img">
                <img src="assets/images/r3.jpg" alt="">
              </div>
              <div class="donate_content text-center">
                <span><img src="assets/images/icon/d3.png" alt=""></span>
                <a href="service-details.html">
                  <h5>How Denations Help?</h5>
                </a>
                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was
                  born and I will give</p>
              </div>
            </div>
            <a href="service-details.html" class="d-block black_bg text-center">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- service end -->


@endsection
@push('js')

<script>


    </script>
@endpush

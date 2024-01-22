@extends('layouts.app')
@push('css')

@endpush
@section('content')
  <!-- breadcrumb start -->
  <div class="breadcrumb_section overflow-hidden ptb-150">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-8 col-sm-10 col-12 text-center">
          <h2>Login As a Blood BD Donor</h2>
          <ul>
            <li><a href="index-2.html">Home</a></li>
            <li class="active"> Login Now</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- resister box section start -->
  <section class="km__register__box ptb-120">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 offset-xl-2">
          <div class="text-center">
            <div class="km__website__title mb-30">
              <h2>Blood BD Organization</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-8">
          <div class="km__form__box">
            @include('partial.formerror')
            <form role="form"  method="post" action="{{ route('login') }}">
              @csrf
              <div class="row align-items-center mb-20">
                <div class="col-md-3">
                  <label class="fss-18">Phone Number <span>*</span></label>
                </div>
                <div class="col-md">
                  <label class="fs-14">
                    Phone
                  </label>
                  <input type="tel" value="{{ old('phone') }}" required  name="phone" placeholder="Your Email" >
                </div>
              </div>
              <div class="row align-items-center mb-20">
                <div class="col-md-3">
                  <label class="fss-18">Password <span>*</span></label>
                </div>
                <div class="col-md">
                  <label class="fs-14">
                    Password
                  </label>
                  <input type="password" value="{{ old('password') }}" required  name="password" placeholder="Your Password" >
                </div>
              </div>
              
              <div class="row align-items-center g-4">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                  <button type="submit" class="km__register__btn pt-3 pb-3 mt-3">
                    Submit
                    <span><i class="fas fa-arrow-right"></i></span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- resister box section start -->

  @endsection
@extends('frontend.layouts.app')
@section('content')
    @push('css')
        <style>
        </style>
    @endpush
   <!--pricing Start-->
   <section class="pricing">
    <div class="container">
        <div class="section-title text-center">
            <div class="section-sub-title-box">
                <p class="section-sub-title">Payment Option</p>
                
            </div>
            <h2 class="section-title__title">Choose Your Payment </h2>
        </div>
        <div class="pricing__tab">
            <div class="pricing__tab-box tabs-box">
               
                <div class="tabs-content">
                    <!--tab-->
                    <div class="tab active-tab" id="monthly">
                        <div class="pricing__main-content-box">
                            <div class="row">
                                <!--Pricing Single Start-->
                                <div class="col-xl-4 col-lg-4">
                                    <div class="pricing__single">
                                        <div class="pricing-shape-1">
                                            <img src="https://www.insurancebyowner.com/storage/app/photos/1/2023/02/stripe.jpg" alt="">
                                        </div>
                                        <div class="pricing__single-top">
                                            <div class="pricing__img">
                                                <img src="https://www.insurancebyowner.com/storage/app/photos/1/2023/02/stripe.jpg" alt="">
                                            </div>
                                            <div class="pricing__content">
                                                <h3>$ {{Session::get('payamount')}}</h3>
                                                <p>Pay </p>
                                            </div>
                                        </div>
                                        
                                            <div class="pricing__btn-box">
                                                <a href="{{url('customer/pay-with-stripe')}}" class="thm-btn pricing__btn">Pay Now
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="pricing__single">
                                            <div class="pricing-shape-1">
                                                {{-- <img src="https://www.insurancebyowner.com/storage/app/photos/1/2023/02/stripe.jpg" alt=""> --}}
                                            </div>
                                            <div class="pricing__single-top">
                                                <div class="pricing__img">
                                                    {{-- <img src="https://www.insurancebyowner.com/storage/app/photos/1/2023/02/stripe.jpg" alt=""> --}}
                                                </div>
                                                <div class="pricing__content">
                                                    <h3>$ {{Session::get('payamount')}}</h3>
                                                    <p>Pay </p>
                                                </div>
                                            </div>
                                            
                                                <div class="pricing__btn-box">
                                                    <a href="{{url('customer/pay-with-cash-in-hand')}}" class="thm-btn pricing__btn">Cash In Hand
                                                        </a>
                                                </div>
                                            </div>
                                        </div>
                                
                                
                                </div>
                                <!--Pricing Single End-->
                              
                              
                            </div>
                        </div>
                    </div>
                    <!--tab-->
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--pricing End-->
 
@endsection
@push('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush

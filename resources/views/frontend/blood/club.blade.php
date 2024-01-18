@extends('layouts.app')
@push('css')

@endpush
@section('content')
  <!-- donate form start -->
  <section class="register_donate gray_bg ptb-115">
    <div class="container">
      <div class="row mb-5 ">
        <div class="col-12">
          <div class="common_title text-center">
            <p>services</p>
            <h2>our best services</h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        @foreach ($clubs as $club)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
          <div class="register_donate_item">
            <div class="donate_item_top">
              <div class="donate_img">
                <img src="{{url(@$club->image)}}" alt="">
              </div>
              <div class="donate_content text-center">
                <span><img src="{{url(@$club->image)}}" alt=""></span>
                <a href="#">
                  <h5>{{@$club->club_name}}</h5>
                </a>
                <p>Contact Persion{{@$club->contact_person}} | Email {{@$club->email}}  | Phone @foreach (json_decode($club->phones,true) as $phone)
              
                  <a class="btn btn-sm btn-primary" href="tel:{{$phone}}">{{$phone}}</a> ,
                @endforeach
                | Division {{@$club->division}} | District {{@$club->district}} | Thana/Upazila {{@$club->upazila}} 
                  {{@$club->address}}</p>
              </div>
            </div>
           
          </div>
        </div>
        @endforeach
        {{ $clubs->links() }}
      </div>
    </div>
  </section>
  
  <!-- donate form start -->
  @endsection
@push('js')

<script>


    </script>
@endpush

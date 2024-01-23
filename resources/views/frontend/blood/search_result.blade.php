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
            <p>Blood </p>
            <h2>Search Result</h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        @if($bloodDonners->isNotEmpty())
        @foreach ($bloodDonners as $donner)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
          <div class="register_donate_item">
            <div class="donate_item_top">
              <div class="donate_content text-center">
                <a href="#">
                  <h5>{{@$donner->name}}</h5>
                </a>
                <p>Contact Persion{{@$donner->phone}} | Email {{@$donner->email}}  | {{@$donner->phone}}
                | Division {{@$donner->division}} | District {{@$donner->district}} | Thana/Upazila {{@$donner->upazila}} 
                  {{@$donner->address}}</p>
              </div>
            </div>
           
          </div>
        </div>
        @endforeach
        @else 
        <div>
            <h2 class="text-center">No Resule found</h2>
        </div>
        @endif
      </div>
    </div>
  </section>
  
  <!-- donate form start -->
  @endsection
@push('js')

<script>


    </script>
@endpush

@extends('layouts.app')
@push('css')

@endpush
@section('content')
  <!-- donate form start -->
  <div class="gray_bg ptb-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-6 col-lg-9 col-md-11 col-12">
          <div class="website__title text-center">
            <h2 class="mb-5">Search Blood</h2>
          </div>
        </div>
      </div>
      @include('partial.formerror')
      {!! Form::open(['route' => Request::segment(1) . '.sliders.store', 'method' => 'POST', 'files' => true]) !!}

    
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-11 col-12 ">
          <div class="km__nice__select">
            <h6 class="mb-30">Patient's Name </h6>
            <div class="select__box">
                {!! Form::text('weight',null,['id'=>'weight','class'=>'form-control','required','placeholder'=>'Type Weight']) !!}
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-11 col-12">
          <div class="km__donate__form">
            <h6 class="mb-30">Details</h6>
            <div class="km__form__donat">
             
                <div class="row g-4">
                  <div class="col-12 col-sm-6">
                    <input type="text" placeholder="Frist Name">
                  </div>
                  <div class="col-12 col-sm-6">
                    <input type="text" placeholder="Last Name">
                  </div>
                </div>
                <div class="row g-4">
                  <div class="col-12 col-sm-6">
                    <input type="email" placeholder="Email">
                  </div>
                  <div class="col-12 col-sm-6">
                    <input type="text" placeholder="Adress">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <textarea placeholder="Case Description..." rows="5"></textarea>
                  </div>
                </div>
                <button type="submit" class="primary__btn border-0">Donate Now</button>
              
            </div>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
  <!-- donate form start -->
@push('js')

<script>


    </script>
@endpush

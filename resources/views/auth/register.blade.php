@extends('layouts.app')
@push('css')

@endpush
@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb_section overflow-hidden ptb-150">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-8 col-md-8 col-sm-10 col-12 text-center">
        <h2>Register As a Blood Donor</h2>
        <ul>
          <li><a href="index-2.html">Home</a></li>
          <li class="active"> Register Now</li>
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
      @include('partial.formerror')
      <div class="col-xl-8">
        <div class="km__form__box">
          <form role="form" method="post" action="{{ route('register') }}">
            @csrf
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label class="fss-18">Full Name <span>*</span></label>
              </div>
              <div class="col-md">
                <input type="text" value="{{ old('name') }}" required name="name" placeholder="Full Name">
              </div>

            </div>
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label class="fss-18">Birth % Gender<span>*</span></label>
              </div>
              <div class="col-md"><div class="row">
            <div class="col-md-6">
              <input type="date" value="{{ old('date_of_birth') }}" required name="date_of_birth"
              placeholder="Full Name">
            </div>
            <div class="col-md-6">
              <select class="form-control" value="{{ old('gender') }}" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>

            </div>
              </div>
              
              
              </div>

            </div>
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label class="fss-18">BLOOD GROUP & Weight<span>*</span></label>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" value="{{ old('blood_group') }}" name="blood_group" required>
                      <option></option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    {!! Form::text('weight',null,['id'=>'weight','class'=>'form-control','required','placeholder'=>'Type Weight']) !!}
                  </div>
                </div>

              </div>
            </div>

            
            <div class="row align-items-center mb-10 g-4">
              <div class="col-md-3">
                <label for="phone" class="fss-18">Phone Number<span>*</span></label>
              </div>
              <div class="col-md-9">

                {!! Form::tel('phone',null,['id'=>'phone','class'=>'form-control','required','placeholder'=>'+880']) !!}
              </div>
            </div>
            <div class="row align-items-center mb-10 g-4">
              <div class="col-md-3">
                <label for="phone" class="fss-18">Password<span>*</span></label>
              </div>
              <div class="col-md-9">
                {!! Form::password('password',null,['id'=>'password','class'=>'form-control','required']) !!}
              </div>
            </div>
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label for="division" class="fss-18">Select Division<span>*</span></label>
              </div>
              <div class="col-md-9">

                {!! Form::select('division', Helper::divisionPluckValue(),null,
                ['id'=>'division','class'=>'form-control','required','placeholder'=>'Select One']) !!}

              </div>
            </div>
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label for="district" class="fss-18">Select District<span>*</span></label>
              </div>
              <div class="col-md-9">

                {!! Form::select('district', [],null,
                ['id'=>'district','class'=>'form-control','required','placeholder'=>'Select One']) !!}

              </div>
            </div>
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label for="thana" class="fss-18">Upazila/Thana<span>*</span></label>
              </div>
              <div class="col-md-9">
                {!! Form::select('thana', [],null,
                ['id'=>'thana','class'=>'form-control','required','placeholder'=>'Select One']) !!}

              </div>
            </div>
            <div class="row align-items-center mb-20">
              <div class="col-md-3">
                <label for="union" class="fss-18">Union<span>*</span></label>
              </div>
              <div class="col-md-9">
                {!! Form::text('union',null,['id'=>'union','class'=>'form-control','required','placeholder'=>'Type
                Union']) !!}

              </div>
            </div>

            <div class="row align-items-center mb-10 g-4">
              <div class="col-md-3">
                <label class="fss-18">Address<span>*</span></label>
              </div>
              <div class="col-md-9">
                <label class="fs-14">
                  Street Address
                </label>
                <input type="text" value="{{ old('address') }}" required name="address" placeholder="Full Address">
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
@push('js')
<script>
  $('#division').change(function(){
    $('#district').empty();
    $('#thana').empty();
var divisionid = $(this).val();

$.ajax({
type: "GET",
url: url + '/get-district/'+divisionid,
data:{},
dataType: "JSON",
success:function(data) {
   if(data){
         
            $.each(data, function(key, value){
              $('#district').append('<option value="'+value.district+'">' + value.district + '</option>');

            });
        }

    },
});
});
  $('#district').change(function(){
    $('#thana').empty();

var districtnid = $(this).val();

$.ajax({
type: "GET",
url: url + '/get-thana/'+districtnid,
data:{},
dataType: "JSON",
success:function(data) {
   if(data){
         
            $.each(data, function(key, value){
              $('#thana').append('<option value="'+value.thana+'">' + value.thana + '</option>');

            });
        }

    },
});

});
</script>
@endpush
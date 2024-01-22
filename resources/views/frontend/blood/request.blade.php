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
            <h2 class="mb-5">Request Blood</h2>
          </div>
        </div>
      </div>
      @include('partial.formerror')
      {!! Form::open(['url' => 'blood-request', 'method' => 'POST', 'files' => true]) !!}
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-11 col-12 ">
          <div class="km__nice__select">
            <h6 class="mb-30">Patient's Name </h6>
            <div class="select__box">
                {!! Form::text('patients_name',null,['id'=>'patients_name','class'=>'form-control','required','placeholder'=>'Type Patients Name']) !!}
            </div>
            <div class="row mt-1">
                <div class="col-md-6">
                    <label class="mt-1">Blood Group </label>
                  {!! Form::select('blood_group', ['A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'],null,
                  ['id'=>'blood_group','class'=>'form-control','required']) !!}
  
                  
                </div>
                <div class="col-md-6">
                    <label class="mt-1">Amount Bag </label>
                    {!! Form::select('amount_bag', ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'],null,
                    ['id'=>'amount_bag','class'=>'form-control','required']) !!}
                </div>
                
              </div>
            <div class="row mt-1">
                
                <div class="col-md-6">
                    <label class="mt-1">Date </label>
                    {!! Form::date('date', null,
                    ['id'=>'amount_bag','class'=>'form-control','required']) !!}
                </div>
                <div class="col-md-6">
                    <label class="mt-1">Time</label>
                  {!! Form::time('time',null,
                  ['id'=>'blood_group','class'=>'form-control','required']) !!}
                  
                </div>
              </div>
            <div class="row mt-1">
                
                <div class="col-md-12">
                    <label class="mt-1">Health's Issue </label>
                    {!! Form::select('health_issue',['None'=>'None','Anemia'=>'Anemia','Bleeding disorders'=>'Bleeding disorders','Blood disorders'=>'Blood disorders','Blood Loss'=>'Blood Loss','Cancer'=>'Cancer','Cardiovascular Surgeries'=>'Cardiovascular Surgeries','Chemotherapy'=>'Chemotherapy','Chronic Diseases'=>'Chronic Diseases','Chronic Kidney Diseases'=>'Chronic Kidney Diseases','Cirrhosis'=>'Cirrhosis','Gastrointestinal bleeding'=>'Gastrointestinal bleeding','Gastrointestinal Tumors'=>'Gastrointestinal Tumors','Genetic Disorder'=>'Genetic Disorder','Hemophilia'=>'Hemophilia','Iron Deficiency'=>'Iron Deficiency','Kidney failure'=>'Kidney failure','Liver disease'=>'Liver disease','Postpartum Hemorrhage'=>'Postpartum Hemorrhage','Pregnancy'=>'Pregnancy','Radiation therapy'=>'Radiation therapy','Severe infection'=>'Severe infection','Severe injuries'=>'Severe injuries','Sickle cell disease'=>'Sickle cell disease','Surgery'=>'Surgery','Thalassemia'=>'Thalassemia','Trauma'=>'Trauma','Ulcers'=>'Ulcers','Valve Replacement'=>'Valve Replacement'], null,
                    ['id'=>'health_issue','class'=>'form-control','required']) !!}
                </div>
               
              </div>
              <div class="row mt-1">
                
                <div class="col-md-6">
                    <label class="mt-1">Select Division<span>*</span> </label>
                    {!! Form::select('division', Helper::divisionPluckValue(),null,
                ['id'=>'division','class'=>'form-control','required','placeholder'=>'Select One']) !!}
                </div>
                <div class="col-md-6">
                    <label class="mt-1">Select District<span>*</span></label>
                    {!! Form::select('district', [],null,
                    ['id'=>'district','class'=>'form-control','required','placeholder'=>'Select One']) !!}
    
                  
                </div>
              </div>
              <div class="row mt-1">
                
                <div class="col-md-6">
                    <label class="mt-1">Upazila/Thana<span>*</span> </label>
                    {!! Form::select('upazila', [],null,
                    ['id'=>'thana','class'=>'form-control','required','placeholder'=>'Select One']) !!}
    
                </div>
                <div class="col-md-6">
                    <label class="mt-1">Union<span>*</span></label>
                    {!! Form::text('union',null,['id'=>'union','class'=>'form-control','required','placeholder'=>'Type
                    Union']) !!}
    
                  
                </div>
              </div>
              <div class="row mt-1">
                
                <div class="col-md-6">
                    <label class="mt-1">Address<span>*</span> </label>
                    {!! Form::text('address', null,
                    ['id'=>'address','class'=>'form-control','required','placeholder'=>'Type address']) !!}
    
                </div>
                <div class="col-md-6">
                    <label class="mt-1">Contact Person<span>*</span></label>
                    {!! Form::text('contact_person_phone',null,['id'=>'contact_person_phone','class'=>'form-control','required','placeholder'=>'Type
                    Contact Persion']) !!}
    
                  
                </div>
              </div>

              <div class="col-md-12">
                <button type="submit" class="km__register__btn pt-3 pb-3 mt-3">
                  Request Now
                  <span><i class="fas fa-arrow-right"></i></span>
                </button>
              </div>
              
          </div>
          
        </div>
      </div>
      
      {!! Form::close() !!}
    </div>
  </div>
  <!-- donate form start -->
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
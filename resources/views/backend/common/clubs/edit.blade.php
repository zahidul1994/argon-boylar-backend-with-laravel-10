@extends('backend.layouts.master')
@section('title', 'Update Club')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: var(--bs-gray-200);
        border: none !important;
        font-size: 12px;
        font-size: 0.85rem !important;
    }
</style>
@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">User Update</p>
                        <a href="{{route(Request::segment(1).'.users.index')}}"
                            class="btn btn-primary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')

                        {!! Form::model($club, ['method' => 'PATCH','route' => [Request::segment(1).'.clubs.update',
                        $club->id]]) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="club_name" class="form-control-label">Club Name * </label>
                                {!! Form::text('club_name', null, ['id' => 'club_name','class' =>
                                "form-control",'required',
                                ]) !!}
                                @if ($errors->has('club_name')) <span class="text-danger alert">{{
                                    $errors->first('club_name') }}</span> @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person" class="form-control-label">Contact Person * </label>
                                        {!! Form::text('contact_person', null, ['id' => 'contact_person','class' =>
                                        "form-control",'required',
                                        ]) !!}
                                        @if ($errors->has('contact_person')) <span class="text-danger alert">{{
                                            $errors->first('contact_person')
                                            }}</span> @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email Address * </label>
                                        {!! Form::email('email', null, ['id' => 'email','class' =>
                                        "form-control",'required',
                                        ]) !!}
                                        @if ($errors->has('email')) <span class="text-danger alert">{{
                                            $errors->first('email') }}</span> @endif
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phones" class="form-control-label">Phone Number [Type Phone Number and
                                    Enter] * </label>

                                {!! Form::select('phones[]', [],json_decode($club->phones,true), ['id' =>
                                'phones','class' => "form-control select2",'required','multiple'
                                ]) !!}
                                @if ($errors->has('phones')) <span class="text-danger alert">{{ $errors->first('phones')
                                    }}</span> @endif
                            </div>
                            <div class="form-group">
                                <label for="division" class="form-control-label">Select Division * </label>

                                {!! Form::select('division', Helper::divisionPluckValue(),null,
                                ['id'=>'division','class'=>'form-control select2','required','placeholder'=>'Select
                                One']) !!}
                                @if ($errors->has('division')) <span class="text-danger alert">{{
                                    $errors->first('division') }}</span> @endif
                            </div>

                            <div class="form-group">
                                <label for="district" class="form-control-label">Select District * </label>
                                {!!
                                Form::select('district',[$club->district=>$club->district],null,['id'=>'district','class'=>'form-control','required','placeholder'=>'Select
                                One']) !!}
                                @if ($errors->has('district')) <span class="text-danger alert">{{
                                    $errors->first('district') }}</span> @endif
                            </div>
                            <div class="form-group">
                                <label for="upazila" class="form-control-label">Upazila/Thana * </label>
                                {!! Form::select('upazila', [$club->upazila=>$club->upazila],null,
                                ['id'=>'upazila','class'=>'form-control','required','placeholder'=>'Select One']) !!}
                                @if ($errors->has('upazila')) <span class="text-danger alert">{{
                                    $errors->first('upazila') }}</span> @endif
                            </div>
                            <div class="form-group">
                                <label for="union" class="form-control-label">Union * </label>
                                {!!
                                Form::text('union',null,['id'=>'union','class'=>'form-control','required','placeholder'=>'Type
                                Union']) !!}
                                @if ($errors->has('union')) <span class="text-danger alert">{{ $errors->first('union')
                                    }}</span> @endif
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-control-label">Address * </label>
                                {!! Form::text('address', null, ['id' => 'address','class' => 'form-control','required',
                                ]) !!}
                                @if ($errors->has('address')) <span class="text-danger alert">{{
                                    $errors->first('address')
                                    }}</span> @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Image
                                    </a>
                                </span>
                                {!! Form::text('image', null, ['id' => 'thumbnail', 'class' => 'form-control',
                                'readonly','required','style'=>'height:40px']) !!}
                                @if ($errors->has('image'))
                                <span class="text-danger alert">{{ $errors->first('image') }}</span>
                                @endif
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
@push('js')
<!-- CKEditor init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(document).ready(function () {    
  
    $(".select2").select2({
        tags: true
});

data=@json((json_decode($club->phones,true))); 

   if(data){
         
            $.each(data, function(key, value){
                console.log(value);
              $('#phones').append('<option selected value="'+value+'">' + value + '</option>');

            });
        }

$('#lfm').filemanager('filemanager');
$('#division').change(function(){
    $('#district').empty();
    $('#upazila').empty();
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
    $('#upazila').empty();
var districtnid = $(this).val();
$.ajax({
type: "GET",
url: url + '/get-thana/'+districtnid,
data:{},
dataType: "JSON",
success:function(data) {
   if(data){
         
            $.each(data, function(key, value){
              $('#upazila').append('<option value="'+value.thana+'">' + value.thana + '</option>');

            });
        }

    },
});
}); 
});
</script>

@endpush
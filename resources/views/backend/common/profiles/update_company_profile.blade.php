@extends('backend.layouts.master')
@section('title', 'Update Company')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Company Update</p>
                            <a href="{{route(Request::segment(1).'.profiles.index')}}" class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($user, [
                            'route' => [Request::segment(1) . '.updateCompanyProfile'],
                            'method' => 'POST',
                            'files' => true,
                        ]) !!}
                      
    <div class="col-md-12">
        <div class="form-group">
            <label for="name" class="form-control-label">Name * </label>
            {!! Form::text('name', null, ['id' => 'name','class' => 'form-control','required',
            ]) !!}
          @if ($errors->has('name')) <span class="text-danger alert">{{ $errors->first('name') }}</span> @endif
        </div>
        <div class="form-group">
          <label for="gender" class="form-control-label">Gender * </label>
          {!! Form::select('gender',['Male'=>'Male','Female'=>'Female','Other'=>'Other'], null, ['id' => 'gender','class' => 'form-control','required',
          ]) !!}
        @if ($errors->has('gender')) <span class="text-danger alert">{{ $errors->first('gender') }}</span> @endif
      </div>
        <div class="form-group">
          <label for="position" class="form-control-label">Position * </label>
          {!! Form::text('position', null, ['id' => 'position','class' => 'form-control','required',
          ]) !!}
        @if ($errors->has('position')) <span class="text-danger alert">{{ $errors->first('position') }}</span> @endif
      </div>
        <div class="form-group">
            <label for="username" class="form-control-label">Username * </label>
            {!! Form::text('username', null, ['id' => 'username','class' => 'form-control','required',
            ]) !!}
          @if ($errors->has('username')) <span class="text-danger alert">{{ $errors->first('username') }}</span> @endif
        </div>
        <div class="form-group">
          <label for="phone" class="form-control-label">phone * </label>
          {!! Form::tel('phone',null, ['id' => 'phone','class' => 'form-control','readonly'
          ]) !!}
        @if ($errors->has('phone')) <span class="text-danger alert">{{ $errors->first('phone') }}</span> @endif
      </div>
        <div class="form-group">
          <label for="fax" class="form-control-label">Fax Number * </label>
          {!! Form::tel('fax',null, ['id' => 'fax','class' => 'form-control','required'
          ]) !!}
        @if ($errors->has('fax')) <span class="text-danger alert">{{ $errors->first('fax') }}</span> @endif
      </div>
        <div class="form-group">
            <label for="email" class="form-control-label">Email * </label>
            {!! Form::email('email', null, ['id' => 'email','class' => 'form-control','readonly',
            ]) !!}
          @if ($errors->has('email')) <span class="text-danger alert">{{ $errors->first('email') }}</span> @endif
        </div>
        <div class="form-group">
            <label for="password" class="form-control-label">Password  </label>
            {!! Form::password('password', ['id' => 'password','class' => 'form-control'
            ]) !!}
          @if ($errors->has('password')) <span class="text-danger alert">{{ $errors->first('password') }}</span> @endif
        </div>
       
         <div class="form-group">
            <label for="country" class="form-control-label">Select Country * </label>
            {!! Form::select('country',Helper::getCountry(),null, ['id' => 'country','class' => 'form-control select2','placeholder'=>'Select State','required'
            ]) !!}
          @if ($errors->has('country')) <span class="text-danger alert">{{ $errors->first('country') }}</span> @endif
        </div> 
        <div class="form-group">
            <label for="state" class="form-control-label">Select State * </label>
            {!! Form::select('state',Helper::getState(),null, ['id' => 'state','class' => 'form-control select2','placeholder'=>'Select State','required'
            ]) !!}
          @if ($errors->has('state')) <span class="text-danger alert">{{ $errors->first('state') }}</span> @endif
        </div>
        <div class="form-group">
          <label for="zip_code" class="form-control-label">Zip Code * </label>
          {!! Form::number('zip_code', null, ['id' => 'zip_code','class' => 'form-control','required',
          ]) !!}
        @if ($errors->has('zip_code')) <span class="text-danger alert">{{ $errors->first('zip_code') }}</span> @endif
      </div>
     
        <div class="form-group">
            <label for="company_name" class="form-control-label">Company Name * </label>
            {!! Form::text('company_name', null, ['id' => 'company_name','class' => 'form-control','required',
            ]) !!}
          @if ($errors->has('company_name')) <span class="text-danger alert">{{ $errors->first('company_name') }}</span> @endif
        </div>
        
        <div class="form-group">
            <label for="company_address" class="form-control-label">Company Address * </label>
            {!! Form::textarea('company_address', null, ['id' => 'company_address','class' =>
            "form-control",'required','rows'=>2
            ]) !!}
            @if ($errors->has('company_address')) <span class="text-danger alert">{{ $errors->first('company_address') }}</span> @endif
        </div>
        <div class="form-group">
            <label for="google_location_link" class="form-control-label">Google Location Link  </label>
            {!! Form::text('google_location_link', null, ['id' => 'google_location_link','class' => "form-control"
            ]) !!}
       @if ($errors->has('google_location_link')) <span class="text-danger alert">{{ $errors->first('google_location_link') }}</span> @endif
        </div>
        <div class="form-group">
            <label for="facebook_link" class="form-control-label">Facebook Link </label>
            {!! Form::text('facebook_link', null, ['id' => 'facebook_link','class' => "form-control"
            ]) !!}
       @if ($errors->has('facebook_link')) <span class="text-danger alert">{{ $errors->first('facebook_link') }}</span> @endif
        </div>
        
        <div class="form-group">
            <label for="twitter_link" class="form-control-label">Twitter Link </label>
            {!! Form::text('twitter_link', null, ['id' => 'twitter_link','class' => "form-control"
            ]) !!}
       @if ($errors->has('twitter_link')) <span class="text-danger alert">{{ $errors->first('twitter_link') }}</span> @endif
        </div>
       
        <div class="form-group">
            <label for="linkedin_link" class="form-control-label">Linkdin Link </label>
            {!! Form::text('linkedin_link', null, ['id' => 'linkedin_link','class' => "form-control"
            ]) !!}
       @if ($errors->has('linkedin_link')) <span class="text-danger alert">{{ $errors->first('linkedin_link') }}</span> @endif
        </div>
      
        <div class="form-group">
            <label for="facts" class="form-control-label">Facts * </label>
            {!! Form::text('facts', null, ['id' => 'facts','class' => "form-control",'required'
            ]) !!}
       @if ($errors->has('facts')) <span class="text-danger alert">{{ $errors->first('facts') }}</span> @endif
        </div>
      
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Profile  [300*300]</label>
        {!! Form::file('image', ['id' => 'example-text-input', 'class' => 'form-control', ]) !!}
        @if ($errors->has('image')) <span class="text-danger alert">{{ $errors->first('image') }}</span> @endif
      
    </div>
    @if($user==!Null)
    <img src="{{url(@$user->image)}}" >
    @endif
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Company  (Logo)  [300*300]</label>
        <input class="form-control" type="file" name="company_logo" accept="image/png, image/jpeg,image/webp">
    @if ($errors->has('company_logo')) <span class="text-danger alert">{{ $errors->first('company_logo') }}</span> @endif
</div>
@if($user==!Null)
<img src="{{url(@$user->company_logo)}}" >
@endif

<div class="form-group">
    <label for="description" class="form-control-label">Company Description * </label>
    {!! Form::textarea('description', null, [
        'id' => 'description',
        'class' => 'form-control',
        'required',
        'rows' => 2,
    ]) !!}
    @if ($errors->has('description'))
        <span class="text-danger alert">{{ $errors->first('description') }}</span>
    @endif
</div>
    </div>
                       
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
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
<script src="{{asset('backend/assets/select2/js/select2.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
<script>
  $(".select2").select2({
    
});
   
    
    var route_prefix = "/filemanager";
        $('textarea[name=description]').ckeditor({
          height: 300,
           removePlugins:'image,pwimage,about,blockquotes,link',
            format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
            allowedContent: true
        });
  </script>

@endpush
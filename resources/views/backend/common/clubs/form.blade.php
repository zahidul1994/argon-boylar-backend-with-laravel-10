<div class="col-md-12">
    <div class="form-group">
        <label for="club_name" class="form-control-label">Club Name * </label>
        {!! Form::text('club_name', null, ['id' => 'club_name','class' => "form-control",'required',
        ]) !!}
        @if ($errors->has('club_name')) <span class="text-danger alert">{{ $errors->first('club_name') }}</span> @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="contact_person" class="form-control-label">Contact Person * </label>
                {!! Form::text('contact_person', null, ['id' => 'contact_person','class' => "form-control",'required',
                ]) !!}
                @if ($errors->has('contact_person')) <span class="text-danger alert">{{ $errors->first('contact_person')
                    }}</span> @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="form-control-label">Email Address * </label>
                {!! Form::email('email', null, ['id' => 'email','class' => "form-control",'required',
                ]) !!}
                @if ($errors->has('email')) <span class="text-danger alert">{{ $errors->first('email') }}</span> @endif
            </div>
           

        </div>
    </div>
    <div class="form-group">
        <label for="phones" class="form-control-label">Phone Number [Type Phone Number and Enter] * </label>
        {!! Form::select('phones[]',[], null, ['id' => 'phones','class' => "form-control select2",'required','multiple'=>true
        ]) !!}
        @if ($errors->has('phones')) <span class="text-danger alert">{{ $errors->first('phones') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="division" class="form-control-label">Select Division * </label>
    
    {!! Form::select('division', Helper::divisionPluckValue(),null,
    ['id'=>'division','class'=>'form-control select2','required','placeholder'=>'Select One']) !!}
      @if ($errors->has('division')) <span class="text-danger alert">{{ $errors->first('division') }}</span> @endif
  </div>
    
    <div class="form-group">
        <label for="district" class="form-control-label">Select District * </label>
     {!! Form::select('district', [],null,['id'=>'district','class'=>'form-control','required','placeholder'=>'Select One']) !!}
      @if ($errors->has('district')) <span class="text-danger alert">{{ $errors->first('district') }}</span> @endif
  </div>
    <div class="form-group">
        <label for="upazila" class="form-control-label">Upazila/Thana * </label>
        {!! Form::select('upazila', [],null,
        ['id'=>'upazila','class'=>'form-control','required','placeholder'=>'Select One']) !!}
      @if ($errors->has('upazila')) <span class="text-danger alert">{{ $errors->first('upazila') }}</span> @endif
  </div>
    <div class="form-group">
        <label for="union" class="form-control-label">Union * </label>
        {!! Form::text('union',null,['id'=>'union','class'=>'form-control','required','placeholder'=>'Type Union']) !!}
      @if ($errors->has('union')) <span class="text-danger alert">{{ $errors->first('union') }}</span> @endif
  </div>

    <div class="form-group">
        <label for="address" class="form-control-label">Address * </label>
        {!! Form::text('address', null, ['id' => 'address','class' => 'form-control','required',
        ]) !!}
        @if ($errors->has('address')) <span class="text-danger alert">{{ $errors->first('address')
            }}</span> @endif
    </div>
    <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Image 
            </a>
        </span>
        {!! Form::text('image', null, ['id' => 'thumbnail', 'class' => 'form-control', 'readonly','required','style'=>'height:40px']) !!}
        @if ($errors->has('image'))
        <span class="text-danger alert">{{ $errors->first('image') }}</span>
        @endif
        <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>
</div>
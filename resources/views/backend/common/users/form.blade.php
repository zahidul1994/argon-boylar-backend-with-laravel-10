
    <div class="col-md-12">
        <div class="form-group">
            <label for="short_description" class="form-control-label">Short Description * </label>
           
            {!! Form::text('short_description', null, ['id' => 'short_description','class' => 'form-control','required',
            ]) !!}
          @if ($errors->has('short_description')) <span class="text-danger alert">{{ $errors->first('short_description') }}</span> @endif
        </div>
        <div class="form-group">
            <label for="long_description" class="form-control-label">Long Description * </label>
            {!! Form::textarea('long_description', null, ['id' => 'long_description','class' =>
            "form-control",'required','rows'=>2
            ]) !!}
 @if ($errors->has('long_description')) <span class="text-danger alert">{{ $errors->first('long_description') }}</span> @endif
        </div>
        <div class="form-group">
            <label for="link" class="form-control-label">Button Link * </label>
            {!! Form::text('link', null, ['id' => 'link','class' => "form-control",'required',
            ]) !!}
 @if ($errors->has('link')) <span class="text-danger alert">{{ $errors->first('link') }}</span> @endif
        </div>
  
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Image *</label>
            <input class="form-control" type="file" name="image" accept="image/png, image/jpeg,image/webp">
        </div>
        @if ($errors->has('image')) <span class="text-danger alert">{{ $errors->first('image') }}</span> @endif
    </div>
<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="form-control-label">Title * </label>
        {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('title'))
            <span class="text-danger alert">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="slug" class="form-control-label">Slug * </label>
        {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('slug'))
            <span class="text-danger alert">{{ $errors->first('slug') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="meta_title" class="form-control-label">Meta Title  </label>
        {!! Form::text('meta_title', null, ['id' => 'meta_title', 'class' => 'form-control']) !!}
        @if ($errors->has('meta_title'))
            <span class="text-danger alert">{{ $errors->first('meta_title') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="meta_description" class="form-control-label">Meta Description  </label>
        {!! Form::text('meta_description', null, ['id' => 'meta_description', 'class' => 'form-control']) !!}
        @if ($errors->has('meta_description'))
            <span class="text-danger alert">{{ $errors->first('meta_description') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="json_screma" class="form-control-label">Json Screma </label>
        {!! Form::textarea('json_screma', null, ['id' => 'json_screma', 'class' => 'form-control','rows'=>3]) !!}
        @if ($errors->has('json_screma'))
            <span class="text-danger alert">{{ $errors->first('json_screma') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="keyword" class="form-control-label">Keyword </label>
        {!! Form::text('keyword', null, ['id' => 'keyword', 'class' => 'form-control']) !!}
        @if ($errors->has('keyword'))
            <span class="text-danger alert">{{ $errors->first('keyword') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="category" class="form-control-label">Category * </label>
        {!! Form::select('category',Helper::getCategory(), null, ['id' => 'category', 'class' => 'form-control select2','placeholder'=>'Select One']) !!}
        @if ($errors->has('category'))
            <span class="text-danger alert">{{ $errors->first('category') }}</span>
        @endif
    </div>
   
    <div class="form-group">
        <label for="short_description" class="form-control-label">Short Description * </label>
        {!! Form::text('short_description', null, ['id' => 'short_description', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('short_description'))
            <span class="text-danger alert">{{ $errors->first('short_description') }}</span>
        @endif
    </div>
    <div class="input-group">
        <span class="input-group-btn">
          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Image *
          </a>
        </span>
        {!! Form::text('image', null, ['id' => 'thumbnail', 'class' => 'form-control', 'required','readonly','style'=>'height:40px']) !!}
        @if ($errors->has('image'))
        <span class="text-danger alert">{{ $errors->first('image') }}</span>
      @endif
    <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>


    <div class="form-group">
        <label for="long_description" class="form-control-label">Long Description * </label>
        {!! Form::textarea('long_description', null, [
            'id' => 'long_description',
            'class' => 'form-control',
            'required',
            'rows' => 2,
        ]) !!}
        @if ($errors->has('long_description'))
            <span class="text-danger alert">{{ $errors->first('long_description') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="status" class="form-control-label">Status *</label>
        {!! Form::select('status',[1=>'Publish',0=>'Pending'], null, ['id' => 'status', 'class' => 'form-control select2']) !!}
        @if ($errors->has('status'))
            <span class="text-danger alert">{{ $errors->first('status') }}</span>
        @endif
    </div>

</div>

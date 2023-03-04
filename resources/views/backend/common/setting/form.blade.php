<div class="col-md-12">
    <div class="form-group">
        <label for="name" class="form-control-label">Name * </label>
        {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('name'))
            <span class="text-danger alert">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="title" class="form-control-label">Title * </label>
        {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('title'))
            <span class="text-danger alert">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="phone" class="form-control-label">Phone * </label>
        {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('phone'))
            <span class="text-danger alert">{{ $errors->first('phone') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="email" class="form-control-label">Email * </label>
        {!! Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('email'))
            <span class="text-danger alert">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="address" class="form-control-label">Address * </label>
        {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('address'))
            <span class="text-danger alert">{{ $errors->first('address') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="description" class="form-control-label">Description * </label>
        {!! Form::text('description', null, ['id' => 'description', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('description'))
            <span class="text-danger alert">{{ $errors->first('description') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="facebook" class="form-control-label">Facebook * </label>
        {!! Form::text('facebook', null, ['id' => 'facebook', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('facebook'))
            <span class="text-danger alert">{{ $errors->first('facebook') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="youtube" class="form-control-label">Youtube * </label>
        {!! Form::text('youtube', null, ['id' => 'youtube', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('youtube'))
            <span class="text-danger alert">{{ $errors->first('youtube') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="twitter" class="form-control-label">Twitter * </label>
        {!! Form::text('twitter', null, ['id' => 'twitter', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('twitter'))
            <span class="text-danger alert">{{ $errors->first('twitter') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="instagram" class="form-control-label">Instagram * </label>
        {!! Form::text('instagram', null, ['id' => 'instagram', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('instagram'))
            <span class="text-danger alert">{{ $errors->first('instagram') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="meta_title" class="form-control-label">Meta Title * </label>
        {!! Form::text('meta_title', null, ['id' => 'meta_title', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('meta_title'))
            <span class="text-danger alert">{{ $errors->first('meta_title') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="meta_description" class="form-control-label">Meta Description * </label>
        {!! Form::text('meta_description', null, ['id' => 'meta_description', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('meta_description'))
            <span class="text-danger alert">{{ $errors->first('meta_description') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Favicon *</label>
        <input class="form-control" type="file" name="favicon" accept="image/png, image/jpeg,image/webp">
    </div>
    @if ($setting == !null)
        <img src="{{ url(@$setting->favicon) }}" height="20" width="20">
    @endif
    @if ($errors->has('favicon'))
        <span class="text-danger alert">{{ $errors->first('favicon') }}</span>
    @endif
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Logo *</label>
        <input class="form-control" type="file" name="logo" accept="image/png, image/jpeg,image/webp">
    </div>
    @if ($setting == !null)
        <img src="{{ url(@$setting->favicon) }}" height="50" width="50">
    @endif
    @if ($errors->has('logo'))
        <span class="text-danger alert">{{ $errors->first('logo') }}</span>
    @endif
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Footer Logo *</label>
        <input class="form-control" type="file" name="footer_logo" accept="image/png, image/jpeg,image/webp">
    </div>
    @if ($setting == !null)
        <img src="{{ url(@$setting->footer_logo) }}" height="50" width="50">
    @endif
    @if ($errors->has('footer_logo'))
        <span class="text-danger alert">{{ $errors->first('footer_logo') }}</span>
    @endif
    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Admin Logo *</label>
        <input class="form-control" type="file" name="admin_logo" accept="image/png, image/jpeg,image/webp">
    </div>
    @if ($setting == !null)
        <img src="{{ url(@$setting->admin_logo) }}" height="50" width="50">
    @endif
    @if ($errors->has('admin_logo'))
        <span class="text-danger alert">{{ $errors->first('admin_logo') }}</span>
    @endif
</div>

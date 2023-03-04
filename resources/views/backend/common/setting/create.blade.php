@extends('backend.layouts.master')
@section('title', 'Create Slider')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Sliders Create</p>
                            <a href="{{route(Request::segment(1).'.sliders.index')}}" class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('partial.formerror')
                        {!! Form::open(['route' => Request::segment(1) . '.sliders.store', 'method' => 'POST', 'files' => true]) !!}
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description" class="form-control-label">Short Description * </label>
                                        {!! Form::text('short_description', null, ['id' => 'short_description','class' => "form-control",'required',
                                        ]) !!}
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="long_description" class="form-control-label">Long  Description * </label>
                                        {!! Form::textarea('long_description', null, ['id' => 'long_description','class' => "form-control",'required','rows'=>2
                                        ]) !!}
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="link" class="form-control-label">Button Link * </label>
                                        {!! Form::text('link', null, ['id' => 'link','class' => "form-control",'required',
                                        ]) !!}
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Image *</label>
                                        <input class="form-control" type="file" name="image"  accept="image/png, image/jpeg,image/webp">
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

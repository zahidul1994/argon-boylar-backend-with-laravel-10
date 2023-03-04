@extends('backend.layouts.master')
@section('title', 'Update Slider')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Sliders Update</p>
                            <a href="{{route(Request::segment(1).'.sliders.index')}}" class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($slider, [
                            'route' => [Request::segment(1) . '.sliders.update', $slider->id],
                            'method' => 'PATCH',
                            'files' => true,
                        ]) !!}
                        @include('backend.common.sliders.form')
                        @if($slider==!Null)
                        <img src="{{url(@$slider->image)}}" >
                        @endif
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

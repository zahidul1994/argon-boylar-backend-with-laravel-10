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
                        <div class="row">
                        @include('partial.formerror')
                        {!! Form::open(['route' => Request::segment(1) . '.sliders.store', 'method' => 'POST', 'files' => true]) !!}

                        @include('backend.common.sliders.form')
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                                </div>
                                {!! Form::close() !!}
                            </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

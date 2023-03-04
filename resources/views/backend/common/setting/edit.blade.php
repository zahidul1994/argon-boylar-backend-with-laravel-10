@extends('backend.layouts.master')
@section('title', 'Update Setting')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Setting Update</p>
                            <a href="{{ route(Request::segment(1) . '.setting.index') }}"
                                class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('partial.formerror')
                            {!! Form::model($setting, [
                                'route' => [Request::segment(1) . '.setting.update', $setting->id],
                                'method' => 'PATCH',
                                'files' => true,
                            ]) !!}
                            @include('backend.common.setting.form')
                            
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

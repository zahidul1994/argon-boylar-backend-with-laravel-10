@extends('backend.layouts.master')
@section('title', 'Update User')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">User Update</p>
                            <a href="{{route(Request::segment(1).'.users.index')}}" class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        @include('partial.formerror')
                       
                        {!! Form::model($user, ['method' => 'PATCH','route' => [Request::segment(1).'.users.update', $user->id]]) !!}
                     
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div> --}}
                            <div class="form-group">
                                        <label for="status" class="form-control-label"> Status * </label>
                                        {!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
                                            'id' => 'status',
                                            'class' => 'form-control select2',
                                        ]) !!}
                                        @if ($errors->has('status'))
                                            <span class="text-danger alert">{{ $errors->first('status') }}</span>
                                        @endif
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

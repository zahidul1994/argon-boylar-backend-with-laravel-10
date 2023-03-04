@extends('backend.layouts.master')
@section('title', 'Profile')
@push('css')
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset(@$profileInfo->image ?: 'backend/assets/img/team-1.jpg') }}" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ @$profileInfo->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Type: {{ @$profileInfo->user_type }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        {{-- <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">App</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-email-83"></i>
                  <span class="ms-2">Messages</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-settings-gear-65"></i>
                  <span class="ms-2">Settings</span>
                </a>
              </li>
            </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row mt-3">

            <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                            <div class="col-md-4 text-end">
                          
                                <a href="{{ route(Request::segment(1) . '.showProfileForm') }}">
                                    <i class="fas fa-user-edit text-secondary text-sm" title="Edit Profile"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <p class="text-sm">
                            {!! @$profileInfo->profile->description ?: 'No set any Description' !!}
                        </p>
                        <hr class="horizontal gray-light my-4">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                    Name:</strong> &nbsp; {{ @$profileInfo->name }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                                &nbsp; {{ @$profileInfo->phone }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                &nbsp; {{ @$profileInfo->email }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong>
                                &nbsp; {{ @$profileInfo->profile->country ?: '' }} {{ @$profileInfo->profile->state ?: '' }}
                                {{ @$profileInfo->zip_code ?: 'Not Yet' }} </li>
                            <li class="list-group-item border-0 ps-0 pb-0">
                                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0"
                                    href="{{ @$profileInfo->profile->facebook_link }}">
                                    <i class="fab fa-facebook fa-lg"></i>
                                </a>
                                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0"
                                    href="{{ @$profileInfo->profile->twitter_link }}">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a class="btn btn-linkdin btn-simple mb-0 ps-1 pe-2 py-0"
                                    href="{{ @$profileInfo->profile->linkdin_link }}">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @if (@$profileInfo->user_type == 'Company')
                <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Company Information</h6>
                                </div>
                                <div class="col-md-4 text-end">

                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-blod">
                                {!! @$profileInfo->profile->company_name ?: 'NoT Set' !!}
                            </p>
                            <hr class="horizontal gray-light my-4">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Facts:
                                        {{ @$profileInfo->profile->facts ?: 'Not Set' }}</strong> &nbsp;Position:
                                    {{ @$profileInfo->profile->position ?: 'Not Set' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Company
                                        Fax:</strong> &nbsp; {{ @$profileInfo->profile->fax ?: 'Not Set' }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                    &nbsp; {{ @$profileInfo->email }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address
                                        :</strong> &nbsp; {{ @$profileInfo->profile->company_address ?: 'Not Update' }} </li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @if (@$profileInfo->user_type == 'Company')
                <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Company Logo</h6>
                                </div>
                                <div class="col-md-4 text-end">

                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <img src="{{ asset(@$profileInfo->profile->company_logo) }}" class="img-fluid">
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>


    </div>

@endsection

@push('js')
    <script src="{{ asset('js/lightbox.js') }}"></script> ## for image view ##

    <script>
        $(document).ready(function() {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });



        });
    </script>
@endpush

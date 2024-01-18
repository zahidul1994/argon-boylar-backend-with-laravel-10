@extends('backend.layouts.master')
@section('title', 'Create Club')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: var(--bs-gray-200);
        border: none !important;
        font-size: 12px;
        font-size: 0.85rem !important;
    }
</style>
@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Club Create</p>
                        <a href="{{route(Request::segment(1).'.clubs.index')}}"
                            class="btn btn-primary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::open(['route' => Request::segment(1) . '.clubs.store', 'method' => 'POST', 'files' =>
                        true]) !!}

                        @include('backend.common.clubs.form')
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
@push('js')
<!-- CKEditor init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(".select2").select2({
  tags: true
});
$('#lfm').filemanager('filemanager');
$('#division').change(function(){
    $('#district').empty();
    $('#upazila').empty();
var divisionid = $(this).val();

$.ajax({
type: "GET",
url: url + '/get-district/'+divisionid,
data:{},
dataType: "JSON",
success:function(data) {
   if(data){
         
            $.each(data, function(key, value){
              $('#district').append('<option value="'+value.district+'">' + value.district + '</option>');

            });
        }

    },
});
});

  $('#district').change(function(){
    $('#upazila').empty();

var districtnid = $(this).val();

$.ajax({
type: "GET",
url: url + '/get-thana/'+districtnid,
data:{},
dataType: "JSON",
success:function(data) {
   if(data){
         
            $.each(data, function(key, value){
              $('#upazila').append('<option value="'+value.thana+'">' + value.thana + '</option>');

            });
        }

    },
});
}); 
</script>

@endpush
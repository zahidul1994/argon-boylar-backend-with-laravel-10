@extends('frontend.layouts.app')
@section('content')
    @push('css')
        <style>
        </style>
    @endpush
    <!--Start Checkout Page-->
    <section class="checkout-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="order_table_box">
                        <table class="order_table_detail">
                            <thead class="order_table_head">
                                <tr>
                                    <th>Insurance {{ @$healthPlanDetails->company->profile->company_name }}
                                        {{ $healthPlanDetails->title }}
                                        @foreach (json_decode($healthPlanDetails->plan_type) as $pt)
                                            ({{ $pt . ' ' }})
                                            </h3>
                                        @endforeach
                                    </th>
                                    <th class="right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pro__title">Specialist</td>
                                    <td class="pro__price">$ {{ @$healthPlanDetails->specialist_fees }} USD</td>
                                </tr>
                                <tr>
                                    <td class="pro__title">Emergency</td>
                                    <td class="pro__price">$ {{ @$healthPlanDetails->emergency_fees }} USD</td>
                                </tr>
                                <tr>
                                    <td class="pro__title">Doctor</td>
                                    <td class="pro__price">$ {{ @$healthPlanDetails->primary_doctor_fees }} USD</td>
                                </tr>
                                <tr>
                                    <td class="pro__title">Total ({{ @$healthPlanDetails->plan_year }} Year) </td>
                                    <td class="pro__price">$ {{ @$healthPlanDetails->out_of_pocket }} USD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="billing_details">
                        <div class="billing_title">
                            <h4>Full fill details</h4>
                        </div>
                        {!! Form::open(['route' => 'customer.healthPlanCheckOutStore', 'method' => 'POST', 'class' => 'billing_details_form']) !!}

                        <div class="row bs-gutter-x-20">
                            <div class="col-xl-6">
                                <div class="billing_input_box">
                                    {!! Form::text('name', @Auth::user()->name, [
                                        'class' => '',
                                        'placeholder' => 'Full Name',
                                        'required',
                                        'max' => 198,
                                    ]) !!}
                                    @if ($errors->has('name'))
                                        <span class="text-danger alert">{{ $errors->first('name') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="billing_input_box">
                                    <div class="form-check">
                                        {{ Form::radio('gender', '1', ['class' => 'form-check-input', 'id' => 'customRadio1']) }}
                                        <label class="custom-control-label" for="customRadio1">Male</label>
                                    </div>
                                    <div class="form-check">
                                        {{ Form::radio('gender', '2', ['class' => 'form-check-input', 'id' => 'customRadio2']) }}
                                        <label class="custom-control-label" for="customRadio2">FeMale</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="billing_input_box">
                                    <label class="custom-control-label" for="smokingHabit"> Smoking Habit ?</label>
                                    <div class="select-box">
                                        {{ Form::select('smoking_habit', ['Yes' => 'Yes', 'No' => 'No'], null, ['class' => 'wide nice-select', 'id' => 'smokingHabit', 'required']) }}
                                        @if ($errors->has('smoking_habit'))
                                        <span class="text-danger alert">{{ $errors->first('smoking_habit') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="billing_input_box">
                                    <label class="custom-control-label" for="birthDate"> Birth Date *</label>
                                    <div class="select-box">
                                        {{ Form::date('birth_date', null, ['class' => 'wide nice-select', 'id' => 'birthDate', 'required']) }}
                                        @if ($errors->has('birth_date'))
                                        <span class="text-danger alert">{{ $errors->first('birth_date') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label class="custom-control-label" for="zipCode"> Zip Code *</label>
                                <div class="billing_input_box">
                                    {{ Form::text('zip_code',  @$zipCode, ['class' => 'form-control', 'id' => 'zipCode', 'required', 'readonly' ]) }}
                                    @if ($errors->has('billing_input_box'))
                                    <span class="text-danger alert">{{ $errors->first('billing_input_box') }}</span>
                                @endif
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <input type="hidden" name="plan_id" value="{{ @$healthPlanDetails->id}}">
                                                    <input type="hidden" name="category_id" value="{{ @$healthPlanDetails->category_id}}">
                                <div class="text-right d-flex justify-content-end">
                                    <button class="thm-btn">Enrole Now</button>
                                </div>

                            </div>

                        </div>


                        </form>
                    </div>
                </div>



            </div>

        </div>
    </section>
    <!--End Checkout Page-->
@endsection
@push('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush

@extends('frontend.user.dashboard.user-master')
@section('page-title')
    {{__('User Dashboard')}}
@endsection

@section('site-title')
    {{__('User Dashboard')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom-dashboard.css')}}">
@endsection

@section('section')

    <div class="row">
        <div class="col-xl-6 col-md-6 orders-child">
            <div class="single-orders">

                <div class="orders-flex-content">
                    <div class="icon">
                        <i class="las la-tasks"></i>
                    </div>
                    <div class="contents">
                        <h2 class="order-titles">#{{ auth()->guard('web')->user()->id }} </h2>
                        <span class="order-para"> {{__('User ID')}} </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 orders-child">
            <div class="single-orders">

                <div class="orders-flex-content">

                    <div class="contents">
                        <h2 class="order-titles"> {{$total_post}} </h2>
                        <span class="order-para">{{__('Total Created Post')}} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




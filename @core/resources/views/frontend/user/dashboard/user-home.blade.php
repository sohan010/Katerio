@extends('frontend.user.dashboard.user-master')
@section('section')
    <div class="row">
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01">
                <div class="icon"><i class="fas fa-money-bill"></i></div>
                <div class="content">
                    <h4 class="title">{{__('Total Post')}}</h4>
                    <span class="number">{{$total_post}}</span>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function(){
            $(document).on('click','.mobile-nav-click', function (e){
                e.preventDefault()

                // $('.nav-pills-close').toggleClass('active');
                $('.nav-pills-open').toggleClass('active');
            });
        });
    </script>
@endsection



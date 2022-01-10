@extends('frontend.frontend-page-master')

@section('page-title')
    {{__('Category : ').$category_name}}
@endsection

@section('site-title')
    {{$category_name}}
@endsection

@section('page-meta-data')
    {!! render_site_meta() !!}
    {!! render_site_title($category_name) !!}
@endsection

@section('content')
    <div class="blog-two-wrapper padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if(count($all_blogs) < 1)
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block col-md-12 ">
                                    <strong><div class="error-message "><span>{{__('No Post Available In Category : ').$category_name}}</span></div></strong>
                                </div>
                            </div>
                        @else
                            @foreach($all_blogs as $data)
                                @php
                                    $video_url =  $data->video_url;
                                    $icon_color = get_static_option('blog_category_video_icon_color');
                                @endphp
                            <div class="col-lg-6 col-md-12 wow animated zoomIn" data-wow-delay=".1s">
                                <div class="single-popular-stories margin-top-30">
                                    <div class="popular-stories-thumb video-parent-global">
                                        {!! render_image_markup_by_attachment_id($data->image, '', 'grid') !!}
                                        @if(!empty($video_url))
                                            <div class="popup-videos ">
                                                <a href="{{$video_url}}" class="play-icon videos-play-global videos-play-small" style="color: {{$icon_color}}">
                                                    <i class="las la-play icon"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="popular-stories-contents">
                                        <h4 class="common-title common-title-two">  <a href="{{route('frontend.blog.single',$data->slug)}}">{{$data->getTranslation('title',$user_select_lang_slug) ?? ' '}}</a> </h4>
                                        <div class="popular-stories-tag">
                                            @if($data->created_by == 'user')
                                                @php $user = $data->user; @endphp
                                            @else
                                                @php $user = $data->admin; @endphp
                                            @endif

                                             <span class="tags"> <a @if(!empty($user->id))  href="{{route('frontend.user.created.blog', ['user'=> $data->created_by, 'id'=>$user->id])}}" @endif><strong> {{$data->author ?? __('Anonymous')}} </strong></a> </span>
                                                @foreach($data->category_id as $key => $cat)

                                                        <span class="tags"> <a href="{{route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])}}">{{$cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')}}</a></span>
                                                @endforeach
                                                 <span class="tags"> {{date('d M Y',strtotime($data->created_at))}} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper" aria-label="Page navigation">
                            {{$all_blogs->links()}}
                        </nav>
                @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper custom-margin-widget style-02">
                        {!! render_frontend_sidebar('sidebar_05',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

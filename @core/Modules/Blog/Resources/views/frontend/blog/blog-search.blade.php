@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Search For: ')}} {{$search_term}}
@endsection

@section('site-title')
     {{$search_term}}
@endsection

@section('page-meta-data')
    {!! render_site_meta() !!}
    {!! render_site_title($search_term) !!}
@endsection

@section('content')
    <div class="blog-two-wrapper padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(count($all_blogs) < 1)
                        <div class="alert alert-danger">
                            {{__('Nothing found related to').' '.$search_term}}
                        </div>
                    @endif
                    <div class="row">
                        @foreach($all_blogs as $data)
                            @php
                                $video_url =  $data->video_url;
                                $icon_color = get_static_option('blog_search_video_icon_color');
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
                                            <span class="tags"> <a @if(!empty($user->id)) href="{{route('frontend.user.created.blog', ['user'=> $data->created_by, 'id'=>$user->id])}}" @endif><strong> {{$data->author ?? __('Anonymous')}} </strong></a> </span>
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
                    <div class="pagination-wrapper" aria-label="Page navigation ">
                        {{$all_blogs->links()}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper style-02 padding-reverse">
                        {!! render_frontend_sidebar('sidebar_05',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

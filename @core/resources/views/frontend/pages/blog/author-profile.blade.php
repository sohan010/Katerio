@extends('frontend.frontend-page-master')

@section('site-title')
    {{$author_info->name}} : {{__('Blogs')}}
@endsection

@section('page-title')
    {{$author_info->name}} : {{__('Blogs')}}
@endsection

@section('page-meta-data')
    {!! render_site_meta() !!}
    {!! render_site_title($author_info->name) !!}
@endsection

@section('content')

<div class="author-profile-area padding-bottom-50 padding-top-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="author-profile">
                    <div class="author-profile-flex">
                        @php
                            $img = get_attachment_image_by_id($author_info->image);
                        @endphp
                        <div class="author-thumbs">
                           {!! render_image_markup_by_attachment_id($author_info->image,'','grid') ?? '' !!}
                        </div>
                        <div class="profile-contents">
                            <div class="author-profile-top">
                                <h3 class="profile-title"> <a href="#0"> {{$author_info->name}} </a> </h3>
                                <div class="profile-span"> {{$author_info->designation}} </div>

                                <p class="common-para"> {!! $author_info->description !!}</p>
                            </div>
                            <div class="author-profile-bottom">
                                <ul class="common-socials">
                                    <li>
                                        <a class="facebook" href="{{$author_info->facebook_url}}"> <i class="lab la-facebook-f"></i> </a>
                                    </li>
                                    <li>
                                        <a class="twitter" href="{{$author_info->twitter_url}}"> <i class="lab la-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a class="instagram" href="{{$author_info->instagram_url}}"> <i class="lab la-instagram"></i> </a>
                                    </li>
                                    <li>
                                        <a class="linkedin" href="{{$author_info->linkedin_url}}"> <i class="lab la-linkedin-in"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="related-post-area padding-top-50 padding-bottom-100">
    <div class="container">
        <div class="section-title-two">
            <h4 class="title"> {{__('Author Post')}} </h4>
        </div>
        <div class="row">
         @if(count($all_blogs) < 1)
          <div class="col-md-6">
              <div class="alert-area padding-bottom-100">
                      <div class="alert alert-warning">
                          {!! __('No post found related to').' '. '<strong> '.$author_info->name.' </strong>'!!}
                      </div>
              </div>
          </div>

          @else
         @foreach($all_blogs as $data)
            <div class="col-lg-4 col-md-6 wow animated zoomIn" data-wow-delay=".1s">
                <div class="single-popular-stories margin-top-30">
                    <div class="popular-stories-thumb">
                        {!! render_image_markup_by_attachment_id($data->image, '', 'grid') !!}
                    </div>

                    <div class="popular-stories-contents">
                        <h4 class="common-title common-title-two"> <a href="{{route('frontend.blog.single',$data->slug)}}"> {{$data->getTranslation('title',$user_select_lang_slug) ?? ''}} </a> </h4>
                        <div class="popular-stories-tag">
                            @foreach($data->category_id as $key => $cat)
                                <span class="tags"> <strong> <a href="{{route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)])}}"> {{$cat->getTranslation('title',$user_select_lang_slug) ?? __('Uncategorized')}} </a></strong> </span>
                            @endforeach

                            <span class="tags"> {{ date('d M Y',strtotime($data->created_at)) }} </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-wrapper text-center" aria-label="Page navigation" data-padding-bottom="0">
                    {{$all_blogs->links()}}
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
</div>
@endsection

@if(!empty(get_static_option('leftbar_show_hide')))
<div class="sidebars-wrappers">
    <div class="sidebars-close"> <i class="las la-times"></i> </div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <a href="{{url('/')}}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo_two')) !!}
            </a>
        </div>
        <div class="contents-wrapper">
            <h4 class="connets-title"> {!! get_static_option('leftbar_social_'.$user_select_lang_slug.'_title') !!}</h4>
            <div class="updated-socials">
                <ul class="common-socials">
                    @php
                        $classes = ['facebook','twitter','instagram','linkedin','youtube' ];
                        $con = 0;
                    @endphp
                    @foreach($social_icons_for_leftbar as  $social)
                    <li>
                        <a class="{{$classes[$con] ?? ''}}" href="{{$social->details}}"> <i class="{{$social->icon}}"></i> </a>
                    </li>

                        @php $con == 5 ? $con = 0 : $con ++   @endphp
                    @endforeach
                </ul>
            </div>
            <div class="sidebar-updated-content">
                <div class="section-title">
                    <h4 class="title"> {!! get_static_option('leftbar_category_'.$user_select_lang_slug.'_title') !!} </h4>
                </div>
                <div class="categories-contents-inner">
                    <div class="categories-lists">
                        @foreach($category_for_leftbar as  $category)
                            @php
                                $count_blog_item = \App\Blog::whereJsonContains('category_id', (string) $category->id)->count();
                            @endphp
                        <div class="single-list">
                             <span class="follow-para"><a href="{{route('frontend.blog.category', ['id' => $category->id,'any' => Str::slug($category->title)])}}"> {{$category->title}}</a> </span>
                            <span class="followers"> {{$count_blog_item}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tag-new-contents">
                    <div class="section-title">
                        <h4 class="title"> {!! get_static_option('leftbar_tag_'.$user_select_lang_slug.'_title') !!} </h4>
                    </div>
                    <div class="tag-list">
                        @foreach($tags_for_leftbar as  $tag)
                        <a class="list" href="{{route('frontend.blog.tags.page', ['any' => $tag->name])}}"> {{$tag->name}} </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
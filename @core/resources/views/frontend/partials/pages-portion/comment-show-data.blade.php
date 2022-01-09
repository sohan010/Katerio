
    @foreach($blogComments as $key => $data)
        <div class="single-comments">
        <div class="comments-flex-contents">
            <div class="comment-author">
                {!! render_image_markup_by_attachment_id(optional($data->user)->image ?? get_static_option('single_blog_page_comment_avatar_image')) !!}
            </div>
            <div class="comments-content">
                <div class="flex-replay">
                    <span class="author-title" data-parent_name="{{optional($data->user)->name }}"> {{optional($data->user)->name ?? ''}}</span>

                    @if(auth('web')->check() && auth('web')->id() != $data->user_id)
                    <div class="btn-wrapper">
                        <a href="#0" data-comment_id="{{ $data->id }}"  class="btn-replay"> {{__('Replay')}} </a>
                    </div>
                    @endif
                </div>

                <span class="comment-date">{{date('d F Y', strtotime($data->created_at ?? ''))}} </span>
                <p class="common-para">{!! $data->comment_content ?? '' !!}</p>

            </div>
        </div>
            @foreach($data->reply as $repData)
                <div class="child-single-comments">
                    <div class="comments-flex-contents">
                        <div class="comment-author">
                            {!! render_image_markup_by_attachment_id($repData->user->image ?? get_static_option('single_blog_page_comment_avatar_image')) !!}
                        </div>
                        <div class="comments-content">
                            <div class="flex-replay">
                                <span class="author-title" > {{$repData->user->name ?? ''}}</span>
                            </div>

                            <span class="comment-date">{{date('d F Y', strtotime($repData->created_at ?? ''))}} </span>
                            <p class="common-para">{!! $repData->comment_content ?? '' !!}</p>

                        </div>
                    </div>
                </div>
     @endforeach
</div>
 @endforeach


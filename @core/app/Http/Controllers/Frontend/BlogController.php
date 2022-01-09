<?php

namespace App\Http\Controllers\Frontend;

use App\Admin;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;

class BlogController extends Controller
{

    public function blog_single($slug)
    {

        $blog_post = Blog::where('slug', $slug)->first();

        if (empty($blog_post)) {
            abort(404);
        }

        $blogCommentCount = BlogComment::where('blog_id', $blog_post->id)
            ->where('parent_id', null)
            ->count();

        $blogComments = BlogComment::with('reply')
            ->where('parent_id', null)
            ->where('blog_id', $blog_post->id)
            ->orderBy('id', 'desc')
            ->take(5)->get();

        $cat_id = '';
        foreach ($blog_post->category_id as $item) {
            $cat_id .= $item->id;
        }


        $all_related_blog = Blog::with(['user', 'admin'])->whereJsonContains('category_id', $cat_id)->where('status','publish')->orderBy('id', 'desc')->take(2)->get();


        if (is_null($blog_post->views)) {
            Blog::where('id', $blog_post->id)->update(['views' => 0]);
        } else {
            Blog::where('id', $blog_post->id)->increment('views');
        }

        return view('frontend.pages.blog.blog-single')->with([
            'blog_post' => $blog_post,
            'all_related_blog' => $all_related_blog,
            'blogCommentCount' => $blogCommentCount,
            'blogComments' => $blogComments,
        ]);
    }

    public function category_wise_blog_page($id)
    {
        $all_blogs = Blog::whereJsonContains('category_id', $id)->orderBy('id', 'desc')->paginate(4);
        $category_name = BlogCategory::where(['id' => $id])->first()->title;

        return view('frontend.pages.blog.blog-category')->with([
            'all_blogs' => $all_blogs,
            'category_name' => $category_name,
        ]);
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $all_data = Blog::where('status', 'publish')
            ->whereJsonContains('tag_id', $query)
            ->orWhere('title', 'LIKE', "%$query%")->paginate(10);

        $html_markup = '';
        foreach ($all_data as $data) {
            $route = route('frontend.blog.single', ['slug' => $data->slug]);
            $html_markup .= '<li class="article-wrap"><a href="' . $route . '"> <i class="fas fa-newspaper"></i> ' . Str::words($data->title, 5) . '</a></li>';
        }
        return response()->json($html_markup);
    }

    public function tags_wise_blog_page($tag)
    {
        $all_blogs = Blog::whereJsonContains('tag_id', $tag)->paginate(4);

        return view('frontend.pages.blog.blog-tags')->with([
            'all_blogs' => $all_blogs,
            'tag_name' => $tag,
        ]);
    }


    public function blog_search_page(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ],
            ['search.required' => 'Enter anything to search']);

        $all_blogs = Blog::Where('title', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'desc')->paginate(6);

        return view('frontend.pages.blog.blog-search')->with([
            'all_blogs' => $all_blogs,
            'search_term' => $request->search,

        ]);
    }

    public function blog_get_search(Request $request)
    {
        $all_blogs = Blog::Where('title', 'LIKE', '%' . $request->term . '%')
            ->orderBy('id', 'desc')->paginate(6);

        return view('frontend.pages.blog.blog-search')->with([
            'all_blogs' => $all_blogs,
            'search_term' => $request->term,

        ]);
    }

    public function blog_comment_store(Request $request)
    {
        $this->validate($request, [
            'comment_content' => 'required'
        ]);

        $content = BlogComment::create([
            'blog_id' => $request->blog_id,
            'user_id' => $request->user_id,
            'parent_id' => $request->comment_id,
            'commented_by' => $request->commented_by,
            'comment_content' => purify_html($request->comment_content),
        ]);

        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('You have a comment from') . ' ' . get_static_option('site_title'),
                'message' => __('you have a new comment submitted by') . ' ' . Auth::user()->name . ' ' . __('Email') . ' ' . Auth::user()->email . ' .' . __('check admin panel for more info'),
            ]));

        } catch (\Exception $e) {
            return redirect()->back()->with(FlashMsg::error($e->getMessage()));
        }


        return response()->json([
            'msg' => __('Your comment sent succefully'),
            'type' => 'success',
            'status' => 'ok',
            'content' => $content,
        ]);
    }

    public function load_more_comments(Request $request)
    {
        $all_comment = BlogComment::with(['blog', 'user','reply'])
            ->where('parent_id',null)
            ->orderBy('id','desc')
            ->skip($request->items)
            ->take(5)
            ->get();

        $markup = '';
        foreach ($all_comment as $item) {
            $image = render_image_markup_by_attachment_id(optional($item->user)->image ?? get_static_option('single_blog_page_comment_avatar_image'));
            $var_data_parent_name = optional($item->user)->name;
            $title = optional($item->user)->name ?? '';
            $created_at = date('d F Y', strtotime($item->created_at ?? ''));
            $comment_content = $item->comment_content;
            $data_id = $item->id;
            $replay_mark = '';


            $replay_mark .= <<<REPLA
 <div class="btn-wrapper">
       <a href="#0" data-comment_id="{$data_id}"  class="btn-replay"> Reply</a>
 </div>
REPLA;

            $repl = auth('web')->check() && auth('web')->id() != $item->user_id ? $replay_mark : '';

            $li_data = '';
            foreach ($item->reply as $repData) {
                $child_image = render_image_markup_by_attachment_id(optional($repData->user)->image ?? get_static_option('single_blog_page_comment_avatar_image'));
                $child_user_name = $repData->user->name ?? '';
                $child_commented_date = date('d F Y', strtotime($repData->created_at ?? ''));
                $child_comment = $repData->comment_content ?? '';


                $li_data .= <<<LIDATA

 <div class="child-single-comments">
        <div class="comments-flex-contents">
            <div class="comment-author">
                {$child_image}
            </div>
            <div class="comments-content">
                <div class="flex-replay">
                    <span class="author-title">{$child_user_name}</span>
                    <span class="comment-date">  {$child_commented_date} </span>
                </div>
         
                <p class="comment">{$child_comment}</p>

            </div>
        </div>
        </div>

LIDATA;
            }


            $markup .= <<<HTML

        <div class="single-comments">
        <div class="comments-flex-contents">
            <div class="comment-author">
                {$image}
            </div>
            <div class="comments-content">
                <div class="flex-replay">
                    <span class="author-title" data-parent_name="{$var_data_parent_name}">{$title}</span>
                   {$repl}
                </div>

                <span class="comment-date"> {$created_at} </span>
                <p class="common-para">{$comment_content}</p>

            </div>
        </div>
        {$li_data}
   </div>

HTML;
        }

        return response()->json(['blogComments' => $all_comment, 'markup' => $markup]);
    }

    public function user_created_blogs($user, $id)
    {
        $id_type = $user === 'user' ? 'user_id' : 'admin_id';
        $all_blogs = Blog::where(['created_by' => $user, $id_type => $id, 'status' => 'publish'])->paginate(6);
        $user_info = $user === 'user' ? User::find($id) : Admin::find($id);
        if (empty($user_info)) {
            abort(404);
        }
        return view('frontend.pages.blog.user-blog', compact('all_blogs', 'user_info'));
    }

    public function author_profile($id)
    {
        $author_info = User::find($id);
        $all_blogs = Blog::where('user_id', $id)->paginate(6);
        if (empty($author_info)) {
            abort(404);
        }
        return view('frontend.pages.blog.author-profile', compact('all_blogs', 'author_info'));
    }


    public function get_tags_by_ajax(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Tag::Where('name', 'LIKE', '%' . $query . '%')->get();
        $html_markup = '';
        $result = [];
        foreach ($filterResult as $data) {
            array_push($result, $data->name);
        }
        return response()->json(['result' => $result]);
    }


    public function get_blog_by_ajax(Request $request)
    {
        $current_lang = LanguageHelper::user_lang_slug();
        $blogs = Blog::where(['status' => 'publish'])->whereJsonContains('category_id', $request->id)->take(4)->get();

        $news_markup = '';
        foreach ($blogs as $item) {
            $video_and_image = '';
            $image_markup = render_image_markup_by_attachment_id($item->image, '');
            $route = route('frontend.blog.single', $item->slug);
            $title = SanitizeInput::esc_html($item->getTranslation('title', $current_lang) ?? '');
            $date = date('M d, Y', strtotime($item->created_at));
            $category_markup = '';
            foreach ($item->category_id as $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= ' <li class="tag-list active"><a class="item" href="' . $category_route . '">' . $category . '</a></li>';
            }

            $video_url = SanitizeInput::esc_html($item->video_url);
            $video_and_image .= '
                   <a href="' . $video_url . '" class="play-icon videos-play-global videos-play-small">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';

            $news_markup .= <<<HTML
         <div class="col-lg-6">
            <div class="single-news margin-top-30">
                <div class="news-thumb video-parent-global">
                {$image_markup}
                 <div class="popup-videos"> {$video_url_condition}</div>
                    <ul class="news-date-tag">
                        <li class="tag-list"> $date </li>
                        {$category_markup}
                    </ul>
                </div>
                <div class="news-contents">
                    <a href="{$route}"><h3 class="common-title"> {$title} </h3></a>
                </div>
            </div>
        </div>

HTML;
        }
        return response()->json(['markup' => $news_markup]);

    }
    
    public function user_blog_password(Request $request){

        $request->validate([
           'user_blog_password'=> 'required|string|max:20'
        ]);

        $blog_id = $request->password_form_id;
        $original_password = $request->original_password;
        $user_password = $request->user_blog_password;
         Session::put('user_given_password',$user_password);

        if($original_password  == $user_password){
            return redirect()->back();
        }else{
            return redirect()->back()->with(FlashMsg::item_delete('Password Not Matching..!'));
        }


    }


}

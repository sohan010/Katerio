<?php


namespace App\PageBuilder\Addons\StaticHeader;
use App\Blog;
use App\BlogComment;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Illuminate\Support\Str;

class HeaderOne extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'header/header-one.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $blogs = Blog::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();

        $output .= NiceSelect::get([
            'name' => 'blogs',
            'multiple'=> true,
            'label' => __('Blogs'),
            'placeholder' =>  __('Select Blogs'),
            'options' => $blogs,
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('you can select blog or leave it empty')
        ]);

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);


        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render() : string
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();

        $blog = $this->setting_item('blogs') ?? [];
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));

        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        $blogs = Blog::whereIn('id',$blog)->where('status','publish')->orderBy($order_by,$order);

        if(!empty($items)){
            $blogs = $blogs->take($items)->get();
        }else{
            $blogs = $blogs->get();
        }

        $category_button_color = ['bg-color-a','bg-color-d','bg-color-f'];
        $blog_markup = '';
        foreach ($blogs as $key=> $item) {

            $bg_image_markup = render_background_image_markup_by_attachment_id($item->image, '');
            $route = route('frontend.blog.single', $item->slug);
            $title = Str::words($item->getTranslation('title', $current_lang),13);
            $created_by = SanitizeInput::esc_html($item->author ?? __('Anonymous'));
            $created_by_image = render_image_markup_by_attachment_id(optional($item->user)->image) ?? render_image_markup_by_attachment_id(get_static_option('single_blog_page_comment_avatar_image'));
            $date = date('M d, Y', strtotime($item->created_at));

            $category_markup = '';
            foreach ($item->category_id as $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= ' <a class="category-style-01 '.$category_button_color[$key % count($category_button_color)].'" href="' . $category_route . '">' . $category . '</a>';
            }


            if ($item->created_by === 'user') {
                $user_id = $item->user_id;
            } else {
                $user_id = $item->admin_id;
            }

            $created_by_url = !is_null($user_id) ?  route('frontend.user.created.blog', ['user' => $item->created_by, 'id' => $user_id]) : route('frontend.blog.single',$item->slug) ;

            $comment_count = BlogComment::where('blog_id',$item->id)->count();
            $comment_condition_check = $comment_count == 0 ? 0 : $comment_count;

   $blog_markup .= <<<HTML
        <div class="col-lg-4">
            <div class="image-blog-style-01">
                <div class="img-box">
                    <div class="background-img"{$bg_image_markup} data-height="740">
                    </div>
                    <span class="overlay"></span>
                </div>
                <div class="content">
                
                    {$category_markup}
                    
                    <h3 class="title">
                        <a href="{$route}">{$title}</a>
                    </h3>
                    <div class="post-meta color-white">
                        <ul class="post-meta-list">
                            <li class="post-meta-item">
                                <a href="{$created_by_url}">
                                   {$created_by_image}
                                    <span class="text">{$created_by}</span>
                                </a>
                            </li>
                            <li class="post-meta-item date">
                                <i class="lar la-clock icon"></i>
                                <span class="text">{$date}</span>
                            </li>
                            <li class="post-meta-item">
                                <a href="#">
                                    <i class="lar la-comments icon"></i>
                                    <span class="text">{$comment_condition_check}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       

HTML;

}



 return  <<<HTML
    <div class="header-area-wrapper" data-padding-top="30" data-padding-bottom="0">
        <div class="header-area index-01">
                 <div class="container-fluid padding-x-0"data-padding-top="{$padding_top}" data-padding-bottom="$padding_bottom">
                        <div class="row if-index-01-header-slider-inst">
                            {$blog_markup}
                     </div>
                </div>
            </div>
        </div>

HTML;

}


    public function addon_title()
    {
        return __('Static Header: 01');
    }
}
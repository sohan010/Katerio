<?php


namespace App\PageBuilder\Addons\Blog;
use App\Blog;
use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
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
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Illuminate\Support\Str;

class BlogGridThree extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'blog-page/blog-grid-03.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);

            $output .= Text::get([
                'name' => 'section_title_'.$lang->slug,
                'label' => __(' Section Title'),
                'value' => $widget_saved_values['section_title_'.$lang->slug] ?? null,
            ]);


            $categories = BlogCategory::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= NiceSelect::get([
            'multiple' => true,
            'name' => 'categories',
            'label' => __('Section Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
        ]);

        $output .= ColorPicker::get([
            'name' => 'play_icon_color',
            'label' => __('Play Icon Color'),
            'value' => $widget_saved_values['play_icon_color'] ?? null,

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
            'label' => __(' Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many left item you want to show in frontend'),
        ]);


        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Left Section Column'),
            'options' => [
                'col-lg-3' => __('04 Column'),
                'col-lg-4' => __('03 Column'),
                'col-lg-6' => __('02 Column'),
                'col-lg-12' => __('01 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
        ]);


        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Pagination Settings')
        ]);

        $output .= Switcher::get([
            'name' => 'pagination_status',
            'label' => __('Enable/Disable Pagination'),
            'value' => $widget_saved_values['pagination_status'] ?? null,
            'info' => __('your can show/hide pagination'),
        ]);

        $output .= Select::get([
            'name' => 'pagination_alignment',
            'label' => __('Pagination Alignment'),
            'options' => [
                'text-left' => __('Left'),
                'center-text' => __('Center'),
                'end-text' => __('Right'),
            ],
            'value' => $widget_saved_values['pagination_alignment'] ?? null,
            'info' => __('set pagination alignment'),
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

        // add padding option

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $selected_lang = get_user_lang();
        $current_lang = LanguageHelper::user_lang_slug();
        $category = $this->setting_item('categories') ?? [];
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));

        $columns = $this->setting_item('columns') ?? [];
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $pagination_alignment = $this->setting_item('pagination_alignment');
        $pagination_status = $this->setting_item('pagination_status');
        $play_icon_color = $this->setting_item('play_icon_color');
        $section_title = SanitizeInput::esc_html($this->setting_item('section_title_'. $current_lang)) ;


        $blogs = Blog::usingLocale($current_lang)->query();

        if (!empty($category)){
            $blogs->whereJsonContains('category_id', current($category));
        }
        $blogs =$blogs->orderBy($order_by,$order);
        if(!empty($items)){
            $blogs = $blogs->paginate($items);
        }else{
            $blogs = $blogs->get();

        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12 "><div class="pagination-wrapper '.$pagination_alignment.'">'.$blogs->links().'</div></div>';
        }

        $blog_markup = '';
        foreach ($blogs as $item) {
            $video_and_image = '';
            $image = render_image_markup_by_attachment_id($item->image,'','grid');
            $route = route('frontend.blog.single', $item->slug);
            $title = Str::words($item->getTranslation('title', $selected_lang),7);
            $created_by = SanitizeInput::esc_html($item->author ?? __('Anonymous'));
            $creating_date = date_format($item->created_at, 'M d, Y');

            $video_url = SanitizeInput::esc_html($item->video_url);
            $video_and_image .= '<a href="' . $video_url . '" class="play-icon videos-play-global videos-play-small" style="color: ' . $play_icon_color . '">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';


            $category_markup = '';
            foreach ($item->category_id as $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= '<span class="span-title"><a  href="' . $category_route . '">' . $category . '</a></span>';
            }

            if ($item->created_by === 'user') {
                $user_id = $item->user_id;
            } else {
                $user_id = $item->admin_id;
            }

            $created_by_url = !is_null($user_id) ?  route('frontend.user.created.blog', ['user' => $item->created_by, 'id' => $user_id]) : route('frontend.blog.single',$item->slug) ;


$blog_markup .= <<<HTML
    <div class="{$columns} col-md-6">
        <div class="single-popular-stories margin-top-30">
            <div class="popular-stories-thumb video-parent-global">
               {$image}
            <div class="popup-videos">{$video_url_condition}</div>
            </div>
            <div class="popular-stories-contents">
                <h4 class="common-title common-title-two"> <a href="{$route}"> {$title} </a> </h4>
                <div class="popular-stories-tag">
                    <span class="tags"><a href="{$created_by_url}"> <strong> {$created_by} </strong></a> </span>
                    <span class="tags"> {$creating_date} </span>
                </div>
            </div>
        </div>
    </div>
     
HTML;
}


 return <<<HTML
    <div class="popular-stories-area res-padding-reverse res-margin-rev" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
           
            <div class="row">
                {$blog_markup}
                {$pagination_markup}
            </div>
        </div>
    </div>
HTML;

}

    public function addon_title()
    {
        return __('Blog Grid : 03');
    }
}
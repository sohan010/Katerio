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

class BlogGridTwo extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'blog-page/blog-grid-02.png';
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
                'name' => 'section_left_title_'.$lang->slug,
                'label' => __('Left Section Title'),
                'value' => $widget_saved_values['section_left_title_'.$lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'section_right_title_'.$lang->slug,
                'label' => __('Right Section Title'),
                'value' => $widget_saved_values['section_right_title_'.$lang->slug] ?? null,
            ]);


            $categories = BlogCategory::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= NiceSelect::get([
            'multiple' => true,
            'name' => 'categories',
            'label' => __('Left Section Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
        ]);

        $output .= NiceSelect::get([
            'multiple' => true,
            'name' => 'categories_right',
            'label' => __('Right Section Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories_right'] ?? null,
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
            'label' => __('Left Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many left item you want to show in frontend'),
        ]);

        $output .= Number::get([
            'name' => 'right_items',
            'label' => __('Right Items'),
            'value' => $widget_saved_values['right_items'] ?? null,
            'info' => __('enter how many right item you want to show in frontend'),
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
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $category = $this->setting_item('categories') ?? [];
        $category_right = $this->setting_item('categories_right') ?? [];
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $right_items = SanitizeInput::esc_html($this->setting_item('right_items'));
        $columns = $this->setting_item('columns') ?? [];
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $pagination_alignment = $this->setting_item('pagination_alignment');
        $pagination_status = $this->setting_item('pagination_status') ?? '';
        $play_icon_color = $this->setting_item('play_icon_color') ?? '';
        $section_left_title = SanitizeInput::esc_html($this->setting_item('section_left_title_'. $current_lang)) ;
        $section_right_title = SanitizeInput::esc_html($this->setting_item('section_right_title_'. $current_lang));

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

        $blog_hot_news_left_markup = '';
        foreach ($blogs as  $item) {
        $video_and_image = '';
            $image = render_image_markup_by_attachment_id($item->image);
            $route = route('frontend.blog.single', $item->slug);
            $title = SanitizeInput::esc_html($item->getTranslation('title', $selected_lang) ?? '');
            $description = SanitizeInput::esc_html(Str::words($item->getTranslation('blog_content', $selected_lang), 40) ?? '');

            $video_url = SanitizeInput::esc_html($item->video_url);
            $video_and_image .= '
                   <a href="' . $video_url . '" class="play-icon videos-play-global videos-play-medium" style="color: ' . $play_icon_color . '">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';

            $category_markup = '';
            foreach ($item->category_id as $key => $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= '<span class="span-title"><a  href="' . $category_route . '">' . $category . '</a></span>';
            }


            $blog_hot_news_left_markup .= <<<HTML
      <div class="$columns wow animated fadeInUp" data-wow-delay=".2s">
            <div class="single-topics single-details margin-top-30">
                <div class="topics-thumb details-thumbs video-parent-global">
                   {$image}
                  <div class="popup-videos"> {$video_url_condition}</div>
                </div>
                <div class="topic-contents">
                     {$category_markup} 
                    <h3 class="common-title"> <a href="{$route}"> {$title} </a> </h3>
                    <p class="common-para"> {$description} </p>
                </div>
            </div>
        </div>
     
HTML;
}

        $right_blogs = Blog::usingLocale($current_lang)->query();

        if (!empty($category_right)){
            $right_blogs->whereJsonContains('category_id', current($category_right));
        }
        $right_blogs =$right_blogs->orderBy($order_by,$order);
        if(!empty($right_items)){
            $right_blogs = $right_blogs->paginate($right_items);
        }else{
            $right_blogs = $right_blogs->get();

        }

        $blog_hot_news_right_markup = '';
        foreach ($right_blogs as $key=> $item){
            $right_image = render_image_markup_by_attachment_id($item->image);
            $right_route = route('frontend.blog.single',$item->slug);
            $right_title = SanitizeInput::esc_html($item->getTranslation('title',$selected_lang) ?? '');
            $right_category_markup = '';
            foreach ($item->category_id as $cat){
                $right_category = $cat->getTranslation('title',$current_lang);
                $right_category_route = route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)]);
                $right_category_markup.='<span class="span-title"><a  href="'.$right_category_route.'">'.$right_category.'</a></span>';
            }

$blog_hot_news_right_markup .= <<<HTML
    <div class="recent-contents style-03 wow animated fadeInUp" data-wow-delay=".4s">
        <div class="recent-flex-contents">
            <div class="flex-thumbs">
                 {$right_image }
            </div>
            <div class="flex-contents">
                  {$right_category_markup} 
                <h4 class="common-title"> <a href="{$right_route}"> {$right_title} </a> </h4>
            </div>
        </div>
    </div>

HTML;
}

 return <<<HTML

    <section class="topics-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container container-two">
            <div class="row">

        <div class="section-title">
            <h4 class="title"> {$section_left_title}</h4>
        </div>
        <div class="row">
           <div class="col-xl-8 wow animated fadeInUp" data-wow-delay=".4s">
             <div class="row">
              {$blog_hot_news_left_markup}
           </div> 
        </div> 
              
    <div class="col-xl-4">
        <div class="visited-area responsive-margin">
            <div class="section-title">
                <h4 class="title">{$section_right_title} </h4>
            </div>
            <div class="visited-wrapper">
                <div class="sidebar-contents">
                      {$blog_hot_news_right_markup}
                 </div>
            </div>
        </div>
    </div>
              {$pagination_markup}
        </div>
    </div>
   </div>
 </div>
</section>
HTML;

}

    public function addon_title()
    {
        return __('Blog Grid : 02');
    }
}
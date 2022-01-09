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
use App\User;
use Illuminate\Support\Str;

class BlogGridSliderOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
       return 'blog-page/grid-slider-01.jpg';
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
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $categories = BlogCategory::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'categories',
            'label' => __('Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
            'info' => __('you can select category for blog, if you want to show all event leave it empty')
        ]);

        $output .= ColorPicker::get([
            'name' => 'play_icon_color',
            'label' => __('Play Icon Color'),
            'value' => $widget_saved_values['play_icon_color'] ?? null,

        ]);


        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'left-align' => __('Left Align'),
                'center-align' => __('Center Align'),
                'right-align' => __('Right Align'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set alignment of section title')
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
            'info' => __('enter how many item you want to show in frontend'),
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
        $current_lang = LanguageHelper::user_lang_slug();
        $section_title = SanitizeInput::esc_html($this->setting_item('section_title_'.$current_lang));
        $section_title_alignment = SanitizeInput::esc_html($this->setting_item('section_title_alignment'));
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $category = SanitizeInput::esc_html($this->setting_item('categories'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $play_icon_color = $this->setting_item('play_icon_color') ?? '';

        $blogs = Blog::usingLocale($current_lang)->where('status','publish');
        if (!is_null($category) && $category !== 'Select Category'){
            $blogs->whereJsonContains('category_id', $category);
        }
        $blogs = $blogs->orderBy($order_by,$order);

        if(!empty($items)){
            $blogs = $blogs->paginate($items);
        }else{
            $blogs = $blogs->get();
        }

        $slider_markup = '';
        foreach ($blogs as $item){
            $video_and_image = '';
         $image = render_image_markup_by_attachment_id($item->image, '', 'grid');
         $title = Str::words($item->getTranslation('title',$current_lang),10);
         $route = route('frontend.blog.single',$item->slug);
            $category_markup = '';
            foreach ($item->category_id as $key=> $cat){
                $category = $cat->getTranslation('title',$current_lang);
                $category_route = route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)]);
                $category_markup.='<a href="'.$category_route.'"> <span class="span-title">'.$category.'</span></a>';
            }

            $video_url = SanitizeInput::esc_html($item->video_url);
            $video_and_image .= '
                   <a href="' . $video_url . '" class="play-icon videos-play-global videos-play-small" style="color: ' . $play_icon_color . '">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';

   $slider_markup .= <<<HTML
    <div class="single-sports-slider">
        <div class="single-sports">
            <div class="sports-thumbs video-parent-global">
                {$image}
                <div class="popup-videos"> {$video_url_condition}</div>
            </div>
            <div class="sports-contents">
               {$category_markup}
                <h4 class="common-title"> <a href="{$route}">{$title}</a> </h4>
            </div>
        </div>
    </div>
HTML;
}

  return <<<HTML
    <section class="sports-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container container-two">
            <div class="section-title">
                <h4 class="title {$section_title_alignment}"> {$section_title} </h4>
            </div>
            <div class="sports-slider slider-nav-style margin-top-40">
                {$slider_markup}
            </div>
        </div>
    </section>
HTML;

}


    public function addon_title()
    {
        return __('Grid Slider: 01');
    }
}
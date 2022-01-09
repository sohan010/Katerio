<?php


namespace App\PageBuilder\Addons\HeaderSlider;


use App\Blog;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\DatePicker;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Illuminate\Support\Str;

class HeaderSliderTwo extends PageBuilderBase
{
    use  LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'header/slider-02.png';
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
            'multiple'=>true,
            'label' => __('Blog'),
            'placeholder' => __('Select Blog'),
            'options' => $blogs,
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('you can select category for blog, if you want to show all event leave it empty')
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
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 225,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 220,
            'max' => 500,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render():string
    {
        $current_lang = get_user_lang();
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $play_icon_color = $this->setting_item('play_icon_color') ?? '';
        $blog = $this->setting_item('blogs') ?? '';

        $blogs = Blog::whereIn('id', $blog)->orderBy($order_by, $order)->take($items)->get();

        $video_and_image = '';
        $child_markup = '';
        foreach ($blogs as $item) {
            $bg_image = render_background_image_markup_by_attachment_id($item->image, 'full');
            $title = Str::words($item->getTranslation('title', $current_lang), 12) ?? '';
            $route = route('frontend.blog.single', $item->slug);
            $video_url = $item->video_url ?? '';
            $category_markup = '';
            foreach ($item->category_id as $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= ' <span class="span-title style-02"><a href="' . $category_route . '">' . $category . '</a></span>';
            }

            $video_and_image .= '
                   <a href="' . $video_url . '" class="play-icon videos-play-global" style="color: ' . $play_icon_color . '">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';


$child_markup.= <<<HTML
    <div class="single-banner-slider bg-image video-parent-global" {$bg_image}>
         <div class="popup-videos">
             {$video_url_condition}
        </div>
        
            <div class="container" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-contents-02">
                          {$category_markup}
                            <h2 class="banner-title"><a href="{$route}">  {$title}</a></h2> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
HTML;
}

      return <<<PARENT
    <div class="banner-area">
        <div class="banner-slider slick-slider-two">
        {$child_markup}
      </div>
    </div>   

PARENT;


 }

    public function addon_title()
    {
        return __('Header Slider : 02');
    }




}
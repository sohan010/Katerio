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
use App\PageBuilder\Helpers\StylesheetHelper;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Illuminate\Support\Str;

class VideoAreaStyleTwo extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'blog-page/video-02.png';
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
                'name' => 'heading_text_'.$lang->slug,
                'label' => __('Heading Text'),
                'value' => $widget_saved_values['heading_text_'.$lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

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
        $selected_blog = $this->setting_item('blogs') ?? [];
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $play_icon_color = $this->setting_item('play_icon_color') ?? '';

        $heading_text = SanitizeInput::esc_html($this->setting_item('heading_text_'.$current_lang) ?? '');
        $blogs = Blog::usingLocale(LanguageHelper::default_slug())->whereIn('id',$selected_blog);
        if (!empty($items)){
            $blogs->take($items);
        }
        $blogs =  $blogs->get();

        $video_markup = '';
        foreach ($blogs as  $item){
            $image = render_image_markup_by_attachment_id($item->image,'large');
            $title = Str::words($item->getTranslation('title',$current_lang),12) ?? '';
            $video_url = $item->video_url ?? '';
            $category_markup = '';
            foreach ($item->category_id as $cat){
                $category = $cat->getTranslation('title',$current_lang);
                $category_route = route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)]);
                $category_markup .= ' <span class="beauty-title mr-2"><a href="'.$category_route.'">'.$category.'</a></span>' ;
            }
            $video_play_btn = '';
            if (!empty($video_url)){
                $video_play_btn =' <a href="'.$video_url.'"class="videos-play"> <i class="las la-play" style="color: '.$play_icon_color.' !important;"></i></a>';
            }
            $route = route('frontend.blog.single',$item->slug);

$video_markup .= <<<HTML
<div class="video-wrapper margin-top-40">
    <div class="single-videos">
        <div class="video-thumbs">
                {$image}
       
      <div class="popup-videos style-02">
           {$video_play_btn}
      </div>
           
        </div>
        <div class="video-contents style-02">
            <div class="d-flex justify-content-center">
             {$category_markup}
            </div>
            <h2 class="video-title"> <a href="{$route}">{$title}</a> </h2>
        </div>
    </div>
</div>
HTML;
}

 return <<<HTML
    <section class="video-area"data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="section-title-two">
                <h4 class="title"> {$heading_text} </h4>
            </div>
            <div class="video-slider-two slider-nav-style-two">
                {$video_markup}
            </div>
        </div>
    </section>
HTML;

    }

    public function addon_title()
    {
        return __('Video Area : 02');
    }
}
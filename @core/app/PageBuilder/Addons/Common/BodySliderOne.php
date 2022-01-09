<?php


namespace App\PageBuilder\Addons\Common;


use App\Blog;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Tag;
use Illuminate\Support\Str;

class BodySliderOne extends PageBuilderBase
{
    use RepeaterHelper, LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'common/body_slider_social_tag-01.png';
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
                'name' => 'left_section_title_'.$lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['left_section_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $categories = Blog::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'blogs',
            'multiple' => true,
            'label' => __('Post'),
            'options' => $categories,
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('you can select specific blog post for header slider')
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
            'name' => 'blog_items',
            'label' => __('Blog Items'),
            'value' => $widget_saved_values['blog_items'] ?? null,
            'info' => __('enter how many blog item you want to show in frontend'),
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

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));

        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        $blog = $this->setting_item('blogs');
        $blog_items = $this->setting_item('blog_items') ?? [];
        $left_section_title = SanitizeInput::esc_html($this->setting_item('left_section_title_'.$current_lang));


        $blogs = Blog::usingLocale($current_lang)->where('status','publish');

        if (!empty($blog)){
            $blogs->whereIn('id', $blog);
        }
        $blogs = $blogs->orderBy($order_by,$order);

        if(!empty($blog_items)){
            $blogs = $blogs->paginate($blog_items);
        }else{
            $blogs = $blogs->get();
        }


        $slider_markup  = '';
        foreach ($blogs as $item){
            $image = render_image_markup_by_attachment_id($item->image,'','full');
            $route = route('frontend.blog.single',$item->slug);
            $title = SanitizeInput::esc_html($item->getTranslation('title',$current_lang) ?? '');
            $created_by = SanitizeInput::esc_html($item->author ?? __('Anonymous'));
            $creating_date = date_format($item->created_at, 'M d, Y');

            $blog_category_markup = '';
            foreach ($item->category_id as $cat){
                $length = count($item->category_id )  ? ' | ' : ' ';
                $blog_category_markup .= '<span class="tags"><a href="'.route('frontend.blog.category',['id' => $cat->id,'any' => Str::slug($cat->title  ?? '')]).'">'.$cat->getTranslation('title',$current_lang) . $length .'</a></span>';
            }

            if ($item->created_by === 'user') {
                $user_id = $item->user_id;
            } else {
                $user_id = $item->admin_id;
            }


       $created_by_url = !is_null($user_id) ?  route('frontend.user.created.blog', ['user' => $item->created_by, 'id' => $user_id]) : route('frontend.blog.single',$item->slug) ;


 $slider_markup .= <<<SLIDER
     <div class="single-stories-slider">
        <div class="recent-stories-thumbs">
           {$image}
        </div>
        <div class="recent-stories-contents">
            <div class="popular-stories-tag">
                <span > <a href="{$created_by_url}"><strong> {$created_by} </strong></a> </span>
                <span class="tags"> {$creating_date} </span>
                {$blog_category_markup}
            </div>
            <h4 class="recent-stories-title"> <a href="{$route}"> {$title} </a> </h4>
        </div>
    </div>
SLIDER;
}



return <<<PARENT
    <section class="recent-stories-area margin-reverse-20" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h4 class="title"> {$left_section_title}</h4>
                    </div>
                    <div class="recent-stories-slider slick-slider-three slider-nav-style-two">
                        {$slider_markup}
                    </div>
                </div>
               
            </div>
        </div>
    </section>
PARENT;

    }

    public function addon_title()
    {
        return __('Body Slider : 01');
    }

}
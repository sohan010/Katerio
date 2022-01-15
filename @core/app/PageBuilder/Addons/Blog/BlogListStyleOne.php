<?php


namespace App\PageBuilder\Addons\Blog;
use App\Blog;
use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Illuminate\Support\Str;

class BlogListStyleOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'blog-page/blog-list-01.png';
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

            $output .= Text::get([
                'name' => 'readmore_text_'.$lang->slug,
                'label' => __('Readmore Text'),
                'value' => $widget_saved_values['readmore_text_'.$lang->slug] ?? null,
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
        $category = $this->setting_item('categories') ?? null;
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $heading_text= SanitizeInput::esc_html($this->setting_item('heading_text_'.$current_lang));
        $readmore_text= SanitizeInput::esc_html($this->setting_item('readmore_text_'.$current_lang));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));



        $blogs = Blog::usingLocale($current_lang)->query();

        if (!empty($category)){
            $blogs->whereJsonContains('category_id', $category);
        }
        $blogs =$blogs->orderBy($order_by,$order);
        if(!empty($items)){
            $blogs = $blogs->paginate($items);
        }else{
            $blogs = $blogs->get();

        }



        $blog_markup = '';
        foreach ($blogs as $item){

            $image = render_image_markup_by_attachment_id($item->image,'','full');
            $route = route('frontend.blog.single',$item->slug);
            $title = SanitizeInput::esc_html($item->getTranslation('title',$current_lang)) ?? '';
            $date = date('M d, Y',strtotime($item->created_at));
            $created_by = $item->author ?? __('Anonymous');


            $category_markup = '';
            foreach ($item->category_id as $cat){
               $category = $cat->getTranslation('title',$current_lang);
                $category_route = route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)]);
                $category_markup.='<a class="item" href="'.$category_route.'">'.$category.'</a>';
            }


            if ($item->created_by === 'user') {
                $user_id = $item->user_id;
            } else {
                $user_id = $item->admin_id;
            }

            $created_by_url = !is_null($user_id) ?  route('frontend.user.created.blog', ['user' => $item->created_by, 'id' => $user_id]) : route('frontend.blog.single',$item->slug) ;

 $blog_markup .= <<<HTML
      <div class="single-recent-stories-wrap">
                <div class="blog-list-style-01">
                    <div class="img-box">
                        <div class="tag-box left">
                            <a href="#" class="category-style-01 bg-color-e">fashion</a>
                        </div>
                        <img src="assets/img/recent-stories/01.jpg" alt="image">
                    </div>
                    <div class="content">
                        <div class="content-inner">
                            <h4 class="title">
                                <a href="#">
                                     My money right where I can see it…hanging in my closet.
                                </a>
                            </h4>
                            <p class="info">One advanced diverted domestic set repeated bringing you
                                old. Possible procured her trifling laughter thoughts property she met
                                way. Which could saw guest man now heard but. </p>
                            <div class="post-meta">
                                <ul class="post-meta-list">
                                    <li class="post-meta-item">
                                        <a href="#">
                                            <img src="assets/img/post-meta/user/user-01.png" alt="image"
                                                class="image">
                                            <span class="text">Xgenious</span>
                                        </a>
                                    </li>
                                    <li class="post-meta-item date">
                                        <i class="lar la-clock icon"></i>
                                        <span class="text">June 19, 2021</span>
                                    </li>
                                    <li class="post-meta-item">
                                        <a href="#">
                                            <i class="lar la-comments icon"></i>
                                            <span class="text">120</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
HTML;


}


 return <<<HTML
        <div class="section-title-style-01">
            <h3 class="title">recent stories</h3>
            <a href="#" class="view-more">view more <i class="las la-arrow-right icon"></i></a>
        </div>
        <div class="recent-stories-slider-inst">
            <div class="recent-stories-inner">
              
                    {$blog_markup}
            </div>
        </div>
HTML;

    }

    public function addon_title()
    {
        return __('Blog List : 01');
    }
}
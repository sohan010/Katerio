<?php


namespace App\WidgetsBuilder\Widgets;

use App\Blog;
use App\Language;
use App\Menu;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class MostVisitedBlogPostWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        // TODO: Implement admin_render() method.
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        //render language tab
        $output .= $this->admin_language_tab();
        $output .= $this->admin_language_tab_start();
        $all_languages = Language::all();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $widget_title = $widget_saved_values['widget_title_' . $lang->slug] ?? '';
            $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="' .purify_html($widget_title) . '"></div>';

            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end();
        //end multi langual tab option
        $post_items = $widget_saved_values['post_items'] ?? '';
        $output .= '<div class="form-group"><input type="number" name="post_items" class="form-control" placeholder="' . __('Post Items') . '" value="' . $post_items . '"></div>';

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        //Implement frontend_render() method.
        $icon_class = (get_user_lang_direction() == 'rtl')? 'ml-2' : '';
        $user_selected_language = get_user_lang();
        $widget_saved_values = $this->get_settings();

        $widget_title = $this->setting_item('widget_title_' . $user_selected_language) ?? '';
        $post_items = $this->setting_item('post_items') ?? '';

        $blog_posts = Blog::where(['status' => 'publish'])->take($post_items)->orderBy('views','desc')->get();

        $output = $this->widget_before(); //render widget before content

        $output .= ' <div class="visited-area padding-top-30">';
        if (!empty($widget_title)) {
            $output .= '<div class="section-title"><h4 class="title">' .purify_html($widget_title) . '</h4></div>';
        }
        $output .= '<div class="visited-wrapper"><div class="sidebar-contents">';

        foreach ($blog_posts as $post) {
            $image = render_image_markup_by_attachment_id($post->image);
            $route = route('frontend.blog.single',$post->slug);
            foreach ($post->category_id as $cat){
                $category = $cat->getTranslation('title',$user_selected_language);
                $category_route = route('frontend.blog.category',['id'=> $cat->id,'any'=> Str::slug($cat->title)]);
            }

            $output.= '<div class="recent-contents style-03 wow animated fadeInUp" data-wow-delay=".1s"">
                        <div class="recent-flex-contents">
                         <div class="flex-thumbs">
                            <a href="'. $route .'">'.$image.'</a>
                        </div>
                        <div class="flex-contents">
                             <span class="span-title"><a href="'.$category_route.'">'.$category.'</a></span>
                             <h4 class="common-title"><a href="' .  $route  . '">'.purify_html($post->getTranslation('title',$user_selected_language)).'</a></h4>
                    </div></div></div>';
        }
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        $output .= $this->widget_after(); // render widget after content
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
        // TODO: Implement widget_title() method.
        return __('Most Visited News');
    }
}

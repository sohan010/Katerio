<?php


namespace App\WidgetsBuilder\Widgets;


use App\Events;
use App\Language;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Widgets;
use App\WidgetsBuilder\WidgetBase;

class NewsletterWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

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
            $widget_title = $widget_saved_values['widget_title_'.$lang->slug] ?? '';
            $widget_description = $widget_saved_values['widget_description_'.$lang->slug] ?? '';
            $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '" class="form-control" placeholder="' . __('Newsletter Title') . '" value="' . $widget_title . '"></div>';
            $output .= '<div class="form-group"><input type="text" name="widget_description_' . $lang->slug . '" class="form-control" placeholder="' . __('Newsletter Description') . '" value="' . $widget_description . '"></div>';

            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end();
        //end multi langual tab option




        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render()
    {

        // TODO: Implement frontend_render() method.
        $widget_saved_values = $this->get_settings();
        $selected_lang = get_user_lang();
        $widget_title = $this->setting_item('widget_title_'.$selected_lang) ??  '';
        $description = $this->setting_item('widget_description_'.$selected_lang) ??  '';

        $output = '<div class="footer-widget">';
        if (!empty($widget_title)){
            $output .= '<h4 class="widget-title">'.purify_html($widget_title).'</h4>';
        }
        $output .= '<p class="info">'.purify_html($description).'</p>';
        $output .= '<div class="form-message-show"></div>
                    <div class="search-form style-01">';

        $output .= '<form action="'.route('frontend.subscribe.newsletter').'" method="post" enctype="multipart/form-data">';

        $output .= ' <div class="form-row">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
   
                    <div class="newsletter-footer">
                        <input type="text" name="email" class="form-control"placeholder="'.__('your email').'">
                        <div class="btn-wrapper">
                            <button type="submit" class="btn-default btn-rounded submit-btn" >'.__('Subscribe').'</button>
                        </div>
                    </div>

                </div>
                </form>';

        $output .= '</div></div></div>';

        return $output;

    }

    public function widget_title()
    {
        // TODO: Implement widget_title() method.
        return __("Newsletter");
    }
}
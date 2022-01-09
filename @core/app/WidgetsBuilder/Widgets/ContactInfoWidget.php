<?php

namespace App\WidgetsBuilder\Widgets;
use App\Language;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use Mews\Purifier\Facades\Purifier;

class ContactInfoWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
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
            $location =  $widget_saved_values['location_' . $lang->slug] ?? '';
            $phone =  $widget_saved_values['phone_' . $lang->slug] ?? '';
            $email =  $widget_saved_values['email_' . $lang->slug] ?? '';

            $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '"  class="form-control" placeholder="' . __('Widget Title') . '" value="'. purify_html($widget_title) .'"></div>';
            $output .= '<div class="form-group"><input type="text" name="location_' . $lang->slug . '" class="form-control" placeholder="' . __('Location') . '" value="'. purify_html($location) .'"></div>';
            $output .= '<div class="form-group"><input type="text" name="phone_' . $lang->slug . '"  class="form-control" placeholder="' . __('Phone') . '" value="'. purify_html($phone) .'"></div>';
            $output .= '<div class="form-group"><input type="email" name="email_' . $lang->slug . '" class="form-control" placeholder="' . __('Email') . '" value="'. purify_html($email) .'"></div>';


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
        $user_selected_language = get_user_lang();
        $widget_saved_values = $this->get_settings();
        $widget_title =  $this->setting_item('widget_title_' . $user_selected_language) ?? '';
        $location =  $this->setting_item('location_' . $user_selected_language) ?? '';
        $phone =  $this->setting_item('phone_' . $user_selected_language) ?? '';
        $email = $this->setting_item('email_' . $user_selected_language) ?? '';


        $output = $this->widget_before(); //render widget before content

        if (!empty($widget_title)){
            $output .= '<h4 class="widget-title">'.purify_html($widget_title).'</h4>';
        }
        $output .= '<ul class="contact_info_list">';
        if(!empty($location)){
            $output .= ' <li class="single-info-item">
                    <div class="icon">
                       <i class="las la-home"></i>
                    </div>
                    <div class="details">
                        '.purify_html($location).'
                    </div>
                </li>';
        }
        if(!empty($phone)){
            $output .= '<li class="single-info-item">
                    <div class="icon">
                       <i class="las la-phone-volume"></i>
                    </div>
                    <div class="details">
                       '.purify_html($phone).'
                    </div>
                </li>';
        }
        if(!empty($email)){
            $output .= '<li class="single-info-item">
                    <div class="icon">
                       <i class="las la-envelope-open"></i>
                    </div>
                    <div class="details">
                       '.purify_html($email).'
                    </div>
                </li>';
        }
        $output .= '</ul>';

        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title()
    {
        return __('Contact Info');
    }

}
<?php

/**
 * Pro Render class
 */
class WPUF_Pro_Render_Form {

    function __construct() {
        //render_form
        add_action( 'wpuf_add_post_form_top', array($this, 'wpuf_add_post_form_top_runner'), 10, 2 );
        add_action( 'wpuf_edit_post_form_top', array($this, 'wpuf_edit_post_form_top_runner'), 10, 3 );
        // render element form in backend form builder
        add_action( 'wpuf_admin_field_custom_repeater',array($this,'wpuf_admin_field_custom_repeater_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_repeat_field',array($this,'wpuf_admin_template_post_repeat_field_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_custom_date',array($this,'wpuf_admin_field_custom_date_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_date_field',array($this,'wpuf_admin_template_post_date_field_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_custom_file',array($this,'wpuf_admin_field_custom_file_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_file_upload',array($this,'wpuf_admin_template_post_file_upload_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_custom_map',array($this,'wpuf_admin_field_custom_map_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_google_map',array($this,'wpuf_admin_template_post_google_map_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_country_select',array($this,'wpuf_admin_field_country_select_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_country_list_field',array($this,'wpuf_admin_template_post_country_list_field_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_numeric_field',array($this,'wpuf_admin_field_numeric_field_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_numeric_text_field',array($this,'wpuf_admin_template_post_numeric_text_field_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_address_field',array($this,'wpuf_admin_field_address_field_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_address_field',array($this,'wpuf_admin_template_post_address_field_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_step_start',array($this,'wpuf_admin_field_step_start_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_step_start',array($this,'wpuf_admin_template_post_step_start_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_really_simple_captcha',array($this,'wpuf_admin_field_really_simple_captcha_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_really_simple_captcha',array($this,'wpuf_admin_template_post_really_simple_captcha_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_action_hook',array($this,'wpuf_admin_field_action_hook_runner'), 10, 4 );
        add_action( 'wpuf_admin_template_post_action_hook',array($this,'wpuf_admin_template_post_action_hook_runner'), 10, 5 );
        add_action( 'wpuf_admin_field_toc',array($this,'wpuf_admin_field_toc_runner'), 10, 4 );
        add_action( 'wpuf_admin_field_ratings',array($this,'wpuf_admin_field_ratings_runner'), 10, 4 );

        add_action( 'wpuf_admin_template_post_toc',array($this,'wpuf_admin_template_post_toc_runner'), 10, 5 );
        add_action( 'wpuf_admin_template_post_ratings',array($this,'wpuf_admin_template_post_ratings'), 10, 5 );

        // others
        add_action( 'wpuf_form_buttons_custom', array( $this, 'wpuf_form_buttons_custom_runner' ) );
        add_action( 'wpuf_form_buttons_other', array( $this, 'wpuf_form_buttons_other_runner') );
        add_action( 'wpuf_form_post_expiration', array( $this, 'wpuf_form_post_expiration_runner') );
        add_action( 'wpuf_form_setting', array( $this, 'form_setting_runner' ),10,2 );
        add_action( 'wpuf_form_settings_post_notification', array( $this, 'post_notification_hook_runner') );
        add_action( 'wpuf_edit_form_area_profile', array( $this, 'wpuf_edit_form_area_profile_runner' ) );
        add_action( 'wpuf_add_profile_form_top', array( $this, 'wpuf_add_profile_form_top_runner' ), 10, 2 );
        add_action( 'registration_setting' , array($this,'registration_setting_runner') );
        add_action( 'wpuf_check_post_type' , array( $this, 'wpuf_check_post_type_runner' ),10,2 );
        add_action( 'wpuf_form_custom_taxonomies', array( $this, 'wpuf_form_custom_taxonomies_runner' ) );
        add_action( 'wpuf_conditional_field_render_hook', array( $this, 'wpuf_conditional_field_render_hook_runner' ), 10, 3 );
        add_filter( 'wpuf-get-form-fields', array( $this, 'get_form_fields' ) );

        // scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
        add_action( 'wpuf_submit_btn', array( $this, 'conditional_logic_on_submit_button' ), 10, 2 );
    }

    //form element's rendering form in backend form builder
    public function wpuf_admin_field_custom_repeater_runner( $type, $field_id, $classname, $obj ) {
       WPUF_pro_form_element::repeat_field( $field_id, 'Custom field: Repeat Field',$classname );
    }

    public function wpuf_admin_template_post_repeat_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::repeat_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_custom_date_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::date_field( $field_id, 'Custom Field: Date',$classname );
    }

    public function wpuf_admin_template_post_date_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::date_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_custom_file_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::file_upload( $field_id, 'Custom field: File Upload', $classname);
    }

    public function wpuf_admin_template_post_file_upload_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::file_upload( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_custom_map_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::google_map( $field_id, 'Custom Field: Google Map',$classname );
    }

    public function wpuf_admin_template_post_google_map_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::google_map( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_country_select_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::country_list_field( $field_id, 'Custom field: Select', $classname );
    }

    public function wpuf_admin_template_post_country_list_field_runner( $name, $count, $input_field, $classname, $obj ) {
        WPUF_pro_form_element::country_list_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_numeric_field_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::numeric_text_field( $field_id, 'Custom field: Numeric Text', $classname);
    }

    public function wpuf_admin_template_post_numeric_text_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::numeric_text_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_address_field_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::address_field( $field_id, 'Custom field: Address',$classname);
    }

    public function wpuf_admin_template_post_address_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::address_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_step_start_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::step_start( $field_id, 'Step Starts', $classname);
    }

    public function wpuf_admin_template_post_step_start_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::step_start( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_really_simple_captcha_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::really_simple_captcha( $field_id, 'Really Simple Captcha',$classname );
    }
    public function wpuf_admin_template_post_really_simple_captcha_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::really_simple_captcha( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_action_hook_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::action_hook( $field_id, 'Action Hook', $classname );
    }

    public function wpuf_admin_template_post_action_hook_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::action_hook( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_toc_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::toc( $field_id, 'TOC', $classname );
    }

    public function wpuf_admin_field_ratings_runner( $type, $field_id, $classname, $obj ){
        WPUF_pro_form_element::ratings( $field_id, 'Ratings', $classname );
    }

    public function wpuf_admin_template_post_toc_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::toc( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_template_post_ratings( $name, $count, $input_field, $classname, $obj ){
        WPUF_pro_form_element::ratings( $count, $name, $classname, $input_field );
    }

    public function wpuf_add_profile_form_top_runner( $form_id, $form_settings ) {
        if ( isset( $form_settings['multistep_progressbar_type'] ) && $form_settings['multistep_progressbar_type'] == 'progressive' ) {
            wp_enqueue_script('jquery-ui-progressbar');
        }
    }

    public function wpuf_form_buttons_custom_runner() {
        //add formbuilder widget pro buttons
        WPUF_pro_form_element::add_form_custom_buttons();
    }

    public function wpuf_form_buttons_other_runner() {
        WPUF_pro_form_element::add_form_other_buttons();
    }

    public function wpuf_form_post_expiration_runner(){
        WPUF_pro_form_element::render_form_expiration_tab();
    }

    public function form_setting_runner( $form_settings, $post ) {
        WPUF_pro_form_element::add_form_settings_content( $form_settings, $post );
    }

    public function post_notification_hook_runner() {
        WPUF_pro_form_element::add_post_notification_content();
    }

    public function wpuf_edit_form_area_profile_runner() {
        WPUF_pro_form_element::render_registration_form();
    }

    public function registration_setting_runner() {
        WPUF_pro_form_element::render_registration_settings();
    }

    public function wpuf_check_post_type_runner( $post, $update ) {
        WPUF_pro_form_element::check_post_type( $post, $update );
    }

    public function wpuf_form_custom_taxonomies_runner() {
        WPUF_pro_form_element::render_custom_taxonomies_element();
    }

    public function wpuf_conditional_field_render_hook_runner( $field_id, $con_fields, $obj ) {
        WPUF_pro_form_element::render_conditional_field( $field_id, $con_fields, $obj );
    }

    //render_form
    public function wpuf_add_post_form_top_runner( $form_id, $form_settings ) {
        if ( ! isset( $form_settings['enable_multistep'] ) || $form_settings['enable_multistep'] != 'yes' ) {
            return;
        }

        if ( $form_settings['multistep_progressbar_type'] == 'progressive' ) {
            wp_enqueue_script('jquery-ui-progressbar');
        }
    }

    public function wpuf_edit_post_form_top_runner( $form_id, $post_id, $form_settings ) {

        if ( ! isset( $form_settings['enable_multistep'] ) || $form_settings['enable_multistep'] != 'yes' ) {
            return;
        }

        if ( isset( $form_settings['multistep_progressbar_type'] ) && $form_settings['multistep_progressbar_type'] == 'progressive' ) {
            wp_enqueue_script('jquery-ui-progressbar');
        }
    }

    /**
     * Filter form fields
     *
     * @since 2.5
     *
     * @param array $field
     *
     * @return array
     */
    public function get_form_fields( $field ) {
        // make sure that country_list has all its properties
        if ( 'country_list' === $field['input_type'] ) {

            if ( ! isset( $field['country_list']['country_select_hide_list'] ) ) {
                $field['country_list']['country_select_hide_list'] = array();
            }

            if ( ! isset( $field['country_list']['country_select_show_list'] ) ) {
                $field['country_list']['country_select_show_list'] = array();
            }
        }

        if ( 'address' === $field['input_type'] ) {
            if ( ! isset( $field['address']['country_select']['country_select_hide_list'] ) ) {
                $field['address']['country_select']['country_select_hide_list'] = array();
            }

            if ( ! isset( $field['address']['country_select']['country_select_show_list'] ) ) {
                $field['address']['country_select']['country_select_show_list'] = array();
            }
        }

        if ( 'google_map' === $field['input_type'] && ! isset( $field['directions'] ) ) {
            $field['show_checkbox'] = false;
        }

        if ( 'toc' === $field['input_type'] && ! isset( $field['show_checkbox'] ) ) {
            $field['show_checkbox'] = false;
        }

        if ( 'ratings' === $field['input_type'] && ! isset( $field['selected'] ) ) {
            $field['selected'] = array();
        }

        return $field;
    }

    /**
     *
     * Conditional logic on submit button
     *
     * @param $form_id, $form_settings
     *
     * @since v3.1.5
     */
    public function conditional_logic_on_submit_button( $form_id, $form_settings ) {
        if ( !isset( $form_settings['submit_button_cond']['condition_status'] ) || $form_settings['submit_button_cond']['condition_status'] != 'yes' ) {
            return;
        }

        $cond_inputs                     = $form_settings['submit_button_cond'];
        $cond_inputs['condition_status'] = isset( $cond_inputs['condition_status'] ) ? $cond_inputs['condition_status'] : '';

        if ( $cond_inputs['condition_status'] == 'yes' ) {
            $cond_field = array();
            $cond_operator = array();
            $cond_option = array();

            if ( isset($cond_inputs['conditions']) && !empty($cond_inputs['conditions']) ) {
                foreach ($cond_inputs['conditions'] as $condition ) {
                    if ( isset($condition['name']) && !empty($condition['name']) ) {
                        array_push($cond_field, $condition['name']);
                        array_push($cond_operator, $condition['operator']);
                        array_push($cond_option, $condition['option']);
                    }
                }

                unset($cond_inputs['conditions']);
            }

            $cond_inputs['cond_field']    = $cond_field;
            $cond_inputs['cond_operator'] = $cond_operator;
            $cond_inputs['cond_option']   = $cond_option;
            $cond_inputs['type']          = 'submit';
            $cond_inputs['name']          = 'submit';
            $cond_inputs['form_id']       = $form_id;
            $condition                    = json_encode( $cond_inputs );

        } else {
            $condition = '';
        }

        ?>
        <script type="text/javascript">
            wpuf_conditional_items.push(<?php echo $condition; ?>);
        </script>
        <?php
    }

    /**
     * Enqueue scripts and styles
     */
    function enqueue_scripts_styles() {
        global $post;

        if ( ! is_a( $post, 'WP_Post' ) ) {
            return;
        }

        if ( has_shortcode( $post->post_content, 'wpuf_form' )
            || has_shortcode( $post->post_content, 'wpuf_edit' )
            || has_shortcode( $post->post_content, 'wpuf_profile' )
            || has_shortcode( $post->post_content, 'weforms' )
            || is_single()
            || is_page_template()
            || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')
            || strstr($_SERVER['REQUEST_URI'], 'wp-admin/admin.php')
            || ( isset( $_GET['section'] ) && $_GET['section'] == 'submit-post' )
            || ( isset( $_GET['wpuf_preview'] ) && isset($_GET['form_id']) )
        ) {
            wp_enqueue_style( 'wpuf-rating-star-css', WPUF_PRO_ASSET_URI . '/css/css-stars.css' );

            wp_enqueue_script( 'wpuf-rating-js', WPUF_PRO_ASSET_URI . '/js/jquery.barrating.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'wpuf-conditional-logic', WPUF_PRO_ASSET_URI . '/js/conditional-logic.js', array('jquery'), false, true );
        }
    }

}

<?php
/**
 *  Frontend Profile Form Manager Class
 *
 * @since 3.1.0
 **/
class WPUF_Frontend_Form_Profile extends WPUF_Frontend_Render_Form {

    function __construct() {

        add_shortcode( 'wpuf_profile', array($this, 'shortcode_handler') );
        // ajax requests
        add_action( 'wp_ajax_nopriv_wpuf_submit_register', array($this, 'user_register') );
        add_action( 'wp_ajax_wpuf_update_profile', array($this, 'update_profile') );
        add_action( 'init', array( $this, 'resend_activation_email' ) );
    }

   /**
    * Add post shortcode handler
    *
    * @param array $atts
    *
    * @return string
    **/
    public function shortcode_handler ( $atts ) {

        add_filter( 'wpuf-form-fields', array( $this, 'add_field_settings' ) );
        extract( shortcode_atts( array('id' => 0, 'type' => 'registration'), $atts ) );

        //registration time redirect to subscription
        if ( $type == 'registration' ) {
            $is_fource_pack = wpuf_get_option( 'register_subscription', 'wpuf_payment' );

            if ( ( $is_fource_pack == 'on' && !isset( $_GET['type'] ) ) || ( $is_fource_pack == 'on' && $_GET['type'] != 'wpuf_sub' ) ) {
                $subscription_page_id = wpuf_get_option( 'subscription_page', 'wpuf_payment' );
                if ( empty( $subscription_page_id ) ) {
                    _e('Please select subscription page','wpuf-pro');
                    return;
                } else if ( ! is_admin() && ! defined( 'DOING_AJAX' ) && ! defined( 'REST_REQUEST' ) ) {
                    wp_redirect( get_permalink( $subscription_page_id ) );
                    exit;
                }
            }
        }

        ob_start();

        $form          = new WPUF_Form( $id );
        $form_fields   = $form->get_fields();
        $form_settings = $form->get_settings();

        if ( !$form_fields ) {
            return;
        }

        if ( $type == 'profile' ) {

            if ( is_user_logged_in() ) {

                if ( isset( $_GET['msg'] ) && $_GET['msg'] == 'profile_update' ) {
                    echo '<div class="wpuf-success">';
                    echo $form_settings['update_message'];
                    echo '</div>';
                }

                $this->profile_edit( $id, $form_fields, $form_settings );

            } else {
                echo '<div class="wpuf-info">' . __( 'Please login to update your profile!', 'wpuf-pro' ) . '</div>';
            }

        } elseif ( $type == 'registration' ) {

            if ( is_user_logged_in() ) {

                echo '<div class="wpuf-info">' . __( 'You are already logged in!', 'wpuf-pro' ) . '</div>';

            } else {

                if ( get_option( 'users_can_register' ) != '1' ) {
                    echo '<div class="wpuf-info">';
                    _e( 'User registration disabled, please contact the admin to enable.', 'wpuf-pro' );
                    echo '</div>';
                    return;
                }

                $this->profile_edit( $id, $form_fields, $form_settings );
            }
        }

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }

    public function user_register() {
        check_ajax_referer( 'wpuf_form_add' );
        add_filter( 'wpuf-form-fields', array( $this, 'add_field_settings'));

        @header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );

        $form_id               = isset( $_POST['form_id'] ) ? intval( $_POST['form_id'] ) : 0;
        $form                  = new WPUF_Form( $form_id );
        $form_settings         = $form->get_settings();
        $form_fields           = $form->get_fields();
        $attachments_to_delete = isset( $_POST['delete_attachments'] ) ? $_POST['delete_attachments'] : array();

        foreach ( $attachments_to_delete as $attach_id ) {
            wp_delete_attachment( $attach_id, true );
        }

        list( $user_vars, $taxonomy_vars, $meta_vars ) = $this->get_input_fields($form_fields);
        $this->on_edit_no_check_recaptcha( $user_vars );

        $has_username_field = false;
        $username           = '';
        $user_email         = '';
        $firstname          = '';
        $lastname           = '';

        // don't let to be registered if no email address given
        if ( !isset( $_POST['user_email']) || empty( $_POST['user_email'] ) ) {
            $this->send_error( __( 'An Email address is required', 'wpuf-pro' ) );
        }

        // if any username given, check if it exists
        if ( $this->search( $user_vars, 'name', 'user_login' )) {
            $has_username_field = true;
            $username = sanitize_user( trim( $_POST['user_login'] ) );

            if ( username_exists( $username ) ) {
                $username_error = __( 'Username already exists.', 'wpuf-pro' );
                $this->send_error( apply_filters( 'wpuf_duplicate_username_error', $username_error, $form_settings ) );
            }
        }

        // if any email address given, check if it exists
        if ( $this->search( $user_vars, 'name', 'user_email' )) {
            $user_email = trim( $_POST['user_email'] );
            if ( email_exists( $user_email ) ) {
                $this->send_error( __( 'E-mail address already exists.', 'wpuf-pro' ) );
            }
        }

        // if there isn't any username field in the form, lets guess a username
        if ( !$has_username_field ) {
            $username = $this->guess_username( $user_email );
        }

        if ( !validate_username( $username ) ) {
            $this->send_error( __( 'Username is not valid', 'wpuf-pro' ) );
        }

        // verify password
        if ( $pass_element = $this->search($user_vars, 'name', 'password' ) ) {
            $pass_element    = current( $pass_element );
            $password        = $_POST['pass1'];
            $password_repeat = isset( $_POST['pass2'] ) ? $_POST['pass2'] : false;

            // min length check
            if ( strlen( $password ) < intval( $pass_element['min_length'] ) ) {
                $this->send_error( sprintf( __( 'Password must be %s character long', 'wpuf-pro' ), $pass_element['min_length'] ) );
            }

            // repeat password check
            if ( ( $password != $password_repeat ) && $password_repeat !== false ) {
                $this->send_error( __( 'Password didn\'t match', 'wpuf-pro' ) );
            }
        } else {
            $password = wp_generate_password();
        }

        // default WP registration hook
        $errors = new WP_Error();
        do_action( 'register_post', $username, $user_email, $errors );

        $errors = apply_filters( 'registration_errors', $errors, $username, $user_email );

        if ( $errors->get_error_code() ) {
            $this->send_error( $errors->get_error_message() );
        }

        // seems like we don't have any error. Lets register the user
        $user_id = wp_create_user( $username, $password, $user_email );

        if ( is_wp_error( $user_id ) ) {

            $this->send_error( $user_id->get_error_message() );

        } else {
            $userdata = array(
                'ID'          => $user_id,
                'first_name'  => $this->search( $user_vars, 'name', 'first_name' ) ? $_POST['first_name'] : '',
                'last_name'   => $this->search( $user_vars, 'name', 'last_name' ) ? $_POST['last_name'] : '',
                'display_name'=> isset( $_POST['display_name'] ) ? $_POST['display_name'] : '',
                'nickname'    => $this->search( $user_vars, 'name', 'nickname' ) ? $_POST['nickname'] : '',
                'user_url'    => $this->search( $user_vars, 'name', 'user_url' ) ? $_POST['user_url'] : '',
                'description' => $this->search( $user_vars, 'name', 'description' ) ? $_POST['description'] : '',
                'role'        => $form_settings['role']
            );

            $user_id = wp_update_user( apply_filters( 'wpuf_register_user_args', $userdata ) );

            if ( $user_id ) {

                $status             = isset( $form_settings['wpuf_user_status'] ) ? $form_settings['wpuf_user_status'] : 'pending';
                $user_notification  = isset( $form_settings['user_notification'] ) ? $form_settings['user_notification'] : 'off';
                $admin_notification = isset( $form_settings['admin_notification'] ) ? $form_settings['admin_notification'] : 'off';

                // update meta fields
                $this->update_user_meta( $meta_vars, $user_id );

                // send user notification or email verification
                if ( $user_notification == 'on' ) {
                    if ( isset( $form_settings['notification_type'] ) && $form_settings['notification_type'] != 'email_verification' ) {
                        $this->user_email_notification( $status, $user_id, $form_id );
                    }else {
                        $this->send_verification_mail( $user_id, $user_email, $form_id );
                    }
                }

                // send admin notification
                if ( $admin_notification == 'on' ) {
                    $this->admin_email_notification( $status, $user_id, $form_id );
                }

                do_action( 'wpuf_after_register', $user_id, $form_id, $form_settings );

                //redirect URL
                $show_message = false;
                $redirect_to = '';

                if ( $form_settings['reg_redirect_to'] == 'page' ) {
                    $redirect_to = get_permalink( $form_settings['reg_page_id'] );
                } elseif ( $form_settings['reg_redirect_to'] == 'url' ) {
                    $redirect_to = $form_settings['registration_url'];
                } elseif ( $form_settings['reg_redirect_to'] == 'same' ) {
                    $show_message = true;
                } else {
                    $redirect_to = get_permalink( $post_id );
                }

                if ( isset( $form_settings['reg_redirect_to'] ) && $form_settings['reg_redirect_to'] == 'page' ) {
                    $redirect_to = get_permalink( $form_settings['reg_page_id'] );
                } elseif ( isset( $form_settings['reg_redirect_to'] ) && $form_settings['reg_redirect_to'] == 'url' ) {
                    $redirect_to = $form_settings['registration_url'];
                } elseif ( isset( $form_settings['reg_redirect_to'] ) && $form_settings['reg_redirect_to'] == 'same' ) {
                    $redirect_to = get_permalink( $_POST['reg_page_id'] );
                    $redirect_to = add_query_arg( array( 'msg' => 'profile_update' ), $redirect_to );
                }

                // send the response
                $response = array(
                    'success'      => true,
                    'post_id'      => $user_id,
                    'redirect_to'  => $redirect_to,
                    'show_message' => $show_message,
                    'message'      => ( isset( $form_settings['enable_email_verification'] ) && $form_settings['enable_email_verification'] == 'yes' )? __( 'Please check your email for activation link', 'wpuf-pro' ) : $form_settings['message']
                );

                $autologin_after_registration = wpuf_get_option( 'autologin_after_registration', 'wpuf_profile', 'on' );

                // if ( $autologin_after_registration == 'on' ) {
                if ( $autologin_after_registration == 'on' && $form_settings['wpuf_user_status'] == 'approved' && $form_settings['notification_type'] == 'welcome_email' ) {
                    wp_set_current_user( $user_id );
                    wp_set_auth_cookie( $user_id );
                }

                $response = apply_filters( 'wpuf_user_register_redirect', $response, $user_id, $userdata, $form_id, $form_settings );

                wpuf_clear_buffer();
                echo json_encode( $response );

                exit;
            } // endif
        }


        wpuf_clear_buffer();

        echo json_encode( array(
            'success' => false,
            'error' => __( 'Something went wrong', 'wpuf-pro' )
        ) );

        exit;
    }

    public function update_profile() {
        check_ajax_referer( 'wpuf_form_add' );

        add_filter( 'wpuf-form-builder-field-settings', array( $this, 'add_field_settings'));
        @header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );

        $form_id       = isset( $_POST['form_id'] ) ? intval( $_POST['form_id'] ) : 0;
        $form          = new WPUF_Form( $form_id );
        $form_settings = $form->get_settings();
        $form_fields   = $form->get_fields();

        list( $user_vars, $taxonomy_vars, $meta_vars ) = $this->get_input_fields( $form_fields );
        $user_id  = get_current_user_id();
        $userdata = array('ID' => $user_id);
        $userinfo = get_userdata( $user_id );

        if ( $this->search( $user_vars, 'name', 'first_name' ) ) {
            $userdata['first_name'] = $_POST['first_name'];
        }

        if ( $this->search( $user_vars, 'name', 'last_name' ) ) {
            $userdata['last_name'] = $_POST['last_name'];
        }

        if ( $this->search( $user_vars, 'name', 'display_name' ) ) {
            $userdata['display_name'] = $_POST['display_name'];
        }

        if ( $this->search( $user_vars, 'name', 'nickname' ) ) {
            $userdata['nickname'] = $_POST['nickname'];
        }

        if ( $this->search( $user_vars, 'name', 'user_url' ) ) {
            $userdata['user_url'] = $_POST['user_url'];
        }

        if ( $this->search( $user_vars, 'name', 'user_email' ) ) {
            $userdata['user_email'] = $_POST['user_email'];
        }

        if ( $this->search( $user_vars, 'name', 'description' ) ) {
            $userdata['description'] = $_POST['description'];
        }

        // check if Email filled out
        // verify Email
        if ( $userinfo->user_email != trim( $_POST['user_email'] ) ) {
            if( email_exists( trim( $_POST['user_email'] ) ) ) {
                $this->send_error( __( 'That E-mail already exists', 'wpuf-pro' ) );
            }
        }

        // check if password filled out
        // verify password
        if ( $pass_element = $this->search($user_vars, 'name', 'password') ) {
            $pass_element = current( $pass_element );
            $password = $_POST['pass1'];
            $password_repeat = $_POST['pass2'];

            // check only if it's filled
            if ( $pass_length = strlen( $password) ) {

                // min length check
                if ( $pass_length < intval( $pass_element['min_length'] ) ) {
                    $this->send_error( sprintf( __( 'Password must be %s character long', 'wpuf-pro' ), $pass_element['min_length'] ) );
                }

                // repeat password check
                if ( $password != $password_repeat ) {
                    $this->send_error( __( 'Password didn\'t match', 'wpuf-pro' ) );
                }

                // seems like he want to change the password
                $userdata['user_pass'] = $password;
            }
        }

        $userdata = apply_filters( 'wpuf_update_profile_vars', $userdata, $form_id, $form_settings );

        $user_id  = wp_update_user( $userdata );

        if ( $user_id ) {
            // update meta fields
            $this->update_user_meta( $meta_vars, $user_id );
            do_action( 'wpuf_update_profile', $user_id, $form_id, $form_settings,$meta_vars);
        }

        //redirect URL
        $show_message = false;
        if ( $form_settings['profile_redirect_to'] == 'page' ) {
            $redirect_to = get_permalink( $form_settings['profile_page_id'] );
        } elseif ( $form_settings['profile_redirect_to'] == 'url' ) {
            $redirect_to = $form_settings['profile_url'];
        } elseif ( $form_settings['profile_redirect_to'] == 'same' ) {
            $show_message = true;
            $redirect_to = get_permalink( $_POST['profile_page_id'] );
        }

        if ( $form_settings['profile_redirect_to'] == 'page' ) {
            $redirect_to = get_permalink( $form_settings['profile_page_id'] );
        } elseif ( $form_settings['profile_redirect_to'] == 'url' ) {
            $redirect_to = $form_settings['profile_url'];
        } elseif ( $form_settings['profile_redirect_to'] == 'same' ) {
            $redirect_to = get_permalink( $_POST['profile_page_id'] );
            $redirect_to = add_query_arg( array( 'msg' => 'profile_update' ), $redirect_to );
        }

        // send the response
        $response = array(
            'success'      => true,
            'redirect_to'  => $redirect_to,
            'show_message' => $show_message,
            'message'      => $form_settings['update_message'],
        );

        $response = apply_filters( 'wpuf_update_profile_resp', $response, $user_id, $form_id, $form_settings );

        wpuf_clear_buffer();

        echo json_encode( $response );

        exit;
    }


   /**
    * Add action links for registration form
    *
    * @since 2.9.0
    **/
    function action_links() {
        if ( is_user_logged_in() ) {
            return;
        }

        $output = '';

        $output .= '<li>';
            $output .= '<div class="wpuf-label">';
                $output .= '&nbsp;';
            $output .= '</div>';
        $output .= wpuf()->login->get_action_links( array( 'register' => false ) );
        $output .= '</li>';

        echo $output;
    }

    public function profile_edit( $form_id, $form_vars, $form_settings ) {
        $label_position = isset( $form_settings['label_position'] ) ? $form_settings['label_position'] : 'left';
        $layout         = isset( $form_settings['form_layout'] ) ? $form_settings['form_layout'] : 'layout1';
        $theme_css      = isset( $form_settings['use_theme_css'] ) ? $form_settings['use_theme_css'] : 'wpuf-style';
        $style_class    = ($layout == 'layout1') ? $theme_css : 'wpuf-style';

        if ( !empty( $layout ) ) {
            wp_enqueue_style( 'wpuf-' . $layout );
        }

        echo '<form class="wpuf-form-add wpuf-form-' . $layout . ' ' . $style_class . '" action="" method="post">'; ?>

            <ul class="wpuf-form form-label-<?php echo $label_position; ?>">

                <script type="text/javascript">
                    if ( typeof wpuf_conditional_items === 'undefined' ) {
                        wpuf_conditional_items = [];
                    }

                    if ( typeof wpuf_plupload_items === 'undefined' ) {
                        wpuf_plupload_items = [];
                    }

                    if ( typeof wpuf_map_items === 'undefined' ) {
                        wpuf_map_items = [];
                    }
                </script>

                <?php

                    $form  = new WPUF_Form( $form_id );

                    do_action( 'wpuf_form_fields_top', $form, $form_vars );

                    // do_action( 'wpuf_add_profile_form_top', $form_id, $form_settings );

                    $atts = array();
                    wpuf()->fields->render_fields( $form_vars, $form_id, $atts,$type = 'user', get_current_user_id() );

                    $this->submit_button( $form_id, $form_settings );
                    $this->action_links();

                    do_action( 'wpuf_add_profile_form_bottom', $form_id, $form_settings);

            echo '</ul>';
        echo '</form>';
    }


    function submit_button( $form_id, $form_settings, $post_id = 0 ) {
        // lets guess its a registration form
        // give the chance to fire action for default register form
        if ( !is_user_logged_in() ) {
            do_action('register_form');
        }
        ?>

        <li class="wpuf-submit">
            <div class="wpuf-label">
                &nbsp;
            </div>

            <?php wp_nonce_field( 'wpuf_form_add' ); ?>
                <input type="hidden" name="form_id" value="<?php echo $form_id; ?>">
                <input type="hidden" name="page_id" value="<?php echo get_the_ID(); ?>">
                <input type="hidden" id="del_attach" name="delete_attachments[]">

            <?php if ( is_user_logged_in() ) { ?>
                <input type="hidden" name="action" value="wpuf_update_profile">
                <input type="submit" class="wpuf-submit-button" name="submit" value="<?php echo $form_settings['update_text']; ?>" />
            <?php } else { ?>
                <input type="hidden" name="action" value="wpuf_submit_register">
                <input type="submit" class="wpuf-submit-button" name="submit" value="<?php echo $form_settings['submit_text']; ?>" />
            <?php } ?>
        </li>

        <?php
    }


    public function login_url() {
        $override          = wpuf_get_option( 'register_link_override', 'wpuf_profile', 'off' );
        $default_login_url = site_url('wp-login.php', 'login');

        if ( $override != 'on' ) {
            return $default_login_url;
        }

        $login_page_id = wpuf_get_option( 'login_page', 'wpuf_profile', false );

        if ( !$login_page_id ) {
            return $default_login_url;
        }

        return site_url( basename( get_permalink( $login_page_id ) ), 'login' );
    }

    public static function meta_filter_checkbox( $meta_vars ) {
        $filteredmeta = array_reduce( $meta_vars, function ( $result, $item ) {
            if( $item['template'] == 'checkbox_field' ) {
                 $result[$item['name']] =  '';
            }
            return $result;
        }, array());

        return $filteredmeta;
    }
    /**
     * Update user meta based on form inputs
     *
     * @param array $meta_vars
     * @param int $user_id
     */
    public static function update_user_meta( $meta_vars, $user_id ) {
        // prepare meta fields
        list( $meta_key_value, $multi_repeated, $files ) = self::prepare_meta_fields( $meta_vars );
        $meta_checkbox = self::meta_filter_checkbox( $meta_vars );
        $meta_key_value = array_merge($meta_checkbox,$meta_key_value);
        // set featured image if there's any
        if ( isset( $_POST['wpuf_files']['avatar'] ) ) {
            $attachment_id = $_POST['wpuf_files']['avatar'][0];

            wpuf_update_avatar( $user_id, $attachment_id );
        }

        // save all custom fields
        foreach ($meta_key_value as $meta_key => $meta_value) {
            update_user_meta( $user_id, $meta_key, $meta_value );
        }

        // save any multicolumn repeatable fields
        foreach ($multi_repeated as $repeat_key => $repeat_value) {
            // first, delete any previous repeatable fields
            delete_user_meta( $user_id, $repeat_key );

            // now add them
            foreach ($repeat_value as $repeat_field) {
                add_user_meta( $user_id, $repeat_key, $repeat_field );
            }
        } //foreach

        // save any files attached
        foreach ($files as $file_input) {
            // delete any previous value
            delete_user_meta( $user_id, $file_input['name'] );

            //to track how many files are being uploaded
            $file_numbers = 0;

            foreach ($file_input['value'] as $attachment_id) {

                //if file numbers are greated than allowed number, prevent it from being uploaded
                if( $file_numbers >= $file_input['count'] ){
                    wp_delete_attachment( $attachment_id );
                    continue;
                }

                add_user_meta( $user_id, $file_input['name'], $attachment_id );

                $file_numbers++;
            }
        }
    }

   /**
    * Resend activation email to user
    *
    * @since 2.8.2
    **/
    public function resend_activation_email() {
        if ( !isset( $_GET['resend_activation'] ) ){
            return;
        }

        $user_id = is_numeric( $_GET['resend_activation'] ) ? $_GET['resend_activation'] : -1;
        $user    = new WPUF_User( $user_id );

        if ( !$user->id ) {
            wpuf()->login->add_error( __( 'User not found', 'wpuf-pro' ) );
            return;
        }
        //check if activated
        if ( $user->is_verified() ) {
            wpuf()->login->add_message( __('User is verified already', 'wpuf-pro' ) );
            return;
        }

        $this->send_verification_mail( $user->id, $user->user->user_email );

        wpuf()->login->add_message( __( 'Email Activation link is sent, please check your email.', 'wpuf-pro' ) );
    }

    /**
     * Send email verification link
     *
     * @param int|WP_Error $user_id
     *
     * @param string $user_email
     *
     * @param null $form_id
     *
     * @return void
     **/
    function send_verification_mail( $user_id, $user_email, $form_id=null ) {
        $user     = get_user_by( 'id', $user_id );
        $code     = sha1( $user_id . $user_email . time() );
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        add_filter( 'login_url', array($this, 'login_url') );

        $activation_link = add_query_arg(
            array(
                'wpuf_registration_activation' => $code,
                'id' => $user_id
            ),
            wp_login_url()
        );

        // add wpuf_password_info_email query arguement with activation link if password field exist in the registration form
        if ( !is_null( $form_id ) ) {
            $fields         = wpuf_get_form_fields( $form_id );
            $password_field = false;

            foreach ($fields as $key => $field) {
                if ( $field['template'] == 'password' ) {
                    $password_field = true;
                }
            }

            if ( !$password_field ) {
                $activation_link = add_query_arg(
                    array(
                        'wpuf_registration_activation' => $code,
                        'id' => $user_id,
                        'wpuf_password_info_email' => true
                    ),
                    wp_login_url()
                );
            }
        }

        // resend verification email when user request
        $subject  = sprintf(__('[%s] Account Activation', 'wpuf-pro' ), $blogname);
        $message  = sprintf( __( 'Congrats! You are Successfully registered to %s:', 'wpuf-pro' ), $blogname ) . "\r\n\r\n";
        $message .= __( 'To activate your account, please click the link below', 'wpuf-pro' ) . "\r\n\r\n";
        $message .= sprintf( __( '%s', 'wpuf-pro' ), $activation_link ) . "\r\n";

        // send verification email after user registration
        if ( !is_null( $form_id ) ) {
            $form_settings = wpuf_get_form_settings( $form_id );
            $subject = isset( $form_settings['notification']['verification_subject'] ) ? $form_settings['notification']['verification_subject'] : $subject;
            $message = isset( $form_settings['notification']['verification_body'] ) ? $form_settings['notification']['verification_body'] : $message;
        }

        // resend verification email when user request & HTML Email Templates module is active
        if ( is_null( $form_id ) && wpuf_pro_is_module_active( 'email-templates/email-templates.php' ) ) {
            $subject = wpuf_get_option( 'confirmation_mail_subject', 'wpuf_mails', $subject );
            $message = wpuf_get_option( 'confirmation_mail_body', 'wpuf_mails', $message );
        }

        $field_search = array( '{username}', '{blogname}', '{activation_link}' );

        $field_replace = array(
            $user->display_name,
            $blogname,
            $activation_link
        );

        $message = str_replace( $field_search, $field_replace, $message );
        $message = get_formatted_mail_body( $message, $subject );

        $wpuf_user = new WPUF_User( $user_id );
        $wpuf_user->set_activation_key( $code );
        $wpuf_user->mark_unverified();

        wp_mail( $user_email, $subject, $message );
    }

    /**
     * Prepare email body
     *
     * @since 2.8
     *
     * @return string $message
     */
    public static function prepare_mail_body( $message, $user_status, $user_id ) {
        $user = get_user_by( 'id', $user_id );

        $pending_users     = admin_url() . 'users.php?s&new_role&wpuf_user_approve_filter-top=pending&paged=1&action2=-1&new_role2';
        $approved_users    = admin_url() . 'users.php?s&new_role&wpuf_user_approve_filter-top=approved&paged=1&action2=-1&new_role2';
        $denied_users      = admin_url() . 'users.php?s&new_role&wpuf_user_approve_filter-top=denied&paged=1&action2=-1&new_role2';

        $user_field_search = array( '%username%', '%user_email%', '%display_name%', '%user_status%', '%pending_users%', '%approved_users%', '%denied_users%' );

        $user_field_replace = array(
            $user->user_login,
            $user->user_email,
            $user->display_name,
            $user_status,
            $pending_users,
            $approved_users,
            $denied_users
        );

        $message = str_replace( $user_field_search, $user_field_replace, $message );

        return $message;
    }


    /**
     * Send email notification to admine
     *
     * @since 2.8
     *
     * @param string $user_status
     *
     * @param int $user_email
     *
     * @param null $form_id
     *
     * @return void
     **/
    public static function admin_email_notification( $user_status, $user_id, $form_id = null ) {
        $to         = get_option( 'admin_email' );
        $subject    = '';
        $message    = '';

        if ( !is_null( $form_id ) ) {
            $form_settings  = wpuf_get_form_settings( $form_id );
            $user_status    = isset( $form_settings['wpuf_user_status'] ) ? $form_settings['wpuf_user_status'] : 'approved';

            $default_message       = "Username: %username% (%user_email%) has requested a username.\r\n\r\n";
            $default_message      .= "To approve or deny this user access go to %pending_users%\r\n\r\n";
            $default_message      .= "Thanks";

            $subject = isset( $form_settings['notification']['admin_email_subject'] ) ? $form_settings['notification']['admin_email_subject'] : 'New user registered on your site';
            $message = isset( $form_settings['notification']['admin_email_body']['user_status_pending'] ) ? $form_settings['notification']['admin_email_body']['user_status_pending'] : $default_message;

            if ( $user_status == 'approved' ) {
                $default_message       = "Username: %username% (%user_email%) has requested a username.\r\n\r\n";
                $default_message      .= "To pending or deny this user access go to %approved_users%\r\n\r\n";
                $default_message      .= "Thanks";

                $message = isset( $form_settings['notification']['admin_email_body']['user_status_approved'] ) ? $form_settings['notification']['admin_email_body']['user_status_approved'] : $default_message;
            }
        }

        $message = self::prepare_mail_body( $message, $user_status, $user_id );
        $message = get_formatted_mail_body( $message, $subject );

        wp_mail( $to, $subject, $message );
    }

    /**
     * Send email notification to admine
     *
     * @since 2.8
     *
     * @param string $user_status
     *
     * @param int $user_email
     *
     * @param null $form_id
     *
     * @return void
     **/
    public static function user_email_notification( $user_status, $user_id, $form_id = null ) {
        $user       = get_user_by('id', $user_id);
        $user_email = $user->user_email;
        $to         = $user_email;
        $subject    = '';
        $message    = '';

        if ( $user_status == 'pending' ) {
            $body  = "Hi %username%,\r\n\r\n";
            $body .= "Your account status has been changed to pending by an administrator.\r\n\r\n";
            $body .= "Thanks";

            $subject = wpuf_get_option( 'pending_user_email_subject', 'wpuf_mails', 'Status has been changed to pending' );
            $message = wpuf_get_option( 'pending_user_email_body', 'wpuf_mails', $body );
        } elseif ( $user_status == 'approved' ) {
            $body  = "Hi %username%,\r\n\r\n";
            $body .= "Your account has been approved by an administrator.\r\n\r\n";
            $body .= "Thanks";

            $subject = wpuf_get_option( 'approved_user_email_subject', 'wpuf_mails', 'Approved your request' );
            $message = wpuf_get_option( 'approved_user_email_body', 'wpuf_mails', $body );
        } elseif ( $user_status == 'denied' ) {
            $body  = "Hi %username%,\r\n\r\n";
            $body .= "Your account has been denied by an administrator, please contact admin to approve your account.\r\n\r\n";
            $body .= "Thanks";

            $subject = wpuf_get_option( 'denied_user_email_subject', 'wpuf_mails', 'Denied your request' );
            $message = wpuf_get_option( 'denied_user_email_body', 'wpuf_mails', $body );
        }

        if ( !is_null( $form_id ) ) {
            $blogname        = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
            $form_settings   = wpuf_get_form_settings( $form_id );

            $body       = "Hi %username%,\r\n\r\n";
            $body      .= "Congrats! You are Successfully registered to ". $blogname ."\r\n\r\n";
            $body      .= "Thanks";

            $subject = isset( $form_settings['notification']['welcome_email_subject'] ) ? $form_settings['notification']['welcome_email_subject'] : 'Thank you for registering';
            $message = isset( $form_settings['notification']['welcome_email_body'] ) ? $form_settings['notification']['welcome_email_body'] : $body;
        }

        $message = self::prepare_mail_body( $message, $user_status, $user_id );
        $message = get_formatted_mail_body( $message, $subject );

        wp_mail( $to, $subject, $message );
    }

    /**
     * add profile field Setting on form builder
     *
     * @param array $field_settings
     *
     * @return array $field_settings
     */
    public function add_field_settings( $field_settings ) {

        if ( class_exists( 'WPUF_Field_Contract' ) ) {
            require_once dirname( __FILE__ ) . '/fields/class-field-avatar.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-display-name.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-first-name.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-last-name.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-nickname.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-password.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-user-bio.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-user-email.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-user-url.php';
            require_once dirname( __FILE__ ) . '/fields/class-field-username.php';

            $fields = array();
            $fields['user_login']   = new WPUF_Form_Field_Username();
            $fields['first_name']   = new WPUF_Form_Field_First_Name();
            $fields['last_name']    = new WPUF_Form_Field_Last_Name();
            $fields['display_name'] = new WPUF_Form_Field_Display_Name();
            $fields['nickname']     = new WPUF_Form_Field_Nickame();
            $fields['user_email']   = new WPUF_Form_Field_User_Email();
            $fields['user_url']     = new WPUF_Form_Field_User_Url();
            $fields['user_bio']     = new WPUF_Form_Field_User_Bio();
            $fields['password']     = new WPUF_Form_Field_Password();
            $fields['avatar']       = new WPUF_Form_Field_Avater();
            $field_settings = array_merge( $field_settings,$fields );

        }

        return $field_settings;
    }
}

<?php
/**
 * Author: Cüneyt Kaya
 * Website: https://cka-contact-form.kayacuneyt.com/
 * Plugin Name: CKa Contact Form
 * Version: 1.0.0
 * Author URI: https://kayacuneyt.com
 * Description: Simple contact form plugin with customizable email address.
 * License: GPL v3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */


if ( ! defined( 'ABSPATH' ) ) exit;


function cka_contact_form_activate() {

    add_option('cka_contact_form_email', get_option('admin_email'));
}

function cka_contact_form_deactivate() {

    delete_option('cka_contact_form_email');
}

register_activation_hook(__FILE__, 'cka_contact_form_activate');
register_deactivation_hook(__FILE__, 'cka_contact_form_deactivate');


function cka_contact_form_add_admin_menu() {
    add_options_page('CKa Contact Form Settings', 'CKa Contact Form', 'manage_options', 'cka-contact-form', 'cka_contact_form_settings_page');
}

add_action('admin_menu', 'cka_contact_form_add_admin_menu');


function cka_contact_form_settings_page() {
    ?>
    <div class="wrap">
        <h2>CKa Contact Form Settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields('cka_contact_form_settings');
            do_settings_sections('cka-contact-form');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}


function cka_contact_form_settings_init() {
    register_setting('cka_contact_form_settings', 'cka_contact_form_email');

    add_settings_section('cka_contact_form_settings_section', 'Settings', 'cka_contact_form_settings_section_cb', 'cka-contact-form');

    add_settings_field('cka_contact_form_email_field', 'Email Address', 'cka_contact_form_email_field_cb', 'cka-contact-form', 'cka_contact_form_settings_section');
}

add_action('admin_init', 'cka_contact_form_settings_init');

function cka_contact_form_settings_section_cb() {
    echo '<p>Enter the email address you want to receive contact messages.</p>';
}

function cka_contact_form_email_field_cb() {
    $email = get_option('cka_contact_form_email');
    ?>
    <input type="email" name="cka_contact_form_email" value="<?php echo isset($email) ? esc_attr($email) : ''; ?>">
    <?php
}


function cka_contact_form_shortcode() {
    ob_start();
    ?>
    <div class="container" id="contact-container">
        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
            <div class="row">
                <div class="col-100">
                    <input type="text" id="mc-name" name="mc-name" placeholder="Your name.." required>
                </div>
            </div>
            <div class="row">
                <div class="col-100">
                    <input type="email" id="mc-email" name="mc-email" placeholder="Your email.." required style="width: 100%;">
                </div>
            </div>
            <div class="row">
                <div class="col-100">
                    <textarea id="mc-message" name="mc-message" placeholder="Write your message.." required style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" name="mc-submitted" value="Send">
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('cka_contact_form', 'cka_contact_form_shortcode');


function cka_contact_form_handle_post() {
    if (isset($_POST['mc-submitted'])) {

        $name    = sanitize_text_field($_POST['mc-name']);
        $email   = sanitize_email($_POST['mc-email']);
        $message = sanitize_textarea_field($_POST['mc-message']);
        $to      = get_option('cka_contact_form_email');

        $headers = "From: $name <$email>" . "\r\n";

        wp_mail($to, "New message from $name", $message, $headers);


        echo '<div>' . esc_html__('Thank you for your message!', 'cka-contact-form') . '</div>';
    }
}

add_action('wp_head', 'cka_contact_form_handle_post');


function cka_contact_form_enqueue_styles() {
    wp_enqueue_style('cka-contact-form-style', plugins_url('/css/style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'cka_contact_form_enqueue_styles');
?>
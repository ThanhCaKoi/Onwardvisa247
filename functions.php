<?php
function bot_setup() {
    // Enable Featured Images
    add_theme_support('post-thumbnails');
    // Enable Title Tag support
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'bot_setup');

function bot_scripts() {
    // Enqueue Styles
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('bot-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'));
    wp_enqueue_style('bot-wide-form', get_template_directory_uri() . '/wide-form.css', array('bot-style'), filemtime(get_template_directory() . '/wide-form.css'));

    // Payment Scripts
    // REPLACE 'sb' WITH YOUR REAL PAYPAL CLIENT ID
    wp_enqueue_script('paypal-sdk', 'https://www.paypal.com/sdk/js?client-id=sb&currency=USD', array(), null, true);
    wp_enqueue_script('stripe-js', 'https://js.stripe.com/v3/', array(), null, true);

    // Enqueue Scripts
    wp_enqueue_script('bot-script', get_template_directory_uri() . '/script.js', array('jquery'), filemtime(get_template_directory() . '/script.js'), true);
    
    // Pass PHP data to JS (for AJAX URL)
    wp_localize_script('bot-script', 'bot_vars', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'bot_scripts');

// Force Load FontAwesome via Head to avoid conflicts
function bot_load_fontawesome() {
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
}
add_action('wp_head', 'bot_load_fontawesome', 1);

// --- STRIPE SERVER SIDE LOGIC ---
add_action('wp_ajax_bot_create_stripe_session', 'bot_create_stripe_session');
add_action('wp_ajax_nopriv_bot_create_stripe_session', 'bot_create_stripe_session');

function bot_create_stripe_session() {
    // 1. CONFIGURATION (Replace with your Secret Key)
    $stripe_secret_key = 'sk_test_...'; // <--- PASTE YOUR SECRET KEY HERE
    $your_domain = home_url();

    // 2. Prepare Data for Stripe API
    $body = array(
        'payment_method_types' => array('card'),
        'line_items' => array(
            array(
                'price_data' => array(
                    'currency' => 'usd',
                    'product_data' => array(
                        'name' => 'Verifiable Onward Ticket',
                        'description' => 'Valid for 48 hours',
                    ),
                    'unit_amount' => 1400, // $14.00 (in cents)
                ),
                'quantity' => 1,
            ),
        ),
        'mode' => 'payment',
        'success_url' => $your_domain . '/success?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $your_domain . '/transaction-cancelled',
    );

    // 3. Convert nested array to HTTP query string (Stripe URL Encoded Form Body)
    // Custom recursive build query or manual construction needed because http_build_query handles arrays differently than Stripe expects
    // Simpler approach for WP: Use standard http_build_query but we need to match Stripe's format line_items[0][price_data]...
    // Let's use a simpler structure or just loop:
    
    $args = array(
        'method'    => 'POST',
        'headers'   => array(
            'Authorization' => 'Bearer ' . $stripe_secret_key,
            'Content-Type'  => 'application/x-www-form-urlencoded',
        ),
        'body'      => _bot_build_stripe_query($body),
        'timeout'   => 45,
    );

    // 4. Call Stripe API
    $response = wp_remote_post('https://api.stripe.com/v1/checkout/sessions', $args);

    if (is_wp_error($response)) {
        wp_send_json_error(array('message' => $response->get_error_message()));
    }

    $response_body = json_decode(wp_remote_retrieve_body($response), true);

    if (isset($response_body['error'])) {
        wp_send_json_error(array('message' => $response_body['error']['message']));
    }

    // 5. Return Session ID to Frontend
    wp_send_json_success(array('id' => $response_body['id']));
}

// Helper: Format array for Stripe API (WordPress http_build_query isn't perfectly matched for deep nested Stripe arrays often)
function _bot_build_stripe_query($data, $prefix = null) {
    if (!is_array($data)) return $data;
    $params = array();
    foreach ($data as $key => $value) {
        $k = isset($prefix) ? $prefix . '[' . $key . ']' : $key;
        if (is_array($value)) {
            $params[] = _bot_build_stripe_query($value, $k);
        } else {
            $params[] = urlencode($k) . '=' . urlencode($value);
        }
    }
    return implode('&', $params);
}

// --- ORDER MANAGEMENT (Database for FE Devs) ---
// 1. Register a "Custom Post Type" to store Orders.
function bot_register_order_cpt() {
    $labels = array(
        'name'               => 'Ticket Orders',
        'singular_name'      => 'Order',
        'menu_name'          => 'Ticket Orders',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Order',
        'edit_item'          => 'Edit Order',
        'new_item'           => 'New Order',
        'view_item'          => 'View Order',
        'search_items'       => 'Search Orders',
        'not_found'          => 'No orders found',
        'not_found_in_trash' => 'No orders found in Trash',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => false,  // Don't show on the frontend
        'show_ui'             => true,   // Show in Admin Dashboard
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-tickets-alt', // Icon class
        'supports'            => array('title', 'custom-fields'),
        'capability_type'     => 'post',
    );
    
    register_post_type('bot_order', $args);
}
add_action('init', 'bot_register_order_cpt');

// 2. Custom Columns for Order List
add_filter('manage_bot_order_posts_columns', 'bot_set_order_columns');
function bot_set_order_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => 'Order ID / Email',
        'pax_name' => 'Passenger Name',
        'flight_route' => 'Route',
        'payment_status' => 'Status',
        'date' => 'Date Created',
    );
    return $new_columns;
}

add_action('manage_bot_order_posts_custom_column', 'bot_fill_order_columns', 10, 2);
function bot_fill_order_columns($column, $post_id) {
    switch ($column) {
        case 'pax_name':
            echo get_post_meta($post_id, 'bot_pax_main_name', true); 
            break;
        case 'flight_route':
            echo get_post_meta($post_id, 'bot_flight_summary', true);
            break;
        case 'payment_status':
            $status = get_post_meta($post_id, 'bot_payment_status', true);
            $color = ($status === 'paid') ? 'green' : 'orange';
            echo '<b style="color:'.$color.'">' . ucfirst($status) . '</b>';
            break;
    }
}

// 3. AJAX Handler: Process Checkout & Save Order
add_action('wp_ajax_bot_process_checkout', 'bot_process_checkout');
add_action('wp_ajax_nopriv_bot_process_checkout', 'bot_process_checkout');

function bot_process_checkout() {
    // 1. Sanitize & Verify Input
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name  = sanitize_text_field($_POST['last_name']);
    $email      = sanitize_email($_POST['email']);
    $title      = sanitize_text_field($_POST['title']);
    
    // Flight & Pax Data
    $flight_summary = sanitize_text_field($_POST['flight_summary']);
    $amount         = sanitize_text_field($_POST['amount']);
    $payment_method = sanitize_text_field($_POST['payment_method']);

    if (empty($email)) {
        wp_send_json_error(array('message' => 'Missing email field'));
    }

    // 2. Create Order Post
    $order_title = 'Order #' . time() . ' - ' . $email;
    
    $order_data = array(
        'post_title'    => $order_title,
        'post_type'     => 'bot_order',
        'post_status'   => 'publish',
    );

    $order_id = wp_insert_post($order_data);

    if (is_wp_error($order_id)) {
        wp_send_json_error(array('message' => 'Could not create order'));
    }

    // 3. Save Order Meta Data
    // Join name if parts provided, else fallback
    $full_name = trim($title . ' ' . $first_name . ' ' . $last_name);
    if(empty($full_name)) $full_name = 'Guest';

    update_post_meta($order_id, 'bot_pax_main_name', $full_name);
    update_post_meta($order_id, 'bot_pax_email', $email);
    update_post_meta($order_id, 'bot_flight_summary', $flight_summary);
    update_post_meta($order_id, 'bot_order_amount', $amount);
    update_post_meta($order_id, 'bot_payment_method', $payment_method);
    update_post_meta($order_id, 'bot_payment_status', 'pending');

    // 4. Return Success
    wp_send_json_success(array(
        'order_id' => $order_id,
        'message'  => 'Order created successfully'
    ));
}
?>

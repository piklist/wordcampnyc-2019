<?php 
/*
Plugin Name: WordCamp NYC - 2019
Plugin URI: https://piklist.com
Description: Best presentation ever!
Version: 1.0
Author: Piklist
Author URI: https://piklist.com/
Plugin Type: piklist
*/

add_action('admin_footer', 'wcnyc_js_css');
add_action('piklist_save_field', 'wcnyc_handle_email_form', 10, 2);

add_filter('piklist_post_types', 'wcnyc_post_types');
add_filter('piklist_empty_post_title', 'wcnyc_set_lead_title', 10, 2);
add_filter('screen_layout_columns', 'wcnyc_layout_columns');
add_filter('get_user_option_screen_layout_lead', 'wcnyc_layout_lead');
add_filter('piklist_validation_rules', 'wcnyc_validation_rules', 11);


/**
 * register post types
 *
 * @param [type] $post_types
 * @return void
 */
function wcnyc_post_types($post_types)
{
  $post_types['lead'] = array(
    'labels' => piklist('post_type_labels', 'Lead')
    ,'menu_icon' => piklist('url', 'piklist') . '/parts/img/piklist-menu-icon.svg'
    ,'page_icon' => piklist('url', 'piklist') . '/parts/img/piklist-page-icon-32.png'
    ,'show_in_rest' => true
    ,'supports' => array()
    ,'public' => true
      ,'has_archive' => true
    ,'rewrite' => array(
      'slug' => 'lead'
    )
    ,'capability_type' => 'post'
    ,'edit_columns' => array(
      'title' => __('Lead')
      ,'author' => __('Assigned to')
    )
    ,'hide_meta_box' => array(
      'slug'
      ,'author'
    )
    ,'status' => array(
      'active' => array(
        'label' => 'Active'
        ,'public' => true
        ,'show_in_admin_all_list' => true
        ,'show_in_admin_status_list' => true
      )
      ,'draft' => array(
        'label' => 'Draft'
        ,'public' => true
      )
    )
  );

  return $post_types;
}

/**
 * create a post_title for each lead
 * combine the first and last name fields
 * since the title field has been removed
 *
 * @param [type] $data
 * @param [type] $post
 * @return void
 */
function wcnyc_set_lead_title($data, $post) 
{
  if ($post['post_type'] == 'lead') 
  {
    $data = get_post_meta($post['ID'], 'first_name', true) . ' ' . get_post_meta($post['ID'], 'last_name', true);
  } 
  
  return $data;
}

/**
 * force one column for lead screen
 *
 * @param [type] $columns
 * @return void
 */
function wcnyc_layout_columns($columns) 
{
  $columns['lead'] = 1;

  return $columns;
}

/**
 * force one column for lead screen in logged in users settings
 *
 * @return void
 */
function wcnyc_layout_lead() 
{
  return 1;
}

/**
 * register custom validation rules
 *
 * @param [type] $validation_rules
 * @return void
 */
function wcnyc_validation_rules($validation_rules) 
{
  $validation_rules['no_fake_names_please'] = array(
    'callback' => 'wcnyc_validate_name'
  );

  $validation_rules['validate_twitter'] = array(
    'callback' => 'wcnyc_validate_twitter'
  );
  
  return $validation_rules;
}

/**
 * validation rule: check for fake names
 *
 * @param [type] $index
 * @param [type] $value
 * @param [type] $options
 * @param [type] $field
 * @param [type] $fields
 * @return void
 */
function wcnyc_validate_name($index, $value, $options, $field, $fields) 
{
  $valid = true;
  
  if (wp_doing_ajax())
  {
    parse_str($_REQUEST['data'], $data);
    
    $first_name = esc_attr($data[piklist::$prefix . 'post_meta']['first_name']);
  }
  else
  {
    $first_name = esc_attr($_REQUEST[piklist::$prefix . 'post_meta']['first_name']);
  }
  
  $post_id = $field['object_id'];

  $attempts = (int) get_post_meta($post_id, 'wcnyc_validate_name', true);
  $name = strtolower($first_name . ' ' . $value);

  $blacklist = array(
    'john smith'
    ,'jane doe'
    ,'john doe'
    ,'johnny appleseed'
  );

  $messages = array(
    '1' => __('C`mon, that name is not real', 'wordcampnyc-2019')
    ,'2' => __('Really. We\'re going to play this game?', 'wordcampnyc-2019')
    ,'3' => __('Seriously? You\'re going to go with this name?', 'wordcampnyc-2019')
  );

  if ($attempts < 3 && in_array($name, $blacklist))
  {
    $attempts = $attempts + 1;
    
    $valid = $messages[$attempts];

    update_post_meta($post_id, 'wcnyc_validate_name', $attempts);
  }
  else
  {
    delete_post_meta($post_id, 'wcnyc_validate_name');
  }

  return $valid;
}

/**
 * validate twitter handle
 * using twitter api
 *
 * @param [type] $index
 * @param [type] $value
 * @param [type] $options
 * @param [type] $field
 * @param [type] $fields
 * @return void
 */
function wcnyc_validate_twitter($index, $value, $options, $field, $fields) 
{
  $valid = true;
  
  $response = wp_remote_get('https://twitter.com/users/username_available?username=' . $value);
  
  if (!is_wp_error($response)) 
  {
    $body = json_decode($response['body']);

    if ($body->reason != 'taken')
    {
      $valid = __('Not a valid Twitter user name', 'wordcampnyc-2019');
    }
  }

  return $valid;
}

/**
 * Adjust our arrow on the help pointer as the pointer API doesn't support right aligned arrows
 *
 * @return void
 */
function wcnyc_js_css() 
{
?>
  <script type="text/javascript">
    $(window).load(function()
    {
      $('h3#wordcampnyc_2019_lead_pointer')
        .parent()
        .siblings('.wp-pointer-arrow')
        .css({
          left: 'auto',
          right: '25px'
        });
    });
  </script>
<?php
}

/**
 * email contents from support form
 *
 * @param [type] $scope
 * @param [type] $fields
 * @return void
 */
function wcnyc_handle_email_form($scope, $fields)
{
  if ($scope == 'email')
  {
    $email = $headers = array();

    foreach ($fields as $field)
    {
      $email[$field['field']] = $field['request_value'];
    }

    array_push($headers, 'From: ' . $email['from']);

    $email['message'] .= "\r\n\r\n" . $email['signature'];
 
    wp_mail($email['to'], $email['subject'], $email['message'], $headers);
  }
}
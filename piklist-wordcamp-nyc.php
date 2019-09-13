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

add_action('admin_footer', 'piklist_wcnyc_js_css');

add_filter('piklist_post_types', 'piklist_wcnyc_post_types');
add_filter('piklist_empty_post_title', 'piklist_wcnyc_set_lead_title', 10, 2);
add_filter('screen_layout_columns', 'piklist_wcnyc_layout_columns');
add_filter('get_user_option_screen_layout_lead', 'piklist_wcnyc_layout_lead');
add_filter('piklist_validation_rules', 'piklist_wcnyc_validation_rules', 11);

function piklist_wcnyc_post_types($post_types)
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
      'title' => __('Demo')
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


  $post_types['sales_lead'] = array(
    'labels' => piklist('post_type_labels', 'Sales Lead')
    ,'menu_icon' => piklist('url', 'piklist') . '/parts/img/piklist-menu-icon.svg'
    ,'page_icon' => piklist('url', 'piklist') . '/parts/img/piklist-page-icon-32.png'
    ,'show_in_rest' => true
    ,'supports' => array()
    ,'public' => true
      ,'has_archive' => true
    ,'rewrite' => array(
      'slug' => 'sales-lead'
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

function piklist_wcnyc_set_lead_title($data, $post) 
{
  if ($post_array['post_type'] == 'lead') 
  {
    $data = get_post_meta($post['ID'], 'first_name', true) . ' ' . get_post_meta($post['ID'], 'last_name', true);
  } 
  
  return $data;
}

function piklist_wcnyc_layout_columns($columns) 
{
  $columns['lead'] = 1;

  return $columns;
}

function piklist_wcnyc_layout_lead() 
{
  return 1;
}

function piklist_wcnyc_validation_rules($validation_rules) 
{
  $validation_rules['no_fake_names_please'] = array(
    'callback' => 'piklist_wcnyc_validate_name'
  );

  $validation_rules['validate_twitter'] = array(
    'callback' => 'piklist_wcnyc_validate_twitter'
  );
  
  return $validation_rules;
}

function piklist_wcnyc_validate_name($index, $value, $options, $field, $fields) 
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

  $attempts = (int) get_post_meta($post_id, 'piklist_wcnyc_validate_name', true);
  $name = strtolower($first_name . ' ' . $value);

  $blacklist = array(
    'john smith'
    ,'jane doe'
    ,'john doe'
    ,'johnny appleseed'
  );

  $messages = array(
    '1' => __('C`mon, that name is not real', 'piklist_wcnyc')
    ,'2' => __('Really. We\'re going to play this game?', 'piklist_wcnyc')
    ,'3' => __('Seriously? You\'re going to go with this name?', 'piklist_wcnyc')
  );

  if ($attempts < 3 && in_array($name, $blacklist))
  {
    $attempts = $attempts + 1;
    
    $valid = $messages[$attempts];

    update_post_meta($post_id, 'piklist_wcnyc_validate_name', $attempts);
  }
  else
  {
    delete_post_meta($post_id, 'piklist_wcnyc_validate_name');
  }

  return $valid;
}

function piklist_wcnyc_validate_twitter($index, $value, $options, $field, $fields) 
{
  $valid = true;
  
  $response = wp_remote_get('https://twitter.com/users/username_available?username=' . $value);
  
  if (!is_wp_error($response)) 
  {
    $body = json_decode($response['body']);

    if ($body->reason != 'taken')
    {
      $valid = __('Not a valid Twitter user name', 'piklist_wcnyc');
    }
  }

  return $valid;
}

function piklist_wcnyc_js_css() 
{
?>
  <script type="text/javascript">
    // Adjust our arrow on the help pointer as the pointer API doesn't support right aligned arrows
    $(window).load(function()
    {
      $('h3#piklist_wordcamp_nyc_lead_pointer')
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
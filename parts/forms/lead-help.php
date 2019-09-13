<?php
/*  
Title: Lead Help
Method: post
Message: Request sent!
*/
  
  // [piklist_form form="lead-help" add_on="piklist-wordcamp-nyc"]

  $current_user = wp_get_current_user();

  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'email'
    ,'field' => 'to'
    ,'value' => get_option('admin_email')
  ));  
  
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'email'
    ,'field' => 'from'
    ,'value' => $current_user->user_email
  ));
  
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'email'
    ,'field' => 'subject'
    ,'value' => 'Lead Generation Form'
  ));
  
  piklist('field', array(
    'type' => 'textarea'
    ,'scope' => 'email'
    ,'field' => 'message'
    ,'value' => false
    ,'required' => true
    ,'template' => 'field'
    ,'attributes' => array(
      'class' => 'large-text'
      ,'style' => 'margin-bottom: 10px;'
    )
  ));
  
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'email'
    ,'field' => 'signature'
    ,'value' => sprintf(__('%1$s' . "\r\n\r\n" . '%2$sLink to Issue%3$s', 'wordcampnyc-2019'), $current_user->display_name, '<a href="' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '">', '</a>')
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Request Help'
    ,'template' => 'field'
    ,'attributes' => array(
      'class' => 'button button-primary'
      ,'style' => 'float: right;margin-bottom: 10px;'
    )
  ));
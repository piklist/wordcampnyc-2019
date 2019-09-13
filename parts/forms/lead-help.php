<?php
/*  
Title: Lead Help
Method: post
Message: Request sent!
*/
  
  // [piklist_form form="lead-help" add_on="piklist-wordcamp-nyc"]

  $current_user = wp_get_current_user();

  $email_address = $current_user->user_email;

  $user_name = $current_user->user_firstname . " " . $current_user->user_lastname;


  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'message'
    ,'value' => false
    ,'required' => true
    ,'columns' => 12
    ,'template' => 'label_field'
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Request Help'
    ,'template' => 'field'
    ,'attributes' => array(
      'class' => 'button button-primary'
      ,'style' => 'float: right;'
    )
  ));
<?php
/*  
Title: Lead Help
Method: post
Message: Request sent!
*/
  
  // [piklist_form form="lead-help" add_on="piklist-wordcamp-nyc"]

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'email'
    ,'label' => __('Email', 'piklist-wordcamp-nyc')
    ,'value' => false
    ,'required' => true
    ,'validate' => array(
      array(
        'type' => 'email_exists'
      )
      ,array(
        'type' => 'email'
      )
      ,array(
        'type' => 'email_domain'
      )
    )
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Request Help'
    ,'attributes' => array(
      'class' => 'button button-primary'
    )
  ));
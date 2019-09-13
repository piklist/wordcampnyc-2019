<?php
/*  
Title: Lead Help
Method: post
Message: Request sent!
*/
  
  // [piklist_form form="lead-help" add_on="piklist-wordcamp-nyc"]

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'support_email'
    ,'label' => __('Email2', 'piklist-wordcamp-nyc')
    ,'value' => false
    ,'required' => true
    ,'template' => 'label_field'
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
      'style' => 'width: 100%; margin-bottom: 10px;'
    )
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit2'
    ,'value' => 'Request Help'
    ,'template' => 'field'
    ,'attributes' => array(
      'class' => 'button button-primary'
      ,'style' => 'float: right;'
    )
  ));
<?php
/*
Post Type: lead
Meta Box: false
*/

  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_status'
    ,'value' => 'active'
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Full Name', 'piklist-wordcamp-nyc')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'first_name'
        ,'label' => __('First Name', 'piklist-wordcamp-nyc')
        ,'label_position' => 'after'
        ,'columns' => 6
        ,'required' => true
        ,'attributes' => array(
          'wrapper_class' => 'first_name'
          ,'class' => 'regular-text'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'last_name'
        ,'label' => __('Last Name', 'piklist-wordcamp-nyc')
        ,'label_position' => 'after'
        ,'columns' => 6
        ,'required' => true
        ,'attributes' => array(
          'wrapper_class' => 'last_name'
          ,'class' => 'regular-text'
        )
        ,'validate' => array(
          array(
            'type' => 'no_fake_names_please'
          )
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'user_email'
    ,'label' => __('Email', 'piklist-wordcamp-nyc')
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
      'wrapper_class' => 'user_email'
      ,'class' => 'large-text'
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'label' => __('Address', 'piklist-wordcamp-nyc')
    ,'list' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'label' => __('Street Address', 'piklist-wordcamp-nyc')
        ,'columns' => 12
        ,'attributes' => array(
          'placeholder' => 'Street Address'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'label' => __('PO Box, Suite, etc.', 'piklist-wordcamp-nyc')
        ,'columns' => 12
        ,'attributes' => array(
          'placeholder' => 'Street Address'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'city'
        ,'label' => __('City', 'piklist-wordcamp-nyc')
        ,'columns' => 5
        ,'attributes' => array(
          'placeholder' => 'City'
        )
      )
      ,array(
        'type' => 'select'
        ,'field' => 'state'
        ,'label' => __('State', 'piklist-wordcamp-nyc')
        ,'columns' => 4
        ,'choices' => array(
          'AL' => 'AL'
          ,'AK' => 'AK'
          ,'AZ' => 'AZ'
          ,'AR' => 'AR'
          ,'CA' => 'CA'
          ,'CO' => 'CO'
          ,'CT' => 'CT'
          ,'DE' => 'DE'
          ,'DC' => 'DC'
          ,'FL' => 'FL'
          ,'GA' => 'GA'
          ,'HI' => 'HI'
          ,'ID' => 'ID'
          ,'IL' => 'IL'
          ,'IN' => 'IN'
          ,'IA' => 'IA'
          ,'KS' => 'KS'
          ,'KY' => 'KY'
          ,'LA' => 'LA'
          ,'ME' => 'ME'
          ,'MD' => 'MD'
          ,'MA' => 'MA'
          ,'MI' => 'MI'
          ,'MN' => 'MN'
          ,'MS' => 'MS'
          ,'MO' => 'MO'
          ,'MT' => 'MT'
          ,'NE' => 'NE'
          ,'NV' => 'NV'
          ,'NH' => 'NH'
          ,'NJ' => 'NJ'
          ,'NM' => 'NM'
          ,'NY' => 'NY'
          ,'NC' => 'NC'
          ,'ND' => 'ND'
          ,'OH' => 'OH'
          ,'OK' => 'OK'
          ,'OR' => 'OR'
          ,'PA' => 'PA'
          ,'RI' => 'RI'
          ,'SC' => 'SC'
          ,'SD' => 'SD'
          ,'TN' => 'TN'
          ,'TX' => 'TX'
          ,'UT' => 'UT'
          ,'VT' => 'VT'
          ,'VA' => 'VA'
          ,'WA' => 'WA'
          ,'WV' => 'WV'
          ,'WI' => 'WI'
          ,'WY' => 'WY'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'postal_code'
        ,'label' => __('Zip Code', 'piklist-wordcamp-nyc')
        ,'columns' => 3
        ,'attributes' => array(
          'placeholder' => 'Postal Code'
        )
      )
    )
  ));

  piklist('field', array(
    'type' => 'textarea'
    ,'field' => 'description'
    ,'label' => __('Notes', 'piklist-wordcamp-nyc')
    ,'value' => false
    ,'attributes' => array(
      'wrapper_class' => 'description'
      ,'class' => 'large-text'
      ,'rows' => 10
    )
  ));
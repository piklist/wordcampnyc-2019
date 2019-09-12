<?php
/*
Post Type: lead
Meta Box: false
Context: advanced
Extend: submitdiv
Extend Method: replace
*/

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'template' => 'post_meta'
    ,'value' => 'Add Lead'
    ,'attributes' => array(
      'class' => 'button button-primary button-large'
      ,'style' => 'float: right;'
    )
  ));
<?php
/*
Title: Get Help
Anchor ID: #contextual-help-link
Edge: top
Align: right
Page: post-new.php, post.php
*/

echo 'KEVIN: please align arrow so it points to HELP tab';
?>

<p>
  <?php printf(__('Help is available from this tab whenever you need it.  For Lead Workflow assistance %1$svisit that section %2$s.', 'piklist'),'<a href="' . network_admin_url() . '#">', '</a>');?>
</p>
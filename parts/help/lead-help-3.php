<?php
/*
Title: Leads 101
Capability: manage_options
Post Type: lead
*/
?>

<div class="videoWrapper">
  <iframe width="560" height="315" src="https://www.youtube.com/embed/X2wzhy5vNBY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<!-- This could also be made global by including it within a stylesheet via piklist_assets -->
<style type="text/css">
  .videoWrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
    margin-top: 10px;
  }
  .videoWrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>
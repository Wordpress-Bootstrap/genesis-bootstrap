<?php
remove_action(  'genesis_doctype', 'genesis_do_doctype' );
add_action(     'genesis_doctype', 'bsg_conditional_comments' );

function bsg_conditional_comments() {
    ?>
<!DOCTYPE html>
<html lang="en" class="no-js" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
}

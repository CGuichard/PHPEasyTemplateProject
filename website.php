<?php
/**
 * This file initialize the operation of PHP Easy Template
 *
 * With the code below PHPEasyTemplate is loaded when the page website.php
 * is called. Please do not modify this file.
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @since 1.0
 *
 */

 /*====================================================*/

  require_once("api/init.inc.php"); // Load api
  session_start(); // Start a new session, or use the previous one
  /* check the database */
  if(manage_db("db.sqlite3")) {
    /* Load PHPEasyTemplate */
    $PHP_EASY_TEMPLATE = new PHPEasyTemplate("routes.inf", $cache=false);
    /* Load the template corresponding to the route called on this page */
    $PHP_EASY_TEMPLATE->load();
  } else {
    /*
     * When a problem happen and the
     * database doesn't exists, redirect
     * to an error 500
     *
     */
    PHPEasyTemplate::e_500();
  }
?>

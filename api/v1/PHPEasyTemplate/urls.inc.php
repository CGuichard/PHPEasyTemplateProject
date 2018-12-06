<?php
/**
 * File defining functions linked to the url management
 *
 * This file is loaded by api/init.inc.php to import all functions of the package
 * PHPEasyTemplate in the version 1 of the api.
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package api.v1.PHPEasyTemplate
 * @since 1.0
 *
 */

 /*====================================================*/

  /* to handle an eventual problem if http_response_code is not defined */
  if(!function_exists('http_response_code')) {
      function http_response_code($newcode=NULL) {
          static $code = 200;
          if($newcode !== NULL) {
              header('X-PHP-Response-Code: '.$newcode, true, $newcode);
              if(!headers_sent()) $code = $newcode;
          }
          return $code;
      }
  }


  /**
   * This function returns the url for a given route of the website
   *
   * @param string $url_route The route
   *
   * @return void
   */
  function get_url_for($url_route) {
    $url_route = PHPEasyTemplate::correct_url($url_route);
    if(isset($GLOBALS["PHP_EASY_TEMPLATE"])) {
      global $PHP_EASY_TEMPLATE;
      foreach ($PHP_EASY_TEMPLATE->get_routes()["route"] as $route => $template) {
        if(PHPEasyTemplate::matching_urls($url_route, $route)) {
          return $PHP_EASY_TEMPLATE->get_website_url().substr($url_route, 1, strlen($url_route));
        }
      }
      return $PHP_EASY_TEMPLATE->get_website_url()."404/";
    } else {
      return $PHP_EASY_TEMPLATE->get_website_url()."404/";
    }
  }

  /**
   * This function displays the url for a given route of the website
   *
   * @param string $url_route The route
   *
   * @return void
   */
  function url_for($url_route) {
    echo get_url_for($url_route);
  }

  /**
   * This function returns the url for a given ajax request route
   *
   * @param string $ajax_url The ajax request route
   *
   * @return string
   */
  function get_ajax_for($ajax_url) {
    $ajax_url = "/ajax".PHPEasyTemplate::correct_url($ajax_url);
    if(isset($GLOBALS["PHP_EASY_TEMPLATE"])) {
      global $PHP_EASY_TEMPLATE;
      foreach ($PHP_EASY_TEMPLATE->get_routes()["ajax"] as $route => $template) {
        if(PHPEasyTemplate::matching_urls($ajax_url, $route)) {
          return $PHP_EASY_TEMPLATE->get_website_url().substr($ajax_url, 1, strlen($ajax_url));
        }
      }
      return $PHP_EASY_TEMPLATE->get_website_url()."ajax/404/";
    } else {
      return $PHP_EASY_TEMPLATE->get_website_url()."ajax/404/";
    }
  }

  /**
   * This function displays the url for a given ajax request route
   *
   * @param string $ajax_url The ajax request route
   *
   * @return void
   */
  function ajax_for($ajax_url) {
    echo get_ajax_for($ajax_url);
  }
?>

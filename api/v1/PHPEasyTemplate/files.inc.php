<?php
/**
 * File defining functions linked to the management of file paths
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

  /* =============== FILE PATH =============== */

  /**
   * This function returns the paths of files in the website url path
   *
   * @param string $file The file path
   *
   * @return string
   */
  function get_file_path($file) {
    if(isset($GLOBALS["WEBSITE_URL"])) {
      global $WEBSITE_URL;
      if($file[0] === "/") {
        return $WEBSITE_URL.substr($file, 1, strlen($file));
      } else {
        return $WEBSITE_URL.$file;
      }
    } else {
      return "";
    }
  }

  /**
   * This function displays the paths of files in the website url path
   *
   * @param string $file The file path
   *
   * @return void
   */
  function file_path($file) {
    echo get_file_path($file);
  }

  /* =============== STATIC PATH =============== */

  /**
   * This function returns the paths of static files in the website url path
   *
   * Returns the paths of static files in the website url path, so files stored
   * in the folder /static from the website root.
   *
   * @param string $file The file path
   *
   * @return string
   */
  function get_static_path($file) {
    if($file[0] === "/") {
      return get_file_path("static/".substr($file, 1, strlen($file)));
    } else {
      return get_file_path("static/".$file);
    }
  }

  /**
   * This function displays the paths of static files in the website url path
   *
   * Displays the paths of static files in the website url path, so files stored
   * in the folder /static from the website root.
   *
   * @param string $file The file path
   *
   * @return void
   */
  function static_path($file) {
    echo get_static_path($file);
  }

  /* =============== STATIC IMG PATH =============== */

  /**
   * This function returns the paths of static images in the website url path
   *
   * Returns the paths of static images in the website url path, so images
   * stored in the folder /static/img from the website root.
   *
   * @param string $img The image path
   *
   * @return string
   */
  function get_static_img_path($img) {
    if($img[0] === "/") {
      return get_static_path("img/".substr($img, 1, strlen($img)));
    } else {
      return get_static_path("img/".$img);
    }
  }

  /**
   * This function displays the paths of static images in the website url path
   *
   * Displays the paths of static images in the website url path, so images
   * stored in the folder /static/img from the website root.
   *
   * @param string $img The image path
   *
   * @return void
   */
  function static_img_path($img) {
    echo get_static_img_path($img);
  }

  /* =============== STATIC SCRIPT PATH =============== */

  /**
   * This function returns the paths of static scripts in the website url path
   *
   * Returns the paths of static scripts in the website url path, so scripts
   * stored in the folder /static/scripts from the website root.
   *
   * @param string $script The script path
   *
   * @return string
   */
  function get_static_script_path($script) {
    if($script[0] === "/") {
      return get_static_path("scripts/".substr($script, 1, strlen($script)));
    } else {
      return get_static_path("scripts/".$script);
    }
  }

  /**
   * This function displays the paths of static scripts in the website url path
   *
   * Displays the paths of static scripts in the website url path, so scripts
   * stored in the folder /static/scripts from the website root.
   *
   * @param string $script The script path
   *
   * @return void
   */
  function static_script_path($script) {
    echo get_static_script_path($script);
  }

  /* =============== UPLOAD PATH =============== */

  /**
   * This function returns the paths of upload files in the website url path
   *
   * Returns the paths of upload files in the website url path, so scripts
   * stored in the folder /uploads from the website root.
   *
   * @param string $file The file path
   *
   * @return string
   */
  function get_upload_path($file) {
    if($file[0] === "/") {
      return get_file_path("uploads/".substr($file, 1, strlen($file)));
    } else {
      return get_file_path("uploads/".$file);
    }
  }

  /**
   * This function displays the paths of upload files in the website url path
   *
   * Displays the paths of upload files in the website url path, so scripts
   * stored in the folder /uploads from the website root.
   *
   * @param string $file The file path
   *
   * @return void
   */
  function upload_path($file) {
    echo get_upload_path($file);
  }

  /* =============== GENERATE =============== */

  /**
   * This function displays the path of a library script in the website url path
   *
   * @param string $script The script path
   *
   * @return void
   */
  function lib_script($script){
    $script_path = get_static_path("libs/".$script);
    echo "<script src=\"".$script_path."\"></script>\n  ";
  }

  /**
   * This function displays the path of a script in the website url path
   *
   * @param string $script The script path
   *
   * @return void
   */
  function script($script){
    $script_path = get_static_script_path($script);
    echo "<script src=\"".$script_path."\"></script>\n  ";
  }

  /**
   * This function displays the path of a library css file in the website url path
   *
   * @param string $css_file The css file path
   *
   * @return void
   */
  function lib_css($css_file){
    $css_path = get_static_path("libs/".$css_file);
    echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"".$css_path."\">\n  ";
  }

  /**
   * This function displays the path of a css file in the website url path
   *
   * @param string $css_file The css file path
   *
   * @return void
   */
  function css($css_file){
    $css_path = get_static_path("styles/".$css_file);
    echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"".$css_path."\">\n  ";
  }

  /* =============== TEMPLATE =============== */

  /**
   * This function displays the path of a css file in the website url path
   *
   * @param string $template The template path with /templates as root
   *
   * @return string
   */
  function template($template) {
    return "templates/".$template ;
  }

?>

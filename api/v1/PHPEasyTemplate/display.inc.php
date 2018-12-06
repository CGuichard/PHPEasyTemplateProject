<?php
/**
 * File defining functions linked to the display of variables and some sections
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

  /**
   * This function returns the string of a variable
   *
   * To ensure security regarding code injection this function return the string
   * variable after transforming it with htmlspecialchars.
   *
   * @param string $var The variable
   *
   * @return string
   */
  function get_display($var) {
    if($var != NULL and strlen($var) > 0) {
      return htmlspecialchars($var);
    }
    return "";
  }

  /**
   * This function displays a variable after processing it with get_display
   *
   * @param string $var The variable
   *
   * @return void
   */
  function display($var) {
    echo get_display($var);
  }

  /**
   * This function returns the representation of the carousel header
   *
   * This function returns the representation of the carousel header. The
   * carousel can have a slide or fade transition, and must have picture
   * of the same size.
   *
   * @param array $images Array of pictures paths
   * @param boolean $slide True if the carousel make a slide transition,
   *                       else False
   *
   * @return string
   */
  function create_carousel_header($images, $slide=true) {
    $carousel = "<div class='carousel slide".((!$slide) ? " carousel-fade":"")."' data-ride='carousel'><div class='carousel-inner'>";
    foreach ($images as $i => $img) {
      if($i === 0) {
        $carousel .= "<div id='first-header-img' class='carousel-item active'><img class='d-block w-100 img-fluid' src='".get_static_img_path('headers/'.$img)."' alt=''></div>";
      } else {
        $carousel .= "<div class='carousel-item'><img class='d-block w-100 img-fluid' src='".get_static_img_path('headers/'.$img)."' alt=''></div>";
      }
    }
    $carousel .= "</div></div>\n";
    return $carousel;
  }

  /**
   * This function displays the carousel header
   *
   * This function displays the carousel header after processing it
   * with create_carousel_header.
   *
   * @param array $images Array of pictures paths
   * @param boolean $slide True if the carousel make a slide transition,
   *                       else False
   *
   * @return void
   */
  function make_carousel_header($images, $slide=true) {
    echo create_carousel_header($images, $slide);
  }

  /**
   * This function returns the representation of the links of the header
   *
   * This function returns the representation of the links in the header.
   * To know more about the format of the links you can see an example in
   * conf.inc.php at the root of the project.
   *
   * @param array $links Array of links
   *
   * @return string
   */
  function create_header_links($links) {
    $links_html = "";
    $id = 0;
    foreach ($links as $link_name => $link_data) {
      if(is_array($link_data)) {
        if(isset($link_data[0]) AND isset($link_data[1])) {
          $links_html .= "<li class='nav-item m-1'><a class='nav-link text-center waves-effect waves-light' href='".get_url_for($link_data[1])."'><i class='".$link_data[0]." mr-1 d-sm-inline-block d-lg-none d-xl-inline-block'></i>".$link_name."</a></li>";
        } else {
          $link_url = get_url_for(((isset($link_data["route"])) ? $link_data["route"] : "/404/"));
          $link_repr = (isset($link_data["icon"])) ? "<i class='".$link_data["icon"]." mr-1 d-sm-inline-block d-lg-none d-xl-inline-block'></i>".$link_name : $link_name;
          if(isset($link_data["links"])) {
            $links_html .= "<li class='nav-item m-1'>";
            $links_html .= "<a href='".$link_url."' class='nav-link waves-effect waves-light text-center d-block d-lg-none'>".$link_repr."</a>";
            $links_html .= "<div class='dropdown d-none d-lg-block'>";
            $links_html .= "<a href='".$link_url."' class='nav-link waves-effect waves-light text-center'>".$link_repr."<i class='fas fa-caret-down ml-1'></i></a>";
            $links_html .= "<ul class='dropdown-menu dropdown-menu-center' aria-labelledby='dropdownMenu".$id."'>";
            foreach ($link_data["links"] as $sublink_name => $sublink_route) {
              $links_html .= "<li'><a class='dropdown-item waves-effect waves-light' href='".get_url_for($sublink_route)."'>".$sublink_name."</a></li>";
            }
            $links_html .= "</ul></div></li>";
            $id = $id + 1;
          } else {
            $links_html .= "<li class='nav-item m-1'><a class='nav-link text-center waves-effect waves-light' href='".$link_url."'>".$link_repr."</a></li>";
          }
        }
      } else {
        $links_html .= "<li class='nav-item m-1'><a class='nav-link text-center waves-effect waves-light' href='".get_url_for($link_data)."'>".$link_name."</a></li>";
      }
    }
    return $links_html;
  }

  /**
   * This function displays the links of the header
   *
   * This function displays the links in the header after processing it
   * with create_header_links. To know more about the format of the links you
   * can see an example in conf.inc.php at the root of the project.
   *
   * @param array $links Array of links
   *
   * @return void
   */
  function make_header_links($links) {
    echo create_header_links($links);
  }

  /**
   * This function returns the representation of the footer links
   *
   * This function returns the representation of the links in the footer.
   * Links are generated from the same list as the header.
   *
   * @param array $links Array of links
   *
   * @return string
   */
  function create_footer_links($links) {
    $links_html = "";
    foreach ($links as $link_name => $link_data) {
      if(!is_array($link_data)) {
        $links_html .= "<li class='list-group-item'><i class='fas fa-link fa-1x mr-2'></i><a href='".get_url_for($link_data)."'>".$link_name."</a></li>";
      } else if(isset($link_data[1])) {
        $links_html .= "<li class='list-group-item'><i class='fas fa-link fa-1x mr-2'></i><a href='".get_url_for($link_data[1])."'>".$link_name."</a></li>";
      } else if(isset($link_data["route"])) {
        $links_html .= "<li class='list-group-item'><i class='fas fa-link fa-1x mr-2'></i><a href='".get_url_for($link_data["route"])."'>".$link_name."</a></li>";
      }
    }
    return $links_html;
  }

  /**
   * This function displays the footer links
   *
   * This function displays the links in the footer after processing it
   * with create_footer_links. Links are generated from the same list as
   * the header.
   *
   * @param array $links Array of links
   *
   * @return void
   */
  function make_footer_links($links) {
    echo create_footer_links($links);
  }

?>

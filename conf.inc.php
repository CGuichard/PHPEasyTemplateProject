<?php
/**
 * This file contain the main configuration of the website
 *
 * In PHPEasyTemplate some contents are global for all pages.
 * These variables are here, like the website name, the language, the logo,
 * the links of the navigation bar. To modify this content, please modify these
 * variables.
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @since 1.0
 *
 */

 /*====================================================*/

  $LANG = "en"; // Language of your website (html tag)
  $WEBSITE_NAME = "PHPEasyTemplate"; // Name of your website
  $WEBSITE_LOGO = "logo.png"; // Path to your logo (from the folder /static/img/)
  $PAGE_CONTENT = "PHPEasyTemplate template"; // Default description for the website pages
  $HEADER_PICTURE = ["header.jpg","header2.jpg","header3.jpg"]; // Header picture
  /* Navbar content */
  $NAVBAR_LINKS = [
    "Home" => ["fas fa-home", "/home"],
    "Uploads" => ["fas fa-upload", "/uploads"],
    "About" => ["icon" => "fas fa-smile", "route" => "/about"],
    "Contact" => ["icon" => "fas fa-address-book", "route" => "/contact"],
    "Example" => "/example",
    "Useless link" => [
      "icon" => "fas fa-child",
      "route" => "/useless",
      "links" => [
        "Home" => "/home",
        "Uploads" => "/uploads",
      ]
    ]
  ];

?>

<?php
/**
 * The metas of the website
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package includes.parts
 * @since 1.0
 *
 */

 /*====================================================*/
?>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="GUICHARD Clément">
  <meta name="description" content="<?php display($PAGE_CONTENT) ?>"/>
  <link rel="icon" type="image/x-icon" href="<?php static_img_path($WEBSITE_LOGO) ?>" />
  <title><?php display($WEBSITE_NAME." - ".$PAGE_TITLE) ?></title>

<?php
/**
 * The base of all pages
 *
 * This file is the base of every web page used in the website.
 * Please, modify do not this file. If you want to change the navbar the
 * footer or else you can modify it in /includes/parts from the project root.
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package templates
 * @since 1.0
 *
 */

 /*====================================================*/

 if(!isset($LANG)) $LANG = "en";
 if(!isset($WEBSITE_NAME)) $WEBSITE_NAME = "PHPEasyTemplate";
 if(!isset($WEBSITE_LOGO)) $WEBSITE_LOGO = "logo.png";
 if(!isset($PAGE_CONTENT)) $PAGE_CONTENT = "PHPEasyTemplate template";
 if(!isset($HEADER_PICTURE)) $HEADER_PICTURE = [];
 if(!isset($NAVBAR_LINKS)) $NAVBAR_LINKS = ["No links" => ["fas fa-skull-crossbones", "/home"]];
 if(!isset($LOCK_LOG)) $LOCK_LOG = false;
 if(!isset($PAGE_TITLE)) $PAGE_TITLE = "Base";
 if(!isset($PAGE_SECTION)) $PAGE_SECTION = "Base";
 if(!isset($JARALLAX)) $JARALLAX = false;
?>

<!DOCTYPE html>
<html lang='<?php echo $LANG; ?>'>
<head>

<?php
  require_once('includes/parts/_metas.inc.php');
  if(isset($metas_content)) echo $metas_content;
  require_once('includes/parts/_links.inc.php');
  if(isset($css_content)) echo $css_content;
?>

</head>
<body>
  <!--          Header of the page             --->
  <?php
    require_once('includes/parts/_header.inc.php');
    require_once('includes/parts/_ie.inc.php');
  ?>

  <!-- Page Content -->
  <?php if(isset($page_content)) echo $page_content; else echo "<div class='text-center m-4'><h1>".$WEBSITE_NAME." - ".$PAGE_TITLE."</h1><p class='m-4'>".$PAGE_CONTENT."</p></div><div style='height:200px;'></div>"; ?>

  <?php
    require_once('includes/parts/_footer.inc.php');
    require_once('includes/parts/_modals.inc.php');
    if(isset($modals_content)) echo $modals_content;
    require_once('includes/parts/_scripts.inc.php');
    if(isset($scripts_content)) echo $scripts_content;
  ?>
</body>
</html>

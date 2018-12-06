<?php
/**
 * The scripts of the website
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

  echo "\n  ";
  lib_script("fontawesome-free-5.5.0-web/js/all.min.js");
  lib_script("MDB-Free_4.5.14/js/jquery-3.3.1.min.js");
  lib_script("MDB-Free_4.5.14/js/popper.min.js");
  lib_script("MDB-Free_4.5.14/js/bootstrap.min.js");
  lib_script("MDB-Free_4.5.14/js/mdb.min.js");
  if(isset($JARALLAX) AND $JARALLAX) {
    lib_script("jarallax-master/dist/jarallax.min.js");
    lib_script("jarallax-master/dist/jarallax-element.min.js");
  }
  script("min.js/phpeasytemplate.min.js");
  if (isset($_SESSION) AND isset($_SESSION["USER"]) AND isset($_SESSION["ALREADY_CONNECTED"]) AND !$_SESSION["ALREADY_CONNECTED"]) {
    $_SESSION["ALREADY_CONNECTED"] = true;
  }
  echo "\n";
?>

<?php
/**
 * The modals of the website
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

<?php
  if (isset($_SESSION) AND isset($_SESSION["USER"]) AND isset($_SESSION["ALREADY_CONNECTED"]) AND !$_SESSION["ALREADY_CONNECTED"]) {
    require_once("includes/modals/_modal-connection-success.inc.php");
  }
  if (isset($_SESSION) AND !isset($_SESSION["USER"])) {
    require_once("includes/modals/_modal-sign-in.inc.php");
  }

?>

  <a id="top-arrow" class="btn btn-round z-depth-2" href="#top"><i class="fas fa-2x fa-arrow-alt-circle-up"></i></a>

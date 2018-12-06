<?php
/**
 * The page for error 403
 *
 * This page is called for 403 error purpose. You can design like you
 * want, but do not remove the http_response_code function.
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package templates.errors
 * @since 1.0
 *
 */

 /*====================================================*/

?>

<h1>Error 403</h1>
<p>Access denied</p>
<?php
  http_response_code(403);
?>

<?php
/**
 * The internet explorer warning of the website
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
if( (new Browser())->getBrowser() == Browser::BROWSER_IE ) {
?>
<section class="m-5">
  <blockquote class="blockquote bq-warning">
    <p class="bq-title">Warning!</p>
    <p>
      The Internet browser you are currently using is Internet Explorer. It
      sometimes has problems and some features of this site will not work
      properly, or not at all. We advise you to use another internet browser to
      benefit from a more optimal and enjoyable browsing experience.
    </p>
  </blockquote>
</section>
<?php
}
?>

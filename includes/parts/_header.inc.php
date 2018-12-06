<?php
/**
 * The header of the website
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
<header id="top">
    <span id="page-section" hidden><?php display($PAGE_SECTION); ?></span>
    <div id="header-block" class="view">
      <?php make_carousel_header($HEADER_PICTURE, false) ?>
      <div class="mask rgba-blue-slight flex-center text-center">
          <h1 class="mb-2 animated fadeInDown white-text">
            <a class="mx-auto" href="<?php url_for("/home") ?>">
              <strong><?php display($WEBSITE_NAME) ?></strong>
            </a>
          </h1>
      </div>
    </div>
    <?php require_once('includes/parts/_navbar.inc.php') ?>
  </header>

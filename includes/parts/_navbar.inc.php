<?php
/**
 * The navigation bar of the website
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
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
      <a id="navbar-title" class="navbar-brand mx-auto" href="<?php url_for("/home") ?>">
        <img src="<?php static_img_path($WEBSITE_LOGO) ?>" width="30" height="30" class="d-inline-block align-top" alt="">
        <?php display($WEBSITE_NAME) ?>

      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse animated fadeIn" id="navbarSupportedContent">
        <ul id="navbar-left" class="navbar-nav mr-auto">
          <?php make_header_links($NAVBAR_LINKS); ?>
        </ul>
        <ul id="navbar-right" class="navbar-nav ml-auto nav-flex-icons">
        <?php
          if(!isset($_SESSION["USER"])) {
        ?>  <li class="nav-item m-1">
            <a class="nav-link navbarbtn" id="userbtn" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-in-alt mr-1"></i>Sign in</a>
          </li>
        <?php
          } else {
        ?>
          <li class='nav-item m-1 d-block d-lg-none'>
            <a class='nav-link text-center waves-effect waves-light' href="<?php url_for("/profile/".$CURRENT_USER->get_seq()."/".$CURRENT_USER->get_login()) ?>">
              <i class="fas fa-user-circle fa-lg mr-1"></i>Profile
            </a>
          </li>
          <li class='nav-item m-1 d-block d-lg-none'>
            <a class='nav-link text-center waves-effect waves-light' href="<?php url_for("/logout/") ?>">
              <i class="fas fa-sign-out-alt mr-1"></i>
              Logout
            </a>
          </li>
          <li class="nav-item dropdown d-none d-lg-block">
            <a id="userbtn" class="nav-link dropdown-toggle waves-effect waves-light navbarbtn" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="fas fa-user-circle fa-lg mr-1"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink">
              <h6 class="dropdown-header text-center"><?php display($CURRENT_USER->get_login()); ?></h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php url_for("/profile/".$CURRENT_USER->get_seq()."/".$CURRENT_USER->get_login()) ?>"><i class="fas fa-cog mr-1"></i>Profile</a>
              <a class="dropdown-item" href="<?php url_for("/logout/") ?>"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a>
            </div>
          </li>
        <?php
          }
        ?></ul>
      </div>
    </nav>

<?php
  PHPEasyTemplate::lock_log();
  $PAGE_TITLE = "Profile";
  $PAGE_SECTION = "Sign in";
  $PAGE_CONTENT = "Profile page of PHPEasyTemplate";

  $parameters = $PHP_TEMPLATE["parameters"];
  if(isset($parameters["seq"]) AND isset($parameters["log"])) {
    if($parameters["seq"] != $CURRENT_USER->get_seq() OR
    $parameters["log"] != $CURRENT_USER->get_login()) {
      PHPEasyTemplate::e_404();
    }
  }
?>

<?php ob_start(); ?>
<section class="section white-section">
  <div id="card-profile" class="card">
    <h4 class="card-header text-center m-1 p-4 h4"><?php display($CURRENT_USER->get_login()) ?></h4>
    <div class="card-body">
      <form id="form-profile" class="m-4" method="POST" action="<?php ajax_for("/profile/modify/") ?>">
        <fieldset id="fieldset-form-profile" disabled>
          <div class="row">
            <div class="col-12">
              <div class="md-form">
                <i class="fas fa-envelope prefix"></i>
                <input value="<?php display($CURRENT_USER->get_mail()) ?>" name="mail" id="form-mail" type="email" maxlength="254" class="form-control validate" required>
                <label for="form-mail" data-error="wrong" data-success="right">Mail</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="md-form">
                <i class="fas fa-address-card prefix"></i>
                <input value="<?php display($CURRENT_USER->get_fname()) ?>" name="fname" id="form-fname" type="text" maxlength="40" class="form-control validate" required>
                <label for="form-fname" data-error="wrong" data-success="right">First name</label>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="md-form">
                <i class="fas fa-address-card prefix"></i>
                <input value="<?php display($CURRENT_USER->get_name()) ?>" name="name" id="form-name" type="text" maxlength="40" class="form-control validate" required>
                <label for="form-name" data-error="wrong" data-success="right">Name</label>
              </div>
            </div>
            <div class="col-12 col-lg-6 passwords-div" hidden>
              <div class="md-form">
                <i class="fa fa-lock prefix"></i>
                <input name="new-password" id="form-new-password" type="password" maxlength="25" class="form-control validate">
                <label for="form-new-password" data-error="wrong" data-success="right">New password</label>
              </div>
            </div>
            <div class="col-12 col-lg-6 passwords-div" hidden>
              <div class="md-form">
                <i class="fa fa-exclamation-triangle prefix"></i>
                <input name="confirm-password" id="form-confirm-password" type="password" maxlength="25" class="form-control validate">
                <label for="form-confirm-password" data-error="wrong" data-success="right">Confirm your new password</label>
              </div>
            </div>
            <div class="col-12 passwords-div" hidden>
              <div class="md-form">
                <i class="fa fa-lock prefix"></i>
                <input name="password" id="form-password" type="password" maxlength="25" class="form-control validate" required>
                <label for="form-password" data-error="wrong" data-success="right">Current password</label>
              </div>
            </div>
          </div>
        </fieldset>
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <button id="profile-btn1" type="button" class="btn btn-color-1 btn-rounded">Modify</button>
          </div>
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <button id="profile-btn2" type="button" class="btn btn-color-1 btn-rounded">Undo changes</button>
          </div>
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <button id="profile-btn3" type="submit" class="btn btn-color-1 btn-rounded">Accept changes</button>
          </div>
        </div>
        <div id="alert-profile" class="alert rounded text-center mt-4" role="alert" hidden>
          <h5 id="alert-profile-title" class="alert-heading"></h5>
          <hr>
          <p id="alert-profile-msg" class="mb-0"></p>
        </div>
      </form>
    </div>
  </div>
</section>
<?php $page_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <?php
    script("min.js/phpeasytemplate-profile.min.js");
    // script("js/phpeasytemplate-profile.js");
  ?>
<?php $scripts_content = ob_get_clean(); ?>

<?php require_once( template("base.php") ); ?>

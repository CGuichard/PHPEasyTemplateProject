<?php
  PHPEasyTemplate::lock_unlog();
  $PAGE_TITLE = "Sign Up";
  $PAGE_SECTION = "Sign in";
  $PAGE_CONTENT = "Sign up page of PHPEasyTemplate";
?>

<?php ob_start(); ?>
  <style media="screen">
      #card-signup{background-color:rgba(255,255,255,0.55)!important;}#card-signup .card-title{margin-bottom:5vh;}
  </style>
<?php $css_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <section class="section-parallax" style="background-image: url('<?php static_img_path('backgrounds/bg4.jpg') ?>')">
    <div class="section white-parallax">
      <div id="card-signup" class="card card-rounded">
        <div class="card-body">
          <h2 class="card-title text-center">Sign Up</h2>
          <input id="form-signup-next" type="text" value="<?php url_for("/home") ?>" hidden>
          <form id="form-signup" class="m-4" method="POST" action="<?php ajax_for("/sign-up/") ?>">
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="md-form">
                  <i class="fa fa-user prefix"></i>
                  <input name="login" id="form-login" type="text" maxlength="40" class="form-control validate" required>
                  <label for="form-login" data-error="wrong" data-success="right">Login</label>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="md-form">
                  <i class="fas fa-envelope prefix"></i>
                  <input name="mail" id="form-mail" type="email" maxlength="254" class="form-control validate" required>
                  <label for="form-mail" data-error="wrong" data-success="right">Mail</label>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="md-form">
                  <i class="fas fa-address-card prefix"></i>
                  <input name="fname" id="form-fname" type="text" maxlength="40" class="form-control validate" required>
                  <label for="form-fname" data-error="wrong" data-success="right">First name</label>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="md-form">
                  <i class="fas fa-address-card prefix"></i>
                  <input name="name" id="form-name" type="text" maxlength="40" class="form-control validate" required>
                  <label for="form-name" data-error="wrong" data-success="right">Name</label>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="md-form">
                  <i class="fa fa-lock prefix"></i>
                  <input name="password" id="form-password" type="password" maxlength="25" class="form-control validate" required>
                  <label for="form-password" data-error="wrong" data-success="right">Password</label>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="md-form">
                  <i class="fa fa-exclamation-triangle prefix"></i>
                  <input name="confirm-password" id="form-confirm-password" type="password" maxlength="25" class="form-control validate" required>
                  <label for="form-confirm-password" data-error="wrong" data-success="right">Confirm your password</label>
                </div>
              </div>
            </div>
            <div id="alert-signup" class="alert rounded text-center" role="alert">
              <h5 id="alert-signup-title" class="alert-heading"></h5>
              <hr>
              <p id="alert-signup-msg" class="mb-0"></p>
            </div>
            <div class="text-center mt-4">
              <button id="btn-signup" class="btn btn-color-1 btn-rounded" type="submit"><i class="fas fa-arrow-alt-circle-right fa-lg mr-1"></i>register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php $page_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <script type="text/javascript">
    if($("#form-signup").length) {
      send_ajax("form-signup", "btn-signup", "alert-signup", "alert-signup-title", "alert-signup-msg", function() {
        window.location.href = $("#form-signup-next").val();
      });
    }
  </script>
<?php $scripts_content = ob_get_clean(); ?>

<?php require_once( template("base.php") ); ?>

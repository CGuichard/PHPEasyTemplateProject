<?php
/**
 * The sign in modal
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package includes.modals
 * @since 1.0
 *
 */

 /*====================================================*/
?>
  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="modal-login"
    aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
      <div class="modal-content">
        <div class="modal-header light-blue white-text text-center">
          <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input id="form-connec-next" type="text" value="<?php url_for("/home") ?>" hidden>
          <form id='form-connec' action="<?php ajax_for("/connection") ?>" method="POST">
            <div class="md-form form-md">
              <i class="fas fa-user prefix"></i>
              <input name="userlogin" type="text" maxlength="40" id="defaultForm-login" class="form-control form-control-md validate" required>
              <label data-error="wrong" data-success="right" for="defaultForm-login">Your login</label>
            </div>
            <div class="md-form form-md">
              <i class="fas fa-lock prefix"></i>
              <input name="userpassword" type="password" maxlength="25" id="defaultForm-pass" class="form-control form-control-md validate" required>
              <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
            </div>
            <div id="alert-connec" class="alert rounded text-center" role="alert">
              <h5 id="alert-connec-title" class="alert-heading"></h5>
              <hr>
              <p id="alert-connec-msg" class="mb-0"></p>
            </div>
            <div class="d-flex justify-content-center">
              <button id="btnlogin" class="btn btn-outline-info btn-rounded" type="submit">Login</button>
            </div>
          </form>
        </div>
        <div class='modal-footer mx-5 pt-3 mb-1'>
          <p class='font-small grey-text d-flex justify-content-end'>Want to sign up?<a href='<?php url_for("/sign-up") ?>' class='blue-text ml-1'>Register here</a></p>
        </div>
      </div>
    </div>
  </div>

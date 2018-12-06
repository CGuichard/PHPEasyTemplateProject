<?php
/**
 * The connect modal (only showed in the first page wisited after connection)
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
  <div class="modal fade right" id="modal-connection-success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Connected</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body">
          <div class="text-center">
            <i class="far fa-smile fa-4x animated rotateIn text-info"></i>
            <p class="mt-2">Welcome <?php display($CURRENT_USER->get_login()) ?> </p>
          </div>
        </div>
        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Thanks</a>
        </div>
        <!--/.Content-->
      </div>
    </div>
  </div>

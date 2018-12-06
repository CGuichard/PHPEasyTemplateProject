/**
 * @file phpeasytemplate-profile.js
 * This file contain javascript functions needed to the profile page
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 *
 * @requires jquery-3.0.0 or up
 * @requires bootstrap-4.0.0 or up
 * @requires mdb-free-4.0.0 or up (mdb-pro-4.0.0 is also good)
 *
 * @see {@link https://jquery.com/|JQuery 3}
 * @see {@link https://getbootstrap.com/|Bootstrap 4}
 * @see {@link https://mdbootstrap.com/|Material Design for Bootstrap 4}
 * @see {@link https://fontawesome.com/|Font Awesome}
 *
 */

/* ==================== PROFILE SCRIPT OF PHPEASYTEMPLATE =================== */

/*
 * Variable to store the mail
 *
 * @global
 *
 * @var
 *
 */
let mail;

/*
 * Variable to store the first name
 *
 * @global
 *
 * @var
 *
 */
let fname;

/*
 * Variable to store the name
 *
 * @global
 *
 * @var
 *
 */
let name;

/**
 * This function is called to unlock the form (in order to modify the profile)
 *
 * @since 1.0
 *
 * @global
 *
 * @function modify
 *
 * @return {void}
 *
 */
function modify() {
  $("#fieldset-form-profile").prop('disabled', false);
  $(".passwords-div").prop('hidden', false);
  for (div of $(".passwords-div input")) $(div).val(null);
  $("#profile-btn1").hide();
  $("#profile-btn2").show();
  $("#profile-btn3").show();
}

/**
 * This function is called to undo the profile modification
 *
 * @since 1.0
 *
 * @global
 *
 * @function undo
 *
 * @return {void}
 *
 */
function undo() {
  $("#fieldset-form-profile").prop('disabled', true);
  $(".passwords-div").prop('hidden', true);
  $("#alert-profile").prop('hidden', true);
  $("#profile-btn2").hide();
  $("#profile-btn3").hide();
  $("#profile-btn1").show();
}

/**
 * This function is called to initialize the buttons click event
 *
 * @since 1.0
 *
 * @global
 *
 * @function undo
 *
 * @return {void}
 *
 */
function init() {
  $("#profile-btn2").hide();
  $("#profile-btn3").hide();
  $("#profile-btn1").click(function () {
    mail = $("#form-mail").val();
    fname = $("#form-fname").val();
    name = $("#form-name").val();
    modify();
  });
  $("#profile-btn2").click(function () {
    $("#form-mail").val(mail);
    $("#form-fname").val(fname);
    $("#form-name").val(name);
    undo();
  });
}

init(); // Init the buttons click event

/* Send an AJAX request when form-profile is submit */
$("#form-profile").submit(function(event){
  event.preventDefault();
  $("#alert-profile").prop('hidden', true);
  $("#profile-btn2").prop('disabled', true);
  const formData = $("#form-profile").serialize();
  const btncontent = $("#profile-btn3").html();
  $("#profile-btn3").html("<i class='fas fa-spinner fa-lg fa-pulse'></i>");
  $.ajax({
    type: 'POST',
    url: $("#form-profile").attr('action'),
    data: formData,
    dataType: 'JSON',
    success: function(rep) {
      if (rep["success"] == 200) {
        window.location.href = "";
      } else {
        if(rep["success"] == 500) {
          if($("#alert-profile").hasClass("alert-success"))
            $("#alert-profile").removeClass("alert-success");
          if($("#alert-profile").hasClass("alert-warning"))
            $("#alert-profile").removeClass("alert-warning");
          if(!$("#alert-profile").hasClass("alert-danger"))
            $("#alert-profile").addClass("alert-danger");
        } else if(rep["success"] == 404) {
          if($("#alert-profile").hasClass("alert-success"))
            $("#alert-profile").removeClass("alert-success");
          if($("#alert-profile").hasClass("alert-danger"))
            $("#alert-profile").removeClass("alert-danger");
          if(!$("#alert-profile").hasClass("alert-warning"))
            $("#alert-profile").addClass("alert-warning");
        }
        $("#alert-profile-title").text(rep["title"]);
        $("#alert-profile-msg").text(rep["response"]);
        $("#alert-profile").prop('hidden', false);
        $("#profile-btn3").html(btncontent);
        $("#profile-btn2").prop('disabled', false);
      }
    },
    error: function(req, status, err) {
      if($("#alert-profile").hasClass("alert-warning"))
        $("#alert-profile").removeClass("alert-warning");
      if(!$("#alert-profile").hasClass("alert-danger"))
        $("#alert-profile").addClass("alert-danger");
      $("#alert-profile-title").text("ERROR");
      if(err == "") err = "Cannot connect to the server"
      $("#alert-profile-msg").text(err);
      $("#alert-profile").prop('hidden', false);
      $("#profile-btn3").html(btncontent);
      $("#profile-btn2").prop('disabled', false);
    }
  });
});

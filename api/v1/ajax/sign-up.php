<?php
/**
 * Page visited by AJAX request to sign up, to register
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package api.v1.ajax
 * @since 1.0
 *
 */

 /*====================================================*/

  PHPEasyTemplate::lock_unlog();

  $REP = array("success" => 404, "title" => "Register error", "response" => "One of the fields is incorrect");
  $db_pdo = get_sqlite_db_pdo("db.sqlite3");
  if($db_pdo == NULL) {
    // If cannot connect to Database
    $REP["success"] = 500;
    $REP["title"] = "Internal server error";
    $REP["response"] = "An error occured on the server side. Please retry later.";
  } else {
    if(isset($_REQUEST)) {
      if(isset($_REQUEST["login"]) AND isset($_REQUEST["mail"])
      AND isset($_REQUEST["fname"]) AND isset($_REQUEST["name"])
      AND isset($_REQUEST["password"]) AND isset($_REQUEST["confirm-password"])) {
        $login = htmlspecialchars($_REQUEST["login"]);
        $mail = htmlspecialchars($_REQUEST["mail"]);
        $fname = htmlspecialchars($_REQUEST["fname"]);
        $name = htmlspecialchars($_REQUEST["name"]);
        $password = htmlspecialchars($_REQUEST["password"]);
        $confirm_password = htmlspecialchars($_REQUEST["confirm-password"]);
        if($password != $confirm_password) {
          $REP["title"] = "Wrong confirmation";
          $REP["response"] = "The password confirmation given is wrong";
        } else {
          if(strlen($login) > 40) {
            $REP["title"] = "Maximum size exceeded";
            $REP["response"] = "Login too long";
          } elseif (strlen($mail) > 254) {
            $REP["title"] = "Maximum size exceeded";
            $REP["response"] = "Mail too long";
          } elseif (strlen($fname) > 40) {
            $REP["title"] = "Maximum size exceeded";
            $REP["response"] = "First name too long";
          } elseif (strlen($name) > 40) {
            $REP["title"] = "Maximum size exceeded";
            $REP["response"] = "Name too long";
          } elseif (strlen($password) > 25) {
            $REP["title"] = "Maximum size exceeded";
            $REP["response"] = "Password too long";
          } elseif (!preg_match("/^[a-zA-Z0-9-_]*$/", $login)) {
            $REP["title"] = "Login incorrect";
            $REP["response"] = "Some characters in the login given are not alowed";
          } else {
            require_once("api/v1/controlers/ctrl-user.inc.php");
            $user = register_user($db_pdo, $login, $mail, $fname, $name, $password);
            if($user != NULL) {
              unset($REP["title"]);
              unset($REP["response"]);
              $REP["success"] = 200;
              $_SESSION["USER"] = $user->to_array();
            } else {
              $REP["title"] = "Login already taken";
              $REP["response"] = "The login given already exists";
            }
          }
        }
      }
    }
  }
  $JSON_REP = json_encode($REP);
  echo $JSON_REP;
  
?>

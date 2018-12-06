<?php
/**
 * Page visited by AJAX request to modify a profile
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

  PHPEasyTemplate::lock_log();

  $REP = array("success" => 404, "title" => "Login error", "response" => "Invalid login or password");
  $db_pdo = get_sqlite_db_pdo("db.sqlite3");
  if($db_pdo == NULL) {
    // If cannot connect to Database
    $REP["success"] = 500;
    $REP["title"] = "Internal server error";
    $REP["response"] = "An error occured on the server side. Please retry later.";
  } else {
    if(isset($_REQUEST) AND isset($CURRENT_USER)) {
      if(isset($_REQUEST["mail"]) AND isset($_REQUEST["fname"])
      AND isset($_REQUEST["name"]) AND isset($_REQUEST["password"])) {
        require_once("api/v1/controlers/ctrl-user.inc.php");
        $mail = htmlspecialchars($_REQUEST["mail"]);
        $fname = htmlspecialchars($_REQUEST["fname"]);
        $name = htmlspecialchars($_REQUEST["name"]);
        $password = hash("sha512", (htmlspecialchars($_REQUEST["password"])));
        if($password === $CURRENT_USER->get_passw()) {
          $CURRENT_USER->set_mail($mail);
          $CURRENT_USER->set_fname($fname);
          $CURRENT_USER->set_name($name);
          if(isset($_REQUEST["new-password"]) AND isset($_REQUEST["confirm-password"])
          AND strlen($_REQUEST["new-password"]) > 0 AND strlen($_REQUEST["confirm-password"]) > 0
          AND $_REQUEST["new-password"] == $_REQUEST["confirm-password"] ) {
            $new_passw = htmlspecialchars($_REQUEST["new-password"]);
            $CURRENT_USER->set_passw($new_passw);
          }
          if(update_user($db_pdo, $CURRENT_USER)) {
            unset($REP["title"]);
            unset($REP["response"]);
            $REP["success"] = 200;
            $CURRENT_USER->save_in_session();
          }
        } else {
          $REP["title"] = "Wrong password";
          $REP["response"] = "The password given is wrong, modification of the profile canceled";
        }
      } else {
        $REP["title"] = "Wrong request";
        $REP["response"] = "Some of the needed input are absents";
      }
    }
  }
  $JSON_REP = json_encode($REP);
  echo $JSON_REP;

?>

<?php
/**
 * Page visited by AJAX request to attempt a connection
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

  $REP = array("success" => 404, "title" => "Login error", "response" => "Invalid login or password");
  $db_pdo = get_sqlite_db_pdo("db.sqlite3");
  if($db_pdo == NULL) {
    // If cannot connect to Database
    $REP["success"] = 500;
    $REP["title"] = "Internal server error";
    $REP["response"] = "An error occured on the server side. Please retry later.";
  } else {
    if(isset($_REQUEST)) {
      if(isset($_REQUEST["userlogin"]) AND isset($_REQUEST["userpassword"])
      AND strlen($_REQUEST["userlogin"]) > 0 AND strlen($_REQUEST["userpassword"]) > 0) {
        require_once("api/v1/controlers/ctrl-user.inc.php");
        $user = get_user($db_pdo, $_REQUEST["userlogin"], $_REQUEST["userpassword"]);
        if($user != NULL) {
          unset($REP["title"]);
          unset($REP["response"]);
          $REP["success"] = 200;
          $user->save_in_session();
        }
      }
    }
  }
  $JSON_REP = json_encode($REP);
  echo $JSON_REP;

?>

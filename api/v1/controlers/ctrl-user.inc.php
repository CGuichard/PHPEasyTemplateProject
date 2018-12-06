<?php
/**
 * Controlers functions of the class User
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package api.v1.controlers
 * @since 1.0
 *
 */

 /*====================================================*/

  /* Load the class User */
  require_once("api/v1/models/User.class.php");

  /**
   * This function returns the user from the database
   *
   * Return the user from the database if the login and the password are
   * good, else NULL.
   *
   * @param PDO $db_pdo The database PDO object
   * @param string $user_login The user login
   * @param string $user_passw The user password
   *
   * @return User the user get in the database (else NULL)
   */
  function get_user($db_pdo, $user_login, $user_passw) {
    $user_login = htmlspecialchars($user_login);
    $user_passw = htmlspecialchars($user_passw);
    $user_passw = hash("sha512", $user_passw);
    $stmt = $db_pdo->prepare("SELECT * FROM T_USER_US WHERE US_LOGIN=:LOGIN AND US_PASSW=:PASSW");
    $stmt->bindParam(":LOGIN", $user_login);
    $stmt->bindParam(":PASSW", $user_passw);
    $stmt->execute();
    $rep = $stmt->fetch();
    if($rep != NULL) {
      $user = User::from_array($rep);
      return $user;
    }
    return NULL;
  }

  /**
   * This function register a new user
   *
   * @param PDO $db_pdo The database PDO object
   * @param string $login Login of the future user
   * @param string $mail Mail address of the future user
   * @param string $fname First name of the future user
   * @param string $name Name of the future user
   * @param string $password Password of the future user
   *
   * @return User The user if he registered successfully (else NULL)
   */
  function register_user($db_pdo, $login, $mail, $fname, $name, $password){
    try {
      $register = $db_pdo->prepare(
        "INSERT INTO T_USER_US(US_LOGIN, US_SEQ, US_MAIL, US_FNAME, US_NAME, US_PASSW)
        VALUES (:LOGIN, :SEQ, :MAIL, :FNAME, :NAME, :PASSW);");
      $passw = hash("sha512", $password);
      $seq = hash("MD5", $login);
      $seq = substr($seq, 0, 4).substr($seq, strlen($seq)-4, strlen($seq));
      $register->bindParam(":LOGIN", $login);
      $register->bindParam(":SEQ", $seq);
      $register->bindParam(":MAIL", $mail);
      $register->bindParam(":FNAME", $fname);
      $register->bindParam(":NAME", $name);
      $register->bindParam(":PASSW", $passw);
      $register->execute();
      $stmt = $db_pdo->prepare("SELECT * FROM T_USER_US WHERE US_LOGIN=:LOGIN");
      $stmt->bindParam(":LOGIN", $login);
      $stmt->execute();
      $rep = $stmt->fetch();
      if($rep != NULL AND isset($rep["US_ID"])) {
        $id = intval($rep["US_ID"]);
        return new User($id, $login, $seq, $mail, $fname, $name, $passw);
      }
    } catch(Exception $e) {
      return NULL;
    }
    return NULL;
  }

  /**
   * This function updates the actual user
   *
   * @param PDO $db_pdo The database PDO object
   * @param User $user User to update
   *
   * @return boolean True if update succeeded, else False
   */
  function update_user($db_pdo, $user) {
    if($db_pdo == NULL || $user == NULL) return false;
    if($user->is_changed()) {
      try {
        $update = $db_pdo->prepare(
          "UPDATE T_USER_US
          SET US_MAIL=:MAIL, US_FNAME=:FNAME, US_NAME=:NAME, US_PASSW=:PASSW
          WHERE US_ID=:ID AND US_LOGIN=:LOGIN;");
        $mail = $user->get_mail();
        $fname = $user->get_fname();
        $name = $user->get_name();
        $passw = $user->get_passw();
        $id = $user->get_id();
        $login = $user->get_login();
        $update->bindParam(":MAIL", $mail);
        $update->bindParam(":FNAME", $fname);
        $update->bindParam(":NAME", $name);
        $update->bindParam(":PASSW", $passw);
        $update->bindParam(":ID", $id);
        $update->bindParam(":LOGIN", $login);
        $update->execute();
        $user->set_up_to_date();
        return true;
      } catch(Exception $e) {
        return false;
      }
    }
  }

?>

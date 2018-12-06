<?php
/**
 * File defining functions linked to the database management
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package api.v1.PHPEasyTemplate
 * @since 1.0
 *
 */

 /*====================================================*/

  /**
   * This function returns the database PDO of an sqlite file
   *
   * @param string $file Path of the file
   *
   * @return PDO The PDO object
   */
  function get_sqlite_db_pdo($file) {
    try{
      if(file_exists($file)) {
        $db_pdo = new PDO('sqlite:'.$file);
        $db_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
        return $db_pdo;
      }
      return NULL;
    } catch(Exception $e) {
      return NULL;
    }
  }

  /**
   * This function manages the initialization of the database
   *
   * This function check if the database sqlite file exists, if not it create
   * it and initialize it.
   *
   * @param string $file Path of the file
   *
   * @return boolean True if the database exists, else False
   */
  function manage_db($file) {
    if(!file_exists("static/scripts/sql/db.sql")) return false;
    if(!file_exists($file)) {
      try{
        $db_pdo = new PDO('sqlite:'.$file);
        $db_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = file_get_contents("static/scripts/sql/db.sql");
        $db_pdo->exec($req);
        $init_db = $db_pdo->prepare(
          "INSERT INTO T_USER_US(US_LOGIN, US_SEQ, US_MAIL, US_FNAME, US_NAME, US_PASSW)
          VALUES ('PHPEasyTemplate', :SEQ, 'phpeasytemplate@localhost', 'PHP', 'EasyTemplate', :PASSW);");
        $passw = hash("sha512", "mypassword");
        $hash = hash("MD5", "PHPEasyTemplate");
        $hash = substr($hash, 0, 4).substr($hash, strlen($hash)-4, strlen($hash));
        $init_db->bindParam(":PASSW", $passw);
        $init_db->bindParam(":SEQ", $hash);
        $init_db->execute();
      } catch(Exception $e) {
        return false;
      }
    }
    return true;
  }
  
?>

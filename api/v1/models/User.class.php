<?php
/**
 * File defining the User class
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package api.v1.models
 * @since 1.0
 *
 */

 /*====================================================*/

  /**
   * The class User that represent people registered to the website
   *
   * @package api.v1.models
   * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
   * @version 1.0
   * @since 1.0
   * @access public
   */
  class User {

    /**
     * @var string $US_ID User id
     * @access private
     */
    private $US_ID;

    /**
     * @var string $US_LOGIN User login
     * @access private
     */
    private $US_LOGIN;

    /**
     * @var string $US_SEQ User sequence
     * @access private
     */
    private $US_SEQ;

    /**
     * @var string $US_MAIL User mail
     * @access private
     */
    private $US_MAIL;

    /**
     * @var string $US_FNAME User first name
     * @access private
     */
    private $US_FNAME;

    /**
     * @var string $US_NAME User name
     * @access private
     */
    private $US_NAME;

    /**
     * @var string $US_PASSW User password
     * @access private
     */
    private $US_PASSW;

    /**
     * @var string $US_ID User changing boolean (tell if the user
     *                    has been modified)
     * @access private
     */
    private $HAS_BEEN_CHANGED;

    /**
     * Constructor of User
     *
     * @param integer $id Id of the user
     * @param string $login Login of the user
     * @param string $seq Sequence of the user
     * @param string $mail Mail of the user
     * @param string $fname First name of the user
     * @param string $name Name of the user
     * @param string $passw Password of the user
     * @param boolean $changed (default false) Tell if the user is
     *                         up-to-date with the database
     *
     * @return void
     * @access public
     */
    public function __construct($id, $login, $seq, $mail, $fname, $name, $passw, $changed=false) {
      $this->US_ID = $id;
      $this->US_LOGIN = $login;
      $this->US_SEQ = $seq;
      $this->US_MAIL = $mail;
      $this->US_FNAME = $fname;
      $this->US_NAME = $name;
      $this->US_PASSW = $passw;
      $this->HAS_BEEN_CHANGED = $changed;
    }

    /**
     * Getter of US_ID
     *
     * @return integer US_ID, member of User class
     * @access public
     */
    public function get_id() {
      return $this->US_ID ;
    }

    /**
     * Getter of US_LOGIN
     *
     * @return string US_LOGIN, member of User class
     * @access public
     */
    public function get_login() {
      return $this->US_LOGIN ;
    }

    /**
     * Getter of US_SEQ
     *
     * @return string US_SEQ, member of User class
     * @access public
     */
    public function get_seq() {
      return $this->US_SEQ ;
    }

    /**
     * Getter of US_MAIL
     *
     * @return string US_MAIL, member of User class
     * @access public
     */
    public function get_mail() {
      return $this->US_MAIL ;
    }

    /**
     * Getter of US_FNAME
     *
     * @return string US_FNAME, member of User class
     * @access public
     */
    public function get_fname() {
      return $this->US_FNAME ;
    }

    /**
     * Getter of US_NAME
     *
     * @return string US_NAME, member of User class
     * @access public
     */
    public function get_name() {
      return $this->US_NAME ;
    }

    /**
     * Getter of US_PASSW
     *
     * @return string US_PASSW, member of User class
     * @access public
     */
    public function get_passw() {
      return $this->US_PASSW ;
    }

    /**
     * Getter of HAS_BEEN_CHANGED
     *
     * @return boolean HAS_BEEN_CHANGED, member of User class
     * @access public
     */
    public function is_changed() {
      return $this->HAS_BEEN_CHANGED;
    }

    /**
     * Setter of US_MAIL
     *
     * @return void
     * @access public
     */
    public function set_mail($mail) {
      $this->HAS_BEEN_CHANGED = true;
      $this->US_MAIL = $mail;
    }

    /**
     * Setter of US_FNAME
     *
     * @return void
     * @access public
     */
    public function set_fname($fname) {
      $this->HAS_BEEN_CHANGED = true;
      $this->US_FNAME = $fname;
    }

    /**
     * Setter of US_NAME
     *
     * @return void
     * @access public
     */
    public function set_name($name) {
      $this->HAS_BEEN_CHANGED = true;
      $this->US_NAME = $name;
    }

    /**
     * Setter of US_PASSW
     *
     * @return void
     * @access public
     */
    public function set_passw($passw) {
      $this->HAS_BEEN_CHANGED = true;
      $this->US_PASSW = hash("sha512", $passw);
    }

    /**
     * Set HAS_BEEN_CHANGED to true
     *
     * @return void
     * @access public
     */
    public function set_up_to_date() {
      $this->HAS_BEEN_CHANGED = false;
    }

    /**
     * Saves all members of the user $this in an array
     *
     * @return array The user in it array form
     * @access public
     */
    public function to_array() {
      return array(
        "US_ID" => $this->US_ID,
        "US_LOGIN" => $this->US_LOGIN,
        "US_SEQ" => $this->US_SEQ,
        "US_MAIL" => $this->US_MAIL,
        "US_FNAME" => $this->US_FNAME,
        "US_NAME" => $this->US_NAME,
        "US_PASSW" => $this->US_PASSW,
        "HAS_BEEN_CHANGED" => $this->HAS_BEEN_CHANGED
      );
    }

    /**
     * Saves the array representation of $this in the Session as "USER"
     *
     * @return void
     * @access public
     */
    public function save_in_session() {
      if(isset($_SESSION)) {
        $_SESSION["USER"] = $this->to_array();
      }
    }

    /**
     * Returns the user object corresponding to an array representation of a User
     *
     * @return User The user extract from the array
     * @access public
     * @static
     */
    public static function from_array($user_array) {
      if(isset($user_array) AND $user_array != NULL) {
        if(isset($user_array['US_ID']) AND isset($user_array['US_LOGIN'])
        AND isset($user_array['US_SEQ']) AND isset($user_array['US_FNAME'])
        AND isset($user_array['US_NAME']) AND isset($user_array['US_PASSW'])
        AND isset($user_array['US_MAIL'])) {
          if(isset($user_array['HAS_BEEN_CHANGED'])) {
            return new User(
              $user_array['US_ID'],
              $user_array['US_LOGIN'],
              $user_array['US_SEQ'],
              $user_array['US_MAIL'],
              $user_array['US_FNAME'],
              $user_array['US_NAME'],
              $user_array['US_PASSW'],
              $user_array['HAS_BEEN_CHANGED']
            );
          } else {
            return new User(
              $user_array['US_ID'],
              $user_array['US_LOGIN'],
              $user_array['US_SEQ'],
              $user_array['US_MAIL'],
              $user_array['US_FNAME'],
              $user_array['US_NAME'],
              $user_array['US_PASSW']
            );
          }
        } else {
          return NULL;
        }
      } else {
        return NULL;
      }
    }

    /**
     * Displays the user $this
     *
     * @return void
     * @access public
     */
    public function display() {
      echo "<div class='text-justify'><[User] | ";
      echo "ID=".$this->get_id()." ; ";
      echo "MAIL=".$this->get_mail()." ; ";
      echo "FNAME=".$this->get_fname()." ; ";
      echo "NAME=".$this->get_name()."";
      echo " ></div></br>";
    }

  }

?>

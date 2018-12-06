<?php
/**
 * File defining the PHPEasyTemplate class
 *
 * This file contain the PHPEasyTemplate class, the core of this project.
 * The class PHPEasyTemplate handle all of the route/template system of the
 * project and is absolutely needed.
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
  * The class PHPEasyTemplate, used to manage the project core
  *
  * The class PHPEasyTemplate is extremely important. This class process some
  * important information, like the website url (if you are not at the root of
  * your ip address, something like http://x.x.x.x/folder/folder2/website_folder)
  * or the full url simply, or the current url (like /home) in the website.
  * It also extract routes of the website from a route file, that define a route
  * and its corresponding template.
  * In addition, the template is loaded thank to a function and in the called
  * template some variables and functions are defined to help you in your page
  * generation and management, such as the current user, or the template parameters
  * obtained from the url route.
  *
  *
  * @package api.v1.models
  * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
  * @version 1.0
  * @since 1.0
  * @access public
  */
  class PHPEasyTemplate {

    /**
     * @var string $full_url The full url of the website
     * @access private
     */
    private $full_url;

    /**
     * @var string $website_url The website url
     * @access private
     */
    private $website_url;

    /**
     * @var string $current_url The current url in the website
     * @access private
     */
    private $current_url;

    /**
     * @var array $routes The website list of routes and templates associated
     * @access private
     */
    private $routes;

    /**
     * @var array $template Define a template, its type (page/ajax), template
     *                      path, and the template parameters
     * @access private
     */
    private $template;

    /**
     * @var boolean $cache Tell if some datas can be saved in the session
     * @access private
     */
    private $cache;

    /**
     * @var string $loaded Tell if the template has been loaded
     * @access private
     */
    private $loaded;

    /**
     * Constructor of PHPEasyTemplate
     *
     * @param string $route_file (default "routes.inf") The file containing the
     *                           routes of the website with their templates
     * @param boolean $cache (default true) Tell if some datas will be saved
     *                       in the session
     *
     * @return void
     * @access public
     */
    public function __construct($route_file="routes.inf", $cache=true) {
      $this->full_url = self::calculate_full_url();
      $this->website_url = ($this->cache AND isset($_SESSION["WEBSITE_URL"])) ? $_SESSION["WEBSITE_URL"] : self::calculate_website_url();
      $this->current_url = self::calculate_current_url($this->full_url, $this->website_url);
      $this->routes = ($this->cache AND isset($_SESSION["ROUTES"])) ? $_SESSION["ROUTES"] : self::calculate_routes_from($route_file);
      $this->template = $this->calculate_template();
      $this->cache = $cache;
      if($this->cache) {
        if(!isset($_SESSION["WEBSITE_URL"]))
          $_SESSION["WEBSITE_URL"] = $this->get_website_url();
        if(!isset($_SESSION["ROUTES"]))
          $_SESSION["ROUTES"] = $this->get_routes();
      }
      $this->loaded = false;
    }

    /**
     * Getter of full_url
     *
     * @return string full_url, member of PHPEasyTemplate class
     * @access public
     */
    public function get_full_url() {
      return $this->full_url;
    }

    /**
     * Getter of website_url
     *
     * @return string website_url, member of PHPEasyTemplate class
     * @access public
     */
    public function get_website_url() {
      return $this->website_url;
    }

    /**
     * Getter of current_url
     *
     * @return string current_url, member of PHPEasyTemplate class
     * @access public
     */
    public function get_current_url() {
      return $this->current_url;
    }

    /**
     * Getter of routes
     *
     * @return array routes, member of PHPEasyTemplate class
     * @access public
     */
    public function get_routes() {
      return $this->routes;
    }

    /**
     * Getter of template
     *
     * @return array template, member of PHPEasyTemplate class
     * @access public
     */
    public function get_php_template() {
      return $this->template;
    }

    /**
     * This function load the template
     *
     * @return void
     * @access public
     */
    public function load() {
      if(file_exists("conf.inc.php")) {
        require_once("conf.inc.php");
      } else {
        exit("ERROR: Configuration file 'conf.inc.php' does not exist at the root of the website.");
      }
      $GLOBALS['PHP_EASY_TEMPLATE'] = $this;
      $GLOBALS['FULL_URL'] = $this->get_full_url();
      $GLOBALS['WEBSITE_URL'] = $this->get_website_url();
      $GLOBALS['CURRENT_URL'] = $this->get_current_url();
      $GLOBALS['PHP_TEMPLATE'] = $this->get_php_template();
      if(isset($_SESSION["USER"])) {
        require_once("api/v1/models/User.class.php");
        $GLOBALS["CURRENT_USER"] = User::from_array($_SESSION["USER"]);
      } else {
        $GLOBALS["CURRENT_USER"] = NULL;
      }
      if(!isset($_SESSION["ALREADY_CONNECTED"])) {
        $_SESSION["ALREADY_CONNECTED"] = false;
      }
      global $PHP_EASY_TEMPLATE, $FULL_URL, $WEBSITE_URL, $CURRENT_URL, $PHP_TEMPLATE, $CURRENT_USER;
      $this->loaded = true;
      require_once($PHP_TEMPLATE["template"]);
    }

    /**
     * Displays the object PHPEasyTemplate $this
     *
     * @return void
     * @access public
     */
    public function display() {
      echo "<div class='text-justify'><[PHPEasyTemplate]><div style='margin-left:20px;'>";
      echo "CACHE: ".(($this->cache)?"TRUE":"FALSE")."</br>";
      echo "FULL_URL: ".$this->full_url."</br>";
      echo "WEBSITE_URL: ".$this->website_url."</br>";
      echo "CURRENT_URL: ".$this->current_url."</br>";
      echo "ROUTES: ";
      print_r($this->routes);
      echo "</br>";
      echo "TEMPLATE: ";
      print_r($this->template);
      echo "</br>";
      echo "</div><\[PHPEasyTemplate]></div></br>";
    }

    /**
     * Return an url after correcting it with the good format
     *
     * @return string The url corrected with the format used by url-type functions
     * @access public
     * @static
     */
    public static function correct_url($url){
      if (strlen($url) == 0) {
        $url = "/";
      } else {
        if($url[0] != "/") {
          $url = "/".$url;
        }
        if($url[strlen($url)-1] != "/") {
          $url = $url."/";
        }
      }
      return $url;
    }

    /**
     * Return the full url of the website
     *
     * @return string The full url
     * @access public
     * @static
     */
    public static function calculate_full_url() {
      $full_url = $_SERVER['REQUEST_URI'];
      return self::correct_url($full_url);
    }

    /**
     * Return the url of the website
     *
     * @return string The website url
     * @access public
     * @static
     */
    public static function calculate_website_url() {
      $tab_url = explode('/', $_SERVER["SCRIPT_NAME"]);
      $website_php_file = $tab_url[substr_count($_SERVER["SCRIPT_NAME"], '/')];
      $website_url = str_replace($website_php_file, '', $_SERVER["SCRIPT_NAME"]);
      return self::correct_url($website_url);
    }

    /**
     * Return the current url in the website
     *
     * @param string $full_url (default '') The full url of the website
     * @param string $website_url (default '') The website url
     *
     * @return string The current url
     * @access public
     * @static
     */
    public static function calculate_current_url($full_url='', $website_url='') {
      if($full_url === '') {
        $full_url = self::calculate_full_url();
      }
      if($website_url === '') {
        $website_url = self::calculate_website_url();
      }
      if($website_url !== "/") {
        $current_url = str_replace($website_url, '', $full_url);
      } else {
        $current_url = $full_url;
      }
      return self::correct_url($current_url);
    }

    /**
     * Return the routes from a given file
     *
     * @param string $file The file path
     *
     * @return array The routes
     * @access public
     * @static
     */
    public static function calculate_routes_from($file) {
      if(file_exists($file)) {
        $routes = array();
        $state = "";
        $fileR = fopen($file, 'r');
        while(!feof($fileR)) {
          $line = fgets($fileR);
          if(strpos($line, "#ROUTES") !== false) {
            $state = "route";
            $routes[$state] = array();
          } elseif (strpos($line, "#AJAX") !== false) {
            $state = "ajax";
            $routes[$state] = array();
          } elseif(strlen($line) != 0 AND $state != "") {
            $split = explode(" @", $line);
            if(count($split) == 2) {
              if($state === "ajax") {
                $routes[$state]["/ajax".$split[0]] = $split[1];
              } else {
                $routes[$state][$split[0]] = $split[1];
              }
            } elseif(count($split) == 1) {
              exit("ERROR: Please check that every route is separated from its template with a space, and that the template have its @. In addition, check that there is no empty line.");
            }
          }
        }
        fclose($fileR);
        return $routes;
      } else {
        exit("ERROR: Routes file \"".$file."\" doesn't exist.");
      }
    }

    /**
     * Return the template after processing it using the routes
     *
     * @return array The template
     * @access public
     */
    public function calculate_template() {
      $result = array(
        "type" => "page",
        "template" => "templates/errors/404.php",
        "parameters" => NULL,
      );
      foreach ($this->routes["route"] as $route => $template) {
        if(self::matching_urls($this->current_url, $route)) {
          $result["template"] = "templates/pages/".trim($template);
          $result["parameters"] = self::get_parameters_from_url($this->current_url, $route);
          return $result;
        }
      }
      foreach ($this->routes["ajax"] as $route => $template) {
        if(self::matching_urls($this->current_url, $route)) {
          $result["type"] = "ajax";
          $result["template"] = "api/".trim($template);
          $result["parameters"] = self::get_parameters_from_url($this->current_url, $route);
          return $result;
        }
      }
      return $result;
    }

    /**
     * Return if an url match an url route are matching
     *
     * Return if an url match an url route are matching, with url like
     * "/products/page/1" and the url route like "/products/page/[number]"
     *
     * @param string $url The url to check
     * @param string $url_route The url route on witch we test $url
     *
     * @return array The routes
     * @access public
     * @static
     */
    public static function matching_urls($url, $url_route) {
      if ($url_route[strlen($url_route)-1] != "/") {
        $url_route = $url_route."/";
      }
      if ($url_route === $url) {
        return true;
      } else {
        $tab_url_route = explode("/", $url_route);
        $tab_url = explode("/", $url);
        if (count($tab_url_route) != count($tab_url)) {
          return false;
        } else {
          for ($i=0; $i < count($tab_url); $i++) {
            if ($tab_url[$i] != "" AND $tab_url_route[$i] != "") {
              if ($tab_url_route[$i] != $tab_url[$i] AND ($tab_url_route[$i][0] !== "[" OR $tab_url_route[$i][strlen($tab_url_route[$i])-1] !== "]")) {
                return false;
              }
            }
          }
        }
        return true;
      }
    }

    /**
     * Return the parameters of an url
     *
     * @see PHPEasyTemplate::matching_urls
     *
     * @param string $url The url to extract url from
     * @param string $url_route The url route used to evaluate the parameters parts
     *
     * @return array Array of parameters
     * @access public
     * @static
     */
    public static function get_parameters_from_url($url, $url_route) {
      $parameters = array();
      if ($url_route[strlen($url_route)-1] != "/") {
        $url_route = $url_route."/";
      }
      $tab_url_route = explode("/", $url_route);
      $tab_url = explode("/", $url);
      if (count($tab_url_route) != count($tab_url)) {
        return $parameters;
      } else {
        for ($i=0; $i < count($tab_url); $i++) {
          if ($tab_url[$i] != "" AND $tab_url_route[$i] != "") {
            if ($tab_url_route[$i][0] === "[" AND $tab_url_route[$i][strlen($tab_url_route[$i])-1] === "]") {
              $parameters[substr($tab_url_route[$i], 1, strlen($tab_url_route[$i])-2)] = $tab_url[$i];
            }
          }
        }
      }
      return $parameters;
    }

    /**
     * Lock a page only for the users that are connected
     *
     * @return void
     * @access public
     * @static
     */
    public static function lock_log() {
      if(isset($GLOBALS["CURRENT_USER"])) {
        global $CURRENT_USER;
        if($CURRENT_USER == NULL) {
          PHPEasyTemplate::e_403();
        }
      }
    }

    /**
     * Lock a page only for the users that are not connected
     *
     * @return void
     * @access public
     * @static
     */
    public static function lock_unlog() {
      if(isset($GLOBALS["CURRENT_USER"])) {
        global $CURRENT_USER;
        if($CURRENT_USER != NULL) {
          PHPEasyTemplate::e_403();
        }
      }
    }

    /**
     * Displays an http page error for the error code 403
     *
     * @return void
     * @access public
     * @static
     */
    public static function e_403() {
      if(file_exists("templates/errors/403.php"))
        require_once("templates/errors/403.php");
      die();
    }

    /**
     * Generate an http page error for the error code 404
     *
     * @return void
     * @access public
     * @static
     */
    public static function e_404() {
      if(file_exists("templates/errors/404.php"))
        require_once("templates/errors/404.php");
      die();
    }

    /**
     * Generate an http page error for the error code 500
     *
     * @return void
     * @access public
     * @static
     */
    public static function e_500() {
      if(file_exists("templates/errors/500.php"))
        require_once("templates/errors/500.php");
      die();
    }

  }
?>

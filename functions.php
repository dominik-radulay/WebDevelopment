<?php
function getConnection() {
try {
$connection = new PDO("mysql:host=localhost;dbname=unn_w19000898",
  "unn_w19000898", "teK*xf?EfnC3?K7%rWMTX#}h");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $connection;
} catch (Exception $e) {
throw new Exception("Connection error ". $e->getMessage(), 0, $e);
}
}

function validate_logon() {
try {
  /* Retrieve the username and the password from the form*/
  $username = filter_has_var(INPUT_POST, 'username')
  ? $_POST['username']: null;
  $password = filter_has_var(INPUT_POST, 'password')
  ? $_POST['password']: null;
  $username = trim($username);
  $password = trim($password);
  $input = array($username,$password);
  $errors = array();
  if (empty($username) || empty($password)) {
    array_push($errors,"Wrong Username or Password");
    return array($input, $errors);
  }
  else {
    try {
    // Make a database connection
    		$dbConn = getConnection();
    /* Query the users database table to get the password hash for the username entered by the user */
        $querySQL = "SELECT passwordHash FROM NBL_users
        WHERE username = :username";
    // Prepare the sql statement using PDO
        $stmt = $dbConn->prepare($querySQL);
    // Execute the query using PDO
        $stmt->execute(array(':username' => $username));
        /* Check if a record was returned by the query. Otherwise, indicate an error. */
        $user = $stmt->fetchObject();
        if ($user) {
          if(password_verify($password, $user->passwordHash)){
            set_session('logged-in', 'true');
            return array($input, $errors);
          }else {
            array_push($errors,"Wrong Username or Password");
            return array($input, $errors);
          }

        }
        else{
        array_push($errors,"Wrong Username or Password");
        return array($input, $errors);
        }
        } catch (Exception $e) {
              array_push($errors,"'There was a problem: ' . $e->getMessage();");
              return array($input, $errors);
                     }
        }
} catch (Exception $e) {
throw new Exception("Something got wrong ". $e->getMessage(), 0, $e);
}
}

function show_errors($errorsinput) {
  try {
  $errorsresult = implode(",", $errorsinput);
  	return $errorsresult;

  } catch (Exception $e) {
  throw new Exception("Something got wrong   ". $e->getMessage(), 0, $e);
  }
  }

  function set_session($sessionkey, $sessionvalue) {
    try {
       $_SESSION[$sessionkey] = $sessionvalue;
       return true;
    } catch (Exception $e) {
    throw new Exception("Something got wrong   ". $e->getMessage(), 0, $e);
    }
    }

    function get_session($sessionkey) {
      if ( isset ($_SESSION[$sessionkey]))
      {
      try {
         return $_SESSION[$sessionkey];
      } catch (Exception $e) {
      throw new Exception("Something got wrong   ". $e->getMessage(), 0, $e);
      }
      }
      else {
        return false;
      }
      }

    function check_login() {
      try {
         return get_session("logged-in");
      } catch (Exception $e) {
      throw new Exception("Something got wrong   ". $e->getMessage(), 0, $e);
      }
    }

    function logout() {
      try {
        $_SESSION = array();
        session_destroy();
         return;
      } catch (Exception $e) {
      throw new Exception("Something got wrong   ". $e->getMessage(), 0, $e);
      }
    }


    function start_session() {
      try {
        ini_set("session.save_path", "/home/unn_w19000898/sessionData");
        session_start();
         return;
      } catch (Exception $e) {
      throw new Exception("Something got wrong   ". $e->getMessage(), 0, $e);
      }
    }

?>

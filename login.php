<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once("functions.php");
    start_session();

    list($input, $errors) = validate_logon();
    if ($errors) {
      /*
      if there were already errors before,
      this function will clear them,
       so they will not multiply after clicking login multiple times with wrong arguments
       */
      if (strpos($_SERVER['HTTP_REFERER'], '?loginerrors') == true) {
        $urladd = strtok($_SERVER['HTTP_REFERER'], '?');
        $urladd.='?loginerrors='.show_errors($errors);
        header('Location: ' . $urladd);
      }
      else
      {
        $urladd=$_SERVER['HTTP_REFERER'].'?loginerrors='.show_errors($errors);
        header('Location: ' . $urladd);
      }
    }
    else {
    set_session('logged-in', 'true');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

        ?>
  </body>
</html>

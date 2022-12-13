<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php require_once("functions.php");
    start_session();
          logout();
          header('Location: ' . $_SERVER['HTTP_REFERER']);
     ?>
  </body>
</html>

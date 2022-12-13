<div class="picture"></div>
    <div id="nav">
      <a href="index.php" class="navbutton">Home</a>
        <a href="orderBooksForm.php" class="navbutton">Order Books</a>
      <a href="admin.php" class="navbutton">Administration</a>
      <a href="credits.php" class="navbutton">Credits</a>
    </div>
    <div id="log-in">
      <?php
      require_once("functions.php");
      start_session();
      $loginerrors = filter_has_var(INPUT_GET, 'loginerrors') ? $_GET['loginerrors'] : null;
      if (    check_login() == 'true') {

        echo"<a href='logout.php' class='loginbutton'>Logout</a>";
      }
    else {
      echo"
            <form method='post' action='login.php' class='loginform'>
          <label for='username' class='logintext'>Username:</label>
          <input id='username' type='text' name='username' class='loginfield'>
          <label for='password' class='logintext'>Password:</label>
          <input id='password' type='password' name='password' class='loginfield'>

          <input type='submit'  class='loginbutton' value='Logon'>
          </form>
          ";
          if (!empty($loginerrors)) {
  					echo "<p>  $loginerrors</p>\n";
  				}
        }
    ?>

  </div>
<div id="viewbar">
</div>

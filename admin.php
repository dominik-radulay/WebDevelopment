<!doctype html>
<html lang="en-gb">
<meta charset="utf-8">
<link href="style.css" rel="stylesheet" type="text/css">

<title>Northumbia Books Limited</title>


</head>
<body>
<div id="maingrid">
<?php
  include('header.php');

  /*
  if user isnt logged in, the page whill show alert, after which it will refer him back to home page
   */
  if (    check_login() !== 'true') {
    echo "<script>alert('You dont have rights to view this page, please login first!');window.location='index.php';</script>";
}
?>

<!--Header of section -->

<section id="center">
<h2>Administration - Choose a book to edit by cliking at the Title</h2>

<!--create table-->
  <table>
    <tr>
      <th><b>ISBN</b></th>
      <th><b>Title</b></th>
      <th><b>Year</b></th>
      <th><b>Category</b></th>
      <th><b>Price</b></th>
    </tr>
          <?php
          try {
          	require_once("functions.php");
          	// Define connection
          	$dbConn = getConnection();

              // select data from tables
                $sqlQuery = "SELECT bookISBN, bookTitle, bookYear, catDesc, bookPrice
                  FROM NBL_books
                      INNER JOIN NBL_category
                        ON  NBL_category.catID = NBL_books.catID
                    ORDER by bookTitle";
                $queryResult = $dbConn->query($sqlQuery);

                // fetch row returned by the query and display it in the table
                while ($rowObj = $queryResult->fetchObject()) {
                 echo
                    "<tr>
                       <th>{$rowObj->bookISBN}</th>
                       <th><a class='linkstyle' href='editBookForm.php?bookISBN={$rowObj->bookISBN}'>{$rowObj->bookTitle}</a></th>
                       <th>{$rowObj->bookYear}</th>
                       <th>{$rowObj->catDesc}</th>
                       <th>£{$rowObj->bookPrice}</th>
                     </tr> ";
                    }
                  }
                  // If query wasnt inserted sucesfully show what error occurred
            catch (Exception $e){
              echo "<p>Query failed: ".$e->getMessage()."</p>\n";
            }
            ?>

              </table>
      </section>

        <div id="footer"><hr/><p>Site design ©2020 by Dominik Radulay for Northumbia Books Limited
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
</p>
<!--This website was created for academic pourpouses-->
</div>
</div>
</body>
</html>

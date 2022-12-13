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

<!--Start of SQL code -->

      <section id="center">
				<?php
				$bookISBN = filter_has_var(INPUT_POST, 'bookISBN') ? $_POST['bookISBN'] : null;
				$title = filter_has_var(INPUT_POST, 'title') ? $_POST['title'] : null;
				$year = filter_has_var(INPUT_POST, 'year') ? $_POST['year'] : null;
				$category = filter_has_var(INPUT_POST, 'category') ? $_POST['category'] : null;
				$price = filter_has_var(INPUT_POST, 'price') ? $_POST['price'] : null;
				$publisher = filter_has_var(INPUT_POST, 'publisher') ? $_POST['publisher'] : null;
				$title = trim($title);
				$errors = false;


        echo "<h2>Administration - Editing of a book with ISBN $bookISBN</h2>";



				if (empty($bookISBN)) {
					echo "<p>Please <a href='admin.php'>choose</a> a Book.</p>\n";
					$errors = true;
				}
				if (empty($title)) {
					echo "<p>You need to set a title.</p>\n";
					$errors = true;
				}
				if (empty($year)) {
					echo "<p>You need to set a year.</p>\n";
					$errors = true;
				}
				if (empty($category)) {
					echo "<p>You need to choose a category.</p>\n";
					$errors = true;
				}
				if (empty($price)) {
					echo "<p>You need to set a price.</p>\n";
					$errors = true;
				}
				if (empty($publisher)) {
					echo "<p>You need to choose a publisher.</p>\n";
					$errors = true;
				}
				else {
					try {
						require_once("functions.php");
						$dbConn = getConnection();
						$title = $dbConn->quote($title);

						$updateSQL = "UPDATE NBL_books
						SET bookTitle = $title, bookYear = $year, bookPrice = $price, pubID = '$publisher', catID = '$category'
						WHERE bookISBN = '$bookISBN'";
						$dbConn->exec($updateSQL);
						echo "<p>Book updated</p>\n
						<div class='articlebutton'>
						<a href='admin.php' class='goback' >Back to the list of Books</a>
						</div>

						";


					}
					catch (Exception $e){
						echo "<p>Book not updated: ".$e->getMessage()."</p>\n
						<div class='articlebutton'>
						<a href='admin.php' class='goback' >Back to the list of Books</a>
						</div>

						";
					}
				}
				?>

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

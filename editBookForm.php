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

<!--Start of articles section -->

      <section id="center">
				<?php
				$bookISBN = filter_has_var(INPUT_GET, 'bookISBN') ? $_GET['bookISBN'] : null;
        echo "<h2>Administration - Editing of a book with ISBN $bookISBN</h2>";



				if (empty($bookISBN)) {
					echo "<p>Please <a href='admin.php'>choose</a> a Book.</p>\n";
				}
				else {
					try {
						require_once("functions.php");
						$dbConn = getConnection();

						$sqlQuery = "SELECT bookISBN, bookTitle, bookYear, catDesc, bookPrice, pubName, NBL_books.pubID, NBL_books.catID
							FROM NBL_books
							INNER JOIN NBL_category
							ON  NBL_category.catID = NBL_books.catID
							INNER JOIN NBL_publisher
							ON  NBL_publisher.pubID = NBL_books.pubID
							WHERE bookISBN = '$bookISBN'";
						$queryResult = $dbConn->query($sqlQuery);
						$rowObj = $queryResult->fetchObject();

						$sqlQuery = "SELECT * FROM NBL_category";
						$queryResult = $dbConn->query($sqlQuery);
						$catoptions = '';
						while($options = $queryResult->fetchObject()){
							if($rowObj->catID==$options->catID);
								else {
						$catoptions .="<option value=$options->catID>$options->catDesc</option>";
								}
								}

								$sqlQuery = "SELECT * FROM NBL_publisher";
								$queryResult = $dbConn->query($sqlQuery);
								$puboptions = '';
								while($options = $queryResult->fetchObject()){
									if($rowObj->pubID==$options->pubID);
										else {
								$puboptions .="<option value=$options->pubID>$options->pubName</option>";
										}
										}

						echo "
						<form action='editBook.php?' method='post'>
						<input type='hidden' value='$bookISBN' name='bookISBN' />
						<label for='title'>Title:</label>  <br>      <input type='text' name='title' class='inputtitle' id='title' value='{$rowObj->bookTitle}' required><br>
						<label for='year'>Year:</label>  <input type='number' min='0' step='1' name='year' class='input' max='date('Y')'  id='year' value='{$rowObj->bookYear}' required>
						<label for='category'>Category:</label>
	          <select id='category' name='category'  required>
	          <option value='{$rowObj->catID}' selected>{$rowObj->catDesc}</option>
						$catoptions
						</select>
						<label for='price'>Price:</label>     £      <input type='number' name='price' class='input' min='0' step='0.01' id='price' value='{$rowObj->bookPrice}' required>
						<label for='publisher'>Publisher:</label>
						<select id='publisher' name='publisher'  required>
	          <option value='{$rowObj->pubID}' selected>{$rowObj->pubName}</option>
						$puboptions
						</select><br>
						<input type='submit' name='submit' class='inputsubmit' value='Update a Book'>
						</form>
						";
					}
					catch (Exception $e){
						echo "<p>Query failed: ".$e->getMessage()."</p>\n";
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

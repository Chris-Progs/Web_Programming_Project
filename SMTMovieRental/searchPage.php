<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Movies</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:ital,wght@0,400;0,700;1,300&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="container" style="background-color:rgb(211, 211, 211)">
        <header class="row">
            <div class="col-lg-10">
                <h1 class="text-center-col-lg-4">Search Movies</h1>
            </div>
        </header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="searchPage.php">Search Movies</a></li>
                    <li><a href="top10Movies.php">Top 10 Movies</a></li>
                </ul>
            </div>
        </nav>
        <?php require "connect.php";
        /**
         * Footer
         *
         * Main footer file for the theme.
         * PHP version 5.2.0
         * 
         * @category   MyCategory
         * @package    Project_SMTMovieRental
         * @subpackage Mytheme
         * @author     Chris <p255951@tafe.wa.edu.au>
         * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
         * @version    GIT: 1.0.0
         * @link       ****
         * @since      1.0.0
         */
        ?>
    <form id= "form" action='searchPDO.php' method='post'>
        <label>Title: </label> 
        <input type="text" id='title' name='title'><br>
        <label>Rating:</label>
        <select id="rating" name="rating">
            <option value="0">Select Rating</option>
            <?php
            $sql = "SELECT DISTINCT rating FROM movies;";
            $stmt = $conn->query($sql);
            while($row = $stmt->fetch()){
                    echo "<option>$row[rating]</option><br>";
            }
            ?>
        </select><br>
        <label>Genre:</label>
        <select id="genre" name="genre">
            <option value="0">Select Genre</option>
            <?php
            $sql = "SELECT DISTINCT genre FROM movies;";
            $stmt = $conn->query($sql);
            while($row = $stmt->fetch()){
                    echo "<option>$row[genre]</option><br>";
            }
            ?>
        </select><br>
        <label>Year: </label>
        <select id="year" name="year">
            <option value="0">Select Year</option>
            <?php
            $sql = "SELECT DISTINCT year FROM movies;";
            $stmt = $conn->query($sql);
            while($row = $stmt->fetch()){
                    echo "<option>$row[year]</option><br>";
            }
            ?>
        </select><br>
       <input type="submit">
       </div>
    </form>
</body>
</html>
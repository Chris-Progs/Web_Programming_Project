<?php
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
require "connect.php";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Title</th><th>Studio</th><th>Status</th><th>Sound</th><th>Versions</th><th>RRP</th><th>Rating</th><th>Year</th>
<th>Genre</th><th>Aspect<th>Searches</th></tr>";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
} 

$sqlWhere = '';
if (!empty($_POST["title"])) {
    $title = "%" . $_POST["title"] . "%";
    $sqlWhere.= 'title LIKE :title AND ';
}

if (!empty($_POST["rating"])) {
    $rating = $_POST["rating"];
    $sqlWhere.="rating = :rating AND ";
}

if (!empty($_POST["genre"])) {
    $genre = $_POST["genre"];
    $sqlWhere.= 'genre = :genre AND ';
}

if (!empty($_POST["year"])) {
    $year = $_POST["year"];
    $sqlWhere.= 'year = :year AND ';
}

$sqlWhere = rtrim($sqlWhere, " AND ");

try{
    $sql = "SELECT title, studio, status, sound, versions, recretprice, rating, year, genre, aspect, top10 FROM movies WHERE $sqlWhere;";

    //echo $sql . "<br>";
    $stmt = $conn->prepare($sql);
  
    if (!empty($_POST["title"])) {
        $stmt->bindParam(':title', $title);
    }
    if (!empty($_POST["rating"])) {
        $stmt->bindParam(':rating', $rating);
    }
    if (!empty($_POST["genre"])) {
        $stmt->bindParam(':genre', $genre);
    }
    if (!empty($_POST["year"])) {
        $stmt->bindParam(':year', $year);
    }
    
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    
    if (!$result) {
        echo "<p>The search has returned no result, try again.<p>";
    }
    else {
    foreach(new TableRows(new RecursiveArrayIterator($result)) as $k=>$v) 
        {
            echo $v;
        }
    }  
}
catch(PDOException $e)
{
    echo "An error has occured, click the below link and try again.";
}
$conn = null;
echo "</table>";
echo "<p>Click <a href='searchPage.php'>here</a> to go back.<p>";
?>
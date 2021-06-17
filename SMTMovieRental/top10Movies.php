<!DOCTYPE html>
<html lang="en">
<head>
    <title>Top 10 Searched Movies</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:ital,wght@0,400;0,700;1,300&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="container" style="background-color:rgb(211, 211, 211)">
        <header class="row">
            <div class="col-lg-10">
                <h1 class="text-center-col-lg-4">Top 10 Searched Movies</h1>
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

$sql = "SELECT title, (top10 - 4980) FROM movies ORDER BY top10 DESC LIMIT 10;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
/*
 * Chart settings and create image
 */
// Image dimensions
$width = 1150;
$imageHeight = 400;
// Grid dimensions and placement within image
$gridTop = 40;
$gridLeft = 25;
$gridBottom = 340;
$gridRight = 1120;
$gridHeight = $gridBottom - $gridTop;
$gridWidth = $gridRight - $gridLeft;
// Bar and line width
$lineWidth = 2;
$barWidth = 20;
// Font settings
$font = 'C:\Windows\Fonts\Arial.ttf';
$fontSize = 10;
// Margin between label and axis
$labelMargin = 10;
// Max value on y-axis
$yMaxValue = 20;
// Distance between grid lines on y-axis
$yLabelSpan = 2;
// Init image
$chart = imagecreate($width, $imageHeight);
// Setup colors
$backgroundColor = imagecolorallocate($chart, 211, 211, 211);
$axisColor = imagecolorallocate($chart, 85, 85, 85);
$labelColor = $axisColor;
$gridColor = imagecolorallocate($chart, 85, 85, 85);
$barColor = imagecolorallocate($chart, 255, 0, 0);

imagefill($chart, 0, 0, $backgroundColor);
imagesetthickness($chart, $lineWidth);

for($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {
    $y = $gridBottom - $i * $gridHeight / $yMaxValue;
    // draw the line
    imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);
    //draw right aligned label
    $labelBox = imageftbbox($fontSize, 0, $font, strval($i));
    $labelWidth = $labelBox[4] - $labelBox[0];
    $labelX = $gridLeft - $labelWidth - $labelMargin;
    $labelY = $y + $fontSize / 2;
    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i));
} 
/*
 * Draw x- and y-axis
 */
imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);
$barSpacing = $gridWidth / count($result);
$itemX = $gridLeft + $barSpacing / 2;

foreach($result as $key => $value) {
    // Draw the bar
    $x1 = $itemX - $barWidth / 2;
    $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
    $x2 = $itemX + $barWidth / 2;
    $y2 = $gridBottom - 1;

    imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $barColor);
    //Draw the label
    $labelBox = imagettfbbox($fontSize, 0, $font, $key);
    $labelWidth = $labelBox[4] - $labelBox[0];
    $labelX = $itemX - $labelWidth / 2;
    $labelY = $gridBottom + $labelMargin + $fontSize;
    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, $key);
    $itemX += $barSpacing;
}
imagepng($chart, "Top10Chart.png");
echo "<h2>Most Searched Movies</h2>";
echo "<img src='Top10Chart.png'>";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Title</th><th>Number of Searches</th></tr>";
class TableRows extends RecursiveIteratorIterator 
{
    /**
     * Footer
     *
     * Main footer file for the theme.
     * PHP version 5.2.0
     * 
     * $it ($it)
     */
    function __construct($it) 
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }
    function beginChildren() 
    {
        echo "<tr>";
    }
    function endChildren() 
    {
        echo "</tr>" . "\n";
    }
} 
$sql = "SELECT title, (top10 - 4980) FROM movies ORDER BY top10 DESC LIMIT 10;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) 
    {
        echo $v;
    }
    echo "</table>";
?>
        </div>
</body>
</html>
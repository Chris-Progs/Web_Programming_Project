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
$servername = "localhost";
$username = 'root';
$password = '';

try
{
    $conn = new PDO("mysql:host=$servername;dbname=movies_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>
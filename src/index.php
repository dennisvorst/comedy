<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

// https://blog.bobbyallen.me/2013/03/23/using-composer-in-your-own-php-projects-with-your-own-git-packageslibraries/
if ($_SERVER['SERVER_NAME'] == "localhost")
{
    require '../vendor/autoload.php';
} else {
    // production servers
    require_once 'autoload/MysqlDatabase/Log.php';
    require_once 'autoload/MysqlDatabase/MysqlConfig.php';
    require_once 'autoload/MysqlDatabase/MysqlDatabase.php';
}

// init 
$log = new Log("comedy.log");

switch ($_SERVER['SERVER_NAME'])
{
  case "localhost":
    /* localhost */
    $mysqli = new Mysqli("localhost", "root", "", "comedy");
    break;
  case "comedy.dennisvorst.nl":
    throw new exception("Not implemented yet.");
}

try {
  $db = new MysqlDatabase($mysqli, $log);
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
  return;
}

$result = $db->select("SELECT MAX(id) as id FROM jokes");
$max = $result[0]['id'];
$id = $max;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* get the latest joke */
$sql = "SELECT * FROM jokes WHERE id = ?";
$joke = $db->select($sql, "i", [$id]);
$joke = $joke[0];
?>
<!-- bootstrap 5.0.1 -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  	<!-- https://bootswatch.com/litera/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Joke of the day</title>
  </head>
  <body>
    <div class="container">
      
      <div class="row">
        <div class="col-lg-4 text-right">
          <?php 
          if ($id > 1){
            ?>
            <a href="index.php?id=<?php echo $id-1 ?>" type="button" class="btn btn-outline-secondary"><<</a>
            <?php
          }
        ?>
        </div>
        <div class="col-lg-4 text-center">
          <h1>Go on, smile</h1>
        </div>
        <div class="col-lg-4">
          <?php
          if ($id < $max){
            ?>
            <a href="index.php?id=<?php echo $id+1 ?>" type="button" class="btn btn-outline-secondary">>></a>
            <?php
          }
          ?>
        </div>

      </div>

      <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">

          <figure class="text-center">
            <blockquote class="blockquote">
            <?php
              echo show($joke['setup']);
            ?>
            </blockquote>
            <figcaption class="blockquote-footer">
              Dennis E.J.Vorst
            </figcaption>
          </figure>

        </div>
        <div class="col-lg-4">
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<?php
/** enclose all lines in <p> and </p> */
function show(string $text) : string
{
  //init
  $html = "";
  $text = explode("\n", $text);

  foreach ($text as $line)
  {
    if (!empty($line))
    {
      $html .= "<p>" . $line . "</p>\n";
    }
  }

  return $html;
}
?>
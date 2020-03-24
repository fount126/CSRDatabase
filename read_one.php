<!DOCTYPE HTML>
<html>
<head>
    <title>Customer Service Database</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>
<body>


    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Complaints</h1>
        </div>

        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

//include database connection
include 'config/database.php';

// read current record's data
try {
    // prepare select query
    $query = "SELECT id, dater, compmadeby, description, route, bus, oper, sa, jusunf, acttak, outcome, closed FROM complaints WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );

    // this is the first question mark
    $stmt->bindParam(1, $id);

    // execute our query
    $stmt->execute();

    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // values to fill up our form
    $dater = $row['dater'];
    $compmadeby = $row['compmadeby'];
    $description = $row['description'];
    $route = $row['route'];
      $bus = $row['bus'];
      $oper = $row['oper'];
      $sa = $row['sa'];
      $jusunf = $row['jusunf'];
      $acttak = $row['acttak'];
      $outcome = $row['outcome'];
      $closed = $row['closed'];
}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>

        <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Date Received:</td>
        <td><?php echo htmlspecialchars($dater, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Complaint from:</td>
        <td><?php echo htmlspecialchars($compmadeby, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Description:</td>
        <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Route:</td>
        <td><?php echo htmlspecialchars($route, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Bus:</td>
        <td><?php echo htmlspecialchars($bus, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Operator:</td>
        <td><?php echo htmlspecialchars($oper, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Supervisor Assigned:</td>
        <td><?php echo htmlspecialchars($sa, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Justified/Unfound:</td>
        <td><?php echo htmlspecialchars($jusunf, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Action Taken:</td>
        <td><?php echo htmlspecialchars($acttak, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Outcome:</td>
        <td><?php echo htmlspecialchars($outcome, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Closed:</td>
        <td><?php echo htmlspecialchars($closed, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-danger'>Back to Complaints</a>
        </td>
    </tr>
</table>

    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>

<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

</head>
<body>

    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Update Complaint</h1>
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

<?php

// check if form was submitted
if($_POST){

    try{

        // write update query
        // in this case, it seemed like we have so many fields to pass and
        // it is better to label them and not use question marks
        $query = "UPDATE complaints
                    SET dater=:dater, compmadeby=:compmadeby, description=:description, route=:route, bus=:bus, oper=:oper, sa=:sa, jusunf=:jusunf
                    , acttak=:acttak, outcome=:outcome, closed=:closed
                    WHERE id = :id";

        // prepare query for excecution
        $stmt = $con->prepare($query);

        // posted values
        $dater=htmlspecialchars(strip_tags($_POST['dater']));
        $compmadeby=htmlspecialchars(strip_tags($_POST['compmadeby']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $route=htmlspecialchars(strip_tags($_POST['route']));
        $bus=htmlspecialchars(strip_tags($_POST['bus']));
        $oper=htmlspecialchars(strip_tags($_POST['oper']));
        $sa=htmlspecialchars(strip_tags($_POST['sa']));
        $jusunf=htmlspecialchars(strip_tags($_POST['jusunf']));
        $acttak=htmlspecialchars(strip_tags($_POST['acttak']));
        $outcome=htmlspecialchars(strip_tags($_POST['outcome']));
        $closed=htmlspecialchars(strip_tags($_POST['closed']));


        // bind the parameters
        $stmt->bindParam(':dater', $dater);
        $stmt->bindParam(':compmadeby', $compmadeby);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':route', $route);
        $stmt->bindParam(':bus', $bus);
        $stmt->bindParam(':oper', $oper);
        $stmt->bindParam(':sa', $sa);
        $stmt->bindParam(':jusunf', $jusunf);
        $stmt->bindParam(':acttak', $acttak);
        $stmt->bindParam(':outcome', $outcome);
        $stmt->bindParam(':closed', $closed);
        $stmt->bindParam(':id', $id);

        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }

    }

    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Date Received:</td>
            <td><input type='text' name='dater' value="<?php echo htmlspecialchars($dater, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Complaint from:</td>
            <td><textarea name='compmadeby' class='form-control'><?php echo htmlspecialchars($compmadeby, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Route:</td>
            <td><input type='text' name='route' value="<?php echo htmlspecialchars($route, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Bus:</td>
            <td><input type='text' name='bus' value="<?php echo htmlspecialchars($bus, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Operator:</td>
            <td><input type='text' name='oper' value="<?php echo htmlspecialchars($oper, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Supervisor Assigned:</td>
            <td><input type='text' name='sa' value="<?php echo htmlspecialchars($sa, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Justified/Unfound:</td>
            <td><input type='text' name='jusunf' value="<?php echo htmlspecialchars($jusunf, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Action Taken:</td>
            <td><input type='text' name='acttak' value="<?php echo htmlspecialchars($acttak, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Outcome:</td>
            <td><input type='text' name='outcome' value="<?php echo htmlspecialchars($outcome, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Closed:</td>
            <td><input type='text' name='closed' value="<?php echo htmlspecialchars($closed, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to Complaint</a>
            </td>
        </tr>
    </table>
</form>

    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>

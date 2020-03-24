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
            <h1>Create Complaint</h1>
        </div>

<?php
if($_POST){

    // include database connection
    include 'config/database.php';

    try{

        // insert query
        $query = "INSERT INTO complaints SET dater=:dater, compmadeby=:compmadeby, description=:description, route=:route, bus=:bus, oper=:oper,
        sa=:sa, jusunf=:jusunf, acttak=:acttak, outcome=:outcome, closed=:closed, created=:created";

        // prepare query for execution
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


        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);

        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }

    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Date Received:</td>
            <td><input type='text' name='dater' class='form-control' /></td>
        </tr>
        <tr>
            <td>Complaint from:</td>
            <td><textarea name='compmadeby' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>Route:</td>
            <td><input type='text' name='route' class='form-control' /></td>
        </tr>
        <tr>
            <td>Bus:</td>
            <td><input type='text' name='bus' class='form-control' /></td>
        </tr>
        <tr>
            <td>Operator:</td>
            <td><input type='text' name='oper' class='form-control' /></td>
        </tr>
        <tr>
            <td>Supervisor Assigned:</td>
            <td><input type='text' name='sa' class='form-control' /></td>
        </tr>
        <tr>
            <td>Justified/Unfound:</td>
            <td><input type='text' name='jusunf' class='form-control' /></td>
        </tr>
        <tr>
            <td>Action Taken:</td>
            <td><input type='text' name='acttak' class='form-control' /></td>
        </tr>
        <tr>
            <td>Outcome:</td>
            <td><input type='text' name='outcome' class='form-control' /></td>
        </tr>
        <tr>
            <td>Closed:</td>
            <td><input type='text' name='closed' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to Complaints</a>
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

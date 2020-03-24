<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Service Database</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
</head>
<body>
  <div class="content">
    <center>
    	<!-- notification message -->
    	<?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
        	<h3>
            <?php
            	echo $_SESSION['success'];
            	unset($_SESSION['success']);
            ?>
        	</h3>
        </div>
    	<?php endif ?>

      <!-- logged in user information -->
      <?php  if (isset($_SESSION['username'])) : ?>
      	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <?php endif ?>
      </center
  </div>


    <!-- container -->
    <div class="container">

        <div class="page-header">
            <h1>Complaints</h1>
        </div>

        <?php
// include database connection
include 'config/database.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}

// select all data
$query = "SELECT id, dater, compmadeby, description, route, bus, oper, sa, jusunf, acttak, outcome, closed FROM complaints ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create Complaint</a>";

//check if more than 0 record found
if($num>0){

    echo "<table class='table table-hover table-responsive table-bordered'>";//start table

    //creating our table heading
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Date Received:</th>";
        echo "<th>Complaint from:</th>";
        echo "<th>Description:</th>";
        echo "<th>Route:</th>";
        echo "<th>Bus:</th>";
        echo "<th>Operator:</th>";
        echo "<th>Supervisor Assigned:</th>";
        echo "<th>Justified/Unfound:</th>";
        echo "<th>Action Taken:</th>";
        echo "<th>Outcome:</th>";
        echo "<th>Closed:</th>";
        echo "<th>Action:</th>";
    echo "</tr>";

    // retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['firstname'] to
    // just $firstname only
    extract($row);

    // creating new table row per record
    echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$dater}</td>";
        echo "<td>{$compmadeby}</td>";
        echo "<td>{$description}</td>";
        echo "<td>{$route}</td>";
        echo "<td>{$bus}</td>";
        echo "<td>{$oper}</td>";
        echo "<td>{$sa}</td>";
        echo "<td>{$jusunf}</td>";
        echo "<td>{$acttak}</td>";
        echo "<td>{$outcome}</td>";
        echo "<td>{$closed}</td>";
        echo "<td>";
            // read one record
            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

            // we will use this links on next part of this post
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

            // we will use this links on next part of this post
            // echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
        echo "</td>";
    echo "</tr>";
}

// end table
echo "</table>";

}

// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>

    </div> <!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){

    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok,
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    }
}
</script>
<div class="content">
  <center>
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php
          	echo $_SESSION['success'];
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
    </center
</div>
</body>
</html>

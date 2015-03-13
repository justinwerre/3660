<?php
  include "databaseConnect.php";
  include "functions.php";

  //Check to make sure, Serial number is passed
  if (isset($_GET['serial_number']) ) {
  	$serial_number = (int) $_GET['serial_number'];
  }

  //If Page is submitted check
  if (isset($_POST['submitted'])) {
  	foreach($_POST AS $key => $value) {
  		$_POST[$key] = mysqli_real_escape_string($con,$value);
    }

  //Create the Query
  $sql = "UPDATE `VIDEOGAMES` SET
  `title` =  '{$_POST['title']}' ,
  `price` =  '{$_POST['price']}' ,
  `ESRB_rating` =  '{$_POST['ESRB_rating']}' ,
  `release_Date` =  '{$_POST['releaseDate']}',
  `cover_art` =  '{$_POST['cover_art']}' ,
  `description` =  '{$_POST['description']}' ,
  `developer` =  '{$_POST['developer']}'
  WHERE `serial_number` = '$serial_number' ";

  mysqli_query($con,$sql) or die(mysqli_error($con));

  //Grab Title
  if(isset($_POST['title'])) {
    $gameTitle = $_POST['title'];
  }
  else {
    $gameTitle = $row['title'];
  }
  //Output yes or No
  echo (mysqli_affected_rows($con)) ? "<h3 class='container text-success'>Edited $gameTitle. </h3><br />" : "<h3 class='container text-error'>Nothing changed. </h3><br />";
}

$row = mysqli_fetch_array ( mysqli_query($con,"SELECT * FROM `VIDEOGAMES` WHERE `serial_number` = '$serial_number' "));
  mysqli_close($con);




?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Edit VideoGames</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>


      <div class="container">
        <div class="jumbotron">
      <h1>Editing</h1>
                        <form class="form-horizontal" method='post' action=''>

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="text" name="title" value='<?= stripslashes($row['title']) ?>'>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="price" class="col-sm-2 control-label">Price</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="number" name="price" step="00.01" min="0" value='<?= stripslashes($row['price']) ?>'>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="" class="col-sm-2 control-label">ESRB Rating</label>
                        <div class="col-sm-10">


                      <select class="form-control" id='ESRB_RATING' required name='ESRB_rating'>
                              <option value="Children"  <?php if($row['ESRB_rating']=="Children") echo "selected";?>>Children</option>
                              <option value="Everyone"  <?php if($row['ESRB_rating']=="Everyone") echo "selected";?>>Everyone</option>
                              <option value="Teen"      <?php if($row['ESRB_rating']=="Teen")     echo "selected";?>>Teen</option>
                              <option value="Mature"    <?php if($row['ESRB_rating']=="Mature")   echo "selected";?>>Mature</option>
                              <option value="Adult"     <?php if($row['ESRB_rating']=="Adult")    echo "selected";?>>Adult</option>
                      </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Release Date</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" pattern='\d{4}[\-]\d{2}[\-]\d{2}' title="Format YYYY-MM-DD" name="releaseDate" value='<?= stripslashes($row['release_date']) ?>'>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Cover Art Name</label>
                      <div class="col-sm-10">
                      <input class="form-control" type="text" name="cover_art" value='<?= stripslashes($row['cover_art']) ?>'>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="description" value='<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>'>
                  </div>
                </div>

                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Developer</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="developer" value='<?= stripslashes($row['developer']) ?>'>
                </div>
              </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <input type='submit' class="btn btn-info" value='Edit VideoGames' /><input type='hidden' value='1' name='submitted' />
                            </div>
                            <div class="col-sm-offset-0 col-sm-10">
                              <button class="btn btn-danger" formaction="../index.html">Back</a>
                              </div>
                          </div>
                        </form>
                      </div>
                    </div>


      <table class="table table-bordered"> </table>


      </body>
    </html>

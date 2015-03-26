<?php
  include "databaseConnect.php";
  include "functions.php";
  checkAdmin();

  //Check if submitted
  if (isset($_POST['submitted'])) {
    $sql = "INSERT INTO VIDEOGAMES (title,price,ESRB_rating,release_date,cover_art,description,developer)
    VALUES('$_POST[title]','$_POST[price]','$_POST[ESRB_rating]','$_POST[releaseDate]','$_POST[cover_art]','$_POST[description]','$_POST[developer]')";

    //Display success or error message
    if(!mysqli_query($con,$sql)){
       echo "<h3 class='container text-error'>Cannot Add User: Game already exists </h3><br>";
        mysqli_close($con);
      }
      else {
        echo "<h3 class='container text-success'>Added Videogame. </h3><br>";
        mysqli_close($con);
      }
}

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
      <h2>Add a Game</h2>
                        <form class="form-horizontal" method='post' action=''>

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="text" name="title" required placeholder='Game Title'>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="price" class="col-sm-2 control-label">Price</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="number" required name="price" step="00.01" min="0" placeholder='10.99'>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="" class="col-sm-2 control-label">ESRB Rating</label>
                        <div class="col-sm-10">


                      <select class="form-control" id='ESRB_RATING' required name='ESRB_rating'>
                              <option value="Children">Children</option>
                              <option value="Everyone" selected>Everyone</option>
                              <option value="Teen">Teen</option>
                              <option value="Mature">Mature</option>
                              <option value="Adult">Adult</option>
                      </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Release Date</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" required pattern='\d{4}[\-]\d{2}[\-]\d{2}' title="Format YYYY-MM-DD" name="releaseDate" placeholder='2015-01-01'>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Cover Art Filepath</label>
                      <div class="col-sm-10">
                      <input class="form-control" type="text" required name="cover_art" placeholder='art.jpeg'>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" required name="description" placeholder='Description'>
                  </div>
                </div>

                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Developer</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" required name="developer" placeholder='Developer'>
                </div>
              </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10 ">
                            <input type='submit' class="btn btn-info pull-right" value='Confirm' /><input type='hidden' value='1' name='submitted' />
                            </div>
                            <div class="col-sm-offset-0 col-sm-10">
                              <a class="btn btn-danger" href="listGames.php">Back</a>
                              </div>
                          </div>
                        </form>
                      </div>
                    </div>


      <table class="table table-bordered"> </table>


      </body>
    </html>

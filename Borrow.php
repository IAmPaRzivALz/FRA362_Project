<?php
 session_start();
 echo $_SESSION['Name'];
 if (empty($_SESSION['Image'])) {
  $imagepath = "C:/xampp/htdocs/img/Test.png";
  } else {
    $imagepath = "C:/xampp/htdocs/img/" . $_SESSION['Image'] . ".jpg";
  }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page Sus</title>
  <link rel="stylesheet" type = "text/css" href = "St.css?v=<?php echo time(); ?>">
</head>
<body>
  
 
<div class ="SquareforManual">
        <label>Item ID : </label>
        <input type = "text"  name ="ID" placeholder ="Manual Again sry">
        <button type="submit">submit</button>
    </div>
  <div class = "Bigsquare">
    <div class = "Smallersquare"> 
      
        <div class = "squarefortext1">
            <img class="LogoPicsmall" src="img/hand.png" alt="hand">
            Borrow Device
        </div> 
        <img class="CircleforPic" src="<?php echo $imagepath; ?>" alt="Your Image">
       
      <div class = "squarefortext2">
        <?php 
          echo $_SESSION['Name'];
        ?>
      </div>
      <div class = "squarefortext3">
        <?php 
          echo $_SESSION['ID'];
        ?>
      </div>
      <div class = "SquareforLogoutandmneu">
        <a href="PL.php" class ="Logout">Log out </a>  
        <a href="LoginSuss.php" class ="Menu">Back To Menu </a> 
      </div>
      
      
      
  </div>
  <div class = "BigbutSmallersquare"> 
    <div class = "squarefortext5"> Scanned device</div>
    <div class = "squarebiggerthansquareforpic"> 
        <!-- <img class="squareforpic" src="data:image/jpeg;base64,>" alt="Item Image"> -->
        <img src="data:image/jpeg;base64,<?php echo $_SESSION['Image']; ?>" alt="Item Image" style="max-width: 170px; max-height: 170px; width: auto; height: auto; border-radius: 8px;">
        <div class = "squarefortext7">Name <br>Type<br>Description<br><br><br><br><br><br>Place</div>
        <div class = "squareforpointpoint"> :<br>:<br>:<br><br><br><br><br><br>:</div>
        <div class = "squareforb4text8">
        <div class = "squarefortext8"> <?php echo $_SESSION['Name']; ?> </div>
        <div class = "squarefortext9"><?php echo $_SESSION['Type']; ?></div>
        <div class = "squarefortext10"><?php echo $_SESSION['Description']; ?></div>
        <div class = "squarefortext11"><?php echo $_SESSION['Place']; ?></div>
            
        </div>
    </div>
    
    <div class = "squarefortext6"> Scanned list</div>
    <div class = "squareforlist"> </div>
    <a href="LoginSuss.php" class ="Menu2">Confirm all </a> 
    
    
  </div>
  
</div>

      
    
    
</form>
 

</body>
</html>
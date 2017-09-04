<?php
  $auth = 0;
  include "includes/constants.php";
  include "includes/db.php";
  include "includes/auth.php";
  
  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $db->quote($_POST['username']);
    $password = sha1($_POST['password']);
    $select = $db->query("SELECT * FROM vp_users WHERE nom_user = $username AND mdp_user = '$password'");

    if($select->rowCount() > 0){
      $_SESSION['Auth'] = $select->fetch();
      header('Location:' . WEBROOT . 'admin/index.php');
      die();
    }
  }
?>

<?php include "partials/header.php"; ?>

<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <form action="#" method="POST">
      <div class="form-group">
        <label for="username">UserName :</label>
        <input type="text" class="form-control" id="username" placeholder="Email" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
      </div>
      <div class="form-group">
        <label for="password">Password :</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
      </div>
      <button type="submit" class="btn btn-default">Se connecter</button>
    </form>
  </div>
</div>



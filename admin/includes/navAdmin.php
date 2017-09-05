    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Administration - Vente privées</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="pages.php">Mes Pages</a></li>
            <li><a href="lignes.php">Lignes</a></li>
            <li><a href="magasins.php">Magasins</a></li>
           <?php
              if(isset($_SESSION['Auth']['id_user'])){
                echo "<li><a href='logout.php'><button class='btn btn-danger'>Se déconnecter</button></a></li>";
              }
            ?>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Rechercher...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="index.php">Accueil <span class="sr-only">(current)</span></a></li>
            <li><a href="pages.php">Mes Pages</a></li>
            <li><a href="lignes.php">Lignes</a></li>
            <li><a href="magasins.php">Magasins</a></li>
             <?php
              if(isset($_SESSION['Auth']['type_user']) && $_SESSION['Auth']['type_user'] =="1" ){
                echo "<hr>";
                echo "<li><a href='commandes.php'>Gérer les Utilisateurs</a></li>";
                echo "<li><a href='commandes.php'>Gérer les Clients</a></li>";
                echo "<li><a href='commandes.php'>Gérer les Commandes</a></li>";
              }
            ?>
            
          </ul>

        </div>
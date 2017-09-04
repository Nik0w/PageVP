<?php include "includes/constants.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/auth.php"; ?>

<?php


  // On récupere la liste des compagnies
  $selectCompagnies = $db->query("SELECT * FROM compagnies");
  $compagnies = $selectCompagnies->fetchAll();

  //Une fois la compagnie validée, on créer la fiche de commande et sa ref.
  if(isset($_POST['name_compagnie'])){
    //checkCsrf();

    $name = $db->quote($_POST['name_compagnie']);
    $date = $db->quote( date('Y-m-d') );
    $db->query("INSERT INTO commandes SET ref_commande = 'test', id_compagnie = $name, date_commande = $date");
      
    header('Location:add_commande.php');
    die();
  }

?>

<?php include "partials/header.php"; ?>

<body>

        <?php include('includes/navAdmin.php') ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Nouvelle commande :</h1>

          <div class="row">
            <div class="col-sm-6">
              <form action="#" method="POST" enctype="multipart/form-data">

                <!-- STEP 1 : On sélécitionne la compagnie voulue -->
                <div class="form-group">
                  <label for="name_compagnie">Séléctionner la compagnie :</label>
                  <select type="text" class="form-control" id="name_compagnie" placeholder="Slug" name="name_compagnie">
                    <?php foreach ($compagnies as $k => $compagnie): ?>
                      <?php echo '<option value="'.  $compagnie["id_compagnie"] .'"> '.$compagnie["nom_compagnie"] .'</option>'; ?>
                    <?php endforeach  ?>
                  </select>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

<?php include "partials/footer.php"; ?>
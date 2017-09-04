	<div id="footer">
		<div class="container1280">

		</div>
	</div>

	 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"><\/script>')</script>

    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

    <script type="text/javascript">
    	$(document).ready(function(){

            // btn de duplication ?
    		$('#duplicateBtn').click(function(e){
    			e.preventDefault();
    			var $clone = $('#duplicate').clone().attr('id','').removeClass('hidden');
    			$('#duplicate').before($clone);
    		});

            // Gestion du formulaire de nouvelle commande

            $('#name_compagnie').on('change',function(){
                // on séléctionne une compagnie dans la liste > on affiche un bouton > enresitremen en bdd de la compagnie et création du ticket de la commande avec sa ref unique = on ne perd pas le début de commande si pb front
                $('#validCompagnie').remove();
                $(this).parent().parent().append('<button id="validCompagnie" type="submit" class="btn btn-success">Valider la compagnie</button>');
            });

    	});
    </script>
	
</body>
</html>
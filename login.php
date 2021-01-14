<?php
include 'includes/header.php';

// On va mettre une classe sur nos messages : rouge s'il y a une erreur, vert sinon
// Remarquez qu'on peut se passer du else : notre cas par défaut est la réussite
$messageClass = 'success';
if ($loginError) {
    $messageClass = 'danger';
}

// On affiche les messages (on a un tableau, un foreach est tout indiqué ;) )
foreach ($loginMessages as $message) {
    ?>
    <div class="alert alert-<?php echo $messageClass; ?>" role="alert">
        <?php echo $message; //On insère les éléments dans le html. Notez qu'on peut se passer des ; ici, mais par sécurité, je le mets toujours à la fin de mes instructions (je fais aussi ça en js :P ) ?>
    </div>
    <?php
}
?>
<!-- Ici, j'ai pris un template bien compliqué mais très beau sur le net ;) : https://bootsnipp.com/snippets/vl4R7 -->
<div class="container">
	<div class="d-flex justify-content-center">
		<div class="card">
			<div class="card-header">
				<h3>Connexion</h3>
			</div>
			<div class="card-body">
                <!-- le formulaire doit avoir les attributs action (url de destination, vide pour signifier qu'on reste sur la même page) et method, pour lui demander de ne pas mettre les données en clair dans l'url, mais plutôt les envoyer en POST -->
				<form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<label class="input-group-text" for="login"><i class="fas fa-user"></i></label>
						</div>
                        <!-- Ne pas oublier le name sur le champs, c'est cet attribut qui donne la clé dans le tableau $_POST -->
                        <!-- A noter que l'on peut ajouter une validation HTML (ici, préciser au navigateur que le champ est requis), mais nous avons quand même besoin de faire la vérification complète en PHP. N'importe qui peut utiliser l'inspecteur de son navigateur pour enlever cette vérification HTML -->
						<input type="text" name="login" id="login" class="form-control" placeholder="Nom d'utilisateur" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<label class="input-group-text" for="password"><i class="fas fa-key"></i></label>
						</div>
                        <!-- Ne pas oublier le name sur le champs, c'est cet attribut qui donne la clé dans le tableau $_POST -->
                        <!-- A noter que l'on peut ajouter une validation HTML (ici, préciser au navigateur que le champ est requis), mais nous avons quand même besoin de faire la vérification complète en PHP. N'importe qui peut utiliser l'inspecteur de son navigateur pour enlever cette vérification HTML -->
						<input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" is="remember_me"><label for="remember_me">Se souvenir de moi</label>
					</div>
					<div class="form-group">
						<input type="submit" value="Connexion" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Pas encore de compte ?<a href="#">Inscrivez-vous</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Mot de passe oublié ?</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include 'includes/footer.php';
?>
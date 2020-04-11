<?php

require 'inc/panierController.php';

//J'ai ajouter ce variable pour empêcher l'execution de script si une valeur n'existe pas
$erreur = false;

$idc = (isset($_SESSION['client_id'])) ? $_SESSION['client_id'] : 0 ;

//Recuperer le type d'action (Ajouter au panier - changer la quantité - supprimer depuis le panier)
$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
	if(!isset($_SESSION['client_id']))
		header('Location: connexion');

	if(!in_array($action,array('ajouter', 'supprimer', 'refresh')))
	$erreur=true;

	//récuperation des variables en POST ou GET
	$quantite = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
	$idProduit = (isset($_POST['idp'])? $_POST['idp']:  (isset($_GET['idp'])? $_GET['idp']:null )) ;
}

//Par rapport au type d'action voulu en fait l'appel à la fonction requise
if (!$erreur){
   	switch($action){
		case "ajouter":
			ajouterProduit($idProduit, $idc, $db);
			break;

		case "supprimer":
			supprimerProduit($idProduit, $idc, $db);
			break;

		case "refresh" :
			changerQuantite($idProduit, $idc, $quantite, $db);
			break;

		default:
			break;
   	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Panier | MySweater</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Accueil</a></span> <span>Panier</span></p>
					<h1 class="mb-0 bread">mon panier</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>Produit</th>
									<th>Prix</th>
									<th>Quantité</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if ($idc == 0)
									echo "<tr><td>Votre panier est vide! </ td></tr>";
								else
								{
									if(nombreProduits($idc, $db) == 0)
										echo "<tr><td>Votre panier est vide! </ td></tr>";
									else {
									$produits = lesProduitsExistent($idc, $db);
									foreach ($produits as $produit) {
										$product= infosProduit($produit['idProduit'], $db);
							?>			
								<tr class="text-center">
									<td class="product-remove">
										<a href="panier.php?action=supprimer&idp=<?php echo $produit['idProduit'] ?>"><span class="ion-ios-close"></span></a>
									</td>
									<td class="image-prod">
										<div class="img" style="background-image:url(images/<?php echo $product['image'] ?>.jpg);"></div>
									</td>
									<td class="product-name">
										<h3><?php echo $product['libelle'] ?></h3>
										<p>Chemise structurée imprimée à pois easy</p>
									</td>
									<td class="price"><?php echo $product['prix'] ?></td>
									<td class="quantity">
										<div class="input-group mb-3">
											<input class="quantity form-control input-number" max="100" min="1" name="quantity" id="inputQ<?php echo $produit['idProduit'] ?>" onchange="changeFunction(<?php echo $produit['idProduit'] ?>);" type="number" value="<?php echo $produit['quantite'] ?>">
										</div>
									</td>
									<td class="total"><?php echo $product['prix'] * $produit['quantite'] ?></td>
								</tr>
								<?php } } } ?>
							</tbody>
						</table>						
						<a class="btn btn-primary py-3 px-4 float-right" href="panier">Mettre à jour</a>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Totaux du panier</h3>
						<p class="d-flex"><span>Total</span> <span><?php if($idc != 0) echo totalPrixPanier($idc, $db); else echo "0"; ?>.00 DHs</span></p>
						<p class="d-flex"><span>Livraison</span> <span>20.00 DHs</span></p>
						<hr>
						<p class="d-flex total-price"><span>Total</span> <span><?php if($idc != 0) echo totalPrixPanier($idc, $db)+20; else echo "20"; ?>.00 DHs</span></p>
					</div>
					<p class="text-center"><a class="btn btn-primary py-3 px-4" href="checkout">Passer à la caisse</a></p>
				</div>
			</div>
		</div>
	</section>
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
	<script>
			var idp;
			var quantite;

			//la function sert à envoyer les arguments au PHP et changer la valeur de quanyité
			function changeFunction($id){
				idp = $id;
				quantite = document.getElementById("inputQ" + $id).value;
				var url = window.location.href;    
				if (url.indexOf('?') > -1){
					url = url.substring(0, url.indexOf('?'));
				}
				url += '?action=refresh&idp=' + idp + '&q=' + quantite;
				window.location.href = url;
			}
	</script>
</body>
</html>

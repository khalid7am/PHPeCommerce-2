<?php
require 'inc/config.php';
require 'inc/panierController.php';

//J'ai ajouter ce variable pour empêcher l'execution de script si une valeur n'existe pas
$erreur = false;

//Recuperer le type d'action (Ajouter au panier - changer la quantité - supprimer depuis le panier)
$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $quantite = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   $idProduit = (isset($_POST['idp'])? $_POST['idp']:  (isset($_GET['idp'])? $_GET['idp']:null )) ;
}

//Par rapport au type d'action voulu en fait l'appel à la fonction requise
if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterProduit($idProduit);
         break;

      Case "suppression":
         supprimerProduit($idProduit);
         break;

      Case "refresh" :
         modifierQTeProduit($idProduit,$quantite);
         break;

      Default:
         break;
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>MySweater - Panier</title>
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
								if (creationPanier())
								{
									$nbArticles=count($_SESSION['panier']['libelleProduit']);
									if ($nbArticles <= 0)
									echo "<tr><td>Votre panier est vide! </ td></tr>";
									else
									{
										for ($i=0 ;$i < $nbArticles ; $i++)
										{
											echo '
											<tr class="text-center">
												<td class="product-remove">
													<a href="'.htmlspecialchars("panier.php?action=suppression&idp=".rawurlencode($_SESSION['panier']['idProduit'][$i])).'"><span class="ion-ios-close"></span></a>
												</td>
												<td class="image-prod">
													<div class="img" style="background-image:url(images/'.htmlspecialchars($_SESSION['panier']['imageProduit'][$i]).'.jpg);"></div>
												</td>
												<td class="product-name">
													<h3>'.htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]).'</h3>
													<p>Chemise structurée imprimée à pois easy</p>
												</td>
												<td class="price">'.htmlspecialchars($_SESSION['panier']['prixProduit'][$i]).'</td>
												<td class="quantity">
													<div class="input-group mb-3">
														<input class="quantity form-control input-number" max="100" min="1" name="quantity" id="inputQ'.$_SESSION['panier']['idProduit'][$i].'" onchange="changeFunction('.$_SESSION['panier']['idProduit'][$i].')" type="text" value="'.htmlspecialchars($_SESSION['panier']['qteProduit'][$i]).'">
													</div>
												</td>
												<td class="total">'.htmlspecialchars(($_SESSION['panier']['prixProduit'][$i])*($_SESSION['panier']['qteProduit'][$i])).'</td>
											</tr>
											';
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h3>Totaux du panier</h3>
						<p class="d-flex"><span>Total</span> <span><?php echo MontantGlobal(); ?> DHs</span></p>
						<p class="d-flex"><span>Livraison</span> <span>20.00 DHs</span></p>
						<hr>
						<p class="d-flex total-price"><span>Total</span> <span><?php echo MontantGlobal()+20; ?> DHs</span></p>
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

			//la function pour envoyer les arguments au PHP et changer la valeur de quanyité
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
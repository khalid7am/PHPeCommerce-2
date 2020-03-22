<?php
	require 'inc/panierController.php';
	require 'inc/config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MySweater - Check-out</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Accueil</a></span> <span>Check-out</span></p>
					<h1 class="mb-0 bread">Check-out</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-8 ftco-animate">
					<form action="#" class="billing-form">
						<h3 class="mb-4 billing-heading">Détails de la facturation</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">Prénom</label> <input class="form-control" placeholder="" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="lastname">Nom</label> <input class="form-control" placeholder="" type="text">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="country">Pays</label>
									<div class="select-wrap">
										<div class="icon">
											<span class="ion-ios-arrow-down"></span>
										</div><select class="form-control" id="" name="">
											<option value="">
												Maroc
											</option>
										</select>
									</div>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="streetaddress">Adresse de rue</label> <input class="form-control" placeholder="Numéro de maison et nom de rue" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" placeholder="Appartement, suite, unité, etc.: (facultatif)" type="text">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Ville</label> <input class="form-control" placeholder="" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Code postal *</label> <input class="form-control" placeholder="" type="text">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Téléphone</label> <input class="form-control" placeholder="" type="text">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emailaddress">Adresse e-mail</label> <input class="form-control" placeholder="" type="text">
								</div>
							</div>
							<div class="w-100"></div>
						</div>
					</form><!-- END -->
					<div class="row mt-5 pt-3 d-flex">
						<div class="col-md-6 d-flex">
							<div class="cart-detail cart-total bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Total du panier</h3>
								<p class="d-flex"><span>Total</span> <span>90.60 DHs</span></p>
								<p class="d-flex"><span>Livraison</span> <span>20.00 DHs</span></p>
								<hr>
								<p class="d-flex total-price"><span>Total</span> <span>110.60 DHs</span></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="cart-detail bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Mode de paiement</h3>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input class="mr-2" name="optradio" type="radio">Paiement à la livraison</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input class="mr-2" name="optradio" type="radio"> Paypal</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label><input class="mr-2" type="checkbox" value="">J'ai lu et j'accepte les termes et conditions</label>
										</div>
									</div>
								</div>
								<p><a class="btn btn-primary py-3 px-4" href="#">Commander</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
</body>
</html>
<?php

 // Verifie si le panier existe, le crée sinon
function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['idProduit'] = array();
      $_SESSION['panier']['libelleProduit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      $_SESSION['panier']['imageProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}

 // Ajoute un produit dans le panier
function ajouterProduit($idProduit){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search(Produits[$idProduit]['id'],  $_SESSION['panier']['idProduit']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['qteProduit'][$positionProduit] += Produits[$idProduit]['quantite'] ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['idProduit'],Produits[$idProduit]['id']);
         array_push( $_SESSION['panier']['libelleProduit'],Produits[$idProduit]['libelle']);
         array_push( $_SESSION['panier']['qteProduit'],Produits[$idProduit]['quantite']);
         array_push( $_SESSION['panier']['prixProduit'],Produits[$idProduit]['prix']);
         array_push( $_SESSION['panier']['imageProduit'],Produits[$idProduit]['image']);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

 // Modifie la quantité d'un produit
function modifierQTeProduit($idProduit,$qteProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($qteProduit > 0)
      {
         //Recharche du produit dans le panier
         $positionProduit = array_search(Produits[$idProduit]['id'],  $_SESSION['panier']['idProduit']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
         }
      }
      else
      supprimerProduit(Produits[$idProduit]['id']);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

 // Supprime un produit du panier
function supprimerProduit($idProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['idProduit'] = array();
      $tmp['libelleProduit'] = array();
      $tmp['qteProduit'] = array();
      $tmp['prixProduit'] = array();
      $tmp['imageProduit'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++)
      {
         if ($_SESSION['panier']['idProduit'][$i] !== Produits[$idProduit]['id'])
         {
            array_push( $tmp['idProduit'],$_SESSION['panier']['idProduit'][$i]);
            array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
            array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
            array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
            array_push( $tmp['imageProduit'],$_SESSION['panier']['imageProduit'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

 // Montant total du panier
function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++)
   {
      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
   }
   return $total;
}

 // Fonction de suppression du panier
function supprimePanier(){
   unset($_SESSION['panier']);
}

 // Permet de savoir si le panier est verrouillé
function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

 // Compte le nombre des produits différents dans le panier
function compterProduits()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['idProduit']);
   else
   return 0;
}

?>
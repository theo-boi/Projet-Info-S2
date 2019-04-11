<?php
require("main.php");
session_start();
$article_id=$_SESSION["article_id"];

$req_img = "SELECT article.IMAGE FROM article where article.ID_ARTICLE=".$article_id."; ";
$req_nom_produit = "SELECT article.NOM_ARTICLE FROM article where article.ID_ARTICLE=".$article_id."; ";
$req_prix_ht = "SELECT article.PRIX_HT FROM article where article.ID_ARTICLE=".$article_id."; ";
$req_prix_ttc = "SELECT article.PRIX_TTC FROM article where article.ID_ARTICLE=".$article_id."; ";
$req_promo = "SELECT article.REDUCTION FROM ((article INNER JOIN est_en_promo USING ID_ARTICLE) INNER JOIN promotion USING ID_PROMO) where article.ID_ARTICLE=".$article_id."; ";
$req_category = "SELECT article.NOM_CATEGORIE FROM (article INNER JOIN categorie USING ID_CATEGORIE) where article.ID_ARTICLE=".$article_id."; ";
$req_collection = "SELECT article.NOM_COLLECTION FROM (article INNER JOIN categorie USING ID_COLLECTION) where article.ID_ARTICLE=".$article_id."; ";
$req_description = "SELECT article.DESCRIPTION FROM article where article.ID_ARTICLE=".$article_id."; ";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
 <title>Mon panier</title>
 <meta charset="UTF-8">
 <link href="stylesheet.css" rel="stylesheet">
</head>

<header>
    <table id="navbar">
        <tr>
            <td id="logo">
                <a href="index.html"><img id="main_logo" src="img/googlies%20logo.png"></a>
            </td>
            <td id="search-bar">
                <input type="text" placeholder="Rechercher...">
	    </td>
	    <td>
                <button id="submit-button" type="submit"></button>
            </td>
            <td id="espace-client">
                <a href="account.html">Espace Client</a>
            </td>
            <td id="panier">
                <a href="basket.html">Panier</a>
            </td>
        </tr>
    </table>
</header>

<body>
<div id="page">
    <table id="tableStyle">
        <tr>
	    <td id="tableImgProduct"><img id="imgProduct" src="img/articles/	<?php echo(convertTableToString(executeSQL($req_nom_produit)));?>	"></td>
            <td>
                <table id="tableInfoStyle">
	            <tr>
	                <td id="infoProduct">
	                   <p> <?php echo(convertTableToString(executeSQL($req_nom_produit)));?> </p>
	                </td>
	            </tr>
	            <tr>
	                <td id="infoProduct">
	                   <p> <?php echo(convertTableToString(executeSQL($req_prix_ht)));
				     $prix_ttc = convertTableToString(executeSQL($req_prix_ttc));
				     $promo = convertTableToString(executeSQL($req_promo));
				     echo($prix_ttc);
				     if ($promo!=NULL) {
				         echo($promo);
				         $ttc_promo = (int)$prix_ttc * (1- (float)$promo /100);
				         echo($ttc_promo);
				     } ?>
	                   </p>
	                </td>
	            </tr>
                </table>
            </td>
            <td id="categoryProduct">
               <p> <?php echo(convertTableToString(executeSQL($req_categorie)));?> de <?php echo(convertTableToString(executeSQL($req_collection)));?> </p>
		<table>
		<tr>
		<td style="padding-left:55%;">
		<div id="ajoutPanier">
                 <a href="basket.html">Ajouter au panier<pre><br></pre></a>
                </div>
		</td>
		</tr>
		</table>
            </td>
        </tr>
	<tr>
	    <td colspan=3 id="descrProduct">
	       <p> <?php echo(convertTableToString(executeSQL($req_description)));?> </p>
	    </td>
	</tr>
    </table>
</div>
</body>
</html>
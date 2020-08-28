<?php
	 // Démarrage des sessions//
	session_start();
	
	 // Mise en place de la connexion avec la BdD//
	$connexion = mysqli_connect('localhost','id14148902_axelleple','bsg6S)_[~hIr-n8#')
		or die("Problème de connexion");
	mysqli_select_db($connexion,'id14148902_axelleplebdd')
		or die("Impossible de choisir 'portfolio_aple'");

	// Établissement de la connexion en UTF8 pour les échanges avec la BdD//
	$sql = "SET NAMES 'UTF8';";
	$query = mysqli_query($connexion, $sql);

	 // On récupère la valeur de la langue//
	
	if(isset($_SESSION['langue'])) 
	{
		$langue = $_SESSION['langue'];
	} else {		
		$header_lang1 =explode(";" , $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ; 
		$header_lang =explode("," , $header_lang1[0] ) ; //$header_lang1[0] = "fr,en"
 		
 		if($header_lang[0] != "fr" || $header_lang[0] != "en")
 		{
 			$langue = "fr"; //langue par défaut "fr"
 		}
		else{
			$langue = $header_lang[0];
		}
	}

	 // On regarde s'il faut changer de langue \\
	//											\\
	if(isset($_GET['langue'])) {
		switch ($_GET['langue']) { // On ne change de langue que si elle est autorisée//
			case 'en':
				$langue = $_GET['langue'];
				break;
			
			default:
				$langue = "fr";
				break;
		}
	}


switch($langue) {
		case 'fr':
		$id_langue = 1;
		break;
		case 'en' :
		$id_langue =2;
		break;

		default:
		$id_langue = 1; //langue par default 1 => FR 
		break;
}

	  																						   
$_SESSION['langue'] = $langue;

//----------------------------------------------function--------------------------------------------------------------

function parcours($connexion, $id_langue, $paire, $categorie)
{
    $date = null;
    $sql = "SELECT * FROM categorie WHERE idLangue = $id_langue AND paire = $paire;";
	$query = mysqli_query($connexion, $sql);
	$tuple=mysqli_fetch_assoc($query);
	echo "<h3>".  $tuple['nom']. "</h3>";
	        
	$sql = "SELECT * FROM parcours WHERE idLangue = $id_langue AND idCategorie = $categorie;";
	$count = "SELECT COUNT(*) FROM parcours WHERE idLangue = $id_langue AND idCategorie = $categorie;";
	$query = mysqli_query($connexion, $sql);
	$rows = mysqli_query($connexion,$count);
	 			
	$rez = mysqli_fetch_assoc($rows);
	 			
	$i=1;
	while ($tuple=mysqli_fetch_assoc($query)){	
	    echo "<div>";
        if (($date==null) or ($date!=$tuple['date']))
        {
            $date = $tuple['date'];
            echo "<span class='date'>".$tuple['date']."</span>";
        } else {
            echo "<span class='date'></span>";
        }
        echo "<div>
            <svg class='Ellipse_1'  height='11px' width='11'>
		         <ellipse id='Ellipse_1' rx='5' ry='5' cx='5' cy='5'>
		         </ellipse>
		    </svg>
		";
		if ($rez['COUNT(*)'] > $i)
		{
		    echo "<svg class='Ligne_1'>
			    <path d='M 0 0 L 0 80' stroke='#F2F2F2' stroke-width='2px'>
			    </path>
			</svg>";
		}
		echo "</div>";
		echo "<div class='parcours_description'>";
		    echo "<span>".$tuple['texte']."</span>";
		    echo "<span class='parcours_lieu'>".$tuple['Lieu']."</span>";
		echo "</div>";
		echo "</div>";
		$i++;
	}
}

function realisation($connexion, $id_langue, $paire, $categorie)
{
    $sql = "SELECT * FROM categorie WHERE idLangue = $id_langue AND paire = $paire ;";
	$query = mysqli_query($connexion ,$sql);

	$tuple = mysqli_fetch_assoc($query);
	echo "<h3>" .$tuple['nom']. "</h3>\n";
			
	$sql = "SELECT * FROM realisation WHERE idLangue = $id_langue AND idCategorie = $categorie;";
	$count = "SELECT COUNT(*) FROM realisation WHERE idLangue = $id_langue AND idCategorie = $categorie;";
	$query = mysqli_query($connexion ,$sql); 
	$rows = mysqli_query($connexion,$count);

	$rez = mysqli_fetch_assoc($rows);

	$i=1;
	
	return $query;
}

function perso($connexion, $id_langue, $paire, $categorie)
{
    
    $query = realisation($connexion, $id_langue, $paire, $categorie);
    
    while ($tuple = mysqli_fetch_assoc($query) ){				

		echo "<div class=\"polaroid\">\n <img class=\"image_rea\" src=\"".$tuple['src_polaroid']."\" alt=\"".$tuple['alt']. "\"/>\n<div class=\"legende\">" . $tuple['Legende'] . "</div>\n</div>\n";
				echo "<div class=\"popup\"><img class=\"image\" src=\"".$tuple['src_polaroid']."\" alt=\"".$tuple['alt']. "\"/> </div>\n" ;
	    $i++;
	}
}

function logo($connexion, $id_langue, $paire, $categorie)
{
    $query = realisation($connexion, $id_langue, $paire, $categorie);
    
    while ($tuple = mysqli_fetch_assoc($query) ){				

		echo "<div>\n <img class=\"image_rea\" src=\"".$tuple['src_polaroid']."\" alt=\"".$tuple['alt']. "\"/></div>\n" ;
	    $i++;
	}
}
	 	
?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Portfolio Axelle PLE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/parallax.css">
	<link rel="stylesheet" type="text/css" href="css/banniere.css">
	<link rel="stylesheet" type="text/css" href="css/realisation.css">
	<!--
	<link rel="stylesheet" type="text/css" href="css/ensavoirplus.css">-->
	<link rel="stylesheet" type="text/css" href="css/parcours.css">
    <link rel="stylesheet" type="text/css" href="css/competence.css">
	<link rel="stylesheet" type="text/css" href="css/niveau.css">
	<link rel="stylesheet" type="text/css" href="css/memo.css">
	<link rel="stylesheet" type="text/css" href="css/loisir.css">
	<!--<link rel="stylesheet" type="text/css" href="css/contact.css">-->
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
	<input type="hidden" id="lang" value='<?php echo $langue ;?>'>
	<script type="text/javascript" src="./js/action.js"></script>
	<meta name="Description" content="Le portfolio de
	Axelle : Intégration Web du
	S2 du DUT MMI">
	<meta name="Keywords"
	content="MMI,Axelle Plé,S2,HTML,CSS">
	
</head>

<!-- ______________________________________________________________Bannière___________________________________________________________________-->


<body>


	<?php
if(isset($_POST["form"])){


$nom = $connexion->real_escape_string($_POST["nom"]);
$prenom = $connexion->real_escape_string($_POST["prenom"]);
$email = $connexion->real_escape_string($_POST["email"]);
$message = $connexion->real_escape_string($_POST["message"]);
/*$homme =real_escape_string($_POST["homme"]);
$femme=real_escape_string($_POST["femme"]);
$_signal=real_escape_string($_POST["_signal"]);
$autre=real_escape_string($_POST["autre"]);*/


if(!isset($_POST["genre"])){
	$genre = "N\A";
	
}
else{
	$genre = $_POST["genre"];
}
if(!isset($_POST["choix"])){
	$choix ="N\A";
 
}else{
	$choix = $_POST["choix"];
}



	if(!$connexion->query("INSERT INTO retour(genre,nom,prenom,email,choix,message) VALUES('$genre','$nom','$prenom','$email','$choix','$message')")){
		printf("Erreur : %s\n", $connexion->sqlstate);
	}else{
		echo"<script>if(document.getElementById('lang').value=='fr'){alert('Message envoyé :D');}else{alert('Message send :D');}</script>";
	}
}
?>


<header id='header'>
<!--<video id="video" autoplay="" poster="img/kingdomhearts.jpg" loop=""> <source src="Kingdom_Hearts.mp4" type="video/mp4"> </video>-->

<div class='content'>
    <!-- play boutton -->
    <!--<div class='menu-play'>
        <i id="btn_refresh" onclick="restart();" class="fa fa-refresh fa-lg"></i>
        <i id="btn_play"  class="fa fa-pause fa-lg"></i>
        <i id="btn_sound" class="fa fa-volume-off fa-lg"></i>
        <script type="text/javascript" src="./js/video.js"></script>
    </div>-->

<?php
$sql ="SELECT * FROM banniere  WHERE idLangue = $id_langue;";
$query =mysqli_query($connexion , $sql);
$tuple = mysqli_fetch_assoc($query);

echo "<div class='title'>".$tuple['texte']."</div>";

echo "<img class=\"logomoi\" src=\"" .$tuple['src']. "\" alt=\" ".$tuple['alt']. "\"/>";
echo "<div class='name'>Axelle Ple</div>";
$tuple = mysqli_fetch_assoc($query);

echo "<div class=\"description\">"  .$tuple['texte'];
$tuple = mysqli_fetch_assoc($query);
echo "<br>". $tuple['texte']. "</div>";

?>
</div>
</header>

<!-- parcours -->
<div class='secondsection'>
<section id = "Monparcours"> 
<?php

				$sql = "SELECT * FROM menu where idLangue = $id_langue AND href='#Monparcours';";				
				$query = mysqli_query($connexion, $sql);
				$tuple=mysqli_fetch_assoc($query);
	 			echo "<h2 class='soustitre2'> " . $tuple['titre'] . "</h2>" ;
	 			?>
	    <article>
	        <?php
	            parcours($connexion, $id_langue, 4, 7);
			?>
	    </article>
	    
        <article>
            <?php
                parcours($connexion, $id_langue, 5, 9);
			?>
        </article>
</section>

<section id="Mescompetences">

				<?php

				$sql = "SELECT * FROM menu WHERE idLangue = $id_langue AND href = '#Mescompetences'";
				$query = mysqli_query($connexion, $sql);
				$tuple=mysqli_fetch_assoc($query);
	 			echo "<h2> " . $tuple['titre'] . "</h2>" ;

	 			?>

		<?php

				$sql ="SELECT * FROM competences WHERE idLangue = $id_langue;";
	 			$query = mysqli_query($connexion, $sql);
	 			

				while ($tuple=mysqli_fetch_assoc($query)){
				    echo "<article>";
				    echo "<div>";
					echo "<h3>".$tuple['label']."</h3>";
					echo "<img class=\"taille\" " .$tuple['src']. " />";
					echo "</div>";
                    echo "<span>".$tuple['texte']."</span>";
                    echo "</article>";
				}
				?>
</section>

<section id= "Niveau" class='niveau'> 
<?php
                $sql = "SELECT * FROM menu WHERE idLangue = $id_langue AND href = '#Niveau'";
				$query = mysqli_query($connexion, $sql);
				$tuple=mysqli_fetch_assoc($query);
	 			echo "<h2> " . $tuple['titre'] . "</h2>" ;
	 			
				$sql = "SELECT * FROM niveau WHERE idLangue = $id_langue ;";
				$query = mysqli_query($connexion, $sql);
				$i=0;
				while ($tuple=mysqli_fetch_assoc($query)){
					echo "<article>
					    <h3></h3>
					    <div class=\"barre first\"> <div class='progressbarre' style='height:".$tuple['pourcent']."%;background-color:".$tuple['Color'].";'> </div>\n</div>\n";
					echo "<span>".$tuple['pourcent']."%</span>";
					echo "<img src=" . $tuple['src'] . ">";
					echo "</article>";
					$i++;
					
				}
				?>
</section>

</div>

<!--_________________________________________ Réalisation _________________________________________________________-->
<div class="Realisationbackground">
    	
<section id="Realisation">
	
	<?php
	$sql = "SELECT * FROM menu where idLangue = $id_langue AND href='#Realisation';";
		$query = mysqli_query($connexion, $sql);
		$tuple=mysqli_fetch_assoc($query);
	 echo "<h2 class=\"soustitre2\"> " . $tuple['titre'] . "</h2>" ;	
	 ?>
	 
	<article class="logo"> 
		
			<?php
			    logo($connexion, $id_langue, 6, 11);
			?>
	</article>
	
	<article class="untiers"> 		

			<?php
		        perso($connexion, $id_langue, 2, 3);
			?>

	</article>


	<article class="untiers"> 
		
			<?php
			    perso($connexion, $id_langue, 1, 1);
			 ?>


	</article>
	

	<article class="untiers"> 
		
			<?php
			    perso($connexion, $id_langue, 3, 5);
			?>
	</article>

</section>
</div>

<!--______________________________________________________A_vous_de_jouer__________________________________________-->
<div class="Memo"> 
<section id="Bonus">
	<?php

				$sql = "SELECT * FROM menu WHERE idLangue = $id_langue AND href ='#Bonus' ;";
				$query = mysqli_query($connexion, $sql);
				$tuple=mysqli_fetch_assoc($query);
	 			echo "<h2> " . $tuple['titre'] . "</h2>" ;

	 			?>
			<article>
				<?php
				    for ($i=0; $i<16; $i++)
				    {
				        echo "
				<img src='img/memo/dos.png' alt='carte'
								onclick=affiche_carte(this.id,".$i."); id='carte".($i+1)."'/>
				";
				    }
				?>
            </article>
		    <button type="button" aria-hidden="true" name="recommencer" id="recommencer" value="Recommencer"><li class="fa fa-refresh"></li><span><?php if($langue =="fr"){echo "Recommencer";}else{echo "Try Again";}?></span></button>
		    
            		<div id="visible" class="reussite">
					<div class= "positioncentrer"><span id="res1"></span>

					<button id="fermer" class="fa fa-times-circle-o" aria-hidden="true"> <span class="espace"> <?php if($langue =="fr"){echo "Fermer";}else{echo "Close";}?> </span></button>
						
						<script type="text/javascript">
							document.getElementById('fermer').onclick = function(){
								document.getElementById('visible').style = "visibility:hidden;"; 
							}
						</script>

					</div>
		</div>
		

		<input type="hidden" id="valeur" value="0">

			<script type="text/javascript">
					document.getElementById('recommencer').onclick = function(){
					shuffle(cartes);
					Init();
   					 var i=1;
   					 max = 17;
					for(i ; i<max;i++){
					tmp_id = "carte"+ i;
					
					var pict = document.getElementById(tmp_id)
					pict.src= "img/memo/dos.png" ;
					};
				}
			</script>

		<script type="text/javascript" src="js/memo.js"></script>		

		
</section>
</div>

<div class="loisirbackground"> 
<section id = "Mesloisirs"> 
<?php

				$sql = "SELECT * FROM menu WHERE idLangue = $id_langue AND href ='#Mesloisirs' ;";
				$query = mysqli_query($connexion, $sql);
				$tuple=mysqli_fetch_assoc($query);
	 			echo "<h2> " . $tuple['titre'] . "</h2>" ;


	 			$sql = "SELECT * FROM loisirs WHERE idLangue = $id_langue ;";
	 			$query = mysqli_query($connexion, $sql);
	 			$temp_int = 'intitule_'.$langue;
				while($tuple=mysqli_fetch_assoc($query)){
				    echo "<article>";
				    echo "<h3>".$tuple['label']."</h3>";
				    echo "<div>".$tuple['texte']."</div>";
				    echo "</article>";
				}
            ?>
</section>
</div>


<div class="blank"></div>

<!--______________________________________________________Footer__________________________________________-->

<footer class="navbar">
    <?php

	 	$sql = "SELECT * FROM menu  WHERE idLangue = $id_langue;";
		$query = mysqli_query($connexion, $sql);
		$tuple = mysqli_fetch_assoc($query);
	?>
  <div class='navmargin'>
    <div class = 'nav'>
    <?php
    while($tuple=mysqli_fetch_assoc($query)) {
		echo "<a href='{$tuple['href']}'>{$tuple['titre']}</a>";
    }
    ?>
    </div>
    <div class='link'>
        <a href="#" class="fa fa-google"></a>
        <a href="#" class='fa fa-twitter'></a>
        <a href="#" class='fa fa-linkedin'></a>
    </div>  
  </div>
</footer>

<!-- ________________________________________________________________FIN____________________________________________________________________________-->


</body>
</html>
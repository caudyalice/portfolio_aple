var cartes=['rc.png', 'dc.png','rp.png','dp.png','rt.png','dt.png','rca.png', 'dca.png', 'rc.png', 'dc.png','rp.png','dp.png','rt.png','dt.png','rca.png', 'dca.png'];

function shuffle(cartes){
	var temps;
	for(var i=0; i<cartes.length; i++){
		var pos= Math.floor(Math.random()*cartes.length);
		temps=cartes[i];
		cartes[i]=cartes[pos];
		cartes[pos]=temps;
  	}
}




var carte1;
var nb_paires=0;
var nb_clic = 0;
shuffle(cartes);
var langue = document.getElementById("lang").value;

function affiche_carte(id,i) {



	if(nb_clic == 2 || nb_paires==8) {
		if(langue == "en"){alert("Calm Down");}
		else{ alert("On se calme");}
	}
	else{
		var carte=document.getElementById(id);
		if (carte.src.indexOf('img/memo/dos.png') != -1){
			carte.src="img/memo/" +cartes[i];
			nb_clic ++;
			if (nb_clic==1){
				carte1=id;
			}
		
			if (nb_clic==2){
				if(carte.src==document.getElementById(carte1).src){
					nb_paires ++;
					if(nb_paires==8){
						document.getElementById('visible').style = "visibility:visible;"; 
						document.getElementById('res1').innerHTML="<h1>Bravo!</h1>";
					}
					nb_clic=0;
				}
				else{
					setTimeout(function(){
						carte.src="img/memo/dos.png";
						document.getElementById(carte1).src="img/memo/dos.png";
						nb_clic=0;
					}, 1000);
				}
			}
		}
	}
}

function Init(){
shuffle(cartes);

nb_paires=0;
nb_clic = 0;
}

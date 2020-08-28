
var dessins = ['st1' , 'st2' ,'st3','st4','st5','st6','st7'];

var next1 =document.getElementById('next1');
var col1 =document.getElementById('col1');

var div = document.getElementById('container');

next1.onclick = function(){
	var id1 =document.getElementById('id1');
		
	if(id1.value == dessins.length-1 ){
		id1.value=1;
	}else{
	var tmp = parseInt(id1.value) + 1 ;
	id1.value = 0;
	id1.value = tmp;

	}
	div.style.background-image = 'url(img/dessin/' + dessins[id1.value] + '.jpg)';
	
	/*alert('next_  ' + id1.value + '||' + dessins.length);*/
}
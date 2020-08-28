
	/* __INIT__ */
	var video = document.getElementById("video");
	var btn_play = document.getElementById('btn_play');
	var btn_sound = document.getElementById('btn_sound');
	var header= document.getElementsByTagName("HEADER")[0];
	video.muted=true;

    //header.style.height = video.style.height;

	/* _ONCLICK_FUNCTION_ */
	btn_play.onclick=function(){

		if(btn_play.className == "fa fa-pause fa-lg"){
			btn_play.className = "fa fa-play fa-lg";
		}
		else{
			btn_play.className = 'fa fa-pause fa-lg';
		}
		vidplay();
	}	

	btn_sound.onclick=function(){

		if(btn_sound.className == "fa fa-volume-off fa-lg"){
			btn_sound.className = "fa fa-volume-up fa-lg";
			video.muted = false;
		}
		else{
			btn_sound.className = 'fa fa-volume-off fa-lg';
			video.muted = true;
		}
	}	

	/* _VIDEO_FUNCTIONS_ */
	function vidplay() {
       
         if (video.paused) {
          video.play();
          
       } else {
          video.pause();
        
       }
    }
    
    function restart() {
        video.currentTime = 0;
    }


window.addEventListener("load", (event) => {
    console.log("General Kenobi !");
    
    let controls = document.getElementsByClassName("fa-play");
    let media = new Audio();
    
    active = true

    if (active == true) {

    }

    controls[0].addEventListener("click", function(){ 
        console.log('ok - play');
        media.src = "./assets/misc/home-resonance.mp3";
        media.play();
    });

    controls[0].addEventListener("click", function(){ 
        if(media.muted == true){
            media.muted = false;
        }

        else{
            media.muted = true;
        }
    });
    var isscrolling = false
    var i = 10;
    var int = setInterval(function() {
      window.scrollTo(0, i);
      i += 2;
      if (i >=document.body.scrollHeight ) clearInterval(int);
    }, 20);
    const autoScroll = document.getElementsByClassName("autoscroll")[0]
    autoScroll.addEventListener("click", function() {
       clearInterval(int)
    });
    
    
});
    
function changeBG(num){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if(num == 1){
        document.body.style.backgroundImage= "url('backgrounds/1.jpg')";
        }
        else if(num == 2){
        document.body.style.backgroundImage= "url('backgrounds/2.jpg')";
        }
        else if(num == 3){
            document.body.style.backgroundImage= "url('backgrounds/3.jpg')";
        }
        else if(num == 4){
            document.body.style.backgroundImage= "url('backgrounds/4.jpg')";
        }
        else if(num == 5){
            document.body.style.backgroundImage= "url('backgrounds/5.jpg')";
        }
        else {
            document.body.style.backgroundImage= "";
        }
    }
    xhttp.open("GET", "ajax_info.txt", true);
    xhttp.send();
}
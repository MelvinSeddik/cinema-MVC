function adjustSize(){
    let main = document.querySelector("main");
    let body = document.querySelector("body");
    
    if(main.scrollHeight < body.scrollHeight){
        main.style.height = body.scrollHeight + "px";
    }
    else{
        main.style.height = "";
    }
}

adjustSize();

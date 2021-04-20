//DATE DU JOUR VALEUR PAR DEFAUT
let today = new Date().toISOString().slice(0, 10);
let dateInput = document.querySelector("#date_film");
if(dateInput !== null){dateInput.setAttribute("value", today)};

//AJUSTEMENT DE HEIGHT

const selectMultiple = document.querySelectorAll(".multiple-select");
for(let select of selectMultiple){
    select.style.height = (select.scrollHeight + 2) + "px"; // ajuste la taille des select avec attribut multiple
}

const textareas = document.querySelectorAll(".textarea");
for(let textarea of textareas){
    textarea.style.height = (textarea.scrollHeight + 2) + "px"; // ajuste la taille d'un textearea et lui permet d'être resize
}

//

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

//AJOUT DYNAMIQUE DE CASTING
let nombre = 0;
let allCastings = [];
let allCastingNode = document.querySelectorAll(".added-casting");
for(let casting of allCastingNode){
    allCastings.push(casting);
}

let deleteCastings = document.querySelectorAll(".delete-casting");
for(trash of deleteCastings){
    trash.addEventListener("click", function(){
        for(let casting of allCastings){
            if(casting === this.parentNode){
                let index = allCastings.indexOf(casting);
                allCastings.splice(index, 1);
            }
        }
        this.parentNode.remove();

        for(let casting of allCastings){
            casting.firstChild.innerHTML = ("Casting ") + (allCastings.indexOf(casting) + 1);
        }
    })
}


fetch("fetch/acteurs.php")
.then((res) => res.json())
.then(acteurs => {
    fetch("fetch/roles.php")
    .then((res) => res.json())
    .then(roles => {
        
        document.querySelector("#add-casting").addEventListener("click", function(){

            let addedCastings = document.querySelectorAll(".added-casting");
            nombre = addedCastings.length + 1;



            
            const casting = document.querySelector("#casting");
        
            let div = document.createElement("div");
            div.classList.add("form-group", "added-casting");
            casting.appendChild(div)
        
            let title = document.createElement("h5");
            title.innerHTML = "Casting " + nombre;
            div.appendChild(title);
        
            let label = document.createElement("label");
            label.innerHTML = "Selectionnez un acteur";
            div.appendChild(label);
        
            let select = document.createElement("select");
            select.classList.add("custom-select", "custom-select-lg", "mb-3")
            select.setAttribute("name", "select_acteur[]")
            div.appendChild(select);
        
            for(let i in acteurs){
                let option = document.createElement("option");
                option.setAttribute("value", acteurs[i]["id"]);
                option.innerHTML = acteurs[i]["acteur"];
                select.appendChild(option);
            }

            
        
            let label2 = document.createElement("label");
            label2.innerHTML = "Selectionnez son rôle";
            div.appendChild(label2);
        
            let select2 = document.createElement("select");
            select2.classList.add("custom-select", "custom-select-lg", "mb-3")
            select2.setAttribute("name", "select_role[]");
            div.appendChild(select2);
        
            for(let i in roles){
                let option = document.createElement("option");
                option.setAttribute("value", roles[i]["id"]);
                option.innerHTML = roles[i]["personnage"];
                select2.appendChild(option);
            }

            let span = document.createElement("span");
            span.classList.add("btn", "btn-danger", "delete-casting");
            span.innerHTML = "<i class='margin-center fas fa-trash-alt'></i>";
            div.appendChild(span);

            allspans.push(span);
            allCastings.push(div);

            for(let span of allspans){

                span.addEventListener("click",function(){

                    if(span === this){
                        let index = allspans.indexOf(this);
                        allspans.splice(index, 1);
                        for(let casting of allCastings){
                            if(span.parentNode === casting){
                                let index = allCastings.indexOf(casting);
                                allCastings.splice(index, 1);
                                
                            }
                        }
                        this.parentNode.remove();
                        for(let casting of allCastings){
                            casting.firstChild.innerHTML = ("Casting ") + (allCastings.indexOf(casting) + 1);
                        }
                        adjustSize();
                    }                    
                })
            }
            adjustSize();

        });

        let allspans = [];
    })

});






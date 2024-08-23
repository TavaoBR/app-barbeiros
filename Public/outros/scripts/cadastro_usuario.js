var checkAdmin = document.getElementById("btnAdmin");
var camposAdmin = document.querySelectorAll(".check");


checkAdmin.addEventListener('click', () => {
  for (let current of camposAdmin) {
    if (current.checked) {
      current.checked = false;
    } else {
      current.checked = true;
    }
  }
});

var checkTecnicoTi = document.getElementById("btnTecTI");
var camposTecTi = document.querySelectorAll(".ti");

checkTecnicoTi.addEventListener('click', () => {
  for(let current of camposTecTi){
    if(current.checked){
        current.checked = false;
    }else{
        current.checked = true;
   }
  }
});


var checkTecnicoCequip = document.getElementById("btnTecCequi");
var camposTecCequip = document.querySelectorAll(".cequip");

checkTecnicoCequip.addEventListener('click', () => {
  for(let current of camposTecCequip){
    if(current.checked){
        current.checked = false;
    }else{
        current.checked = true;
    }
  }
});

var checkBasic = document.getElementById("btnBasic");
var camposBasic = document.querySelectorAll(".basic");

checkBasic.addEventListener('click', () => {
  for(let current of camposBasic){
    if(current.checked){
        current.checked = false;
    }else{
        current.checked = true;
    }
  }
});

var checkTecManu = document.getElementById("btnTecManu");
var camposTecManu = document.querySelectorAll(".manutencao");

checkTecManu.addEventListener('click', () =>{
 for(let current of camposTecManu){
    if(current.checked){
        current.checked = false;
    }else{
      current.checked = true;
    }
 }
});

var checkMedlynx = document.getElementById("btnMedlynx");
var camposMedlynx = document.querySelectorAll(".medlynx");

checkMedlynx.addEventListener('click', () =>{
 for(let current of camposMedlynx){
  if(current.checked){ 
    current.checked = false;
  }else{
    current.checked = true;
  }
 }
});



setTimeout(function(){
    $("#tempo").fadeOut("fast");
  }, 3000);


  $('#olho').mousedown(function(){
   $('#senha').attr('type', 'text');
  });

  $('#olho').mouseup(function(){
    $('#senha').attr('type', 'password');
   });


   $('#olho2').mousedown(function(){
    $('#confirma_senha').attr('type', 'text');
   });
 
   $('#olho2').mouseup(function(){
     $('#confirma_senha').attr('type', 'password');
  });
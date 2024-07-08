<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<style>
    ul{
  list-style: none;
}

.container-progress{
    max-width: 500px;
    width: 100%;
    margin: 10em auto;
    padding: 0 20px;   
}

.file-upload{
    position: relative;
    width: 100%;
    margin: 0 auto;
    padding: 7em 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5em;
    background-color: hsl(235deg 100% 99%);
    box-shadow: hsl(235deg 100% 78% / 30%) 0 25px 50px -12px;
}


.file-upload input{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 10;
}

.file-upload .icon{
    position: relative;
    margin-bottom: 5em;
}

.file-upload .icon ion-icon{
    font-size: 4em;
    color: hsla(235, 100%, 95%, 1);
    z-index: 1;
    position: relative;
}

.file-upload .icon::before, .file-upload .icon::after{
    content: '';
    width: 56px;
    height: 56px;
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 50%;
    border: 3px solid hsla(235, 100%, 78%, 1);
    background-color: hsla(235, 100%, 99%, 1);
    transform: scale(1.5);
    z-index: 1;
}

.file-upload .icon::after{
    border: 0;
    transform: scale(2.5);
    z-index: 0;
    background-color: hsla(235, 100%, 95%, 1);
}


.file-upload h3
{
    font-weight: 400;
    font-size: 1.5em;
    color: hsla(235, 100%, 78%, 1);
}

.file-upload button 
{
    border: 0;
    outline: 0;
    border-radius: 50%;
    color: white;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, hsla(235, 100%, 78%, 1) 0% hsla(222, 100%, 67%, 1) 100%);
    box-sizing: hsla(222, 100%, 67%, 1) 0 4px 18px;
    -webkit-transition: all .3s ease-out;
    transition: all .3s ease-out;
}

.file-upload button ion-icon{
    font-size: 1.5em;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
}

.file-upload:hover button
{
    -webkit-transform: translateY(-10px);
    transform: translateY(-10px);
}

.list-upload {
 padding: 0 2em;
}

.list-upload ul li{
 position: relative;
 display: flex;
 margin: 3em 0;
 padding-right: 2em;
}

.list-upload .thumbnail
{
  position: relative;
  width: 50px;
  height: 50px;
  margin-right: 20px;
  border-radius: 7px;
  background-color: hsla(235, 100%, 78%, 1);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.list-upload .thumbnail > ion-icon
{
  font-size: 2em;
  color: hsla(235, 100%, 99%, 1);
  display: none;
}

.file-list.image .thumbnail > [name="image-outline"]
{
  display: block;
}


.list-upload .thumbnail .completed 
{
  position: absolute;
  top: 50%;
  right: -10px;
  margin-top: -10px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #2ecc71;
  color: white;
  align-items: center;
  justify-content: center;
}

.list-upload .properties {
  display: flex;
  flex-direction: column;
  flex-basis: 100%;
  gap: 5px; 
}

.list-upload .properties .title
{
  word-break: break-word;
}

.list-upload .properties .size{
  color: #8f98ff;
  font-size: 12px;
}


.list-upload .properties :where(.progress,.buffer){
 position: relative;
 display: block;
 width: 100%;
 height: 2px;
 background-color: hsla(235, 100%, 95%, 1);
}

.list-upload .properties .buffer{
  width: 90%;
  -webkit-background: linear-gradient(90deg, #82f4b1 0%, #2ecc71 100%);
  background: linear-gradient(90deg, #82f4b1 0%, #2ecc71 100%);
}

.list-upload .properties .percentage{
  position: absolute;
  left: 0;
  top: 5px;
  font-size: 10px;
}

.list-upload .remove {
  position: absolute;
  right: 0;
  top: 50%;
  border: 0;
  outline: 0;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  border-radius: 50%;
  background-color: #ff6b81;
  color: white;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  -webkit-transition: all .3s ease-out;
  transition: all .3s ease-out;
}

.list-upload .remove:hover{
  background-color: #303030;
}

.list-upload :where(.completed, .remove) {
   display: none;
}
</style>

<div class="container">

<h2> Adicionar imagens a galeria</h2>

<div id="page" class="site">
    <div class="container-progress">
        <div class="file-upload">
             <input type="file" name="image" class="file-input"  accept="image/jpeg, image/png, image/jpg, image/webp" multiple>
             <input type="hidden" id="id" name="id" value="<?=$fk?>">
             <div class="icon">
               <ion-icon name="arrow-up-outline"></ion-icon>
             </div>
             <h3>Arraste e solte aqui</h3>
             <span>Ou</span>
             <strong>Procure o arquivo aqui</strong>
             <button class="btn btn-primary">
                <ion-icon name="close"></ion-icon>
             </button>
        </div>
        <div class="list-upload">
            <ul>

            </ul>
        </div>
    </div>
</div>
</div>


<script>
    document.querySelector('.file-input').addEventListener('change', function() {
    let id_album =  document.getElementById("id").value;
    let mime_types = []; 
    let size_mb = 100;

    var files_input = document.querySelector('.file-input').files;

    if(files_input.length == 0){
        alert('Erro: Nenhuma Imagem selecionada');
        return;
    }

    for(i = 0; i < files_input.length; i++)
    {
      let file = files_input[i];

      if(file.size > size_mb*1024*1024){
          alert("Error : Exceed size => " + file.name);
          return;
      }

       //console.log("You have choosen the file " + file.name);

       let uniq = 'id-' + btoa(file.name).replace(/=/g, '').substring(0.7);
       let filetype = file.type.match(/([^\/]+)\//);

       let li_ = `<li class="file-list image" id="${uniq}" data-filename="${file.name}">
                    <div class="thumbnail">
                        <ion-icon  name="image-outline"></ion-icon>
                        <span class="completed">
                            <ion-icon name="checkmark"></ion-icon>
                        </span>
                    </div>
                    <div class="properties">
                        <span class="title"><strong></strong></span>
                        <span class="size"></span>
                        <span class="progress">
                           <span class="buffer"></span>
                           <span class="percentage">0%</span>
                        </span>
                    </div>
                    <button class="remove">
                        <ion-icon name="close"></ion-icon>
                    </button>                  
                </li>`;


    document.querySelector('.list-upload ul').innerHTML = li_ + document.querySelector('.list-upload ul').innerHTML;
    let li_el = document.querySelector('#'+uniq)

    let name = li_el.querySelector('.title strong');
    let size_ = li_el.querySelector('.size');

    name.innerHTML = file.name;
    size_.innerHTML = bytesToSize(file.size);


    var data = new FormData();

    data.append('image', file);
    data.append('id', id_album);


    var request = new XMLHttpRequest();
    request.open('POST', "<?=routerConfig()?>/barbeiro/galeria/imagens");

    request.upload.addEventListener('progress', function(e){
      let li_el = document.querySelector('#'+uniq);
      let percent = Math.ceil((e.loaded / e.total)*100);
      li_el.querySelector('.buffer').style.width = percent + '%';
      li_el.querySelector('.percentage').innerHTML = percent + '%';
      li_el.querySelector('.percentage').style.left = percent + '%';

      if( e.loaded == e.total ) {
          li_el.querySelector('.completed').style.display = li_el.querySelector('.remove').style.display = 'flex';
          li_el.querySelector('.remove').addEventListener('click', function(){
              var data = new FormData();
              data.append('removeFile', file.name);
              var xhr = new XMLHttpRequest();
              xhr.open('POST', "<?=routerConfig()?>/barbeiro/galeria/imagens", true);
              xhr.onload = function () {
                 console.log(this.responseText);
                 li_el.remove();
              };
              xhr.send(data);
              alert(this.responseText);
          });
       }
    });

    request.addEventListener('load', function(e){
       console.log(request.response);  
       //alert("Arquivo: " + file.name + " Foi enviado com sucesso ", request.response);
    });
    
       request.send(data);
    }

    
  });

   function bytesToSize(bytes) {
      const units = ["byte", "kilobyte", "megabyte", "terabyte", "petabyte"];
      const unit = Math.floor(Math.log(bytes) / Math.log(2014));
      return new Intl.NumberFormat("en", {style: "unit", unit: units[unit]}).format(bytes / 1024 ** unit);
   }
</script>
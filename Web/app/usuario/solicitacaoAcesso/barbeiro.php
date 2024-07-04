<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<?php 
 if($conta > 0):

 $status = $data->status;

 switch($status){
     case 1:
        $status = "Solicitado";
     break;
     
     case 2: 
        $status =  "Em Andamento";
     break;
     
     case 3:
        $status =  "Aprovado";
     break;   

     case 4:
        $status = "Reprovado";
     break;   

     case 5:
       $status = "Cancelado";
     break;   
 }

?>


<style>
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: 0;
}
.btn-circle.btn-lg, .btn-group-lg>.btn-circle.btn {
    width: 50px;
    height: 50px;
    padding: 14px 15px;
    font-size: 18px;
    line-height: 23px;
}
.text-muted {
    color: #8898aa!important;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
}
.btn-circle {
    border-radius: 100%;
    width: 40px;
    height: 40px;
    padding: 10px;
}
.user-table tbody tr .category-select {
    max-width: 150px;
    border-radius: 20px;
}
</style>


<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">Sua solicitação de acesso</h5>
            </div>
            <div class="table-responsive">
                <table class="table no-wrap user-table mb-0">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 text-uppercase font-medium">#</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Status</th>
                      <th scope="col" class="border-0 text-uppercase font-medium">Data</th>
                         <?php
                           if($data->status != 3 OR $data->status != 4):
                          ?>
                                <th scope="col" class="border-0 text-uppercase font-medium">Alterar status</th>
                          <?php 
                             endif;
                          ?>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="pl-4"><?=$data->id?></td>
                      <td>
                          <span class="text-muted"><?=$status?></span><br>
                      </td>
                      <td>
                          <span class="text-muted"><?=date("d/m/Y", strtotime($data->data))?></span><br>
                      </td>

                        <?php
                          if($data->status != 3 OR $data->status != 4):
                        ?>
                      <td>
                      
                      
                
                      </td>

                      <?php 
                        endif;     
                       ?>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php 
 else:
?>

<h2> Nenhum dado encontrado</h2>


<?php 
 endif;
?>
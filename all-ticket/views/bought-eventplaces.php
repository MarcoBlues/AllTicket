<?php require_once(VIEWS_PATH."header.php") ?>


<section class="home_banner_area" >
<div class="banner_inner">
<div class="container">
<div class="banner_content">

<main class="py-5">
   <section id="listado" class="pad_top">
        <div class="container-fluid">
             <h2 class="">Plazas Disponibles</h2>
           <form method="POST" action="<?=FRONT_ROOT ?>Bought/AddCart">
             <table class="table bg-light-alpha ">
              <tr>
              <?php foreach ($calendary->getEventSquares() as $key=> $eventSquere) {?>
                
                  <td>
                      <div class="card" style="width:18rem; display:inline-flex; color:black">
                        <img class="card-img-top" src="..\views\img\clients-logo\c-logo-1.png" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title"><?=$calendary->getDate();?></h5>
                          <p class="card-text" style="color:black";>Las compras que superen las "5" entradas tiene un "15%" de decuento.</p>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Restantes:  <?= $eventSquere->getRemainings();?></li>
                          <li class="list-group-item">Precio:  <?= $eventSquere->getPrice();?></li>
                          <li class="list-group-item">Descripcion:  <?= $eventSquere->getEvenType()->getDesc();?></li>
                        </ul>
                        <div class="card-body">
                          CANTIDAD<input type="number" name="cart[<?=$key?>][0]" min=1 max="<?=$eventSquere->getRemainings();?>">
                          <input type="hidden" name="cart[<?=$key?>][1]" value="<?php echo $eventSquere->getId(); ?>">
                        </div>
                      </div>
                  </td>
                  <?php } ?>

              </tr>
          
             </table>
                <span id="result"></span>
                <br>
                <span id="total"></span>
                <br>
                <input type="hidden" name="calendaryId" value="<?= $calendary->getId(); ?>">
                <input type="submit" class="btn btn-success" value="CARGAR EN EL CARRITO">
              </form>
        </div>
   </section>
</main>
</div>
</div>
</div>
</section>

<?php require_once(VIEWS_PATH."footer.php") ?>

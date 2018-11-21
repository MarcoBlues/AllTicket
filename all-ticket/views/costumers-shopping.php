<?php
    require_once("header.php");
?>
<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
        <div class="banner_content">
          <main class="py-5">
               <section id="listado" class="pad-top">
                    <div class="container">
                        <h2 class="mb-4">Lista de compras de clientes</h2>

                        <table class="table bg-light-alpha" >
                              <thead class="thead-dark">
                                <th>Email Cliente</th>
                                <th>Fecha de compra</th>
                                <th>Cantidad de entradas</th>
                                <th>Total a pagar</th>
                                <th>Nombre del evento</th>
                              </thead>  
                              <tbody style="font-size:17px;">
                             
                                 <?php foreach($boughtList as $bought) { ?>
                                    <tr>

                                    <td><?=$bought->getClient()->getEmail(); ?></td>
                                    <td><?=$bought->getDate(); ?></td>
                                    <?php foreach($bought->getBuyLine() as $boughtLine) { ?>
                                        
                                        <td><?=$boughtLine->getQuantity(); ?></td>
                                        <td><?=$boughtLine->getPrice(); ?></td>
                                        <td><?=$boughtLine->getEventTitle(); ?></td>
                                    <?php } ?>
                                    </tr>
                                  <?php } ?>
                              </tbody>
                         </table>
                    </div>
                </section>
              
          </main>
        </div>
    </div>
    </div>
</section>

<?php require_once("footer.php"); ?>
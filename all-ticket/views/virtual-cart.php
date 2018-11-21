<?php require_once(VIEWS_PATH."header.php") ?>

<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
        <div class="banner_content">
          <main class="py-5">
               <section id="listado" class="pad-top">
                    <div class="container">
                         <h2 class="mb-4">Mi carrito</h2>
                          <h6>Las compras que superen las "5" entradas tiene un "15%" de decuento.</h6>
                         
                         <?php if(isset($boughtList)){ ?>
                        <table class="table bg-light-alpha">
                              <thead class="thead-dark">
                                <th>Nombre del evento</th>
                                <th>Cantidad</th>
                                <th>Precio UNITARIO</th>
                                <th>Precio TOTAL</th>
                                <th>Tipo de Plaza</th>
                                <th>Elimina de la lista</th>
                              </thead>  
                              <tbody>
                             
                                 <?php foreach($boughtList as $key=> $bought) { ?>
                                   <form action="<?php echo FRONT_ROOT ?>Bought/DeleteFromMyCart" method="post" >
                               
                                    <tr>

                                        <td><?=$bought->getEventTitle() ?></td>
                                        <td><?=$bought->getQuantity() ?></td>
                                        <td><?=$bought->getEventSquare()->getPrice() ?></td>
                                        <td><?=$bought->getPrice() ?></td>
                                        <td><?=$bought->getEventSquare()->getEventype()->getDesc() ?></td>
                                        <input type="hidden" name="position" value="<?=$key?>">
                                        <td><button class="fas fa-trash-alt" type="submit" ></button>
                                    </tr>
                                  </form>
                                  <?php 
                                  }
                                   ?>
                              </tbody>
                         </table>
                    </div>
               </section>


          
            <form action="<?php echo FRONT_ROOT ?>Bought/BuyTickets" method="POST">
                <input type="submit" class="btn btn-success" value="CARGAR EN EL CARRITO">
            </form>
        
               <?php 
               }
               ?>
                
          </main>
        </div>
    </div>
    </div>
</section>

<?php if(isset($purchaseList)){?>
    <section id="listado" class="pad-top">
        <div class="container">
             <h2 class="mb-30 mt-4 title_color"  align="center">Mi compras</h2>

             <table class="table bg-light-alpha">
                <thead class="thead-dark">
                    <th>Nombre del evento</th>
                    <th>Cantidad</th>
                    <th>Precio TOTAL</th>
                    <th>Fecha de compra</th>
                    <th>QR</th>
                </thead>  
                <tbody>

                <?php foreach($purchaseList->getBuyLine() as $purchase) { ?>
                    <tr>
                        
                        <td><?=$purchase->getEventTitle() ?></td>
                        <td><?=$purchase->getQuantity() ?></td>
                        <td><?=$purchase->getPrice() ?></td>
                        <td><?=$purchaseList->getDate()?></td>
                        <td >
                        <?php
                            
                            /*$image = imagecreatefromstring($purchase->getTicket()->getQrCode()); 

                            ob_start();
                            imagejpeg($image, null, 80);
                            $data = ob_get_contents();
                            ob_end_clean();*/
                            echo '<img height="150px" width="150px"" src="data:image/jpg;base64,' .  base64_encode($purchase->getTicket()->getQrCode())  . '" />';
                        
                        ?></td>
                    </tr>
                <?php } ?>


                </tbody>
             </table>
        </div>
    </section>
<?php } ?>

<?php require_once(VIEWS_PATH."footer.php") ?>

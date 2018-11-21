<?php require_once(VIEWS_PATH."header.php") ?>

<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
        <div class="banner_content">
          <main class="py-5">
               <section id="listado" class="mb-5">
                    <div class="container">
                         <h2 class="mb-4">Calendarios disponibles</h2>
                         <table class="table bg-light-alpha">
                              <thead class="thead-dark">
                                   <th>Titulo</th>
                                   <th>Categoria</th>
                                   <th>Fecha</th>
                                   <th>Artistas</th>
                                   <th>Info
                                   </th>

                              </thead>  
                              <tbody>
                             
                                 <?php foreach ($event->getCalendaries() as $calendary) {?>
                                   <form action="<?php echo FRONT_ROOT ?>Bought/BuyEventPlaces" method="post" >
                               
                                      <tr>
                                          <td><?= $event->getTitle(); ?></td>
                                          <td><?= $event->getCategory()->getName(); ?></td>
                                          <td><?= $calendary->getdate(); ?></td>
                                          <td><ul>
                                              <?php foreach ($calendary->getArtists() as $artist) {?>
                                                  <li><?= $artist->getName(); ?>  
                                                  <?= $artist->getLastName(); ?>
                                                  <?= $artist->getNickName(); ?></li>
                                              <?php } ?>
                                          </ul></td>

                                         <td>

                                           <input type="hidden" name="calendaryId" value="<?=$calendary->getId()?>">
                                         
                                          <input type="submit" sytle="" class="btn btn-success" value="Lugares Disponibles">

                                        </td>
                                  </form>
                                  
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

<?php require_once(VIEWS_PATH."footer.php") ?>

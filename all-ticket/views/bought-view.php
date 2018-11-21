<?php require_once(VIEWS_PATH."header.php") ?>

<section class="home_banner_area" >
<div class="banner_inner">
    <div class="container">
        <div class="banner_content">
            <main class="py-5">
                <section id="Listado" class="mb-4 mt-4">
                    <div class="container">
                        <br><br>
                        <h2 class="mb-4">Eventos disponibles</h2>
                        <table class="table">
                            <thead class="thead-head">
                            <th>Titulo</th>
                            <th>Categoria</th>
                            <th>Acceder al evento</th>
                            </thead>  
                            <tbody>
                                <?php
                                if(isset($eventList)) {
                                    foreach ($eventList as $key => $event) {?>
                                        <tr>
                                            <td><?php echo $event->getTitle();?></td>
                                            <td><?php echo $event->getCategory()->getName();?></td>
                                            <td>
                                                <form action="<?php echo FRONT_ROOT ?>Bought/ShowEventByCalendar" method="post">
                                                    <input type="hidden" name="eventId" id="eventId" value= <?= $event->getId()?> >
                                                    <button class="btn btn-info fas fa-arrow-right" type="submit" ></button>
                                                </form>  
                                            </td>
                                            </tr>
                                       <?php
                                   } 
                                }
                                else { 
                                    ?>
                                        <strong>¡No hay eventos disponibles para este evento!</strong>
                                    <?php
                                }?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>
</section>

<?php require_once(VIEWS_PATH."footer.php"); ?>



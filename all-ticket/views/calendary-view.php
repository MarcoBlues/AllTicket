<?php require_once(VIEWS_PATH."header.php") ?>

<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
    <div class="banner_content">
            <main class="py-5">
                 <section id="listado" class="mt-75">
                      <div class="container">
                           <h2 class="mb-4">Agregar calendario</h2>
                           <form method="post" action="<?php echo FRONT_ROOT ?>Calendary/AddCalendary" class="bg-light-alpha p-5">
                                <div class="row">
                                     <div class="col-lg-3">
                                          <div class="form-group">
                                               <label for="">Fecha</label>
                                               <input type="date" name="date" class="form-control" required>
                                          </div>
                                     </div>
                                     <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Eventos</label>
                                            <select name="eventList" class="form-control">
                                                <?php
                                                    if(isset($eventList))
                                                    {
                                                        foreach($eventList as $events)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $events->getId(); ?>"> <?php echo $events->getTitle(); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                     </div>
                                     <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Lugar</label>
                                            <select name="eventPlaceList" class="form-control">
                                                <?php
                                                    if(isset($eventPlaceList))
                                                    {
                                                        foreach($eventPlaceList as $eventPlace)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $eventPlace->getId(); ?>"> <?php echo $eventPlace->getDesc(); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                     </div>
                                     <div class="col-lg-3">
                                          <div class="form-group">
                                               <label for="">Horario</label>
                                               <input type="time" name="horary" class="form-control" required>
                                          </div>
                                     </div>
                                    <div class="container">
                                        <br>
                                        <h1 class="mb-4">Tipos de plaza</h1>
                                            <table class="table table-sm ">
                                                <thead class="table-head">
                                                    <th>Tipo</th>
                                                    <th>Disponibles</th>
                                                    <th>Precio</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if(isset($eventTypeList))
                                                        {
                                                            $i = 0;
                                                            foreach($eventTypeList as $eventType)
                                                            {
                                                                ?>
                                                                    <tr>
                                                                        <td><strong><?php echo $eventType->getDesc(); ?></strong></td>
                                                                        <td><input type="number" name="eventTypeInfo[<?= $i ?>][0]" class="form-control"></td>
                                                                        <td><input type="number" name="eventTypeInfo[<?= $i ?>][1]" class="form-control"></td>
                                                                        <td><input type="hidden" name="eventTypeInfo[<?= $i ?>][2]" class="form-control" value="<?= $eventType->getId(); ?>"></td>
                                                                    </tr>
                                                                <?php
                                                                $i++;
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                     </div>
                                </div>
                                <section id="listado" class="mb-5">
                                    <div class="container">
                                        <br>
                                        <h1 class="mb-4">Artistas Disponibles</h1>
                                         <table class="table table-sm ">
                                                <thead class="table-head">
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Apodo</th>
                                                    <th>Elegir</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if(isset($artistList))
                                                        {
                                                            $i = 0;
                                                            foreach($artistList as $artist)
                                                            {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $artist->getId() ?></td>
                                                                        <td><?php echo $artist->getName() ?></td>
                                                                        <td><?php echo $artist->getLastName() ?></td>
                                                                        <td><?php echo $artist->getNickName() ?></td>
                                                                        <td>
                                                                            <input type="checkBox" name="artistListId[<?= $i; ?>]" value="<?= $artist->getId(); ?>">
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                $i++;
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </section>
                                
                                <button type="submit" name="button" class="btn btn-success btn-lg right circle arrow">Agregar</button>
                           </form>
                      </div>
                     <strong><?php if(isset($message)) { echo $message; } ?></strong>
                 </section>
            </main>
        </div>
        </div>
    </div>
</section>

<section id="listado" class="mb-4 mt-4">
    <div class="container">
        <h2 class="mb-30 title_color progress-table-wrap" align="center">Listado de Calendarios</h2>
        <table class="table table-sm ">
            <thead class="table-head">
                <th>Código</th>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Fecha</th>
                <th>Lugar del evento</th>
                <th>Artistas</th>
            </thead>
             <tbody>
                        <?php
                            if(isset($calendarList))
                            {
                                foreach($calendarList as $calendary)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $calendary->getId();?></td>
                                            <td><?php echo $calendary->getEvent()->getTitle();?></td>
                                            <td><?php echo $calendary->getEvent()->getCategory()->getName();?></td>
                                            <td><?php echo $calendary->getDate();?></td>
                                            <td><?php echo $calendary->getEventPlaces()->getDesc();?></td>
                                            <td>
                                            <select class="form-control">
                                            <?php foreach ($calendary->getArtists() as $artist) { ?>
                                                <option><?php echo $artist->getNickName(); ?></option>
                                            <?php }?>
                                            </td>
                                            </select>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
        </table>
    </div>
</section>

<section id="eliminar-modificar">
    <div class="container"> 
        <div class="card-deck mb-3 text-center">  
            <div class="card mb-3 shadow-sm">
                <div class="card-header"><h4 class="my-0 font-weight-normal">Modificacion</h4></div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">NUEVOS DATOS</small></h1>
                    <form method="post" action="<?php echo FRONT_ROOT ?>Calendary/UpdateCalendary" class="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Codigo</span></div>
                            <input type="number" class="form-control" name="id" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Fecha</span></div>
                            <input type="date" class="form-control" name="name" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Modificar</button>
                    </form>
                </div>
            </div>
             <div class="card mb-3 shadow-sm">
                <div class="card-header"><h4 class="my-0 font-weight-normal">Cambiar estado</h4></div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">CODIGO</h1>
                    <form method="post" action="<?php echo FRONT_ROOT ?>Calendary/ChangeCalendaryState" class="">
                        <div class="input-group mb-3">
                        <input type="number" class="form-control" name="id" id="basic-url" aria-describedby="basic-addon3">
                         </div>
                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Cambiar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(VIEWS_PATH."footer.php") ?>
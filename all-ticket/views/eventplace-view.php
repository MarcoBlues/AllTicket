<?php require_once(VIEWS_PATH."header.php") ?>

<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
        <div class="banner_content">
            <main class="py-5">
                <section id="Agregacion" class="mb-5">
                    <div class="container">
                        <h2 class="mb-4">Agregar lugar de eventos</h2>
                        <form method="post" action="<?php echo FRONT_ROOT ?>EventPlace/AddEventPlace" class="bg-light-alpha p-5">
                            <div class="row" style="display: ruby;">
                                <div class="col-lg-4" >
                                    <div class="form-group">
                                        <label for="">Descripcion</label>
                                        <input type="text" name="desc" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Capacidad</label>
                                        <input type="text" name="slots" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button type="submit" name="button" class="btn btn-success btn-lg right circle arrow">Agregar</button>
                        </form>
                    </div>
                    <strong><?php if(isset($message)) { echo $message; } ?></strong>
                    <strong><?php if(isset($messageError)) { echo "<br><br>".$messageError; }?></strong>
                </section>
                </main>
            </div>
        </div>
    </div>
</section>

<section id="listado" class="mb-4 mt-4">
    <div class="container">
        <h2 class="mb-30 title_color progress-table-wrap" align="center">Listado de Lugar de Evento</h2>
        <table class="table table-sm">
            <thead class="table-head">
                <th>Código</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Estado</th>
            </thead>
            <tbody>
            <?php
                if(isset($eventPlaceList)) {
                    foreach($eventPlaceList as $eventPlace) {?>
                        <tr>
                            <td><?php echo $eventPlace->getId(); ?></td>
                            <td><?php echo $eventPlace->getDesc(); ?></td>
                            <td><?php echo $eventPlace->getSlots(); ?></td>
                            <td><?php  
                                if($eventPlace->getActive() == 1) {
                                    echo "Activo";
                                }
                                else {
                                    echo "Inactivo";
                                }
                            ?>
                            </td>
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
                    <form method="post" action="<?php echo FRONT_ROOT ?>EventPlace/UpdateEventPlace" class="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Codigo</span></div>
                            <input type="number" class="form-control" name="id" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Capacidad</span></div>
                            <input type="text" class="form-control" name="slots" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                         <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Descripcion</span></div>
                            <input type="text" class="form-control" name="desc" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Modificar</button>
                    </form>
                </div>
            </div>
            <div class="card mb-3 shadow-sm">
                <div class="card-header"><h4 class="my-0 font-weight-normal">Cambiar estado</h4></div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">CODIGO</h1>
                    <form method="post" action="<?php echo FRONT_ROOT ?>EventPlace/ChangeEventPlaceState" class="">
                        <div class="input-group mb-3">
                        <input type="number" class="form-control" name="id" id="basic-url" aria-describedby="basic-addon3" required></div>
                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Cambiar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once(VIEWS_PATH."footer.php") ?>
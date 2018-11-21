<?php require_once(VIEWS_PATH."header.php") ?>

<section class="home_banner_area">
    <div class="banner_inner">
    <div class="container">
        <div class="banner_content">
            <main class="py-5">
                <section id="Agregacion" class="mb-4 mt-4">
                <div class="container">
                    <h2 class="mb-4">Listado de clientes</h2>
                    <table class="table table-sm ">
                    <thead class="table-head">
                        <th>Código</th>
                        <th>Rol</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Email</th>
                        <th>Estado</th>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($clientList)) {
                            foreach($clientList as $client) {
                                ?>
                                <tr>
                                    <td><?php echo $client->getId(); ?></td>
                                    <td><?php echo $client->getRol(); ?></td>
                                    <td><?php echo $client->getUserName(); ?></td>
                                    <td><?php echo $client->getPassword(); ?></td>
                                    <td><?php echo $client->getEmail();?></td>
                                    <td><?php 
                                        if($client->getActive() == 1) {
                                            echo "Activo";
                                        }
                                        else {
                                            echo "Inactivo";
                                        }
                                    ?></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
        </div>
    </div>
</section>

<section id="eliminar-modificar">
    <div class="container mt-75" > 
        <div class="card-deck mb-3 text-center">  
            <div class="card mb-3 shadow-sm">
                <div class="card-header"><h4 class="my-0 font-weight-normal">Modificacion</h4></div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">NUEVOS DATOS</small></h1>
                    <form method="post" action="<?php echo FRONT_ROOT ?>Client/UpdateClient" class="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Codigo</span></div>
                            <input type="number" class="form-control" name="id" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Rol</span></div>
                            <input type="number" class="form-control" name="name" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Usuario</span></div>
                            <input type="text" class="form-control" name="name" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Contraseña</span></div>
                            <input type="password" class="form-control" name="name" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">Email</span></div>
                            <input type="text" class="form-control" name="name" id="basic-url" aria-describedby="basic-addon3" required>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Modificar</button>
                    </form>
                </div>
            </div>
             <div class="card mb-3 shadow-sm">
                <div class="card-header"><h4 class="my-0 font-weight-normal">Cambiar estado</h4></div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">CODIGO</h1>
                    <form method="post" action="<?php echo FRONT_ROOT ?>Client/ChangeClientState" class="">
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
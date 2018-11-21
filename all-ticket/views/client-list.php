<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de clientes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Código</th>
                         <th>Usuario</th>
                         <th>Password</th>
                         <th>Email</th>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($clientList))
                            {
                                foreach($clientList as $client)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $client->getId() ?></td>
                                            <td><?php echo $client->getUserName() ?></td>
                                            <td><?php echo $client->getPassword() ?></td>
                                            <td><?php echo $client->getEmail() ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
               </table>
          </div>
     </section>

     <section id="eliminar">
          <div class="container">
               <h2 class="mb-4">Eliminar cliente</h2>

               <form method="post" action="<?php echo FRONT_ROOT ?>Client/Delete" class="form-inline bg-light-alpha p-5">
                    <div class="form-group text-white">
                         <label for="">Código</label>
                         <input type="text" name="id" value="" class="form-control ml-3">
                    </div>
                    <button type="submit" name="button" class="btn btn-danger ml-3">Eliminar</button>
               </form>
          </div>
     </section>
</main>
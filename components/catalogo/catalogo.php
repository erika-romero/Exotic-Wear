<?php
  include 'carrito.php';
  include 'templates/cabecera.php';
?>


    <br>
    <?php if($mensaje!=""){?>
      <div class="alert alert-success" role="alert" style="color: black;">
    <?php echo $mensaje;?>
      <a href="./mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
    </div>
    
    <?php }?>
    
    <div class="row">
      <?php
        $sentencia=$connection->prepare("select * from inventario");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        //print_r($listaProductos);
      ?>
      <?php foreach($listaProductos as $producto){?>
        <div class="col-3">
          <div class="card">
            <img 
            class="card-img-top" 
            src="<?php echo $producto['Imagen'];?>" 
            alt="<?php echo $producto['Descripcion'];?>"
            >
            <div class="card-body">
              <span><?php echo $producto['Nombre'];?></span>
                <h5 class="card-title">$<?php echo $producto['Precio'];?></h5>
              <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                <input type="hidden" name="descripcion" id="descripcion" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);;?>">
                <button class="btn btn-dark" 
                type="submit" 
                name="btnAccion" 
                value="Agregar">Agregar al carrito</button>
              </form>
              
            </div>
          </div>
      </div>
      <?php } ?>
      
    </div>


  </div>
<?php
  include 'templates/pie.php';
?>


  

<?php
  include '../login/bd/conexion.php';
  include 'carrito.php';
  include 'templates/cabecera.php';
?>


    <br>

    <div class="alert alert-success" role="alert" style="color: black;">
    <?php echo $mensaje;?>
      
      <a href="#" class="badge badge-success">Ver carrito</a>
    </div>
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
            src="<?php echo $producto['imagen'];?>" 
            alt="<?php echo $producto['descripcion'];?>"
            >
            <div class="card-body">
              <span><?php echo $producto['descripcion'];?></span>
                <h5 class="card-title">$<?php echo $producto['precio'];?></h5>
              <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'],COD,KEY);?>">
                <input type="hidden" name="descripcion" id="descripcion" value="<?php echo openssl_encrypt($producto['descripcion'],COD,KEY);?>">
                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY);?>">
                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);;?>">
                <button class="btn btn-primary" 
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


  

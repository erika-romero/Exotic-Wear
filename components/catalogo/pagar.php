<?php
  include './carrito.php';
  include './templates/cabecera.php';
?>

<?php 
    if($_POST){
        $total=0;
        $SID=session_id();
        $Correo=$_POST['email'];
        $VAR=1;

        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
        }
        $sentencia=$connection->prepare("INSERT INTO ventas
        (ID, ClaveTransaccion, PaypalDatos, Fecha, Correo, Total, Status) 
        VALUES (1, :ClaveTransaccion, '', NOW(), :Correo,:Total, 'pendiente');");
        
        $sentencia->bindParam(":ClaveTransaccion",$SID);
        $sentencia->bindParam(":Correo",$Correo);
        $sentencia->bindParam(":Total",$total);
        $sentencia->execute();
        $idVenta=$connection->$VAR;

        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $sentencia=$connection->prepare("INSERT INTO detalleventa 
            (ID, IDVENTA, IDPRODUCTO, PRECIOUNITARI, CANTIDAD, DESCARGADO) VALUES (1, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");
        }

        $sentencia->bindParam(":IDVENTA",$idVenta);
        $sentencia->bindParam(":IDPRODUCTO",$$producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
        $sentencia->execute();
    }

?>





<?php
  include './templates/pie.php';
?>
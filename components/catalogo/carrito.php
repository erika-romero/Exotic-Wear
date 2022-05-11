<?php
  include '../login/bd/conexion.php';
session_start();

$mensaje="";
if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje.="ID correcto: ".$ID."<br/>";
            }else{
                $mensaje.="ID incorrecto ";
            }
           if(is_string(openssl_decrypt($_POST['descripcion'],COD,KEY))){
                $DESCRIPCION=openssl_decrypt($_POST['descripcion'],COD,KEY);
                $mensaje.="Descripcion correcta: ".$DESCRIPCION."<br/>";
            }
            else{
                $mensaje.="Descripcion incorrecta";
            }
            if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="Cantidad correcta: ".$CANTIDAD."<br/>";
            }else{
                $mensaje.="Error con la cantidad";break;
            }
            if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="Precio correcto: ".$PRECIO."<br/>";
            }else{
                $mensaje.="Error con el precio";break;
            }
        if(!isset($_SESSION['CARRITO'])){
            $producto=array(
                'ID'=>$ID,
                'DESCRIPCION'=>$DESCRIPCION,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO
            );
            $_SESSION['CARRITO'][0]=$producto;
        }else{
            $numeroProductos=count($_SESSION['CARRITO']);
            $producto=array(
                'ID'=>$ID,
                'DESCRIPCION'=>$DESCRIPCION,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO
            );
            $_SESSION['CARRITO'][$numeroProductos]=$producto;
        }
        //$mensaje=print_r($_SESSION,true);
        $mensaje="Producto agregado al carrito";


        break;
        case 'Eliminar':
            if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
            foreach ($_SESSION['CARRITO'] as $indice => $producto) {
               if($producto['ID']==$ID){
                   unset($_SESSION['CARRITO'][$indice]);
                   //$_SESSION['CARRITO']=array_values($_SESSION["CARRITO"]); 
                   echo"<script>alert('Elemento eliminado...');</script>";
               }
            }
            }
        break;
    }
}

?>
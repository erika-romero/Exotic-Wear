<?php
  include './carrito.php';
  include './templates/cabecera.php';
?>

<?php 
    if($_POST){
        $total=0;
        $SID=session_id();
        $Correo=$_POST['email'];

        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
        }
        $sentencia=$connection->prepare("INSERT INTO ventas
        (ID, ClaveTransaccion, PaypalDatos, Fecha, Correo, Total, Status) 
        VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo,:Total, 'pendiente');");
        
        $sentencia->bindParam(":ClaveTransaccion",$SID);
        $sentencia->bindParam(":Correo",$Correo);
        $sentencia->bindParam(":Total",$total);
        $sentencia->execute();
        $idVenta=$connection->lastInsertId();

        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $sentencia=$connection->prepare("INSERT INTO detalleventa 
            (ID,IDVENTA, IDPRODUCTO, PRECIOUNITARIO, CANTIDAD, DESCARGADO) VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");
        

        $sentencia->bindParam(":IDVENTA",$idVenta);
        $sentencia->bindParam(":IDPRODUCTO",$producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
        $sentencia->execute();
    
      }
      //echo "<h3>".$total."</h3>";
    }
?>
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
<style>
        /* Media query for mobile viewport */
        @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100%;
                justify-content: center;

            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px;
                display: inline-block;
            }
        }
    </style>

<div class="jumbotron text-center" style="background-color: #FBF5CC;">
  <h1 class="display-4">¡Paso Final!</h1>
  <hr class="my-4">
  <p class="lead">Estas a punto de pagar con PayPal la cantidad de:
      <h4>$<?php echo number_format($total,2)?></h4>
      <div id="paypal-button-container"></div>
  </p>
  <p>Los productos se enviarán una vez que se procese el pago.
  <strong>(Si tienes dudas escribe un correo a: erika.romero01@correo.usa.edu.co)</strong>
  </p>
</div>
<script>
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $total?>', 
                            description: "Compra de productos:$<?php echo number_format($total,2);?>",
                            custom:"<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta,COD,KEY);?>"
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    window.location="verificador.php?id="+orderData.id;
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';
                });
            }


        }).render('#paypal-button-container');
    </script>

<?php
  include './templates/pie.php';
?>
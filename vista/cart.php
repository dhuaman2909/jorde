<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "../clases/conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="./bootstrap.min.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Carrito</h1>
			<a href="./products.php" class="btn btn-default">Productos</a>
			<br><br>
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$Cnx = new Conexion();
$cadena = $Cnx->AbrirConexion();
$Query = "select * from producto";
$products = mysqli_query($cadena,$Query);

$Cnx->CerrarConexion($cadena);

if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
?>
<table class="table table-bordered">
<thead>
	<th>Cantidad</th>
	<th>Producto</th>
	<th>Imagen</th>
	<th>Precio Unitario</th>
	<th>Total</th>
	<th></th>
</thead>
<?php 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
foreach($_SESSION["cart"] as $c):
	$Cnx = new Conexion();
	$cadena = $Cnx->AbrirConexion();
	$Query = "select * from producto where id=$c[product_id]";
	$products = mysqli_query($cadena,$Query) ;
	$Cnx->CerrarConexion($cadena);

$r = $products->fetch_object();
	?>
<tr>
<th><?php echo $c["q"];?></th>
	<td><?php echo $r->nombre;?></td>
	<td><img src="../vista<?php echo $r->foto;?>" style="width: 85px; height:85px"></td>
	<td>S/. <?php echo $r->precio; ?></td>
	<td>S/. <?php echo $c["q"]*$r->precio; ?></td>
	<td style="width:260px;">
	<?php
	$found = false;
	foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->id){ $found=true; break; }}
	?>
		<a href="../logica/delfromcart.php?id=<?php echo $c["product_id"];?>" class="btn btn-danger">Eliminar</a>
	</td>
</tr>
<?php endforeach; ?>
</table>

<form class="form-horizontal" method="post" action="../logica/process.php">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email del cliente</label>
    <div class="col-sm-5">
      <input type="email" name="email" required class="form-control" id="inputEmail3" placeholder="Email del cliente">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">	
	  <input type="checkbox" name="cb-aceptar" value="aceptar"> <a href="../vista/tyc.php">ACEPTO TERMINOS Y CONDICIONES</a>
      <button type="submit" class="btn btn-primary">Procesar Venta</button>
    </div>
  </div>
</form>


<?php else:?>
	<p class="alert alert-warning">El carrito esta vacio.</p>
<?php endif;?>
<br><br><hr>


		</div>
	</div>
</div>
</body>
</html>
<?php 
session_start();
include "../clases/conexion.php";
if(!empty($_POST)){
	$Cnx = new Conexion();
	$cadena = $Cnx->AbrirConexion();
	$Query = "insert into cliente(correo,fecha_compra) value(\"$_POST[email]\",NOW())";

	$q1 = mysqli_query($cadena,$Query);
	if($q1){
		$Query = "select max(1) from cliente";
		$resultado = mysqli_query($cadena, $Query);
		if($data = mysqli_fetch_row($resultado))
			$cart_id = $data[0];
			
			foreach($_SESSION["cart"] as $c){
				$Query = "insert into carrito_compra(id_producto,id_cliente,cantidad) value($c[product_id],$cart_id,$c[q])";
				$q1 = mysqli_query($cadena, $Query);
			}
			$Cnx->CerrarConexion($cadena);
			unset($_SESSION["cart"]);
		}
}

	print "<script>alert('Venta procesada exitosamente');window.location='../vista/products.php';</script>";
	?>
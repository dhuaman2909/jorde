<?php
class Conexion
{
	private $usuario;
	private $clave;
	private $servidor;
	private $basededatos;

	function __construct()
	{
		$this->usuario = "root";
		$this->clave = "";
		$this->servidor = "localhost";
		$this->basededatos = "proyecto";
	}

	function AbrirConexion()
	{
		$cadena = mysqli_connect($this->servidor,$this->usuario,$this->clave,$this->basededatos);
		if($cadena)
		{
			return $cadena;
		}
		else
		{
			return "Error".mysqli_error();
		}
	}

	function CerrarConexion($cadena)
	{
		mysqli_close($cadena);
		$cadena = null;
	}
}

?>
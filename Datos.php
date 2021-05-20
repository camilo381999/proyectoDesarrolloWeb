<?php
include_once('Conexion.php');
include_once('Datos.php');

class Datos extends Conexion
{

	function __construct() {
		$this->db = parent::__construct();
	}

	public function selectAll()	{
		$statement = $this->db->prepare("SELECT (SELECT COUNT(Delito) FROM `siedco_datos_detallados__2_` WHERE Mes='ENE') AS 'ENERO',(SELECT COUNT(Delito) FROM `siedco_datos_detallados__2_` WHERE Mes='FEB') AS 'FEBRERO',(SELECT COUNT(Delito) FROM `siedco_datos_detallados__2_` WHERE Mes='MAR') AS 'MARZO' FROM siedco_datos_detallados__2_");
		$statement->execute();

		$result = $statement->fetch();
		return $result;
	}

    public function selectByLocalidad($localidadDB)	{
		$statement = $this->db->prepare("SELECT (SELECT COUNT(Delito) FROM `siedco_datos_detallados__2_` WHERE Localidad=:localidadDB AND Mes='ENE') AS 'ENERO',(SELECT COUNT(Delito) FROM `siedco_datos_detallados__2_` WHERE Localidad=:localidadDB AND Mes='FEB') AS 'FEBRERO',(SELECT COUNT(Delito) FROM `siedco_datos_detallados__2_` WHERE Localidad=:localidadDB AND Mes='MAR') AS 'MARZO' FROM siedco_datos_detallados__2_");
		
        $statement->bindParam(':localidadDB', $localidadDB);
        $statement->execute();
		$result = $statement->fetch();
		return $result;
	}

}
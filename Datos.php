<?php
include_once('Conexion.php');
include_once('Datos.php');

class Datos extends Conexion
{

	function __construct() {
		$this->db = parent::__construct();
	}
//datos_hurto_personas
	public function selectAll()	{
		$statement = $this->db->prepare("SELECT (SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='ENE') AS 'ENERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='FEB') AS 'FEBRERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='MAR') AS 'MARZO', (SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='ABR') AS 'ABRIL' FROM datos_hurto_personas");
		$statement->execute();

		$result = $statement->fetch();
		return $result;
	}

    public function selectByLocalidad($localidadDB)	{
		$statement = $this->db->prepare("SELECT (SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='ENE') AS 'ENERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='FEB') AS 'FEBRERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='MAR') AS 'MARZO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='ABR') AS 'ABRIL' FROM datos_hurto_personas");
		
        $statement->bindParam(':localidadDB', $localidadDB);
        $statement->execute();
		$result = $statement->fetch();
		return $result;
	}

}
<?php
include_once('Conexion.php');
include_once('Datos.php');

class Datos extends Conexion
{

	function __construct() {
		$this->db = parent::__construct();
	}

	//datos_hurto_personas en general
	public function selectAll()	{
		$statement = $this->db->prepare("SELECT (SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='ENE') AS 'ENERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='FEB') AS 'FEBRERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='MAR') AS 'MARZO', (SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Mes='ABR') AS 'ABRIL' FROM datos_hurto_personas");
		$statement->execute();

		$result = $statement->fetch();
		return $result;
	}

	public function selectModalidad()	{
		$statement = $this->db->prepare("SELECT Modalidad, COUNT(Mes) AS Contado FROM `datos_hurto_personas` GROUP BY `Modalidad` ORDER BY `Contado` DESC");
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	public function selectMomento()	{
		$statement = $this->db->prepare("SELECT `Rango del Dia`, COUNT(Mes) AS Contado FROM `datos_hurto_personas` GROUP BY `Rango del Dia` ORDER BY `Contado` DESC");
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	public function selectGenero()	{
		$statement = $this->db->prepare("SELECT `Sexo`, COUNT(Mes) AS Contado FROM `datos_hurto_personas` GROUP BY `Sexo` ORDER BY `Contado` DESC LIMIT 2");
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	//datos_hurto_personas por localidad
    public function selectByLocalidad($localidadDB)	{
		$statement = $this->db->prepare("SELECT (SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='ENE') AS 'ENERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='FEB') AS 'FEBRERO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='MAR') AS 'MARZO',(SELECT COUNT(Delito) FROM `datos_hurto_personas` WHERE Localidad=:localidadDB AND Mes='ABR') AS 'ABRIL' FROM datos_hurto_personas");
		
        $statement->bindParam(':localidadDB', $localidadDB);
        $statement->execute();
		$result = $statement->fetch();
		return $result;
	}

	public function selectModalidadByLocalidad($localidadDB)	{
		$statement = $this->db->prepare("SELECT Modalidad, COUNT(Mes) AS Contado FROM `datos_hurto_personas` WHERE Localidad=:localidadDB GROUP BY `Modalidad` ORDER BY `Contado` DESC");
		$statement->bindParam(':localidadDB', $localidadDB);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	public function selectMomentoByLocalidad($localidadDB) {
		$statement = $this->db->prepare("SELECT `Rango del Dia`, COUNT(Mes) AS Contado FROM `datos_hurto_personas` WHERE Localidad=:localidadDB GROUP BY `Rango del Dia` ORDER BY `Contado` DESC");
		$statement->bindParam(':localidadDB', $localidadDB);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	public function selectGeneroByLocalidad($localidadDB)	{
		$statement = $this->db->prepare("SELECT `Sexo`, COUNT(Mes) AS Contado FROM `datos_hurto_personas` WHERE Localidad=:localidadDB GROUP BY `Sexo` ORDER BY `Contado` DESC LIMIT 2");
		$statement->bindParam(':localidadDB', $localidadDB);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

}
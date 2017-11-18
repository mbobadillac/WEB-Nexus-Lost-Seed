<?php

    header('Content-Type: application/JSON');                
        $method = $_SERVER['REQUEST_METHOD']; 
		$request=$_SERVER['REQUEST_URI'];
		
		
    	// Create connection
		$conn = new mysqli("mysql.hostinger.com.ar", "u469258120_admin", "pEcS3JFhwHMp", "u469258120_nexus");
		// Check connection
		if ($conn->connect_error) {
		    $resultado="Connection failed: " . $conn->connect_error;
		} 
		else {
			$resultado="conexion ok -- ";
		}
			
		
        switch ($method) {
        case 'GET'://consulta
			$result = $conn->query("select * from Usuarios");
			
			if ($result->num_rows > 0) {
		    	$resultado = $result->num_rows." results";
				$primero=true;
				echo '{"Usuarios":[';
				while($row = $result->fetch_assoc()) {
					if($primero!=true)
					{
						echo ',';
					}
					else {
						$primero=false;
					}
		            echo '{
		            	"usuario":"'.$row["X_NOMBRE"].'",
		            	"clave":"'.$row["X_CLAVE"].'"
					}';
    			}
				echo ']}';
			} 
			else {
		    	$resultado = "0 results";
				
	            echo '{
	            	"metodos":"get",
	            	"acciones":"'.$request.'",
	            	"resultado":"'.$resultado.'"
				}';
			}
			
            break;     
        case 'POST'://inserta
        	$datosPUT = fopen("php://input", "r");
			while ($datos = fread($datosPUT, 1024))
			{
				$obj = json_decode($datos);
	            echo '{
		            	"metodos":"post",
		            	"datos":"'.$obj->{'Nombre'}.' '.$obj->{'Clave'}.'"
					}';
			}
            break;                
        case 'PUT'://actualiza
        	$datosPUT = fopen("php://input", "r");
			while ($datos = fread($datosPUT, 1024))
			{
				$obj = json_decode($datos);
	            echo '{
		            	"metodos":"put",
		            	"datos":"'.$obj->{'Nombre'}.' '.$obj->{'Clave'}.'"
					}';
			}
            break;      
        case 'DELETE'://elimina
        	$datosPUT = fopen("php://input", "r");
			while ($datos = fread($datosPUT, 1024))
			{
				$obj = json_decode($datos);
	            echo '{
		            	"metodos":"delete",
		            	"datos":"'.$obj->{'Nombre'}.' '.$obj->{'Clave'}.'"
					}';
			}
            break;
        default://metodo NO soportado
            echo 'METODO NO SOPORTADO';
            break;
        }
    
?>
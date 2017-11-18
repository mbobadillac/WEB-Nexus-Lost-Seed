<?php
    class Listado
	{
		
		
	    // Declaración de un método
	    public function muestraUsuarios() {
	    	// Create connection
			$conn = new mysqli("mysql.hostinger.com.ar", "u469258120_admin", "pEcS3JFhwHMp", "u469258120_nexus");
			// Check connection
			if ($conn->connect_error) {
			    $resultado="Connection failed: " . $conn->connect_error;
			} 
			else {
				$resultado="conexion ok -- ";
			}
			
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
	    }
	}
?>
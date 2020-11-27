
<?php




     

if( $_POST['mun'] == "moschato"){
     


			$con_mosxato = pg_connect ("host=185.4.132.140 dbname=Mosxato_admin user=user password=user");


    
		  $query  = "INSERT INTO mosxato_ebodia(mun,date,descript,geog,odos,arithmos) VALUES ('$_POST[mun]','$_POST[date]','$_POST[descript]',ST_MakePoint('$_POST[lng]','$_POST[lat]'),'$_POST[odos]','$_POST[arithmos]')";
		
	$query = pg_query($query);
		if($query)
		  echo "inserted successfully!";
		else{
		  echo "There was an error! ".pg_last_error();
		}
		}

		else{
			
		$con_alimos = pg_connect ("host=185.4.132.140 dbname=Alimos_admin user=user password=user");
			 
		 $query  = "INSERT INTO alimos_ebodia(mun,date,descript,geog,odos,arithmos) VALUES ('$_POST[mun]','$_POST[date]','$_POST[descript]',ST_MakePoint('$_POST[lng]','$_POST[lat]'),'$_POST[odos]','$_POST[arithmos]')";

			$query = pg_query($query);
		if($query)
		  echo "inserted successfully!";
		else{
		  echo "There was an error! ".pg_last_error();
		}
		
		
		
		}






?>


<?php
	
	require('functions.php');
	session_start();
	is_logged();
	if (isset($_GET["destination"])){
	$destination=$_GET['destination'];
	$checkin=$_GET['checkin'];
	$checkout=$_GET['checkout'];
	$guests=$_GET['guests'];
	
	}
	$url="https://beta.id90travel.com/api/v1/hotels.json";
	 if (isset($_GET["page"])) {
        $page =(int) $_GET["page"];
    }else{
	$page=1;
	}
	
	unset($_GET['page']);
	$parametersUrl = http_build_query($_GET);	
	$parametersGet = array(
			   "currency" => "USD",
			   "destination" => $destination,
			   "guests[]" => $guests,
			   "checkin" => $checkin,
			   "checkout" => $checkout,
			   "rooms" => 1,
			   "sort_criteria" => "Overall",
			   "sort_order" => "desc",
			   "per_page" => 30,
			   "page" => $page
			   
			);
	$getData='';	
	$result=httpGetP($url, $parametersGet);
	$arrayResult=json_decode($result,true);
	$meta=$arrayResult['meta'];
	$totalPages=$meta['total_pages'];	
	$tableHotels=drawTable($arrayResult['hotels']);
	$paginator=drawPaginator($page,$totalPages,$parametersUrl);
	
	function drawTable($hotels){
				$table='';
				$countHotels=sizeof($hotels);
				
				if ( $countHotels > 0) {
				$table .= "<div id=\"contendorTabla\">";
				
			
				$table .= "<table>". "\n";
				$table .= "<thead>". "\n";
				$table .= "<tr>"."\n"."<th>ID</th>";
				$table .= "<th>Nombre</th>";
				$table .= "<th>Pais</th>";
				$table .= "<th>Estrellas</th>"."\n"."</tr>"."\n";
				$table .= "</thead>". "\n";
				$table .= "<tbody>". "\n";
				foreach($hotels as $hotel){
					$table.="<tr>"."\n";
					$table.= "<td>" . $hotel['id'] . "</td>";
					$table.= "<td>" . $hotel['name'] . "</td>";
					$table.= "<td>" . $hotel['location']['country'] . "</td>";;
					$table.= "<td>" . $hotel['star_rating'] . "</td>"."\n";
					$table.="</tr>"."\n";
				
				}
				$table .= "</tbody>". "\n";
				$table .= "</table>". "\n";
				$table .= "</div>";	
				}
				else{
				$table = "<div style=\"text-align:center\">";	
				$table .= "<span> No se encontraron resultados </span>";
				$table .= "</div>";	
				}
				return $table;
	}
	
	function drawPaginator($actualPage,$totalPages,$urlParameters){
				$output='';
				$output.="<div id=\"contendorPaginador\">";								
				$output.="<ul class='pagination'>";

				if ($actualPage > 1){ 
					$output.="<li> <a href=\"?".$urlParameters."&page=".($actualPage-1)."\"> Anterior </a> </li>";
					}else{ 
					$output.="<li  class='disabled'> <a> Anterior </a> </li>";
				}
				$output.="\n";
			
				for ($i = 1; $i <= $totalPages; $i++) { 
					$output.="\n";
					if ($i==$actualPage){
					$output.="<li class='active'> <a>". $i ."</a> </li>";
					 }else{ 
					$output.="<li> <a href=\"?".$urlParameters."&page=".$i. "\">".$i." </a> </li>";
					 } 
				}
				$output.="\n";
						
				if ($actualPage < $totalPages){ 
				$output.="<li> <a href=\"?".$urlParameters."&page=".($actualPage+1)."\"> Siguiente </a> </li>";
				}else{ 
				$output.="<li  class='disabled'> <a> Siguiente </a> </li>";
				}

				$output.="</ul>";
				$output.="</div>";

				return $output;				
	}
?>

<html lang="es">
	<head>
	
		<link rel="stylesheet" type="text/css" href="styles.css">
		<title>Resultado de busqueda</title>
	</head>
	
	<body>
		
		<div class="bar-user">
		  <label>Bienvenido <?php echo  $_SESSION['username'];?></label>	
		  <a href=logout.php><button class="button_userbar" type="button"> Cerrar Sesion</button></a>		
		  <a href=formsearch.php><button class="button_userbar" type="button"> Buscar otro </button></a>	
		  
		</div>
		
		<div class="results-page">
					
				<?php				
					echo $tableHotels;				
			
					if ($totalPages > 1) { 
							
						echo $paginator;				
			
					} 
				?>
		</div>
		
		
	</body>
</html>
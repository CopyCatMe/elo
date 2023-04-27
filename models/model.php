<?php

class EnlacesPaginas{

	public function enlacesPaginasModel($enlacesModel){

		if($enlacesModel == "busca_elo" || 
		   $enlacesModel == "1_1_busca_tu_elo" || 
		   $enlacesModel == "3_1_buscar_elo_fada"){

			$module = "views/modules/".$enlacesModel.".php";

		}

		else if($enlacesModel == "index" ){

			$module = "views/modules/inicio.php";

		}

		else{

			$module = "views/modules/inicio.php";

		}

		return $module;

	}

}


?>
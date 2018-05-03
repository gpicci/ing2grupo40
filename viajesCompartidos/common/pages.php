<?php
require_once('config.php');
require_once('utilDB.php');
require_once('filtroDB.php');

function getPageCount($tabla, $campoFiltro, $filtro) {
   // Determinar cuantas paginas de datos tengo
	if (isset($_POST['pagsTotal']) AND is_numeric($_POST['pagsTotal']) AND ($_POST['pagsTotal'] != -1)) { // Ya fue determinado
      $pags = $_POST['pagsTotal'];
   } else { // Es necesario determinarlo
   	$total = getCountRecs($tabla, $campoFiltro, $filtro);
   	
      // Calcular nro de paginas
      if ($total > RECS_PER_PAGE) { // Mas de una pagina
         $pags = ceil($total/RECS_PER_PAGE);
      } else {
         $pags = 1;
      }
   }
   
   return $pags;
}

function getPageCountFM($tabla, $filtros, $cantidadRegistros=null) {
   // Determinar cuantas paginas de datos tengo
   // Soporte para filtos multiples
   // $filtros debe ser un array de FiltroDB		
	
   /*if (isset($_POST['pagsTotal']) AND is_numeric($_POST['pagsTotal']) AND ($_POST['pagsTotal'] != -1) )  { // Ya fue determinado
      $pags = $_POST['pagsTotal'];
   } else { // Es necesario determinarlo
   	*/if (isset($cantidadRegistros)) {
   		$total = $cantidadRegistros;
   	} else {
   		$total = getCountRecsFM($tabla, $filtros);
   		
   	}
   	
      // Calcular nro de paginas
      if ($total > RECS_PER_PAGE) { // Mas de una pagina
         $pags = ceil($total/RECS_PER_PAGE);
      } else {
         $pags = 1;
      }
  /* }*/
   
   return $pags;
}

function getActualPage() {
   // Determinar que pagina de resultados tengo que mostrar
   if (isset($_POST['pagActual']) AND is_numeric($_POST['pagActual']) AND ($_POST['pagActual'] != -1)) {
      $start = $_POST['pagActual'];
   } else {
      $start = 0;
   }
   
   return $start;
}

function getPageFooter($form, $pags, $start, $sort, $idGrilla) {
   // Links a otras paginas si es necesario
   if ($pags > 1) {
      echo '<p align="center">';

      $current_page = ($start/RECS_PER_PAGE) + 1;

      // Si no es la primera pagina poner el Anterior
      if ($current_page != 1) {
         print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.($start - RECS_PER_PAGE).');">Anterior</a> ');
      }

      // Poner los nros de pagina
      // Si las paginas son menos de 5, muestro todas
      if ($pags < 5) {
	      for ($i = 1; $i <= $pags; $i++) {
	         if (($i % 30) == 0) {
	         	echo '</p><p align="center">';
	         }
	      	 if ($i != $current_page) {
	         	print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.(RECS_PER_PAGE * ($i - 1)).');">'. str_pad($i,4,' ',STR_PAD_LEFT) .'</a> ');
	         } else {
	            print(str_pad($i,4,' ',STR_PAD_LEFT).' ');
	         }
	      }
      } else {
      // Si las paginas son mas de 5 muestro las primeras 3, tres puntos y la ultima
	      for ($i = 1; $i <= 3; $i++) {
	         if (($i % 30) == 0) {
	         	echo '</p><p align="center">';
	         }
	      	 if ($i != $current_page) {
	         	print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.(RECS_PER_PAGE * ($i - 1)).');">'. str_pad($i,4,' ',STR_PAD_LEFT) .'</a> ');
	         } else {
	            print(str_pad($i,4,' ',STR_PAD_LEFT).' ');
	         }
	      }

      	// Si la pagina es la nro 4 tengo que mostrarla
      	if (($current_page == 4)) {
	      	print(str_pad($current_page,4,' ',STR_PAD_LEFT).' ');
		      print('...');
	      } else {
      	// Si la pagina esta en el medio tengo que mostrarla
	      if (($current_page > 4) and ($current_page < $pags-1)) {
	      	print('...');
	      	print(str_pad($current_page,4,' ',STR_PAD_LEFT).' ');
		      print('...');
	      } else {
      	// Si la pagina es la anteultima tengo que mostrarla
	      if ($current_page == $pags-1) {
	      	print('...');
	      	print(str_pad($current_page,4,' ',STR_PAD_LEFT).' ');
	      } else {
	      	print('...');
	      }}}

	      // Muestro la ultima pagina
	      if ($pags != $current_page) {
		   	print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.(RECS_PER_PAGE * ($pags - 1)).');">'. str_pad($pags,3,' ',STR_PAD_LEFT) .'</a> ');
	     	} else {
	         print(str_pad($pags,4,' ',STR_PAD_LEFT).' ');
	      }
	  	}

      // Si no es la ultima pagina poner el Siguiente
      if ($current_page != $pags) {
		print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.($start + RECS_PER_PAGE).');">Siguiente</a>');
      }

      print("</p>");
   }
}

function getPageFooterWithParam($form, $pags, $start, $sort, $idGrilla,$param) {
	// Links a otras paginas si es necesario
	
	if ($pags > 1) {
		echo '<p align="center">';

		$current_page = ($start/RECS_PER_PAGE) + 1;

		// Si no es la primera pagina poner el Anterior
		if ($current_page != 1) {
			print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.($start - RECS_PER_PAGE).','.$param.');">Anterior</a> ');
		}

		// Poner los nros de pagina
		// Si las paginas son menos de 5, muestro todas
		if ($pags < 5) {
			for ($i = 1; $i <= $pags; $i++) {
				if (($i % 30) == 0) {
					echo '</p><p align="center">';
				}
				if ($i != $current_page) {
					print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.(RECS_PER_PAGE * ($i - 1)).','.$param.');">'. str_pad($i,4,' ',STR_PAD_LEFT) .'</a> ');
				} else {
					print(str_pad($i,4,' ',STR_PAD_LEFT).' ');
				}
			}
		} else {
			// Si las paginas son mas de 5 muestro las primeras 3, tres puntos y la ultima
			for ($i = 1; $i <= 3; $i++) {
				if (($i % 30) == 0) {
					echo '</p><p align="center">';
				}
				if ($i != $current_page) {
					print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.(RECS_PER_PAGE * ($i - 1)).','.$param.');">'. str_pad($i,4,' ',STR_PAD_LEFT) .'</a> ');
				} else {
					print(str_pad($i,4,' ',STR_PAD_LEFT).' ');
				}
			}

			// Si la pagina es la nro 4 tengo que mostrarla
			if (($current_page == 4)) {
				print(str_pad($current_page,4,' ',STR_PAD_LEFT).' ');
				print('...');
			} else {
				// Si la pagina esta en el medio tengo que mostrarla
				if (($current_page > 4) and ($current_page < $pags-1)) {
					print('...');
					print(str_pad($current_page,4,' ',STR_PAD_LEFT).' ');
					print('...');
				} else {
					// Si la pagina es la anteultima tengo que mostrarla
					if ($current_page == $pags-1) {
						print('...');
						print(str_pad($current_page,4,' ',STR_PAD_LEFT).' ');
					} else {
						print('...');
					}
				}
			}

			// Muestro la ultima pagina
			if ($pags != $current_page) {
				print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.(RECS_PER_PAGE * ($pags - 1)).','.$param.');">'. str_pad($pags,3,' ',STR_PAD_LEFT) .'</a> ');
			} else {
				print(str_pad($pags,4,' ',STR_PAD_LEFT).' ');
			}
		}

		// Si no es la ultima pagina poner el Siguiente
		if ($current_page != $pags) {
			print('<a href="javascript:changePage'.$idGrilla.'(\''.$form.'\', \''.$sort.'\', '.$pags.', '.($start + RECS_PER_PAGE).','.$param.');">Siguiente</a>');
		}

		print("</p>");
	}
}

?>
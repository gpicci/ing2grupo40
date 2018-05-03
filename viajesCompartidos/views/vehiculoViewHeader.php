<script type="text/javascript" src="./ajax.js"></script>
<script type="text/javascript">

var ajax = new Array();

function getModelos(sel)
{

	var idMarca = sel.options[sel.selectedIndex].value;
	
	document.getElementById('modelo_id').options.length = 0;	// Empty city select box
	
	document.getElementById('modelo_id').innerHTML = "";
	
	ajax = new sack();

	ajax.requestFile = './views/getModelos.php?idMarca='+idMarca;	// Specifying which file to get
	ajax.onCompletion = function(){ createModelos() };	// Specify function that will be executed after file has been found
	ajax.runAJAX();		// Execute AJAX function

}

function createModelos()
{
	var obj = document.getElementById('modelo_id');
	eval(ajax.response);
}

$(function() {
    $( "#modelo_id" ).combobox();
  });


</script>

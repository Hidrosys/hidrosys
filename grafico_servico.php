<?php
//header('Content-Disposition: attachment; filename="graph.png"');
header('Content-type: image/png; charset=UTF-8');

include('phplot/phplot.php');

$grafico = new PHPlot(800, 500);

#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle("Grafico de servicos");
$grafico->SetXTitle("Mes");
$grafico->SetYTitle("Numero de servicos");

$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
$query = "SELECT * FROM servicos WHERE ano = " . $_GET['ano'];
$result = mysqli_query($conexao, $query);
$meses = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);
if($result)
while($consulta = mysqli_fetch_array($result))
{
	$meses[$consulta['mes']] = $meses[$consulta['mes']] + 1;
}


mysqli_close($conexao);

#Definimos os dados do gráfico
$dados = array(
		array('Janeiro', $meses[1]),
		array('Fevereiro', $meses[2]),
		array('Marco', $meses[3]),
		array('Abril', $meses[4]),
		array('Maio', $meses[5]),
		array('Junho', $meses[6]),
		array('Julho', $meses[7]),
		array('Agosto', $meses[8]),
		array('Setembro', $meses[9]),
		array('Outubro', $meses[10]),
		array('Novembro', $meses[11]),
		array('Dezembro', $meses[12]),
);

$grafico->SetDataValues($dados);
 
#Neste caso, usariamos o gráfico em barras
$grafico->SetPlotType("bars");

#Exibimos o gráfico
$grafico->DrawGraph();

?>
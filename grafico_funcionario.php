<?php
//header('Content-Disposition: attachment; filename="graph.png"');
header('Content-type: image/png; charset=UTF-8');

include('phplot/phplot.php');

$grafico = new PHPlot(800, 500);

#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle("Grafico de funcionarios no  mes " . $_GET['mes'] . " do ano " . $_GET['ano']);
$grafico->SetXTitle("Funcionario");
$grafico->SetYTitle("Numero de servicos");

$conexao = mysqli_connect("localhost", "root", "123456", "hidrosys");
$query = "SELECT servicos_funcionarios.id, servicos_funcionarios.id_servico, servicos_funcionarios.id_funcionario, funcionarios.nome FROM servicos_funcionarios LEFT JOIN funcionarios ON servicos_funcionarios.id_funcionario = funcionarios.id LEFT JOIN servicos ON servicos_funcionarios.id_servico = servicos.id WHERE ano = " . $_GET['ano'] . " AND mes = " . $_GET['mes'] ;
$result = mysqli_query($conexao, $query);
$fun = array();
if($result)
while($consulta = mysqli_fetch_array($result))
{
	if(isset($dados[$consulta['nome']]))
		$fun[$consulta['nome']] = $fun[$consulta['nome']] + 1;
	else
		$fun[$consulta['nome']] = 1;
}

$dados = array();

foreach($fun as $key => $value)
{
	$dados[] = array($key, $value);
}

mysqli_close($conexao);

$grafico->SetDataValues($dados);
 
#Neste caso, usariamos o gráfico em barras
$grafico->SetPlotType("bars");

#Exibimos o gráfico
$grafico->DrawGraph();

?>
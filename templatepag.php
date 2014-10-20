<?php
function template($from)
{    	
	echo '
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row-fluid">

          <div class="col-xs-2"><h3>HIDROSYS</h3></div>

          <div class="col-xs-8" style="padding-top:12px">
            <ul class="nav nav-pills">
              <li '. 
                ($from=="principal"? 'class="active"><a href="#">Principal</a></li>': '><a href="index.php">Principal</a></li>').
              '<li '. 
                ($from=="clientes"? 'class="active"><a href="#">Clientes</a></li>': '><a href="clientes.php">Clientes</a></li>').
              '<li '.
                ($from=="servicos"? 'class="active"><a href="#">Serviços</a></li>': '><a href="#">Serviços</a></li>').
              '<li '. 
                ($from=="funcionarios"? 'class="active"><a href="#">Funcionários</a></li>': '><a href="#">Funcionários</a></li>').
              '<li '. 
                ($from=="ferramentas"? 'class="active"><a href="#">Ferramentas</a></li>': '><a href="#">Ferramentas</a></li>').
              '<li '.
                ($from=="pecas"? 'class="active"><a href="#">Peças</a></li>': '><a href="#">Peças</a></li>').
              '<li '.
                ($from=="relatorios"? 'class="active"><a href="#">Relatórios</a></li>': '><a href="#">Relatórios</a></li>').
              '<li '.
                ($from=="usuarios"? 'class="active"><a href="#">Usuários</a></li>': '><a href="#">Usuários</a></li>').  
            '</ul>
          </div>

          <div class="col-xs-2" style="padding-top:12px;">
            <ul class="nav nav-pills">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  '. getLogin() . '<span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <li class="item">
                    <a href="login.php?logoff=true">Logoff</a>
                  </li>
                </ul>
              </li>      
            </ul>      
          </div>

        </div>
      </div>
    </div>';
}
?>
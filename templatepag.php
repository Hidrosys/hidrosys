<?php
function template()
{    	
	echo '
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row-fluid">

          <div class="col-xs-2"><h3>HIDROSYS</h3></div>

          <div class="col-xs-8" style="padding-top:12px">
            <ul class="nav nav-pills">
              <li class="active"><a href="#">Principal</a></li>
              <li><a href="#">Clientes</a></li>
              <li><a href="#">Serviços</a></li>
              <li><a href="#">Funcionários</a></li>
              <li><a href="#">Ferramentas</a></li>
              <li><a href="#">Peças</a></li>
              <li><a href="#">Relatórios</a></li>
            </ul>
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
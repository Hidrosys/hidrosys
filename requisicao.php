<?php
  include("seguranca.php");
  
  if(validaLogin($_POST["login"], $_POST["senha"]) == true)
  {
    header("Location: index.php");
  }
  else
  {
    header("Location: login.php?loginerro=true");
  }
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Tijuca Verde | Home</title>
<link rel="shortcut icon" type="image/x-icon" href="/imagens/favicon.png" style="width:10px; height:5px;" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/principal3.css">
<link rel="stylesheet" href="css/index2.css">
<link rel="stylesheet" href="css/mapa1.css">
<link rel="stylesheet" href="css/denunciaform2.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/carousel.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


      <style type="text/css">
        body {
            margin: 0;
        }
       #map {
    width: 49vw;
    height: 94vh;
    border: 2px solid black;
    box-shadow: black 3px 3px 3px 3px;
}
      


    </style>
</head>
<body>
<!-- Navbar (situado em cima) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card topind" style=" z-index:1;height:60px;" id="myNavbar">
    <a href="#home"><img src="imagens/logo.png" style="width:163px; height:127px;margin-top:-30px;" class="w3-bar-item w3-button w3-wide"></a>
    <!-- Links da barra de navegação do lado direito -->
    <div class="w3-right w3-hide-small topind">
        <a href="#about" class="w3-bar-item w3-button"><i class="fa fa-thumbs-up" aria-hidden="true"></i> SOBRE NÓS</a>
        <a href="#denuncia" class="w3-bar-item w3-button"><i class="fa fa-th"></i> DENÚNCIAS</a>
        <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTATO</a>
   
<?php 
//Menu só aparece para os administradores.
if (isset($_SESSION["acesso"])){ 
if($_SESSION['acesso']=="Admin"){
?>

    <li class='dropdown topind'><a href="javascript:void(0)" class="dropbtn"><i class="fa fa-cog" aria-hidden="true"></i> ADMINISTRAÇÃO DO SITE</a>
	<div class='dropdown-content topind'>
	    <a href='php/admincadastrar1.php'>CADASTRAR USUÁRIO</a>
	<a href='php/usuarioscontrolar.php?pag=1'>CONTROLAR USUÁRIOS</a>
	<a href="php/denunciascontrolar.php"><i class="fa fa-book"></i>Controlar Denuncias</a></div></li>
<?php
}}
?>
      
     <?php
if (!isset($_SESSION["acesso"])){ ?>
  <div class="w3-right w3-hide-small topind">
 <a href ="login.html" class="w3-bar-item w3-button">LOGIN</a></div>
    
<?php }else{
//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['acesso'];

?>
  <li class="dropdown " style="float:right">
    <a href="javascript:void(0)" class="dropbtn"><i class="fa fa-user-circle" aria-hidden="true"></i>Usuário: <?php echo $logado;?></a>
    <div class="dropdown-content topind">
        <a href="php/perfil.php"><i class="fa fa-user"></i> PERFIL</a>
      <a href="php/deslogar.php"><i class="fa fa-power-off"></i> Deslogar</a>
	  
    </div>
  </li>
 <?php } ?>
    </div>
    <!-- Ocultar links flutuantes à direita em telas pequenas e substituí-los por um ícone de menu -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
 
</div>
</div>
<!-- Barra lateral em telas pequenas ao clicar no ícone do menu -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Fechar ×</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">Sobre Nós</a>
  <a href="#denuncia" onclick="w3_close()" class="w3-bar-item w3-button">Denúncias</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">Contato</a>
  <?php 
if (isset($_SESSION["acesso"])){ 
if($_SESSION['acesso']=="Admin"){
?>
	<a href="php/admincadastrar1.php" class="w3-bar-item w3-button">CADASTRAR USUÁRIO</a>
    <a href="php/usuarioscontrolar.php?pag=1" class="w3-bar-item w3-button">CONTROLAR USUÁRIOS</a>
<?php
}}
?>
      
     <?php
if (!isset($_SESSION["acesso"])){ ?>
<a href="login.html" onclick="w3_close()" class="w3-bar-item w3-button">LOGIN</a>
    
<?php }else{
//Cria variáveis com a sessão.
$logado = $_SESSION['nome'];
$acesso = $_SESSION['acesso'];

?>
  <li class="dropdown" style="width:100%">
    <a href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-user-circle" aria-hidden="true"></i>Usuário: <?php echo $logado;?></a>
    <div class="dropdown-content" style="width:100%">
      <a href="php/deslogar.php">Deslogar</a>
    </div>
  </li>
 <?php } ?>
    
</nav>

<!-- Cabeçalho com imagem de altura total -->
 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
<!-- Indicators(inutil, mas n apaga --><!-- Indicators(inutil, mas n apaga --><!-- Indicators(inutil, mas n apaga -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!--Slides do carousel --><!--Slides do carousel --><!--Slides do carousel --><!--Slides do carousel -->
    <div class="carousel-inner">
      <div  id="home" class="item active">
       <a href="index.php"> <img  src="imagens/boasvindas.png" alt="Boas Vindas" style="width:100%; height:650px;"></a>
      </div>
      
    <div class="item">
        <a href="https://chat.whatsapp.com/CKMhwBQHWl2ExbtJ2QVRhl" target="_blank"> <img src="imagens/zapzap.png" alt="Zapzap" style="width:100%; height:650px;"></a>
      </div>
      
      <div class="item">
        <a href="https://www.atados.com.br/ong/sustentarte" target="_blank"> <img src="imagens/sustentarte.png" alt="Sustentarte" style="width:100%; height:650px;"></a>
      </div>
    
      <div class="item">
       <a href="https://br.todosnegocios.com/pt/reciclagem-tijuquinha-21-2223-0953" target="_blank">  <img src="imagens/tijuquinha.png" alt="Tijuquinha" style="width:100%; height:650px;"></a>
      </div>
    </div>

    <!--controle das setas do carousel--> <!--controle das setas do carousel--> <!--controle das setas do carousel-->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="fa fa-arrow-left" style="font-size:48px;"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="fa fa-arrow-right" style="font-size:48px;"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<!-- Sobre Nós Seção -->    <!-- Sobre Nós Seção -->    <!-- Sobre Nós Seção -->    <!-- Sobre Nós Seção -->
<div class="w3-container" style="padding:60px 16px; background-color: #FAEBE0;" id="about">
  <h3 class="sobnos" style="font-size: 35px; font-family: Candara;">SOBRE NÓS</h3>
  <div class="devider">
  <img src="imagens/devider.png">
  </div>
  <div class="w3-row-padding sobnos" style="margin-top:64px">
    <div class="w3-quarter">
      <i class="fa fa-users w3-margin-bottom w3-jumbo" style="color: #61764B;"></i>
      <p class="w3-large"style="font-family: Candara;">Sobre o projeto</p>
      <pstyle="font-family: Candara;">O Tijuca Verde foi criado com o intuito de conscientizar os cidadãos sobre a preservação da área verde da Tijuca.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-recycle w3-margin-bottom w3-jumbo"style="color: #61764B;"></i>
      <p class="w3-large"style="font-family: Candara;">Reciclagem</p>
      <pstyle="font-family: Candara;">Nos preocupamos com o bem social e a conscientização sobre o meio ambiente, através da coleta e reaproveitamento correto de resíduos..</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-gift w3-margin-bottom w3-jumbo"style="color: #61764B;"></i>
      <p class="w3-large"style="font-family: Candara;">Recompensas</p>
      <pstyle="font-family: Candara;">Para incentivar as pessoas a relatarem os crimes ambientais criamos um sistema de recompensa.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-cog w3-margin-bottom w3-jumbo"style="color: #61764B;"></i>
      <p class="w3-large"style="font-family: Candara;">Suporte</p>
      <pstyle="font-family: Candara;">O site é um meio de facilitar a conexão entre o cidadão responsável e a autoridade.</p>
    </div>
  </div>
</div>
<!-- Denúncia Seção --><!-- Denúncia Seção --><!-- Denúncia Seção --><!-- Denúncia Seção --><!-- Denúncia Seção -->
<div class="w3-container" style="padding:60px 16px; background-image: url(imagens/backgrounddenuncia.png);" id="denuncia">
  <h3 style="font-family: Candara; font-size: 45px; color:white; text-align: center;  font-weight: bold;">DENÚNCIAS</h3>
  <div class="devider">
  <img src="imagens/devider.png">
  </div>
  <p class="dns w3-large" style="font-family: Candara;color:white; text-align: center;  font-weight: bold;">Faça do "Meio Ambiente" o seu "Meio de Vida".
</p>
 <div class="w3-row-padding" style="margin-top:64px">
<!--Denuncia1--><!--Denuncia1--><!--Denuncia1--><!--Denuncia1--><!--Denuncia1--><!--Denuncia1--><!--Denuncia1-->
  
   <div class="w3-third w3-section">
      <ul class="w3-ul w3-white w3-hover-shadow centerred">
        <li class="w3-black w3-xlarge w3-padding-32 topred">Bueiros Entupidos</li>
		 <li class="w3-padding-16"><b>Localize bueiros entupidos, vazando ou abertos.</b>
       </li>
        <li class="rodp w3-padding-20 bottomred">
        
<button class="button2" onclick="document.getElementById('id01').style.display='block' " style="width:auto; border-radius: 25px;">Denuncie aqui</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="php/denunciacodigo.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">Fechar</span>
      <img src="imagens/bueiros.png" alt="Avatar" class="avatar">
    </div>

    <div class="container5" id="app">
        
       <input  type="hidden" value="Bueiro entupido" name="tipodenuncia" readonly required>
        
      <label for="localdenuncia"><b>Local da denuncia</b></label>
      <input class="input2" list="locais" name="localdenuncia" placeholder="Onde aconteceu o ocorrido" required>
     <?php
	//Coloca o rodapé que está no arquivo
	include 'locaisdenuncias.php';
?>
      
      <label for="descricao"><b>Descrição</b></label>
      <input class="input2" type="text" placeholder="Descreva o ocorrido" name="descricao" required>
      
      <label for="imagem"><b>Foto</b></label>
      <input type="file" id="myFile" name="imagem" required>
        
      <button class="button1" onclick="myFunction()" type="submit" >Enviar</button>
    </div>
  </form>
</div>



        </li>
      </ul>
    </div>
<!--Denuncia2--><!--Denuncia2--><!--Denuncia2--><!--Denuncia2--><!--Denuncia2--><!--Denuncia2--><!--Denuncia2-->     
	 <div class="w3-third w3-section">
      <ul class="w3-ul w3-white w3-hover-shadow centerred">
        <li class="w3-black w3-xlarge w3-padding-32 topred">Maus Tratos aos Animais</li>
       <li class="w3-padding-16"><b>Denuncie uma agressão ou abandono.</b>
       </li>
        <li class="rodp w3-padding-22 bottomred">
       <button class="button2" onclick="document.getElementById('id02').style.display='block'" style="width:auto; border-radius: 25px;">Denuncie aqui</button>

<div id="id02" class="modal">
  
  <form class="modal-content animate" action="php/denunciacodigo.php" method="post"  enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">Fechar</span>
      <img src="imagens/animal.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container5">
        
       <input  type="hidden" value="Maus tratos aos animais" name="tipodenuncia" readonly required>
        
      <label for="localdenuncia"><b>Local da denuncia</b></label>
      <input class="input2" list="locais" name="localdenuncia" placeholder="Onde aconteceu o ocorrido" required>
     <?php
	//Coloca o rodapé que está no arquivo
	include 'locaisdenuncias.php';
?>

      <label for="descricao"><b>Descrição</b></label>
      <input class="input2" type="text" placeholder="Descreva o ocorrido" name="descricao" required>
      
      <label for="imagem"><b>Foto</b></label>
      <input type="file" id="myFile" name="imagem" required>
        
      <button class="button1" type="submit">Enviar</button>
    </div>
  </form>
</div>


        </li>
      </ul>
    </div>
<!--Denuncia3--><!--Denuncia3--><!--Denuncia3--><!--Denuncia3--><!--Denuncia3--><!--Denuncia3--><!--Denuncia3-->    
	 <div class="w3-third w3-section">
      <ul class="w3-ul w3-white w3-hover-shadow centerred">
        <li class="w3-black w3-xlarge w3-padding-32 topred">Focos de Incêndio</li>
      <li class="w3-padding-16"><b>Informe o local. Exemplos: prédio, casa, árvore.</b>
       </li>
        <li class="rodp w3-padding-22 bottomred">
<button class="button2" onclick="document.getElementById('id03').style.display='block'" style="width:auto; border-radius: 25px;">Denuncie aqui</button>

<div id="id03" class="modal">
  
  <form class="modal-content animate" action="php/denunciacodigo.php" method="post"  enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">Fechar</span>
      <img src="imagens/incendios.png" alt="Avatar" class="avatar">
    </div>

    <div class="container5">
        
       <input  type="hidden" value="Focos de Incêndio" name="tipodenuncia" readonly required>
        
         <label for="localdenuncia"><b>Local da denuncia</b></label>
      <input class="input2" list="locais" name="localdenuncia" placeholder="Onde aconteceu o ocorrido" required>
     <?php
	//Coloca o rodapé que está no arquivo
	include 'locaisdenuncias.php';
?>

      <label for="descricao"><b>Descrição</b></label>
      <input class="input2" type="text" placeholder="Descreva o ocorrido" name="descricao" required>
      
      <label for="imagem"><b>Foto</b></label>
      <input type="file" id="myFile" name="imagem" required>
        
      <button class="button1" type="submit">Enviar</button>
    </div>
  </form>
</div>


        </li>
      </ul>
    </div>
    <!--Denuncia4--><!--Denuncia4--><!--Denuncia4--><!--Denuncia4--><!--Denuncia4--><!--Denuncia4--><!--Denuncia4-->  
    
    	 <div class="w3-third w3-section" style="margin-left: 15%;">
      <ul class="w3-ul w3-white w3-hover-shadow centerred">
        <li class="w3-black w3-xlarge w3-padding-32 topred">Lixo Despejado de Forma Irregular</li>
     <li class="w3-padding-16"><b>Informe como foi despejado e onde foi despejado.</b>
       </li>
        <li class="rodp w3-padding-22 bottomred">
       <button class="button2" onclick="document.getElementById('id04').style.display='block'" style="width:auto;border-radius: 25px;">Denuncie aqui</button>

<div id="id04" class="modal">
  
  <form class="modal-content animate" action="php/denunciacodigo.php" method="post"  enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">Fechar</span>
      <img src="imagens/lixo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container5">
        
       <input  type="hidden" value="Lixo despejado de forma irregular" name="tipodenuncia" readonly required>
        
          <label for="localdenuncia"><b>Local da denuncia</b></label>
      <input class="input2" list="locais" name="localdenuncia" placeholder="Onde aconteceu o ocorrido" required>
     <?php
	//Coloca o rodapé que está no arquivo
	include 'locaisdenuncias.php';
?>
      
      <label for="descricao"><b>Descrição</b></label>
      <input class="input2" type="text" placeholder="Descreva o ocorrido" name="descricao" required>
      
      <label for="imagem"><b>Foto</b></label>
      <input type="file" id="myFile" name="imagem" required>
      
      <button class="button1" type="submit">Enviar</button>
    </div>
  </form>
</div>


        </li>
      </ul>
    </div>
<!--Denuncia5--><!--Denuncia5--><!--Denuncia5--><!--Denuncia5--><!--Denuncia5--><!--Denuncia5--><!--Denuncia5-->  
	 <div class="w3-third w3-section" style="border-radius: 25px 25px 25px 25px;">
      <ul class="w3-ul w3-white w3-hover-shadow centerred">
        <li class="w3-black w3-xlarge w3-padding-32 topred">Outros</li>
     <li class="w3-padding-16"><b>Informe os maus tratos do ocorrido.</b>
       </li>
       
        <li class="rodp w3-padding-22 bottomred">
<button class="button2" onclick="document.getElementById('id05').style.display='block'" style="width:auto;border-radius: 25px;">Denuncie aqui</button>

<div id="id05" class="modal">
  
  <form class="modal-content animate" action="php/denunciacodigo.php" method="post"  enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">Fechar</span>
      <img src="imagens/outro.png" alt="Avatar" class="avatar">
    </div>

    <div class="container5">
        
       <input  type="hidden" value="Outra" name="tipodenuncia" readonly required>
        
          <label for="localdenuncia"><b>Local da denuncia</b></label>
      <input class="input2" list="locais" name="localdenuncia" placeholder="Onde aconteceu o ocorrido" required>
     <?php
	//Coloca o rodapé que está no arquivo
	include 'locaisdenuncias.php';
?>
      
      <label for="descricao"><b>Descrição</b></label>
      <input class="input2" type="text" placeholder="Descreva o ocorrido" name="descricao" required>
      
      <label for="imagem"><b>Foto</b></label>
      <input type="file" id="myFile" name="imagem">
        
      <button class="button1" type="submit">Enviar</button>
    </div>
  </form>
</div>
<script>
// Get the modal
var modal =  document.getElementById('id01');
var modal =  document.getElementById('id02');
var modal =  document.getElementById('id03');
var modal =  document.getElementById('id04');
var modal =  document.getElementById('id05');

</script>
        </li>
      </ul>
    </div>
	</div>
</div>
<!-- Mapa Seção --><!-- Mapa Seção --><!-- Mapa Seção --><!-- Mapa Seção --><!-- Mapa Seção --><!-- Mapa Seção -->

    </script>
    <div class="contt w3-container" style="background: #DFE8CC; padding: 60px 0px;">
          <h3 class="" style="margin-top: 10px; font-family: Candara; font-size: 45px; color:black; text-align: center;">MAPA</h3>
            <div class="devider">
  <img src="imagens/devider.png">
  </div>
          <p class="dns w3-large">Locais mais Denunciados</p>
 <div class="w3-row-padding" >
     
     <div id='map'style="z-index:0; position: relative; width: 1260px; height: 580px; outline: none; margin-top: 60px; margin-left: 2.5%;"></div>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js"></script>
<script type="text/javascript" src='https://tiles.locationiq.com/v3/js/liq-styles-ctrl-leaflet.js?v=0.1.8'></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />

<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>

<link rel="stylesheet" href="https://tiles.locationiq.com/v3/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.css">
<script src="https://tiles.locationiq.com/v3/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-plugins/3.0.2/control/Permalink.js"></script>

      <div id='map'style="width: 0px; height: 0px;"></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js"></script>
<script type="text/javascript" src='https://tiles.locationiq.com/v3/js/liq-styles-ctrl-leaflet.js?v=0.1.8'></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />

<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>

<link rel="stylesheet" href="https://tiles.locationiq.com/v3/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.css">
<script src="https://tiles.locationiq.com/v3/libs/leaflet-geocoder/1.9.6/leaflet-geocoder-locationiq.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-plugins/3.0.2/control/Permalink.js"></script>

<script type="text/javascript">
     
     const criarMarcadores = async () => {

    // Maps access token goes here
    var key = 'pk.7c31698fd4cb5345166c6766e5bbdc50';

    // Add layers that we need to the map
    var streets = L.tileLayer.Unwired({key: key, scheme: "streets"});

    // Initialize the map
    var map = L.map('map', {
        center: [-22.932536, -43.241068], // Localização da Tijuca
        zoom: 14,
        scrollWheelZoom: false,
        layers: [streets] // Show 'streets' by default
    });

  //Aciona o SQL e recebe a resposta.
  const dados = await fetch("/php/mapas3.php");
  const dados2 = await fetch("/php/mapas2.php");

  const resposta = await dados.json();
  const resposta2 = await dados2.json();

  //Você pode usar o console para saber se os dados foram recebidos.
  //console.log(resposta['dados2']);

// Add a 'marker'
var marker = L.marker([resposta['dados'][0], resposta['dados'][1]]).addTo(map);
var marker1 = L.marker([resposta['dados'][2], resposta['dados'][3]]).addTo(map);
var marker = L.marker([resposta['dados'][4], resposta['dados'][5]]).addTo(map);
var marker1 = L.marker([resposta['dados'][6], resposta['dados'][7]]).addTo(map);
var marker = L.marker([resposta['dados'][8], resposta['dados'][9]]).addTo(map);
var marker1 = L.marker([resposta['dados'][10], resposta['dados'][11]]).addTo(map);
var marker = L.marker([resposta['dados'][12], resposta['dados'][13]]).addTo(map);
var marker1 = L.marker([resposta['dados'][14], resposta['dados'][15]]).addTo(map);


    // Add a 'polygon'
    var polygon = L.polygon([
[-22.944366, -43.270591],[-22.945996, -43.262642],[-22.945816, -43.260538],[-22.945868, -43.259566],[-22.945229, -43.258698],[-22.945460, -43.257916],[-22.945946, -43.257529],[-22.946364, -43.257825],[-22.949648, -43.254426],[-22.949391, -43.253396],[-22.949875, -43.252763],[-22.949519, -43.252066],[-22.949608, -43.251390],[-22.950072, -43.250103],[-22.950042, -43.246256],[-22.949770, -43.246400],[-22.949572, -43.246599],[-22.949088, -43.246808],[-22.948560, -43.247307],[-22.947647, -43.247439],[-22.946703, -43.246643],[-22.945977, -43.246104],[-22.946040, -43.244860],[-22.945537, -43.244458],[-22.945125, -43.244420],
[-22.944873, -43.244192],[-22.944831, -43.243813],[-22.945704, -43.240961],[-22.945683, -43.240566],[-22.945076, -43.240270],[-22.944139, -43.239527],[-22.941219, -43.239185],[-22.941238, -43.238991],[-22.941346, -43.238742],[-22.941376, -43.238413],[-22.941161, -43.238043],[-22.940679, -43.237402],[-22.940753, -43.237067],[-22.940964, -43.236886],[-22.942603, -43.236465],[-22.942944, -43.235686],[-22.944421, -43.235365],[-22.944876, -43.235340],[-22.944870, -43.235126],[-22.944661, -43.234880],[-22.944640, -43.234418],[-22.944825, -43.234018],[-22.944789, -43.233776],[-22.944574, -43.233495],[-22.944276, -43.232301],
[-22.944395, -43.231522],[-22.944165, -43.231534],[-22.943898, -43.231699],[-22.943647, -43.231758],[-22.943170, -43.231508],[-22.942435, -43.231372],[-22.942019, -43.231076],[-22.941760, -43.230798],[-22.941490, -43.230701],[-22.940198, -43.230803],[-22.939556, -43.230516],[-22.939295, -43.230204],[-22.939282, -43.229886],[-22.939392, -43.229579],[-22.938873, -43.228834],[-22.938300, -43.228553],[-22.937795, -43.228865],[-22.936484, -43.226927],[-22.935484, -43.227050],[-22.935055, -43.226782],[-22.934779, -43.225734],[-22.934241, -43.224608],[-22.933277, -43.223481],[-22.930727, -43.222104],
[-22.930772, -43.221725],[-22.931009, -43.221421],[-22.931139, -43.220864],[-22.931324, -43.220799],[-22.931474, -43.220932],[-22.931712, -43.220951],[-22.931816, -43.220435],[-22.932232, -43.220511],[-22.927769, -43.218546],[-22.927769, -43.218174],[-22.927350, -43.218181],[-22.926575, -43.218099],[-22.926628, -43.217959],[-22.926243, -43.217664],[-22.926015, -43.217143],[-22.925633, -43.216857],[-22.925550, -43.216908],[-22.925336, -43.216848],[-22.924584, -43.215760],[-22.924964, -43.215288],[-22.923806, -43.214518],[-22.923573, -43.214388],[-22.923374, -43.214368],[-22.922733, -43.214467],[-22.922631, -43.214595],
[-22.922364, -43.214694],[-22.922097, -43.214467],[-22.921895, -43.214648],[-22.921864, -43.214716],[-22.922232, -43.215790],[-22.920344, -43.216642],[-22.917929, -43.211842],[-22.916262, -43.212293],[-22.915058, -43.214774],[-22.914511, -43.214564],[-22.914003, -43.215814],[-22.914060, -43.216068],[-22.913134, -43.215882],[-22.912768, -43.215962],[-22.912601, -43.216086],[-22.914960, -43.220321],[-22.917711, -43.223753],[-22.918097, -43.224380],[-22.916726, -43.225370],[-22.916514, -43.225695],[-22.916430, -43.226224],[-22.916339, -43.226705],[-22.916294, -43.227493],[-22.916253, -43.229441],[-22.916185, -43.229763],[-22.916856, -43.230232],[-22.919093, -43.233092],[-22.919429, -43.234028],[-22.918920, -43.234224],[-22.918823, -43.234383],[-22.918844, -43.234523],[-22.919154, -43.234656],[-22.919808, -43.234792],[-22.921291, -43.235630],[-22.923931, -43.236135],[-22.923991, -43.236247],[-22.924162, -43.237205],[-22.924095, -43.240970],[-22.924420, -43.240820],[-22.924659, -43.241083],[-22.924632, -43.241295],[-22.925082, -43.241303],[-22.925242, -43.241678],[-22.925267, -43.242101],[-22.925409, -43.242366],[-22.925416, -43.242625],[-22.925619, -43.242996],[-22.925318, -43.243184],[-22.925433, -43.243349],[-22.925734, -43.243090],[-22.926080, -43.243621],[-22.925350, -43.244087],[-22.925453, -43.244241],[-22.925829, -43.243997],[-22.926456, -43.245039],[-22.927397, -43.244472],[-22.927093, -43.243866],[-22.927648, -43.243545],[-22.927944, -43.244081],[-22.928758, -43.243547],[-22.928980, -43.243980],[-22.929029, -43.243944],[-22.930152, -43.245900],[-22.930029, -43.245975],[-22.930059, -43.246134],[-22.930021, -43.246146],[-22.930025, -43.246591],[-22.929995, -43.246603],[-22.929989, -43.246734],[-22.930050, -43.246733],[-22.930050, -43.246832],[-22.929982, -43.246838],[-22.930003, -43.247257],[-22.930058, -43.247255],[-22.930040, -43.247502],
[-22.930005, -43.247501],[-22.929986, -43.247768],[-22.929888, -43.247770],[-22.929896, -43.248109],[-22.929655, -43.248083],[-22.930244, -43.249458],[-22.930378, -43.249711],[-22.930151, -43.249771],
[-22.930126, -43.249866],[-22.930278, -43.249986],[-22.930567, -43.250088],[-22.930678, -43.250188],[-22.930799, -43.250412],[-22.930869, -43.250474],[-22.931166, -43.250578],[-22.931648, -43.251341],
[-22.931915, -43.252345],[-22.932096, -43.252264],[-22.933059, -43.252968],[-22.933030, -43.253101],[-22.933339, -43.253267],[-22.933428, -43.253467],[-22.933760, -43.253725],[-22.933790, -43.253844],
[-22.933774, -43.253979],[-22.933815, -43.254073],[-22.933942, -43.254076],[-22.934061, -43.253925],[-22.934201, -43.254049],[-22.934273, -43.254629],[-22.934681, -43.255063],[-22.934917, -43.255179],
[-22.935301, -43.255679],[-22.935552, -43.255638],[-22.935780, -43.256036],[-22.935902, -43.256088],[-22.936051, -43.256034],[-22.936205, -43.256656],[-22.936345, -43.256838],[-22.936530, -43.256754],
[-22.936525, -43.256659],[-22.936549, -43.256623],[-22.936597, -43.256594],[-22.937302, -43.257399],[-22.937314, -43.257549],[-22.937597, -43.257895],[-22.937938, -43.257931],[-22.939093, -43.258558],
[-22.939180, -43.258712],[-22.939097, -43.259470],[-22.938893, -43.259970],[-22.938727, -43.260760],[-22.938852, -43.261373],[-22.939296, -43.262086],[-22.939437, -43.262844],[-22.939342, -43.263218],
[-22.939217, -43.264369],[-22.939035, -43.265077],[-22.938989, -43.265988],[-22.939223, -43.267521],[-22.939684, -43.269014]



    ]).addTo(map);

        var popup = L.popup()
        .setLatLng([39.7236, -104.985]);

    // onMapClick function to popup co-ordinates, Map click listener
    

    map.on('click', onMapClick);


    // Add the autocomplete text box
    L.control.geocoder(key, {
         placeholder: 'Search nearby',
        url: "https://api.locationiq.com/v1",
        expanded: false,
        panToPoint: true,
        focus: true,
        position: "topright"
    }).addTo(map);

    map.addControl(new L.Control.Permalink({ useLocation: true, text: null }));
}

criarMarcadores();

</script>
          </div>
        </div>
<!-- Contato Seção --><!-- Contato Seção --><!-- Contato Seção --><!-- Contato Seção --><!-- Contato Seção -->
<div class="w3-container" style="padding:128px 16px; background-color: #7FB77E;" id="contact">
  <h3 class="contt sub" style="color: black; font-size:35px; font-weight: bold; font-family: Candara;">CONTATO</h3>
  <div class="devider">
  <img src="imagens/devider.png">
  </div>
  <p class="contt w3-large sub" style="margin-top: 20px; margin-bottom: 30px; font-family: Candara;">Nos envie uma mensagem</p>
  <div style="margin-top:38px">
    <p class="contt sub" style="margin-bottom: 50px; margin-top: 5px;"><i class="fa fa-map-marker fa-fw w3-xxlarge contt sub" style="margin-left: 2%;"></i> Tijuca, Rio de Janeiro</p>
    <p class="contt sub"><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right contt sub"> </i> Email: tijucaverdeofc@gmail.com</p>
    <br>
    <form action="/php/contato2.php">
      <p><input class="w3-input w3-border" type="text" name="assunto" placeholder="Assunto" required style="
    width: 547px;"></p>
      <p><input class="w3-input w3-border" type="text"  name="menssagem"  placeholder="Menssagem" required style="
    width: 547px;"></p>
      <p>
        <button class="envmsg w3-button w3-black" type="submit"><i class="fa fa-paper-plane"></i> ENVIAR </button>
      </p>
    </form>
  </div>
</div>

<!-- Footer/Rodapé -->
<footer class="contt w3-black w3-padding-64">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Voltar ao início</a>
</footer>
 
<script>

// Alterne entre mostrar e ocultar a barra lateral ao clicar no ícone do menu
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Feche a barra lateral com o botão Fechar
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>

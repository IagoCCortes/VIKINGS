<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Anoreg</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
    body {
      font-family: "Lato", sans-serif;
    }

  #main {
    transition: margin-left .5s;
    padding: 16px;
  }

  .card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    background-color: rgba(0, 0, 0, 0.03);
  }

  .card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
  }

  .card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
  }

  .mb-3, .my-3 {
    margin-bottom: 1rem !important;
  }

  .two-col {
    overflow: hidden;/* Makes this div contain its floats */
  }

  .two-col .col1,
  .two-col .col2 {
      width: 49%;
  }

  .two-col .col1,
  .float-left {
      float: left;
  }

  .two-col .col2,
  .float-right
   {
      float: right;
  }

  .two-col label {
      display: block;
  }

  .buttonAdd {
    color: white;
    border-color: #337ab7;
    background-color: #337ab7;
    padding: 4px;
    border-radius: 4px;
  }

  .modalOpened {
    display: block;
    padding-right: 17px;
    opacity: 1;
    background-color: rgba(0,0,0,0.4);
    padding-top: 200px;
  }

  #anoreg:hover,
  #navCart:hover,
  #navMail:hover{
    color: #797979 !important;
  }

  .legend-scale ul {
    margin: 0;
    margin-bottom: 5px;
    padding: 0;
    float: left;
    list-style: none;
    }

    .legend-scale ul li {
    font-size: 80%;
    list-style: none;
    margin-left: 0;
    line-height: 18px;
    margin-bottom: 2px;
    }

    ul.legend-labels li span {
    display: block;
    float: left;
    height: 16px;
    width: 30px;
    margin-right: 5px;
    margin-left: 0;
    border: 1px solid #999;
    }

    .like-link {
      color: blue;
      cursor: pointer;
    }

    html { height: 100%; }
    body {
      min-height:100%; 
      position:relative; 
      padding-bottom:[footer-height] 
    }
    footer { 
      position: absolute; 
      left: 0 ; right: 0; bottom: 0; 
      height:[footer-height];
    }

  </style>
<script>
  function preencheCampos(valores){
    $("#nome").val(valores[0]);
    $("#razao").val(valores[1]);
    $("#email").val(valores[2]);
    $("#telefone").val(valores[3]);
    $("#endereco").val(valores[4]);
    $("#bairro").val(valores[5]);
    $("#cidade").val(valores[6]);
    $("#tabeliao").val(valores[7]);
    $("#ativo").val(valores[8]);
    $("#uf").val(valores[9]);
    $("#cep").val(valores[10]);
    $("#documento").val(valores[11]);
  }
</script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a id="anoreg" class="navbar-brand" href="/VIKINGS-master/" style="color: white">Anoreg</a>
      <a id="navCart" class="navbar-brand" href="/VIKINGS-master/" style="color: white">Cartórios</a>
      <a id="navMail" class="navbar-brand" href="/VIKINGS-master/Emails/enviar" style="color: white">E-mails</a>
    </div>
    <div class="navbar-header float-right"> 
      <?php 
      if(!isset($_SESSION['user'])){
        echo '<a id="login" class="navbar-brand" href="/VIKINGS-master/Users/login" style="color: white">Login <i class="fas fa-sign-in-alt" title="login"></i></a>';
      }else{
        echo '<a id="userPg" class="navbar-brand" href="/VIKINGS-master/Users/u/' . $_SESSION['user'] . '" style="color: white">' . $_SESSION['user'] . '</a>';
        echo '<a id="logout" class="navbar-brand" href="/VIKINGS-master/Users/logout" style="color: white">Logout <i class="fas fa-sign-out-alt" title="logout"></i></i></a>';
      }
      ?>
      
    </div>
  </div>
</nav>

<div class="container-fluid" id="main">    
 
      <main role="main">

      <div class="starter-template">
          <?php if(isset($_GET['success'])){
            if($_GET['success'] == 'insert'){
                echo '<p style="color:green;" class="text-center">Cadastro realizado com sucesso.</p>';
            }else if($_GET['success'] == 'insertxml'){
                  echo '<p style="color:green;" class="text-center">Cadastro(s) por arquivo xml realizado(s) com sucesso.</p>';
            }else if($_GET['success'] == 'edit'){
              echo '<p style="color:green;" class="text-center">Edição realizada com sucesso.</p>';
            }else if($_GET['success'] == 'delete'){
              echo '<p style="color:green;" class="text-center">Registro deletado com sucesso.</p>';
            }
          };?>

          <?php
          echo $content_for_layout;
          ?>

      </div>

    </main>
    
</div>

<footer class="container-fluid text-center">
  <p>Desafio21</p>
</footer>

<script>

$('#modalTrigger').click(function() {
    $('#myModal').addClass('modalOpened');
    $('body').css({
      'overflow' : 'hidden'
    });
});

$('#modalClose, #modalCancel').click(function() {
    $('#myModal').removeClass('modalOpened');
    $('body').css({
      'overflow' : ''
    });
});

</script>

</body>
</html>

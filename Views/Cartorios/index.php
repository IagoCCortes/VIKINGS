<div class="card mb-3 responsive">
    <div class="card-header">
        <h4 style="float: left">Cartórios</h4>
        <button type="button" data-toggle="modal" data-target="#myModal" class="float-right buttonAdd"id="modalTrigger">Cadastrar cartório</button>
        <form method="post" action="/VIKINGS/Cartorios/exportarXLSX" name="excelForm" class="float-right">
          <button type="submit" name="export_excel" class="buttonAdd"id="modalTrigger" style="backgroud-color: #366f32 !important;margin-right: 10px;">Exportar para XLSX</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length" id="dataTable_length">
                    <label>Mostrar: 
                      <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"
                      onchange="javascript:location.href = '/VIKINGS/Cartorios/index/0/' + this.value +  '/<?php echo $search; ?>';">
                        <option value="10"<?php echo ($count == 10? ' selected' : '');?>>10</option>
                        <option value="25"<?php echo ($count == 25? ' selected' : '');?>>25</option>
                        <option value="50"<?php echo ($count == 50? ' selected' : '');?>>50</option>
                        <option value="100"<?php echo ($count == 100? ' selected' : '');?>>100</option>
                      </select> registros</label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div id="dataTable_filter" class="dataTables_filter float-right">
                      <label>Pesquisar:<input id="search" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
                    </div>
                  </div>
                </div>
                <div class='legend-scale'>
  <ul class='legend-labels'>
    <li><span style='background:#fbff00;'></span>Registro pendente de atualização</li>
  </ul>
</div>
                <div>
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Razão</th>
                            <th class="text-center">Documento</th>
                            <th class="text-center">Cep</th>
                            <th class="text-center">Endereço</th>
                            <th class="text-center">Bairro</th>
                            <th class="text-center">Cidade</th>
                            <th class="text-center">UF</th>
                            <th class="text-center">Telefone</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Tabelião</th>
                            <th class="text-center">Ativo</th>
                            <th class="text-center">Criado em</th>
                            <th class="text-center">Atualizado em</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <?php 
                        foreach ($cartorios as $cartorio) {
                            echo '<tr' . ($cartorio['XML_ATUALIZAR'] == 1? ' style="background-color: #fbff00;"': '') . '>';
                            echo "<td class='text-left'>" . $cartorio['NOME'] . "</td>";
                            echo "<td class='text-left'>" . $cartorio['RAZAO'] . "</td>";
                            echo "<td class='text-center'>" . $cartorio['DOCUMENTO'] . "</td>";
                            echo "<td class='text-center'>" . $cartorio['CEP'] ."</td>";
                            echo "<td class='text-left'>" . $cartorio['ENDERECO'] ."</td>";
                            echo "<td class='text-left'>" . $cartorio['BAIRRO'] ."</td>";
                            echo "<td class='text-left'>" . $cartorio['CIDADE'] ."</td>";
                            echo "<td class='text-center'>" . $cartorio['UF'] ."</td>";
                            echo "<td class='text-center'>" . ($cartorio['TELEFONE'] === NULL ? '-' : $cartorio['TELEFONE']) ."</td>";
                            echo "<td class='text-center'>" . ($cartorio['EMAIL'] === NULL ? '-' : ("<a href='mailto:" . $cartorio['EMAIL'] . "'>" . $cartorio['EMAIL'] . "</a>")) . "</td>";
                            echo "<td class='text-center'>" . ($cartorio['TABELIAO'] === NULL ? '-' : $cartorio['TABELIAO']) ."</td>";
                            echo "<td class='text-center'>" . ($cartorio['ATIVO'] == 1 ? 'Sim':'Não') ."</td>";
                            echo "<td class='text-center'>" . $cartorio['CRIADO_EM'] ."</td>";
                            echo "<td class='text-center'>" . ($cartorio['ATUALIZADO_EM'] === NULL ? '-' : $cartorio['ATUALIZADO_EM']) ."</td>";
                            echo "<td class='text-center'>
                                    <a class='btn btn-xs' title='editar' href='/VIKINGS/cartorios/editar/" . $cartorio["COD"] . "' ><i style='color:#337ab7;' class='fas fa-edit'></i></a> 
                                    <a href='/VIKINGS/cartorios/deletar/" . $cartorio["COD"] . 
                                    "' class='btn btn-xs' title='deletar' onclick='return confirm(\"Você tem certeza que deseja deletar este registro?\");'>
                                    <i style='color:#337ab7;' class='fas fa-trash-alt'></i></a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
                <div>
                  <div class="float-left">
                  <?php 
                  $totalPgs = ceil($total[0] / $count);
                  $curPg = floor($start / $count);
                  $newStart = $curPg * $count - $count;
                  echo '<span>Mostrando ' . ($start + 1) . ' a ' . ($start + $count) . ' de ' . $total[0] . '</span>';
                  echo '</div>';      
                  echo '<div class="float-right">';
                  echo '<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">';
                  echo '<ul class="pagination">'; 
                        echo '<li class="paginate_button page-item previous' . ($curPg == 0? ' disabled" style="pointer-events: none;"' : '') . ' id="dataTable_previous">
                          <a href="/VIKINGS/cartorios/index/'. ($start - $count) . '/' . $count .'/' . $search . '" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Anteriores</a>
                        </li>';
                          echo '<li class="paginate_button page-item' . (0 == $curPg ? ' active' : '') . '">
                                    <a href="/VIKINGS/cartorios/index/0/' . $count .'/' . $search . '" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">1</a>
                                  </li>';
                          for($i = $curPg -2; ($i <= $curPg + 2) && ($i < $totalPgs -1); $i++){
                            if($i < 1){
                              continue;
                            }
                            else{
                              echo '<li class="paginate_button page-item' . ($i == $curPg ? ' active' : '') . '">
                                    <a href="/VIKINGS/cartorios/index/' . (($i + 1) * $count - $count) . '/' . $count .'/' . $search . '" aria-controls="dataTable" data-dt-idx="' . ($i+2) . '" tabindex="0" class="page-link">' . ($i+1) . '</a>
                                  </li>';
                            }
                          }
                          if($totalPgs > 1){
                            echo '<li class="paginate_button page-item' . (($totalPgs -1) == $curPg ? ' active' : '') . '">
                                      <a href="/VIKINGS/cartorios/index/' . ($totalPgs * $count - $count) . '/' . $count .
                                      '/' . $search . '" aria-controls="dataTable" data-dt-idx="' . ($totalPgs + 1) . '" tabindex="0" class="page-link"'. ($totalPgs + 1 == 1? ' style="display: none;"' : '') . '>' . $totalPgs . '</a>
                                    </li>';
                          }
                          
                        echo '<li class="paginate_button page-item next' . (((($curPg + 1)== $totalPgs) || ($totalPgs == 0))? ' disabled" style="pointer-events: none;"' : '') . ' id="dataTable_next">
                          <a href="/VIKINGS/cartorios/index/'. ($start + $count) . '/' . $count .'/' . $search . '" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">Próximos</a>
                        </li>'
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal inserir cartório-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button id="preencher" type="button" onClick="preencheCampos([
          'Teste Testando', 'testando', 'teste@teste.teste', '55 55555 5555', 'teste', 
          'teste', 'teste', 'teste', 1, 'te', 12365478, '254631897'
        ])" style="display: none;">Preencher</button>
        <button id="modalClose" type="button" class="close" data-dismiss="modal" onClick="toggleForm(1)">&times;</button>
        <h4 class="modal-title text-center">Inserir cartório</h4>
      </div>
      <div class="modal-body">
        <div class="form-group" id="xmlUp">  
          <form method="post" action="/VIKINGS/cartorios/inserirXML" enctype="multipart/form-data" id="xmlForm">
            <label for="xmlFile">Selecione o arquivo XML com os dados dos cartórios a serem inseridos:</label>
            <input type="file" id="xmlFile" name="doc"/>
          </form>
        </div>
        <form method='post' action='/VIKINGS/cartorios/inserir' id='insert' style="display: none;">
          <div class="form-group">
            <label for="nome">Nome <span style="color: red">*</span>:</label>
            <input type="text" maxlength="255" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cartório" required>
          </div>
          <div class="form-group">
            <label for="razao">Razão <span style="color: red">*</span>:</label>
            <input type="text" maxlength="255" class="form-control" id="razao" name="razao" placeholder="Digite a razão" required>
          </div>
          <div class="form-group two-col">
            <div class="col1">
              <label for="documento">Documento <span style="color: red">*</span>:</label>
              <input type="text" maxlength="20" class="form-control" id="documento" name="documento" placeholder="Digite o nro do documento" required>
            </div>
            <div class="col2">
              <label for="cep">Cep <span style="color: red">*</span>:</label>
              <input type="text" maxlength="8" class="form-control" id="cep" name="cep" placeholder="Digite o cep" required>
            </div>
          </div>
          <div class="form-group">
            <label for="endereco">Endereço <span style="color: red">*</span>:</label>
            <input type="text" maxlength="255" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço do cartório" required>
          </div>
          <div class="form-group two-col">
            <div class="col1">
              <label for="bairro">Bairro <span style="color: red">*</span>:</label>
              <input type="text" maxlength="255" class="form-control" id="bairro" name="bairro" placeholder="Digite o bairro" required>
            </div>
            <div class="col2">
              <label for="cidade">Cidade <span style="color: red">*</span>:</label>
              <input type="text" maxlength="255" class="form-control" id="cidade" name="cidade" placeholder="Digite a cidade" required>
            </div>
          </div>
          <div class="form-group two-col">
            <div class="col1">
              <label for="telefone">Telefone:</label>
              <input type="text" maxlength="20" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone" >
            </div>
            <div class="col2">
              <label for="email">E-mail:</label>
              <input type="text" maxlength="255" class="form-control" id="email" name="email" placeholder="Digite o e-mail" >
            </div>
          </div>
          <div class="form-group">
            <label for="tabeliao">Tabelião:</label>
            <input type="text" maxlength="255" class="form-control" id="tabeliao" name="tabeliao" placeholder="Digite o nome do tabelião">
          </div>
          <div class="form-group two-col">
            <div class="col1">
              <label for="uf">UF <span style="color: red">*</span>:</label>
              <input type="text" maxlength="2" class="form-control" id="uf" name="uf" placeholder="Digite a UF" required>
            </div>
            <div class="checkbox col2">
              <label for="ativo"><input type="checkbox" name="ativo" class="form-control" id="ativo" style="width: 15px;height: 15px;" checked> Ativo</label>
            </div>
            <script>
              $('#ativo').on('change', function(){
                this.value = this.checked ? 1 : 0;
              }).change();
            </script>
          </div>       
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left" onClick="toggleForm(1)" id="modalCancel">Cancelar</button>
        <button type="button" class="btn btn-default" onClick="toggleForm(0)" id="btnTog">Cadastrar Manualmente</button>
        <button type="submit" class="btn btn-primary" form="insert" id="btnManual" style="display: none;">Cadastrar</button>
        <button type="submit" class="btn btn-primary" form="xmlForm" value="Send File" id="btnXml">Cadastrar</button>
      </div>
    </div>

  </div>
</div>

<script>
  function toggleForm(type){
    if(type == 0){
      $("#insert").toggle();
      $("#preencher").toggle();
      $('#xmlUp').toggle();
      $('#btnManual').toggle();
      $('#btnXml').toggle();
      $('#btnTog').toggle();
    }
    else{
      $("#insert, #preencher, #btnManual").hide();
      $('#xmlUp, #btnXml, #btnTog').show();
    }
  }

var input = document.getElementById("search");

input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Trigger the button element with a click
    javascript:location.href = '/VIKINGS/Cartorios/index/0/<?php echo $count; ?>/' + this.value;
  }
});

$('#search').val('<?php echo $search; ?>');
</script>
<!-- Editar cartório-->
<?php echo "<form method='post' style='width:50%;margin:auto;' action='/VIKINGS/cartorios/editar/" . $cartorios['COD'] . "'>"; ?>
  <div class="form-group two-col">
    <div class="col1">
      <label for="nome">Nome <span style="color: red">*</span>:</label>
      <input type="text" maxlength="255" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cartório" required>
    </div>
    <div class="col2">
      <label for="razao">Razão <span style="color: red">*</span>:</label>
      <input type="text" maxlength="255" class="form-control" id="razao" name="razao" placeholder="Digite a razão" required>
    </div>
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
  <div class="form-group two-col">
    <div class="col1">
      <label for="endereco">Endereço <span style="color: red">*</span>:</label>
      <input type="text" maxlength="255" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço do cartório" required>
    </div>
    <div class="col2">
      <label for="bairro">Bairro <span style="color: red">*</span>:</label>
      <input type="text" maxlength="255" class="form-control" id="bairro" name="bairro" placeholder="Digite o bairro" required>
    </div>
  </div>
  <div class="form-group two-col">
    <div class="col1">
      <label for="cidade">Cidade <span style="color: red">*</span>:</label>
      <input type="text" maxlength="255" class="form-control" id="cidade" name="cidade" placeholder="Digite a cidade" required>
    </div>
    <div class="col2">
      <label for="telefone">Telefone:</label>
      <input type="text" maxlength="20" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone" >
    </div>
  </div>
  <div class="form-group two-col">
    <div class="col1">
      <label for="email">E-mail:</label>
      <input type="text" maxlength="255" class="form-control" id="email" name="email" placeholder="Digite o e-mail" >
    </div>
    <div class="col2">
      <label for="tabeliao">Tabelião:</label>
      <input type="text" maxlength="255" class="form-control" id="tabeliao" name="tabeliao" placeholder="Digite o nome do tabelião">
    </div>
  </div>
  <div class="form-group two-col">
    <div class="col1">
      <label for="uf">UF <span style="color: red">*</span>:</label>
      <input type="text" maxlength="2" class="form-control" id="uf" name="uf" placeholder="Digite o UF" required>
    </div>
    <div class="checkbox col2">
      <label for="ativo" style="word-wrap:break-word"><input type="checkbox" name="ativo" class="form-control" id="ativo" style="width: 15px;height: 15px;"> Ativo</label>
    </div>
  </div>  
  <button type="button" value="Voltar para a última página" class="btn btn-default float-left" onClick="javascript:history.go(-1)">Voltar</button>
  <button type="submit" class="btn btn-primary float-right">Editar</button>     
</form>

<script>
    $('#ativo').on('change', function(){
        this.value = this.checked ? 1 : 0;
      }).change();

    var campos = <?php echo json_encode(array($cartorios["NOME"], $cartorios['RAZAO'], $cartorios["EMAIL"], $cartorios["TELEFONE"]
                                , $cartorios["ENDERECO"], $cartorios["BAIRRO"], $cartorios["CIDADE"], $cartorios["TABELIAO"] 
                                , $cartorios["ATIVO"], $cartorios["UF"], $cartorios["CEP"], $cartorios["DOCUMENTO"])); ?>;                                    
    preencheCampos(campos);

    if( 1 == <?php echo $cartorios["ATIVO"];?>){
      $('#ativo').prop('checked', true);
    }
</script>
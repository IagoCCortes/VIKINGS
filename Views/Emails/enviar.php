<form method="post" action="/VIKINGS/Emails/enviar/">
	<div class="form-group two-col">
		<label for="para">Para <span style="color: red">*</span>:  
		<span id="send2all" class="like-link"><u>Preencher com todos emails</u>
		</span>/ <span id="send2act" class="like-link"><u>Preencher com todos emails com registros ativos</u></span></label>
      	<textarea class="form-control" id="para" name="para" placeholder="Digite o(s) e-mail(s) do(s) destinatário(s)" required></textarea>
		<small class="text-muted">Use a vírgula (,) como separador de e-mails.</small>
	</div>
	<div class="form-group">
		<label for="assunto">Assunto <span style="color: red">*</span>:</label>
      	<input type="text" maxlength="255" class="form-control" id="assunto" name="assunto" placeholder="Digite o assunto do e-mail" required>
	</div>
	<div class="form-group">
		<label for="texto">Texto <span style="color: red">*</span>:</label>
      	<textarea class="form-control" id="texto" name="texto" rows="4" required></textarea>
	</div> 
	<!--<div class="form-group">
		<label for="att">Anexo:</label>
		<input type="file" id="att" name="att" />
	</div>-->
	<input type="submit" class="btn btn-primary float-right" name="send">
</form>
<script>
$("#send2all").click(function() {
    $('#para').val('<?php 
$mails = '';
foreach ($emails as $email) {
	$mails .= $email[0] . ',';
}
$mails = rtrim($mails, ',');
echo $mails;
?>');
});

$("#send2act").click(function() {
    $('#para').val('<?php 
$mails = '';
foreach ($emailsAtivos as $email) {
	$mails .= $email[0] . ',';
}
$mails = rtrim($mails, ',');
echo $mails;
?>');
});
</script>
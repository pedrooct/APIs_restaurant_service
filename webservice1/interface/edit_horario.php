<?php

$id=$_GET['id'];
$res=file_get_contents("http://engpro.dev/obtain/horario/id/".$id);
$res=json_decode($res);

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="login">
	<title>web page of &ndash; Pedro Costa and Paulo Bento &ndash; Pure</title>


	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title></title>

</head>

<style></style>

<body>
	<div class="header">
		<div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
			<a class="pure-menu-heading" href="">Bem-vindo! faça o seu registo </a>
			<li class="pure-menu-item"><a href="restaurante_hub.php" class="pure-button"> Back </a></li>
		</div>
	</div>
	<div class="content">
		<div class="pure-g">
			<div class="l-box-lrg pure-u-2 pure-u-md-2-5">
				<form class="pure-form pure-form-stacked" method="POST">
					<fieldset>
						<label for="segunda" style="margin-top: 20px" >Horario do restaurante:</label>
						<label for="segunda" style="margin-top: 20px" >Segunda-feira:</label>
						<input name="segunda" type="time" class="pure-input-rounded" value=<?php echo $res[0]->segunda?>  <?php echo isset($_POST['segunda']) ? "value='".$_POST['segunda']."'":""; ?>  >
						<input name="segunda2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['segunda2']) ? "value='".$_POST['segunda2']."'":""; ?>  >

						<label for="terca" style="margin-top: 20px" >terça-feira:</label>
						<input name="terca" type="time" class="pure-input-rounded" value=<?php echo $res[0]->terca?>    <?php echo isset($_POST['terca']) ? "value='".$_POST['terca']."'":""; ?>  >
						<input name="terca2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['terca2']) ? "value='".$_POST['terca2']."'":""; ?>  >

						<label for="quarta" style="margin-top: 20px" >Quarta-feira:</label>
						<input name="quarta" type="time" class="pure-input-rounded" value=<?php echo $res[0]->quarta?>  <?php echo isset($_POST['quarta']) ? "value='".$_POST['quarta']."'":""; ?>  >
						<input name="quarta2" type="time" class="pure-input-rounded" <?php echo isset($_POST['quarta2']) ? "value='".$_POST['quarta2']."'":""; ?>  >

						<label for="quinta" style="margin-top: 20px" >Quinta-feira:</label>
						<input name="quinta" type="time" class="pure-input-rounded" value=<?php echo $res[0]->quinta?>  <?php echo isset($_POST['quinta']) ? "value='".$_POST['quinta']."'":""; ?>  >
						<input name="quinta2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['quinta2']) ? "value='".$_POST['quinta2']."'":""; ?>  >

						<label for="sexta" style="margin-top: 20px" >Sexta-feira:</label>
						<input name="sexta" type="time" class="pure-input-rounded" value=<?php echo $res[0]->sexta?> 	<?php echo isset($_POST['sexta']) ? "value='".$_POST['sexta']."'":""; ?>  >
						<input name="sexta2" type="time" class="pure-input-rounded"	<?php echo isset($_POST['sexta2']) ? "value='".$_POST['sexta2']."'":""; ?>  >

						<label for="sabado" style="margin-top: 20px" >Sabado:</label>
						<input name="sabado" type="time" class="pure-input-rounded" value=<?php echo $res[0]->sabado?>  <?php echo isset($_POST['sabado']) ? "value='".$_POST['sabado']."'":""; ?>  >
						<input name="sabado2" type="time" class="pure-input-rounded" <?php echo isset($_POST['sabado2']) ? "value='".$_POST['sabado2']."'":""; ?>  >

						<label for="domingo" style="margin-top: 20px" >Domingo:</label>
						<input name="domingo" type="time" class="pure-input-rounded" value=<?php echo $res[0]->domingo?>  <?php echo isset($_POST['domingo']) ? "value='".$_POST['domingo']."'":""; ?>  >
						<input name="domingo2" type="time" class="pure-input-rounded"  <?php echo isset($_POST['domingo2']) ? "value='".$_POST['domingo2']."'":""; ?>  >

						<label for="feriados" style="margin-top: 20px" >Feriados:</label>
						<input name="feriados" type="text" class="pure-input-rounded" value=<?php echo $res[0]->feriados?>   <?php echo isset($_POST['feriados']) ? "value='".$_POST['feriados']."'":""; ?>  >
						</fieldset>
					<button type="submit" name="editar" class="pure-button pure-button-primary">Registar</button>
					<?php

					if(isset($_POST['editar'])){

						$data=array(
							"segunda" => $_POST['segunda']." ".$_POST['segunda2'],
							"terca" => $_POST['terca']." ".$_POST['terca2'],
							"quarta" => $_POST['quarta']." ".$_POST['quarta2'],
							"quinta" => $_POST['quinta']." ".$_POST['quinta2'],
							"sexta" => $_POST['sexta']." ".$_POST['sexta2'],
							"sabado" => $_POST['sabado']." ".$_POST['sabado2'],
							"domingo" => $_POST['domingo']." ".$_POST['domingo2'],
							"feriados" => $_POST['feriados']
						);

						$data=json_encode($data);
						$curl=curl_init("http://engpro.dev/edit/horario/".$id);
						curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'PUT');
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
						$response=curl_exec($curl);
						if(strcmp($response,"ok")==0){
							header("Location: restaurante_hub.php");
						}
						echo $response;
						echo '<div id="erro" class="error">Algo correu mal !</div>';
					}
					?>
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2017! Engenharia Software Pedro Costa Nº: 31179 & Paulo Bento Nº:33959 .
	</div>
</div>
</body>
</html>

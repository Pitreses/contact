<?php
/*
Template Name: contact
*/
?>

<?php session_start();?>
<?php include('bb_include/header.php'); ?>
</head>
<body>

<?php include('bb_include/menu.php') ?>


<div class="row bgGris">
	<div class="container">
		<div class="row">
			<div class="col span-24 ombreContenu"></div>
		</div>
		
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="row">

				<div class="col span-12 paddingLeftRight15">
					<h1><?php the_title(); ?></h1>

					<?php if(ICL_LANGUAGE_CODE=='fr'){ ?>

						<!-- FORMULAIRE -->	
						<form id="contactForm" name="contactForm" method="POST" action="">
							Societé
							<input type="text"  name="societe" id="societe" placeholder="Votre societé">
							Nom*
							<input type="text"  name="nom" id="nom" placeholder="Votre nom">
							Prénom*<br/>
							<input type="text" name="prenom" id="prenom" placeholder="Votre prénom">
							Adresse<br/>
							<textarea name="adresse" id="adresse"></textarea>
							Code postal<br/>
							<input type="text" name="cp" id="cp" placeholder="Votre Code postal">
							Ville<br/>
							<input type="text" name="ville" id="ville" placeholder="Votre Ville">
							Téléphone*<br/>
							<input type="text" name="tel" id="tel" placeholder="Votre Téléphone">
							Fax<br/>
							<input type="text" name="fax" id="fax" placeholder="Votre Fax">
							Email*<br/>
							<input type="text" name="email" id="email" placeholder="Votre e-mail">							
							<br/>
							Votre demande*<br/>
							<textarea name="demande" id="demande"  placeholder="Votre demande" cols="43" rows="8"></textarea>
							<br>
							<input type="submit" value="Envoyer" class="envoyer">
							<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
						</form>
						<!-- FORMULAIRE -->	

					<?php } else if(ICL_LANGUAGE_CODE=='en'){ ?>

						<!-- FORMULAIRE -->	
						<form id="contactForm" name="contactForm" method="POST" action="">
							Company
							<input type="text"  name="societe" id="societe" placeholder="Votre societé">
							Last Name*
							<input type="text"  name="nom" id="nom" placeholder="Votre nom">
							First Name*<br/>
							<input type="text" name="prenom" id="prenom" placeholder="Votre prénom">
							Adress<br/>
							<textarea name="adresse" id="adresse"></textarea>
							Zip Code<br/>
							<input type="text" name="cp" id="cp" placeholder="Votre Code postal">
							Country<br/>
							<input type="text" name="ville" id="ville" placeholder="Votre Ville">
							Phone*<br/>
							<input type="text" name="tel" id="tel" placeholder="Votre Téléphone">
							Fax<br/>
							<input type="text" name="fax" id="fax" placeholder="Votre Fax">
							Email*<br/>
							<input type="text" name="email" id="email" placeholder="Votre e-mail">							
							<br/>
							Your message*<br/>
							<textarea name="demande" id="demande"  placeholder="Votre demande" cols="43" rows="8"></textarea>
							<br>
							<input type="submit" value="Send" class="envoyer">
							<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
						</form>
						<!-- FORMULAIRE -->	

					<?php } else if(ICL_LANGUAGE_CODE=='zh-hant'){ ?>

						<!-- FORMULAIRE -->	
						<form id="contactForm" name="contactForm" method="POST" action="">
							公司名称
							<input type="text"  name="societe" id="societe">
							姓*
							<input type="text"  name="nom" id="nom">
							名*<br/>
							<input type="text" name="prenom" id="prenom">
							地址<br/>
							<textarea name="adresse" id="adresse"></textarea>
							邮编<br/>
							<input type="text" name="cp" id="cp">
							城市<br/>
							<input type="text" name="ville" id="ville">
							电话*<br/>
							<input type="text" name="tel" id="tel">
							传真<br/>
							<input type="text" name="fax" id="fax">
							邮箱*<br/>
							<input type="text" name="email" id="email">							
							<br/>
							留言*<br/>
							<textarea name="demande" id="demande" cols="43" rows="8"></textarea>
							<br>
							<input type="submit" value="發送" class="envoyer">
							<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
						</form>
						<!-- FORMULAIRE -->	
						

					<?php } ?>

					<script src="https://www.google.com/recaptcha/api.js?render="></script>
					<script>grecaptcha.ready(function() {
						grecaptcha.execute('', {action: 'page_load'}).then(function(token) {
							var recaptchaResponse = document.getElementById('recaptchaResponse');
                			recaptchaResponse.value = token;// Validez le jeton sur le serveur.
						});
					});
					</script> 



					<?php
					    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["tel"]) && !empty($_POST["email"]) && !empty($_POST["demande"] && $_SERVER['REQUEST_METHOD'] === 'POST')){
					    	
					    	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    						$recaptcha_secret = '';
    						$recaptcha_response = $_POST['recaptcha_response'];

    						$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    						$recaptcha = json_decode($recaptcha);

    						if ($recaptcha->score >= 0.1) {
					    			$societe = str_replace("'"," ",$_POST["societe"]);
					        		$nom = str_replace("'"," ",$_POST["nom"]);
					        		$prenom = str_replace("'"," ",$_POST["prenom"]);
					        		$adresse = $_POST["adresse"];
					        		$cp = str_replace("'"," ",$_POST["cp"]);
					        		$ville = str_replace("'"," ",$_POST["ville"]);
					        		$tel = str_replace("'"," ",$_POST["tel"]);
					        		$fax = str_replace("'"," ",$_POST["fax"]);
					       			$email = $_POST["email"];
					        		$demande = $_POST["demande"];
					    
					        		//$to="";
					        		$to="";
					        
					        		$from ="";
					       
					        		$subject = "CONTACT SUR LE SITE MAISON PAUVIF";
					        		$body = ""; 
					       			$body = "<br>       
					            
					            		<b>Societé:</b> $societe<br>
					            		<b>Nom:</b> $nom<br>
					            		<b>Prenom:</b> $prenom<br>
					            		<b>Adresse:</b> $adresse<br>
					            		<b>Code postal:</b> $cp<br>
					            		<b>Ville:</b> $ville<br>
					            		<b>Téléphone:</b> $tel<br>
					            		<b>Fax:</b> $fax<br>
					            		<b>Email:</b> $email<br><br>

					            		<b>Demande:</b> $demande<br><br>

					            		";

					        	//$bodyEncode = utf8_decode($body);

					        		$header = "Reply-To: ".$from."\n"; 
					        		$header .= "From: ".$from."\n";
					        		$header .= "Return-Path:  \n"; 
					        		$header .= "Content-Type: text/html; charset=UTF-8\n"; 
					        		$header .= "MIME-Version: 1.0\n"; 
					        
					                
					    		mail($to, $subject, $body, $header);
					       		// mail($to2, $subject, $body, $header);

					    		if(ICL_LANGUAGE_CODE=='fr') {
					    			echo '<div class="emailEnvoye">VOTRE MESSAGE A BIEN ETE ENVOYE<br>Nous ne manquerons pas de vous répondre dans les plus brefs délais.</div>';
					    		} else if(ICL_LANGUAGE_CODE=='en') {
					    			echo '<div class="emailEnvoye">YOUR MESSAGE HAS BEEN SENT<br>We will respond as soon as possible.</div>';
					    		} else if(ICL_LANGUAGE_CODE=='zh-hant') {
					    			echo '<div class="emailEnvoye">YOUR MESSAGE HAS BEEN SENT<br>We will respond as soon as possible.</div>';
					    		}
					    	}

					    	else {
        						// Not verified - show form error
        						echo var_dump($recaptcha->success);
        						echo var_dump($recaptcha->challenge_ts);
        						echo var_dump($recaptcha->hostname);
        						echo var_dump($recaptcha->score);
        						echo var_dump($recaptcha->action);
        						echo var_dump($recaptcha->error-codes);
    						}
					            

					    }
					?>
					


				</div>
				<div class="col span-12 paddingLeftRight15 paddingTop40">
					<?php the_content(); ?>
					<iframe src="" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>

				</div>
			</div>
		<?php endwhile; endif; ?>

		<div class="row">
			<div class="col span-24 ombreContenuBas"></div>
		</div>
	</div>
</div>



<?php include('bb_include/footer.php') ?>



</body>
</html>

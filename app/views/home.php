<!-- HEADER Start -->

<?php
if($errors->any())	echo '<div class="alert alert-error">' . implode('', $errors->all(':message')) . '</div>';

if(Session::has('message'))	echo '<div class="float-alert">' . Session::get('message') . '</div>';
?>
<!-- HEADER End -->
<div id="fb-root"></div>
<div class="overlay"></div>
<div class="popup-conditions">
	<a href="#close" class="btn-close">&nbsp;&nbsp;&nbsp;</a>
	<img src="<?php echo URL::asset('img/terminosycondiciones.jpg'); ?>" alt=""/>
</div>

<div class="popup-msg">
	<a href="#close" class="btn-close-msg">&nbsp;&nbsp;&nbsp;</a>
	<img src="<?php echo URL::asset('img/completarcampos1.png'); ?>" alt=""/>
</div>

<div class="popup-msg2">
	<a href="#close" class="btn-close-msg">&nbsp;&nbsp;&nbsp;</a>
	<img src="<?php echo URL::asset('img/completarcampos2.png'); ?>" alt=""/>
</div>

<div class="popup-wait">
	<div class="popup-content">
		<span>Por favor espera mientras <br/>guardamos tus datos</span>
	</div>
</div>

<div class="popup-success">
	<div class="popup-content11">
		<a href="javascript:void(0);"><img id='closeSuccess' src="<?php echo URL::asset('img/gracias1.jpg'); ?>" alt=""/></a>
	</div>
</div>



<div class="container">
	<div id="content" class="row-fluid">
		<div class="span9">
			<img class="titlec" src="<?php echo URL::asset('img/title_cencosud.png'); ?>" alt=""/>
			<img class="datec" src="<?php echo URL::asset('img/date.png'); ?>" alt=""/>
			<div class="block-register">
				<form id="form">
					<table border="0" cellpadding="0" cellspacing="0" class="table-register">
						<tr> <th>Nombres:</th> <td><input type="text" name="name"/> <span class="asterisk">*</span></td> </tr>
						<tr> <th>Apellido <br/> Paterno:</th> <td><input type="text" name="surname_father"/> <span class="asterisk">*</span></td> </tr>
						<tr> <th>Apellido <br/> Materno:</th> <td><input type="text" name="surname_mother"/> <span class="asterisk">*</span></td> </tr>
						<tr> <th>DNI:</th> <td><input type="text" name="dni"/> <span class="asterisk">*</span></td> </tr>
						<tr> <th>Correo <br/> Electrónico:</th> <td><input type="text" name="email"/> <span class="asterisk">*</span> </td> </tr>
						<tr> <th>Teléfono:</th> <td><input type="text" name="phone"/> <span class="asterisk">*</span> </td> </tr>
					</table>
					<div class="pull-right terminos" style="padding-top: 10px;">
						<p>(*) CAMPOS OBLIGATORIOS</p>
						<p><label for="conditions"> <input type="checkbox" id="conditions" name="conditions"/> Acepto los <a id="aconditions" href="#terminos">términos y condiciones</a></label></p>
						
					</div>
					<div style="text-align:right;padding-top: 10px;">
						<p>
							<a id="submitform" href="#submit" class="button-green button">ENVIAR</a>
						</p>
					</div>
					
				</form>
			</div>
		</div>

		<div class="span3">
			<div class="contentimgchris">
				<img class="imgchris" src="<?php echo URL::asset('img/chris_gardner.png'); ?>" alt=""/>
			</div>
		</div>
	</div>
</div>

<!-- FOOTER Start -->
<div id="footer">
</div>


<script >
$(document).ready(initSite);

	function initSite(){
		window.fbAsyncInit = function() {
		FB.init({
		  appId      : '802296979839630',
		  xfbml      : true,
		  version    : 'v2.2'
		});
		FB.Canvas.setSize({ height: 625 });
		};

		(function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		var rules = {
			name: 'required',
			surname_father: 'required',
			surname_mother: 'required',
			dni: {	required: true,	minlength: 8, maxlength: 8,number:true },
			email: {required: true, email: true },
			conditions: 'required',
			phone: 'required'
		};

		$('#submitform').click(function(){$('#form').submit();});
		$('.popup-conditions .btn-close').click(closeConditions);
		$('#aconditions').click(showconditions);
		$('#closeSuccess').click(function(){
			$('.overlay').fadeOut('fast');
			$('.popup-success').fadeOut('fast');
		});
		$('.btn-close-msg').click(function(){
			$('.overlay').fadeOut('fast');
			$('.popup-msg').fadeOut('fast');
			$('.popup-msg2').fadeOut('fast');
		});

		

		$('#form').validate({
			rules: rules,
			invalidHandler: function(event, validator) {
				var errors = validator.numberOfInvalids();
				if (errors == 1 && !$('#conditions').prop('checked'))
					showMsgErrorConditions();
				else
					showMsgError();
			},
			submitHandler: function () {
				$('.overlay').fadeIn('fast');
				$('.popup-wait').fadeIn('fast');
				$.ajax({
					type: 'POST',
					url: "<?php echo URL::to('api/v1/client/new'); ?>",
					dataType: "json",
					data: $('#form').serialize(),
					success: function (response) {
						$('.popup-wait').fadeOut('fast');
						$('.popup-success').fadeIn('fast');
						$('#form').find('input:text').val('');
						$('#form :checked').removeAttr('checked');
					},
					error: function(data) {
					},
					async: false
				});
			}
		});

		function showconditions(){
			$('.overlay').fadeIn('fast');
			$('.popup-conditions').fadeIn('fast');
		}

		function showMsgError(){
			$('.overlay').fadeIn('fast');
			$('.popup-msg').fadeIn('fast');
		}

		function showMsgErrorConditions(){
			$('.overlay').fadeIn('fast');
			$('.popup-msg2').fadeIn('fast');
		}

		function closeConditions() {
			$('.overlay').fadeOut('fast');
			$('.popup-conditions').fadeOut('fast');
			
			return false;
		}
	}
</script>
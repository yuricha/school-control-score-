<div id="content">
	<div class="container">
		<div class="content-body">
			<h1>Registrate</h1>
			<div class="row-fluid">
				<div class="span6">
					<p class="text-important">Crea tu cuenta y empieza a comprar a precios increibles!.</p>
					<form action="<?php echo URL::to('users/register'); ?>" id="form_user"  method="post">
						<input type="hidden" id="fb_id" name="fb_id" value="-1" />
						<div class="content-column">

							<p>
								<label for="username">Usuario:</label>
								<input id="username" name="username" type="text" class="input-block-level"/>
							</p>
							<p>
								<label for="email">E-mail:</label>
								<input id="email" name="email" type="text" class="input-block-level"/>
							</p>
							<p>
								<label for="password">Password:</label>
								<input id="password" name="password" type="password" class="input-block-level"/>
							</p>
							<p class="text-center"><button type="submit" class="">Registrarme</button></p>
						</div>
					</form>
				</div>
				<div class="span6">
					<p class="text-important">También puedes activar tu cuenta con Facebook.</p>
					<br/>
					<div class="fb-card media" style="display: none;">
						<img class="media-object image pull-left" src="" />
						<div class="media-body">
							<h4 class="name media-heading"></h4>
							<p class="email media"></p>
						</div>
					</div>
					<p class="text-center"><a href="#loginfb" class="login_fb"><img src="<?php echo URL::asset('img/fb_login.jpg');  ?>" /></a></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var FBUser;
	window.fbAsyncInit = function() {
		FB.init({ appId:'570971236344099', status:true, cookie:true, xfbml:true });
		FB.Event.subscribe('auth.authResponseChange', function(response) {
			if (response.status === 'connected') {
				//FB.api('me', updateFacebookInfo);
			} else if (response.status === 'not_authorized') {
				//FB.login();
			} else {
				//FB.login();
			}
		});
	};

	// Load the SDK asynchronously
	(function(d){ var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0]; if (d.getElementById(id)) {return;} js = d.createElement('script'); js.id = id; js.async = true; js.src = "//connect.facebook.net/en_US/all.js"; ref.parentNode.insertBefore(js, ref); }(document));
</script>
<script type="application/javascript">
	$(document).ready(initPage);

	function initPage()
	{
		$('.login_fb').click(loginFacebook);
	}

	function updateFacebookInfo(_response)
	{
		$('.fb-card .image').attr('src', 'https://graph.facebook.com/'+_response.id+'/picture');
		$('.fb-card .name').text(_response.name);
		$('.fb-card .email').text(_response.email);

		$('.login_fb').fadeOut(function(){
			$('.fb-card').fadeIn();
		});

	}

	function loginFacebook()
	{
		FB.login(function(_response){
			if(_response)
			{
				FB.api('me', function(res){
					console.log(res);
					$('#username').val(res.username);
					//$('#last_name').val(_response.last_name);
					$('#fb_id').val(res.id);
					$('#email').val(res.email);
					updateFacebookInfo(res);
					$('#form_user').submit();
				});
			}
		}, {'scope':'email, publish_actions'});
	}
</script>
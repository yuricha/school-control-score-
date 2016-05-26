<div class="content">
	<h1>Gestor de Publicaciones</h1>
	<p>Listado de publicaciones que se muestran en el sitio web</p>
	<br/>
	<div class="row">
		<div class="col-md-3" >
			<div class="pull-right"><select>
					<option>Ver todo</option>
					<option>Tours</option>
					<option>Hoteles</option>
				</select></div>
			<h3>Publicaciones</h3>
			<ul id="list-questions" class="list-menu">
				<li><a href="">No existen publicaciones</a> </li>

			</ul>
		</div>

		<!-- End lista de roles -->

		<div class="col-md-9" style="border-left: 1px solid #CCC;" >
			<!--<a href="#add_user" class="btn btn-add pull-right"><span class="icon-add"></span> Crear nueva publicación</a>-->
			<div class="error_empty">
				<h2>Aún no tenemos publicaciones</h2>
				<p>Selecciona una publicación en la lista de la izquierda para verla o editarla</p>
				<p><a href="#add_post" class="btn btn-add"><span class="icon-add"></span> Crear nueva publicación</a></p>
			</div>
			<div>
				<ul class="list-items">

				</ul>
			</div>
		</div>
	</div>
</div>

<!-- ------------------------------------------------------------------------- Dummy's  -->

<div class="dummy dummy-add-user">
	<form action="<?php echo URL::to('api/v1/users/save'); ?>" method="post" class="form-inline">
		<input type="hidden" id="id" name="id" value="-1" />
		<div class="row">
			<div class="col-md-3">
				<p><label class="inline" for="name">Nombre:</label></p>
				<p><label class="inline" for="last_name">Apellidos:</label></p>
				<p><label class="inline" for="email">E-mail:</label></p>
				<p><label class="inline" for="company_id">Compañía:</label></p>
			</div>
			<div class="col-md-9">
				<p><input id="name" name="name" type="text" class="form-control"/></p>
				<p><input id="last_name" name="last_name" type="text" class="form-control"/></p>
				<p><input id="email" name="email" type="text" class="form-control"/></p>
				<p><select id="company_id" name="company_id">
						<option value="-1">Selecciona una compañia</option>
						<?php
						foreach($companies as $c)
						{
							echo '<option value="'.$c->id.'">'.$c->name.'</option>';
						}
						?>
					</select>
				</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<p class="text-center"><button type="submit">Guardar</button></p>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(initSection);

	function initSection()
	{
		$('.btn-add').click(BTN_CLICK_handler);
		$('.list-items a').click(BTN_CLICK_handler);
	}

	function BTN_ROLES_handler()
	{
		loadUsers({role:''});
	}


	function BTN_CLICK_handler()
	{
		switch ($(this).attr('href'))
		{
			case '#add_user':
				openAddUser();
				break;
			case '#edit_user':
				var id_user = $(this).parent().parent().attr('id');
				openAddUser(id_user);
				break;
			case '#delete_user':
				var id_user = $(this).parent().parent().attr('id');
				AlertBox.show('Eliminando usuario');
				$.get('<?php echo URL::to('api/v1/users/delete'); ?>/' + id_user, function(_data){
					AlertBox.hide();
					MainNav.reload();
				});
				break;
		}

		return false;
	}

	function loadUsers(_options)
	{
		$.post('<?php echo URL::to('api/v1/users'); ?>', {'id':_iduser}, function(_res){
			_dom.find('#id').val(_res.data.id);
			_dom.find('#name').val(_res.data.name);
			_dom.find('#last_name').val(_res.data.last_name);
			_dom.find('#email').val(_res.data.email);
			_dom.find('form').css('opacity', '1');
		}, 'json');
	}

	function openAddUser(_iduser)
	{
		ModalBox.open($('.dummy-add-user').html(), {
			title:'Registrar usuario',
			height:290,
			onCreate:function(_dom)
			{
				_dom.find('form').css('opacity', '0.5');

				$.post('<?php echo URL::to('api/v1/users'); ?>', {'id':_iduser}, function(_res){
					_dom.find('#id').val(_res.data.id);
					_dom.find('#name').val(_res.data.name);
					_dom.find('#last_name').val(_res.data.last_name);
					_dom.find('#email').val(_res.data.email);
					_dom.find('form').css('opacity', '1');
				}, 'json');
			},
			onSendComplete:function()
			{
				ModalBox.close();
				MainNav.reload();
			}
		});
	}
</script>
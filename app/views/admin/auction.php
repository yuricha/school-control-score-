<div id="page_locals" class="content">
	<div class="row-fluid">
		<div class="span3" >
			<h4>Subastas disponibles</h4>
			<ul class="list-menu list-locals">
				<?php foreach($auctions as $a)
				{
					echo '<li><a href="#get_local" id="'.$a->id.'">' . $a->product->name . '<span>' . $a->type . '</span></a> </li>';
				} ?>
			</ul>
			<br/>
			<p><a href="#add_local" class="button autofit">Crear nueva subasta</a></p>
		</div>

		<!-- End lista de roles -->

		<div class="span9" id="client-page">
			<div class="content-box">

				<hr class="visible-phone" />
				<div class="msg-help">
					<h2>Elige una subasta para ver su información</h2>
					<p>También puedes agregar una nueva usando el boton de agregar.</p>
				</div>

				<!-- Fin -->

				<div class="form-local-info" style="display: none;">
					<h2 class="title_add">Nueva subasta</h2>
					<form action="<?php echo URL::to('api/v1/auctions/save'); ?>" id="form_local" method="post">
						<input type="hidden" id="local_id" name="id" value="-1">
						<div class="row-fluid">
							<div class="span6">
								<label for="product_id">Producto: </label>
								<select name="product_id" id="product_id" class="input-block-level"><?php foreach($products as $p) echo '<option value="'.$p->id.'">'.$p->name.'</option>' ?></select>
								<label for="product_id">Tipo de subasta: </label>
								<select name="type" id="type" class="input-block-level"><option value="normal">Subasta normal</option></select>
							</div>
							<div class="span6">
								<label for="size">Precio base: </label><input type="text" id="init_price" name="init_price" class="input-block-level"/>
								<label for="size">Fecha de fin: </label><input type="text" id="date_end" name="date_end" class="input-block-level"/>
							</div>
						</div>
						<br/>

						<h4>Opciones de subasta:</h4>
						<label for="auto_bid" class="checkbox"><input type="checkbox" id="auto_bid" name="auto_bid" value="1" /> Permitir subasta automática </label>
						<label for="status" class="checkbox"><input type="checkbox" id="status" name="status" value="1" /> Subasta activa</label>

						<br/>
						<p class="text-center"><button type="submit" >Guardar subasta</button></p>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(initSection);

	var local_selected;
	var newLocal = false;
	var map, marker;

	function initSection()
	{
		$('#page_locals a').click(BTN_CLICK_handler);
		$('#form_local').submit(SAVE_LOCAL_handler);
		$('#client_search').focus();
		map = null;
		marker = null;
	}

	function BTN_CLICK_handler()
	{
		switch ($(this).attr('href'))
		{
			case '#add_local':
				$('.msg-help').hide();
				//$('.title_add').show();
				$('.form-local-info').fadeIn();
				$('input[ type=text ]').val('');
				$('input[ type=checkbox ]').prop('checked', false);
				$(this).parent().parent().find('.active').removeClass('active');
				$('#name').focus();
				newLocal = true;
				return false;
				break;
			case '#get_local':
				newLocal = false;
				//$('.title_add').hide();
				$(this).parent().parent().find('.active').removeClass('active');
				$(this).addClass('active');
				$('.msg-help').hide();
				$('.form-local-info').fadeIn();
				local_selected = $(this).attr('id');
				loadLocal(local_selected);
				break;
		}
		return false;
	}

	function SAVE_LOCAL_handler()
	{
		AlertBox.show('Guardando información de usuario');
		var form = $(this);
		var action = form.attr('action');
		var params = form.serializeArray();

		form.css('opacity', '0.5');
		$.post(action, params, function(){
			form.css('opacity', '1');
			if(newLocal)
				MainNav.reload();
			else
				AlertBox.hide();
		});

		return false;
	}

	function loadLocal(_idlocal)
	{
		AlertBox.show('Cargando información');
		$('#form_local input[type=text]').val('');
		$('input[ type=checkbox ]').prop('checked', false);
		$.post('<?php echo URL::to('api/v1/auctions'); ?>', {'id':_idlocal}, function(_res)
		{
			$('#local_id').val(_res.data.id);
			if(_res.data.status == '1')$('#status').prop('checked', 'checked');
			if(_res.data.auto_bid == '1')$('#auto_bid').prop('checked', 'checked');
			$('.title_add').text(_res.data.product.name);
			$('#init_price').val(_res.data.init_price);
			$('#date_end').val(_res.data.date_end);
			$('#product_id').val(_res.data.product_id);

			AlertBox.hide();
		}, 'json');
	}

</script>
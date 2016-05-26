<ul class="nav nav-tabs">
	<li class="active"><a href="#api" data-toggle="tab">API</a></li>
	<li><a href="#change-log" data-toggle="tab">Change log</a></li>
	<li><a href="#admin" data-toggle="tab">Estructura de URL's</a></li>
	<li><a href="#status" data-toggle="tab">Códigos de status</a></li>
</ul>
<div class="content">
		<div class="tab-content">
			<div id="api" class="tab-pane active">
				<h2>Información sobre la API</h2>
				<p><span class="text-warning">Versión de API: </span> v 1.0<br/>
					<span class="text-warning">Path: </span> <?php echo URL::to('api/v1/'); ?>/<br>
					<span class="text-warning">Password: </span> 123456<br>
					<span class="text-warning">User: </span> admin
				</p>

                <hr>

                <h4><span class="badge badge-info">client</span> :: <?php echo URL::to('api/v1/client'); ?></h4>
                <p>Permite listar todos los clientes o buscar uno ya existente.</p>
                <p>Campos de busqueda</p>
                <ul>
                    <li><span class="text-success">company</span> [string] - Razon Social de la empresa</li>
                    <li><span class="text-success">active</span> [bit] - Estado inactivo=0, activo=1</li>
                    <li><span class="text-success">type_channel</span> [string] - Tipo de canal</li>
                </ul>
				<hr>

                <h4><span class="badge badge-info">client/save</span> :: <?php echo URL::to('api/v1/client/save'); ?></h4>
                <p>Permite actualizar un cliente.</p>
                <p>Lista de parametros o campos a ingresar.</p>
                <ul>
                    <li><span class="text-success">id</span> [integer] - ID del cliente que se quiere actualizar</li>
                    <li><span class="text-success">dni</span> [decimal(8,0)] - DNI del cliente</li>
                    <li><span class="text-success">company</span> [string] - Razon Social de la empresa</li>
                    <li><span class="text-success">active</span> [bit] - Estado inactivo=0, activo=1</li>
                    <li><span class="text-success">type_channel</span> [string] - Tipo de canal</li>
                </ul>
                <hr>

                <h4><span class="badge badge-info">client/delete</span> :: <?php echo URL::to('api/v1/client/delete'); ?></h4>
                <p>Permite eliminar un cliente con sus respectivos contactos.</p>
                <p>Lista de parametros o campos a ingresar.</p>
                <ul>
                    <li><span class="text-success">id</span> [integer] - ID del cliente que se quiere eliminar</li>
                </ul>
                <hr>

                <h4><span class="badge badge-info">client/new</span> :: <?php echo URL::to('api/v1/client/new'); ?></h4>
                <p>Permite registrar un nuevo cliente</p>

                <p>Lista de parametros o campos a ingresar</p>
                <ul>
                    <li><span class="text-success">company</span> [string] - Razon Social de la empresa</li>
                    <li><span class="text-success">active</span> [bit] - Estado inactivo=0, activo=1</li>
                    <li><span class="text-success">type_channel</span> [string] - Tipo de canal</li>
                </ul>



               <hr>
                <h4><span class="badge badge-info">contact/new</span> :: <?php echo URL::to('api/v1/contact/new'); ?></h4>
                <p>Permite registrar un nuevo contacto</p>

                <p>Lista de parametros o campos a ingresar</p>
                <ul>
                    <li><span class="text-success">client_id</span> [integer] - ID del cliente al que se le quiere asignar el nuevo contacto</li>
                    <li><span class="text-success">name</span> [string] - Nombre y Apellido del contacto</li>
                    <li><span class="text-success">email</span> [string] - Email del contacto</li>

                </ul>
                <hr>

                <h4><span class="badge badge-info">companydata/new</span> :: <?php echo URL::to('api/v1/companydata/new'); ?></h4>
                <p>Permite agregar los datos de la empresa</p>

                <p>Lista de parametros o campos a ingresar</p>
                <ul>
                    <li><span class="text-success">client_id</span> [integer] - ID del cliente al que se le quiere asignar el nuevo contacto</li>
                    <li><span class="text-success">name</span> [string] - Nombre y Apellido del contacto</li>
                    <li><span class="text-success">dni</span> [decimal(8,0)] - DNI del cliente</li>
                    <li><span class="text-success">email_primary</span> [string] - Email del contacto</li>
                    <li><span class="text-success">phone</span> [integer] - Telefono de la empresa</li>
                    <li><span class="text-success">country</span> [string] - Pais</li>
                    <li><span class="text-success">province</span> [string] - Provincia</li>
                    <li><span class="text-success">city</span> [string] - Ciudad</li>
                    <li><span class="text-success">address</span> [string] - Direccion de la empresa</li>
                    <li><span class="text-success">code_postal</span> [string] - Codigo postal</li>
                    <li><span class="text-success">site_web</span> [string] - Email del contacto</li>
                    <li><span class="text-success">review</span> [string] - Reseña de la empresa</li>
                </ul>
                <hr>


                <h4><span class="badge badge-info">autocatlt</span> :: <?php echo URL::to('api/v1/autocatlt'); ?></h4>
                <p>Iterface Bienvenido de AutocatLT</p>
                <hr>

                <h4><span class="badge badge-info">autocatlt/description</span> :: <?php echo URL::to('api/v1/autocatlt/description'); ?></h4>
                <p>Iterface Descripcion de AutocatLT</p>

                <hr>
                <h4><span class="badge badge-info">autocatlt/shop</span> :: <?php echo URL::to('api/v1/autocatlt/shop'); ?></h4>
                <p>Iterface para solicitar licencias AutocatLT</p>







			</div>

			<div id="change-log" class="tab-pane">
				<h2>Change Log</h2>
				<h4>V0.1</h4>
				<ul>
					<li><span class="label label-success">Completo</span> Pantalla de bienvenida con enlaces para iniciar sesión y registrarse.</li>
					<li><span class="label label-success">Completo</span> Formulario de login.</li>
					<li><span class="label label-success">Completo</span> Pantalla de bienvenida para usuarios logueados.</li>
					<li><span class="label label-warning">Pendiente</span> Control de acceso al administrador disponible solo para usuarios publisher y administrador.</li>
					<li><span class="label label-success">Completo</span> Gestión de usuarios crear/editar/eliminar/asignación de rol.</li>
					<li><span class="label label-success">Completo</span> Opción para deshabilitar usuarios, restringiendo el acceso de estos.</li>
					<li><span class="label label-success">Completo</span> API de usuarios con opciones de loguear, buscar, registrar y editar.</li>
					<li><span class="label label-success">Completo</span> Sección de gestión de locales con opción para crear y editar locales.</li>
					<li><span class="label label-success">Completo</span> API de locales con opción para crear y listar locales.</li>
					<li><span class="label label-success">Completo</span> API para crear reservas.</li>
				</ul>
				<h4>V0.2</h4>
				<ul>
					<li><span class="label label-success">Completo</span> Autenticanción de API.</li>
					<li><span class="label label-warning">Pendiente</span> Registro de usuarios a traves de la web.</li>
				</ul>
			</div>

			<div id="admin" class="tab-pane">
				<h2>Rutas de administración</h2>
				<h4>Usuarios</h4>
				<ul>
					<li>Login :: /login</li>
					<li>Registro :: /registro</li>
				</ul>
			</div>

			<div id="status" class="tab-pane">
				<h2>Códigos de respuesta</h2>
				<ul>

				<?php
					foreach(Status::getMessages() as $msg)
					{
						echo '<li><span class="label label-warning">' . $msg['CODE'] . '</span> :: ' . $msg['MESSAGE'] .'</li>';
					}
				?>
				</ul>
			</div>


		</div>
</div>
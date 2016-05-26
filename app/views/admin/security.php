<div id="page_users" class="content" ng-controller="SecurityController">

	<div class="row-fluid">
		<div class="col-md-3" >
			<h3>Seguridad y usuarios</h3>
			<div class="content-search">
				<input type="text" ng-change="search()" ng-model="searchText" class="input-block-level" />
				<a ng-click="search()"><span class="ii-search"></span></a>
			</div>
			<div class="filters">
				{{windowHeight}} Filtros: <span><span class="label label-success">Estado</span> <span class="label label-success">Rol</span> </span> <a ng-click="addFilter()"><span class="ii-circle-plus"></span></a>
			</div>

			<!-- Listado de usuarios -->

			<ul class="list-menu" app-resizable offset-bottom="53">
				<li ng-repeat="user in users.data | filter:searchText">
					<a href="" ng-class="getSelected(user.id)" ng-click="selectUser(user, $index)">{{user.person.name}} {{user.person.last_name}}<span>{{user.username}} - {{user.email}}</span></a>
				</li>
			</ul>

			<p><a ng-click="createUser()" class="button button-autofit"><span class="ii-circle-plus icon16"></span> Crear usuario</a></p>
		</div>

		<!-- Detalle de usuario seleccionado -->

		<div class="col-md-9" >

			<!-- Mensajes de bienvenida -->
			<div class="{{user?'collapse':''}}">
				<div class="error_info">
					<h3>Seleccionar un usuario de la lista</h3>
					<p>Puedes usar el buscador para ubicar otros usuarios.</p>
				</div>
			</div>

			<div ng-controller="alertCtrl" ng-show="errores.length > 0">
				<!--<alert ng-repeat="e in errores" type="{{alert.type}}" close="closeAlert($index)">-->
				<alert ng-repeat="e in errores" type="danger" close="closeAlert($index)">
					{{e}}
				</alert>
			</div>

			<div class="{{user?'content-box':'collapse'}}">
				<div class="content">
					<div class="pull-right">
						<a ng-click="close()"><span class="ii-cross"></span></a>
					</div>

					<div class="user-card">
						<h3 class="title">{{user.person.name}} {{user.person.last_name}}</h3>
						<p>{{user.email}}</p>
						<p>
							<a class="button button-mini button-red" ng-hide="user.disabled==1" ng-click="changeStatus()" ><span class="ii-ban"></span> Desabilitar</a>
							<a class="button button-mini" ng-hide="user.disabled==0" ng-click="changeStatus()" ><span class="ii-ban"></span> Habilitar</a>
							<a class="button button-mini button-red" ng-click="delete()" title="Los datos del usuario no perderán simplemente no figurarán dentro del sistema"><span class="ii-trash"></span> Eliminar</a>
						</p>
					</div>
				</div>

				<!-- Section tabs -->

				<div ng-controller="TabsUser">
					<tabset>
						<tab heading="Información personal" >
							<div class="content">
								<form ng-submit="save()">
									<div id="personal">
										<div class="row-fluid">
											<div class="col-md-6" class="tab-pane">
												<p>
													<label for="name">Nombre:</label>
													<input type="text" name="name" ng-model="user.person.name" class="input-block-level"/>
												</p>
												<p>
													<label for="last_name">Apellidos:</label>
													<input type="text" name="last_name" ng-model="user.person.last_name"  class="input-block-level"/>
												</p>
												<p>
													<label for="dni">DNI:</label>
													<input type="text" name="dni" ng-model="user.person.dni"  class="input-block-level"/>
												</p>
												<p>
													<label for="name">Email:</label>
													<input type="text" name="email" ng-model="user.email"  class="input-block-level"/>
												</p>
											</div>
											<div class="col-md-6">
												<h4>Datos de acceso</h4>
												<p>
													<label for="username">Usuario:</label>
													<input type="text" name="username" ng-model="user.username"  class="input-block-level"/>
												</p>
												<p>
													<label for="role">Tipo de usuario:</label>
													<select name="roles" ng-model="user.roles[0].id" class="input-block-level">
														<?php
														foreach($roles as $rol)
															echo '<option value="'.$rol->id.'" >'.$rol->name.'</option>';
														?>
													</select>
												</p>
												<p>
													<a ng-click="activatePassword()"><span class="ii-edit"></span> Activar cambio de contraseña</a>
													<div class="animate" ng-show="user.password">
														<label for="password">Password:</label>
														<input type="text" name="password" ng-model="user.password" class="input-block-level"/>
													</div>
												</p>
											</div>
										</div>
										<p class="text-center"><button type="submit">Guardar cambios</button>&nbsp;<button type="button" class="button-red" ng-click="reset()">Cancelar cambios</button></p>
									</div>
								</form>
							</div>
						</tab>
						<!-- End personal -->

						<tab heading="Perfil" ng-hide="(user.roles[0].name == 'Reclutador')?false:true" >
							<div>

								<div id="perfil" >
								<div class="row-fluid">
									<div class="col-md-4 offset1">
										<h4>Atributos de la persona</h4>
										<div ui-tree="options" class="angular-ui-tree">
											<ol ui-tree-nodes="" ng-model="attributes1">
												<li ng-repeat="attr in attributes1" ui-tree-node>
													<div ui-tree-handle>
														 {{attr.title}} 
													</div>
													<ol ui-tree-nodes="" ng-model="attr.nodes">
														<li ng-repeat="subItem in attr.nodes" ui-tree-node>
															<div ui-tree-handle>
																 {{subItem.title}} 
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</div>
										<!-- 
										<select name="att" id="att" multiple="multiple" style="height: 150px;" class="input-block-level">
											<option value="person">NSE</option>
											<option value="person">NSEA1</option>
											<option value="person">NSEA2</option>
											<option value="person">NSEB1</option>
											<option value="person">NSEB2</option>
											<option value="person">NSEC1</option>
											<option value="person">NSEC2</option>
											<option value="person">NSED</option>
											<option value="person">NSEE</option>
											<option value="person">NSEF</option>
										</select>
										-->
									</div>
									<div class="col-md-2 text-center">
										<br/>
										<br/>
										<br/>
										<br/>
										<a class="button">Agregar</a>
										<br/>
										<br/>
										<a class="button">Remover</a>
									</div>
									<div class="col-md-4">
										<h4>Atributos disponibles</h4>
										<select name="att" id="att" multiple="multiple" style="height: 150px;" class="input-block-level">
											<option value="person">Nivel Socio Economico</option>
											<option value="person">Grado de educacion</option>
											<option value="person">Intereses</option>
											<option value="person">Tiene auto</option>
										</select>
									</div>
								</div>
								<br><br><br>
								<p class="text-center"><button type="submit">Guardar cambios</button></p>
							</div>
							</div>

						</tab>
						<!-- End perfil -->

						<!-- Solo para reclutadores -->
						<tab heading="Reclutador" ng-hide="(user.roles[0].name == 'Reclutador')?false:true">
							<div class="content">
								<form ng-submit="save()">
									<div id="personal">
										<div class="row-fluid">
											<div class="col-md-6" class="tab-pane">
												<p>
													<label for="dni">DNI:</label>
													<input type="text" name="dni" ng-model="user.person.dni"  class="input-block-level"/>
												</p>
												<p>
													<label for="name">Email:</label>
													<input type="text" name="email" ng-model="user.email"  class="input-block-level"/>
												</p>
												<p>
													<label for="sexo">Sexo:</label>
													<input type="radio" name="sexo" value="masculino">Masculino
													<input type="radio" name="sexo" value="femenino">Femenino
												</p>
												<h4>Banco:</h4>
												<p>
													<label for="name">Nombre de Banco:</label>
													<input type="text" name="banco" class="input-block-level"/>
												</p>
												<p>
													<label for="name">Número de cuenta:</label>
													<input type="text" name="banco" class="input-block-level"/>
												</p>
											</div>
											<div class="col-md-6">
												<h4>Datos de ingreso</h4>
												<p>
													<label for="username">Fecha de Ingreso:</label>
													<input type="text" name="username" class="input-block-level" placeholder="05-04-1995" disabled />
												</p>
												<p>
													<label for="username">Efectividad:</label>
													<input type="text" name="username" class="input-block-level" placeholder="60%" disabled/>
												</p>
												<p>
													<label for="username">Calidad:</label>
													<input type="text" name="username" class="input-block-level" placeholder="" disabled/>
												</p>
												<h4>Teléfonos</h4>
												<p>
													<label for="username">Teléfono 1:</label>
													<input type="text" name="username" ng-model="user.person.telefono" class="input-block-level"/>
												</p>
												<p>
													<label for="username">Teléfono 2:</label>
													<input type="text" name="username" class="input-block-level"/>
												</p>
											</div>
										</div>
										<p class="text-center"><button type="submit">Guardar cambios</button>&nbsp;<button type="button" class="button-red" ng-click="reset()">Cancelar cambios</button></p>
									</div>
								</form>
							</div>
						</tab>
						<tab heading="Historial de accesos">
							<div class="row-fluid">
								<div class="col-md-12">
									<h4>Lista de ingresos al sistema</h4>	
								</div>
							</div>
							<div class="row-fluid">
								<div class="col-md-12">
									<table class="table table-striped table-hover">
										<thead>
							        		<tr>
								          		<th>N°</th>
						          				<th>IP</th>
						          				<th>Fecha Inicio</th>
						          				<th>Fecha Cerrado</th>
						          				<th>Navegador</th>
						          				<th>OS</th>
						          				<th>Actividad</th>
						        			</tr>
						      			</thead>
						      			<tbody>
								        	<tr>
						          				<td>01</td>
						          				<td>207.27.222.45</td>
												<td>2014-04-12 8:00</td>
												<td>2014-04-12 10:00</td>
												<td>Firefox 28</td>
												<td>Windows</td>
												<td>Cerrado</td>
						        			</tr>
						        			<tr>
						          				<td>02</td>
						          				<td>207.27.222.45</td>
												<td>2014-04-13 8:00</td>
												<td>2014-04-14 14:00</td>
												<td>Firefox 28</td>
												<td>Windows</td>
												<td>Cerrado</td>
						        			</tr>
						        			<tr>
						          				<td>03</td>
						          				<td>207.27.222.45</td>
												<td>2014-04-12 8:00</td>
												<td></td>
												<td>Chrome 32</td>
												<td>Android</td>
												<td><a class="actAbierto" role="button" data-toggle="modal">Abierto</a></td>
						        			</tr>
						        			<tr>
						          				<td>04</td>
						          				<td>207.27.222.45</td>
												<td>2014-04-12 8:00</td>
												<td></td>
												<td>Firefox 28</td>
												<td>Windows</td>
												<td><a class="actAbierto" role="button" data-toggle="modal">Abierto</a></td>
						        			</tr>
						      			</tbody>
									</table>
								</div>
							</div>
						</tab>
						<!--<tab heading="Permisos">
							<h4>Persmisos</h4>
						</tab>-->
					</tabset>
				</div>

				<!-- Section contents -->


			</div> <!-- End content-box -->
		</div>

	</div>
</div>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h3 id="myModalLabel">Modal header</h3>
  	</div>
  	<div class="modal-body">
	    <p>One fine body…</p>
  	</div>
  	<div class="modal-footer">
	    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	    <button class="btn btn-primary">Save changes</button>
  	</div>
</div>

<script type="text/javascript">

</script>
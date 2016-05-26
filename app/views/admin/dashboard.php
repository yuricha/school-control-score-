<div id="page_dashboard" class="content" ng-controller="DashboardController">

	<div class="pull-right">
		Filtrar:
		<select name="status" ng-change="updateList()" ng-model="filters.status">
			<option value="">Ver todas</option>
			<option value="0">Pendientes</option>
			<option value="1">Activos</option>
			<option value="2">Cerrados</option>
		</select>
		<input type="text" class="search-input" placeholder="Buscar" ng-change="updateList()" ng-model="filters.search"/>
		<a class="search-icon"><i class="ii-search"></i></a>
	</div>
	<h3>Dashboard: proyectos disponibles</h3>

	<!-- Projects list -->
	<div class="alert alert-info" ng-if="projects.data.length == 0">
		No hay estudios disponibles
	</div>
	<div class="project-item" ng-controller="ProjectItemController" ng-repeat="project in projects.data">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					<a href="#project/{{project.id}}" class="title" title="{{project.description}}">{{project.name}}</a>
					<table class="project-info">
						<tr><th>Cliente</th> <td>{{project.client}}</td> </tr>
                        <tr><th>Proyecto</th> <td>{{project.study}}</td> </tr>
                        <tr><th>Jefe Campo</th> <td>{{project.name_chief_field}}</td> </tr>
                        <tr><th>Analista</th> <td>{{project.name_analyst}}</td> </tr>

					</table>
				</div>
				<div class="col-md-3 text-right">
					<progressbar value="0">0%</progressbar>
					<a ng-click="isCollapsed = !isCollapsed" class="button button-mini">Ver detalles</a>
				</div>
			</div>

			<!-- Start detail -->
			<div collapse="isCollapsed">
				<div ng-if="project.dynamic.length == 0" class="alert alert-warning">No tenemos dinámicas registradas para este estudio</div>
				<table ng-if="project.dynamic.length > 0" class="table table-bordered table-striped">
					<tr>
						<th>Dinámica</th>
						<th>Fecha</th>
						<th>Reclutadores</th>
						<th>Invitados</th>
						<th>Estado</th>
					</tr>
					<tr ng-repeat="d in project.dynamic">
						<td><a href="#project/{{project.id}}/dynamic/{{d.id}}">{{d.name}}</a></td>
						<td>{{d.date_execution}}</td>
						<td>{{d.total_recruiter}}</td>
						<td>{{d.total_guests}}</td>
						<td><span class="label label-success">Realizado</span></td>
					</tr>
				</table>
			</div>
			<!-- End detail -->

			<div class="row">
				<div class="col-md-9">
					<table class="project-info">
						<tr> <th>Estado</th> <td>Nuevo</td> </tr>

					</table>
				</div>
				<div class="col-md-3">
					<label>Fecha de inicio:</label> {{project.date_start | date : 'dd-MM-yyyy' }}<br/>
					<label>Fecha de fin: </label> {{project.date_end | date : 'dd-MM-yyyy' }}<br/>
                    <label>Tipo: </label> {{project.type }}<br/>
                    <label>T. muestra: </label> {{project.sample_size }}
				</div>
			</div>
		</div>
	</div>

	<br/>

</div>
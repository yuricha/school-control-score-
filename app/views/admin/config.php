<div id="page_config" class="content" ng-controller="ConfigController">
	<div class="content-box">
		<h2>Configuración de sistema</h2>
		<div ng-controller="TabsUser">
			<tabset>
				<tab heading="Perfiles de usuario">
					<h4>Perfiles de usuario</h4>
					<p>Los perfiles de usuario se usan para definir atributos de las personas participantes en el sistema.</p>

					<div ui-tree="options" class="angular-ui-tree">
						<ol ui-tree-nodes="" ng-model="categories">
							<li ng-repeat="cat in categories" ui-tree-node>
								<div ui-tree-handle>
									{{cat.title}}
								</div>
								<ol ui-tree-nodes="" ng-model="cat.nodes">
									<li ng-repeat="subItem in cat.nodes" ui-tree-node>
										<div ui-tree-handle>
											{{subItem.title}}
										</div>
									</li>
								</ol>
							</li>
						</ol>
					</div>

				</tab>

				<!-- End personal -->

				<tab heading="Configuraciones varias">
					Perfiles
				</tab>
				<!-- End personal -->
			</tabset>
		</div>

	</div>

</div>

<script type="text/javascript">

</script>
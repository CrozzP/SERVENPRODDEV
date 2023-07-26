<template>
	<div class="sidebar sidebar-style-2"  data-background-color="light-blue2">			
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<!-- SUARIO-->

			<slot name="usersidebar"></slot>
			

			<ul class="nav nav-primary">
				<li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Components</h4>
				</li>

				
				
				<slot name="prueba_li"></slot>

				
			<!--
				<li class="nav-item ">
					<a data-toggle="collapse" href="#role">
						<i class="fas fa-layer-group"></i>
						<p>Roles</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="role">
						<ul class="nav nav-collapse">
							<li>
							<router-link to="/back/role" exact>
								<span class="sub-item">Roles del sistema</span>
							</router-link>
							</li>
							<li>
							<router-link to="/" exact>
								<span class="sub-item">Roles del sistema</span>
							</router-link>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Mas Opciones</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Buttons</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="nav-item ">
					<a data-toggle="collapse" href="#permiso">
						<i class="fas fa-layer-group"></i>
						<p>Persmisos</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="permiso">
						<ul class="nav nav-collapse">
							<router-link to="/back/permission" exact>
								<span class="sub-item">Permisos del sistema</span>
							</router-link>
							<router-link to="#" exact>
								<span class="sub-item">mas del sistema</span>
							</router-link>

							<li>
								<a href="#">
									<span class="sub-item">Mas Permisos</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Buttons</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="nav-item ">
					<a data-toggle="collapse" href="#usuario">
						<i class="fas fa-layer-group"></i>
						<p>Usuarios</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="usuario">
						<ul class="nav nav-collapse">
							<li>
								<router-link to="/back/user" exact>
									<span class="sub-item">Usuarios del sistema</span>
								</router-link>

								
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Mas Usuarios del sistema</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item ">
					<a data-toggle="collapse" href="#persona">
						<i class="fas fa-layer-group"></i>
						<p>Personas</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="persona">
						<ul class="nav nav-collapse">
							<li>
							<router-link to="/back/persona" exact>
								<span class="sub-item">Personas del sistema</span>
							</router-link>
							</li>
							<li>
							<router-link to="/" exact>
								<span class="sub-item">Personas del sistema</span>
							</router-link>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Mas Opciones</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Buttons</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item ">
					<a data-toggle="collapse" href="#aula">
						<i class="fas fa-layer-group"></i>
						<p>Aulas</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="aula">
						<ul class="nav nav-collapse">
							<li>
							<router-link to="/back/aula" exact>
								<span class="sub-item">Aulas del sistema</span>
							</router-link>
							</li>
							<li>
							<router-link to="/" exact>
								<span class="sub-item">Aulas del sistema</span>
							</router-link>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Mas Opciones</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Buttons</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item ">
					<a data-toggle="collapse" href="#panel">
						<i class="fas fa-layer-group"></i>
						<p>Panel de Administracion</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="panel">
						<ul class="nav nav-collapse">
							<li>
								<a href="#">
									<span class="sub-item">Administracion</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="sub-item">Buttons</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			-->
			</ul>
		</div>
	</div>
</div>
</template>



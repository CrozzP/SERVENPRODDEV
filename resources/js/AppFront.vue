<template>
	
		
	
	<main>
	<body data-background-color="bg3">
		<div class="wrapper  overlay-sidebar">
				
		<Header>
			<template v-slot:user>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						

						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fab fa-wpforms"></i> Reclamos
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										Opciones de reclamo 									

									</div>
								</li>
								<li>
									<div class="message-notif-scroll scrollbar-outer">
										<div class="notif-center">

										<router-link :to="`/front/reclamo`" exact>
											<div class="notif-icon notif-primary"> <i class="flaticon-file-1"></i> </div>
												<div class="notif-content">
													<span class="block">
														Registrar
													</span>
													<span class="time">El registro debera ser atendido dentro de las 24 hrs.</span> 
												</div>
										</router-link>

										</div>
									</div>
								</li>
							
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								
								<i class="fas fa-file-signature"></i> Contactenos
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<router-link :to="`/front/contactenos`" exact>
												<div class="notif-icon notif-primary"> <i class="flaticon-file-1"></i> </div>
													<div class="notif-content">
														<span class="block">
															Registrar
														</span>
														<span class="time">Enviar su consulta via email</span> 
													</div>
											</router-link>
											
										</div>
									</div>
								</li>
								
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-map-marker-alt"></i> Lugares de Pago
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<router-link :to="`/front/lugarPago`" exact>
												<div class="notif-icon notif-primary"> <i class="flaticon-file-1"></i> </div>
													<div class="notif-content">
														<span class="block">
															Lugares de pagos
														</span>
														<span class="time">Muestra los lugares en donde se pueden realizan los pagos</span> 
													</div>
											</router-link>
											
										</div>
									</div>
								</li>
								
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="far fa-question-circle"></i> Orientacion y tramite
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<router-link :to="`/front/orientacion`" exact>
												<div class="notif-icon notif-primary"> <i class="flaticon-file-1"></i> </div>
													<div class="notif-content">
														<span class="block">
															Orientacion
														</span>
														<span class="time">Pasos, requisitos, etc.</span> 
													</div>
											</router-link>
											
										</div>
									</div>
								</li>
								
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>Hizrian</h4>
												<p class="text-muted">hello@example.com</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">My Profile</a>
										<a class="dropdown-item" href="#">My Balance</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Account Setting</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
			</template>
		</Header>
		
		<Sidebar>
			
			

		</Sidebar>
		
				
		
<Breadcrumbs>
	
	
</Breadcrumbs>
	<div class="main-panel ">

		

			<div class="content " >
					<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-4">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div >
								<h2 class="text-white pb-2 fw-bold">SerVen - Cliente</h2>
								<h5 class="text-white op-7 mb-2">Realizar algun tipo de solicitud</h5>
							</div>
							
						</div>
					</div>
			</div>
					
					<div class="container">
						<div class="page-inner mt--5">

							
						<router-view> </router-view>
						</div>

					</div>
					
				</div>

			<Footer/>
			
		</div>
	</div>
	
</body>

	

	</main>
	
</template>
<script>

	import Header from './components/layouts/front/includes/Header.vue';
	import Sidebar from './components/layouts/front/includes/Sidebar.vue';
	import Footer from './components/layouts/front/includes/Footer.vue';
	import LugarPago from "./views/front/cliente/lugarPago";
	
	export default{
		
		components: {
			Header,
			Sidebar,
			Footer ,
			LugarPago
			
		},

		

		
	}
</script>


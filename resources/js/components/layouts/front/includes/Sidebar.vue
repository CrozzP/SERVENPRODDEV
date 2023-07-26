<template>
	<div class="sidebar sidebar-style-2 "  data-background-color="blue">			
	<div class="sidebar-wrapper scrollbar scrollbar-inner bg-primary-gradient" >
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


			</ul>
		</div>
	</div>
</div>
</template>



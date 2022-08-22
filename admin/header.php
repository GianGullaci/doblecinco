<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="index.php"><span>ADMIN</span></a>
							
			<!-- start: Header Menu -->
			<div class="nav-no-collapse header-nav">
				<ul class="nav pull-right">
					<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
 									<span>USUARIOS DEL SISTEMA</span>
									<!--<a href="#refresh"><i class="icon-repeat"></i></a>-->
								</li>	
								<li>
								    <a href="listado-admins.php">
														<span class="icon blue"><i class="icon-user"></i></span>
														<span class="message">Administradores</span>
								    </a>
								</li>
												<li>
								    <a href="listado-colaboradores.php">
														<span class="icon blue"><i class="icon-user"></i></span>
														<span class="message">Colaboradores</span>
								    </a>
								</li>
												<li>
								    <a href="listado-usuarios.php">
														<span class="icon blue"><i class="icon-user"></i></span>
														<span class="message">Usuarios</span>
								    </a>
								</li>
								</ul>
					</li>
					<li class="dropdown hidden-phone">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white usd"></i>
							</a>
							<ul class="dropdown-menu notifications">
								<li class="dropdown-menu-title">
 									<span>PUBLICIDADES</span>
									<!--<a href="#refresh"><i class="icon-repeat"></i></a>-->
								</li>	
								<li>
								    <a href="listado-publicidades.php">
														<span class="icon blue"><i class="halflings-icon white tasks"></i></span>
														<span class="message">Listado</span>
								    </a>
								</li>
												<li>
								    <a href="nueva-publicidad.php">
														<span class="icon blue"><i class="halflings-icon white picture"></i></span>
														<span class="message">Cargar Publicidad</span>
								    </a>
								</li>
												<li>
								    <a href="listado-posiciones-home.php">
														<span class="icon blue"><i class="halflings-icon white th-large"></i></span>
														<span class="message">Posicionar Publicidades HOME</span>
								    </a>
								</li>
								</li>
												<li>
								    <a href="publicidades-archivadas.php">
														<span class="icon blue"><i class="halflings-icon white th-large"></i></span>
														<span class="message">Publicidades Archivadas</span>
								    </a>
								</li>
								</ul>
					</li>
					
					<li class="dropdown hidden-phone">
							<a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
								<i class="halflings-icon white tasks"></i>
								HOME
							</a>
							<ul class="dropdown-menu tasks">
								<li class="dropdown-menu-title">
 									<span>Dise&ntilde;o HOME</span>
								</li>
								<li>
									<a href="listado-notas-destacadas.php">
										    <span class="header">
											    <span class="title">Notas destacadas (slider)</span>
										    </span>
									</a>
								</li>
								<li>
									<a href="galeria-home.php">
										    <span class="header">
											    <span class="title">Seleccionar Galer&iacute;a</span>
										    </span>
									</a>
								</li>
								<li>
									<a href="listado-notas-home.php">
										    <span class="header">
											    <span class="title">Seleccionar Notas</span>
										    </span>
									</a>
								</li>
								<!--<li>
									<a href="listado-columnas-home.php">
										    <span class="header">
											    <span class="title">Seleccionar Columnas</span>
										    </span>
									</a>
								</li>-->
								<li>
									<a href="listado-posiciones-home.php">
										    <span class="header">
											    <span class="title">Seleccionar Publicidades</span>
										    </span>
									</a>
								</li>
								<li>
									<a href="torneos-sitio.php">
										    <span class="header">
											    <span class="title">Seleccionar Torneos</span>
										    </span>
									</a>
								</li>
								<li>
									<a href="citas.php">
										    <span class="header">
											    <span class="title">Citas</span>
										    </span>
									</a>
								</li>
								<li>
									<a href="fechas-mobile.php">
										    <span class="header">
											    <span class="title">Fixture Mobile</span>
										    </span>
									</a>
								</li>
								<li>
									<a href="fechas-home-tab.php">
										    <span class="header">
											    <span class="title">Fixture Home Tabs</span>
										    </span>
									</a>
								</li>
									
							</ul>
					</li>
					
					<!-- start: User Dropdown -->
					<li class="dropdown">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="halflings-icon white play"></i> Usuario
							<!-- <span class="caret"></span> -->
						</a>
						 <ul class="dropdown-menu">
							<li class="dropdown-menu-title">
								<span>Mi Cuenta</span>
							</li>
							<li><a href="editar-administrador.php?id="><i class="halflings-icon user"></i> Editar Perfil</a></li>
							<li><a href="editar-clavea.php?id=<?=$_SESSION['id_admin']?>"><i class="halflings-icon lock"></i> Editar Clave</a></li>
							<li><a href="logout.php"><i class="halflings-icon off"></i> Salir</a></li>
						</ul> 
					</li>
					<!-- end: User Dropdown -->
				</ul>
			</div>
			<!-- end: Header Menu -->
			
		</div>
	</div>
</div>
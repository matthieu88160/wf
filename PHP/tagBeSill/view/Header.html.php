<header class="container mb-5 mt-2">
	<div class="row">
		<div class="col-sm-3">
			<img alt="Logo" src="/img/logo.png" class="img-fluid">
		</div>
		<div class="col align-self-end">
			<h1>
				<strong class="fs-important"> <span class="c-red">Tag</span><span
					class="c-green">Be</span><span class="c-blue">Sill</span>
				</strong> <span class="fs-05">Project management system</span>
			</h1>
		</div>
	</div>
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-secondary rounded mt-3">
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/'){?>active<?php }?>">
					<a class="nav-link" href="/">
						Home
					</a>
				<li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/register.php'){?>active<?php }?>">
					<a class="nav-link" href="/register.php">
						Register
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>

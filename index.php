<!DOCTYPE html>
<!-- saved from url=(0041)http://mybootstrap.ru/examples/hero.html# -->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>.: ПОРТАЛ ОБЩЕЖИТИЯ НИЯУ МИФИ :. </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
	<link rel="stylesheet" type="text/css" href="CSS/dropdown.css"/>	
    <link href="CSS/bootstrap.css" rel="stylesheet">
    <link href="CSS/content.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="CSS/button.css" />
	<link rel="stylesheet" type="text/css" href="CSS/message.css"/>
  

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/wp-content/themes/clear-theme/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
  
    </head>

	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button>
					<a class="navbar-brand" href="index.html">Портал общежития НИЯУ МИФИ</a>
                </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
				<li class="active"><a href="index.php">ГЛАВНАЯ</a></li>
					<li><a href="dashboard.php">ДОСКА ОБЪЯВЛЕНИЙ</a></li>
					<li><a href="services.php">УСЛУГИ</a></li>
				</ul>
				<?php
					$link = mysqli_connect('localhost','root','','campus') or die("Error " . mysqli_error($link));
					session_start();
					
					$_SESSION['timeout']=120;  //Поменьше
					
					if (isset($_SESSION['login'])){
						if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $_SESSION['timeout'])) {
							// last request was more than 2 minutes ago
							session_unset();     // unset $_SESSION variable for the run-time 
							session_destroy();   // destroy session data in storage
							echo '<div class="m_auth m_error">Извините, время Вашей сессии истекло</div>';
						}
						$_SESSION['last_activity'] = time(); // update last activity time stamp
					}
					
					if(isset($_POST['enter'])){
						$query = "SELECT passwd AS password FROM users WHERE login='".$_POST['login']."';" or die("Ошибка при выполнении запроса.." . mysqli_error($link)); 
						$result = $link->query($query);
						$user_data = mysqli_fetch_array($result);
						$result->close();
						if($_POST['login']=="admin@mephi.com")
							$_SESSION['admin']=1;
						if($user_data['password']==$_POST['password']){
							$_SESSION['login']=$_POST['login'];
							setcookie("login",$_POST['login'],time()+86400); // 1 day
							echo ('<div class="m_auth m_success">Добро пожаловать, '.$_SESSION["login"].'!</div>');
						}
						else {
							echo '<div class="m_auth m_error">Неверный логин или пароль</div>';
						}
					}
					
					if(isset($_POST['logout'])){
						session_unset();     // unset $_SESSION variable for the run-time 
						session_destroy();   // destroy session data in storage
					}
					
					if (isset($_SESSION['login'])){				
						echo '<div id="sign-out">
								<div class="dropdown">
									<ul class="nav navbar-nav navbar-right">
										<li>
											<a class="account btn-group-au">'.$_SESSION["login"].'&nbsp;&nbsp;<img src="Pictures/arrow_w.png"/></a>
										</li>
									</ul>
									<div class="submenu" style="display: none; ">
										<ul class="root">
											<li><a href="inventions.php">Личный кабинет</a></li>
											<li>
												<form method="post" action="index.php">
													<input type="submit" name="logout" value="Выйти"/>
												</form>
											</li>
										</ul>
									</div>
								</div>				
							</div>';
						
					} else {
						echo '<ul class="nav navbar-nav navbar-right">
							<li>
								<a class="btn-group-au" href="registration.php">РЕГИСТРАЦИЯ</a>
							</li>
							<li>
								<button type="button" class="btn-group-au" data-toggle="modal" data-target="#myModal">АВТОРИЗАЦИЯ</button>
							</li>
						</ul>';
					}
				?>	
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">АВТОРИЗАЦИЯ</h4>
				</div>
				<div class="modal-body">
					<form role="form" method="post" action="index.php">
						<div class="form-group">
							<label for="exampleInputEmail1">Логин (Email)</label>
							<input type="email" class="form-control" name="login" placeholder="Введите email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Пароль</label>
							<input type="password" class="form-control" name="password" placeholder="Пароль">
						</div>
		 
						<div class="checkbox">
							<label>
								<input type="checkbox"> Запомнить
							</label>
						</div>
						<button type="submit" name="enter"  class="btn btn-default">Отправить</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					</form>
				</div>
				<div class="modal-footer">
		   
				</div>
			</div>
		</div>
	</div>
    <div class="container">
   
		<!-- Main hero unit for a primary marketing message or call to action -->
		<div class="hero-unit">
        <div id="myCarousel" class="carousel slide">
		<!-- Indicators -->
		
			<ol style="margin-bottom: 1%"  class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="active item" data-slide-number="0"><img class="img-rounded" src="Pictures/1.jpg">
					<div class="carousel-caption" style='background: rgba(0, 0, 0, 0.4) none repeat scroll 0px 0px; border-radius: 6px' >
						<h2>Нужна тех. помощь?</h2>
						<p>Просто сделай заказ услуг</p>
					</div>
				</div>
					  
				<div class="item" data-slide-number="1"><img class="img-rounded" src="Pictures/2.jpg">                
					<div class="carousel-caption" style='background: rgba(0, 0, 0, 0.4) none repeat scroll 0px 0px; border-radius: 6px' >
						<h2>Размещай объявления</h2>
						<p>И оценивай объявления других пользователей</p>
					</div>
				</div>
				<div class="item" data-slide-number="2"><img class="img-rounded" src="Pictures/3.jpg">
					<div class="carousel-caption" style='background: rgba(0, 0, 0, 0.4) none repeat scroll 0px 0px; border-radius: 6px'>
						<h2>Помогай администрации общежития</h2>
						<p>Оценивай качество исполнения услуг</p>
					</div>
				</div>     
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"></a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"></a>
        </div>

    </div>

    <!-- Example row of columns -->
    <div class='row'>
        <div class="span4">
            <h2>Широкие возможности</h2>
            <p> Регистрируйся и получай доступ к таким сервисам как объявления и услуги а также оценка услуг.</p>     
        </div>
        <div class="span4">
			<h2>Эффективная полезность</h2>
			<p>Сервис полезен для студентов и сотрудников МИФИ,  также администрации и персонала общежития</p>
		</div>
        
    </div>
</div>
<footer>
    <p style="color:white">© Портал общежития НИЯУ МИФИ, 2015</p>
    <font style="color:white">© 2015 Портал общежития НИЯУ МИФИ <br>
г. Москва, ул. Москворечье, д. 2. корп. 1 и 2<br>
г. Москва, ул. Москворечье, д. 19, корп. 3 и 4<br>
г. Москва, ул. Кошкина, д. 11, корп. 1.<br>
Заведующая общежитием - Мозгунова Валентина Ивановна, тел. (499) 725-24-47, ул. Москворечье, д. 2, кор. 1, ком. 142<br>
Заместитель директора - Тараканов Юрий Михайлович, тел. (499) 725-24-85, ул. Москворечье, д. 2 кор. 2, ком. 8<br>
Начальник управления студенческими общежитиями — Краскович Сергей Леонидович, тел. (499) 725-24-85<br>
    </font>
</footer>
      <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script src="js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script language="javascript" src="js/dropdown.js"></script>
   

  <script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		});
                
                

	    $('#modal').modal('show');

	
	</script>

</body>
</html>
	<!-- Navbar -->
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right">
				<span class="sr-only">Toggle navbar</span>
				<i class="icon-grid3"></i>
			</button>
			<a class="navbar-brand" href="<?=$url?>"><?=$title?></a>
		</div>

		<!-- 
                    <ul class="nav navbar-nav navbar-right collapse">
                        <li><a href="#"><i class="icon-screen2"></i></a></li>
                        <li><a href="#"><i class="icon-paragraph-justify2"></i></a></li>
                        <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                                <li><a href="#"><i class="icon-cogs"></i> This is</a></li>
                                <li><a href="#"><i class="icon-grid3"></i> Dropdown</a></li>
                                <li><a href="#"><i class="icon-spinner7"></i> With right</a></li>
                                <li><a href="#"><i class="icon-link"></i> Aligned icons</a></li>
                            </ul>
                        </li>
                    </ul> 
                -->
	</div>
	<!-- /navbar -->

	<!-- Login wrapper -->
	<div class="login-wrapper">
		
            <form action="<?=$url?>admin/login" role="form" method="POST">
                <div class="popup-header" style="background-color:#FF4B36;">
                    <a href="#" class="pull-left"><i class="icon-user-plus"></i></a>
                    <span class="text-semibold">Login de Usuario</span>
                </div>
                <div class="well">
                    <div class="form-group <?php echo (isset($user)) ? 'has-feedback' : 'has-feedback has-error'; ?>">
                        <label>Usuario</label>
                        <input type="text" name="username" class="form-control" value="<?php echo (isset($user)) ? $user : ''; ?>" placeholder="<?php echo (isset($user)) ? 'Usuario' : 'Usuario'; ?>">
                        <i class="icon-users form-control-feedback"></i>
                    </div>
                    <div class="form-group <?php echo (isset($password)) ? 'has-feedback' : 'has-feedback has-error'; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <i class="icon-lock form-control-feedback"></i>
                    </div>

                    <div class="row form-actions">
                        <div class="col-xs-6">
                            <div class="checkbox checkbox-success">
                            <!-- 
                                <label>
                                    <input type="checkbox" class="styled">
                                    Remember me
                                </label> 
                            -->
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-warning pull-right" style="background-color:#FF4B36;border:0px;"><i class="icon-menu2"></i> Entrar</button>
                        </div>
                    </div>
                </div>
            </form>
            
	</div>  
	<!-- /login wrapper -->

        <!-- Footer -->                    
        <footer class="footer clearfix fooerLogin" id="footerTSoft">
            <div class="text-center">
                <a href="http://telepathicsoft.com.ar" target="_blank" style="text-decoration:none;">
                    <img id="logoFooterCR" src="<?=$url?>assets/images/logoTs/x64/64-ST-SB.png">
                    <strong>Telepathic Soft</strong> 
                </a>
                Copyright &#169; <?=$anioFooter?> | <strong>Contacto : </strong> <a href="mailto:contacto@telepathicsoft.com.ar">contacto@telepathicsoft.com.ar</a>
                <a href="#" class="go-top">
                   <i class="icon-angle-up"></i>
                </a>
            </div>
        </footer>         
        <!-- /footer -->

</body>
</html>
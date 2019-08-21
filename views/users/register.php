<div class="container-fluid">

	<div class="row">
		<div class="col-sm-3 "></div>
		<div class="col-sm-6">
			<!-- <div id="register">-->
					<!--<div class="span12"><a href="/"><img src="images/logo test 1.png" style="max-width: 100%; height: auto; width: 100%;"></a></div>-->
					<div class="row"><div class="span12"><h3 style="color:#aaaaaa;">Enter your registration information</h3></div></div>
					<form method="post" id="register" name="register">
                        <div class="form-group">					
                            <label for="Username">Desired Username&nbsp;</label>
                            <input type="text" size="53" id="username" name="name" value="" class="form-control"  placeholder="Desired Username" />
							<span id="username_err"></span>
						</div>
						<div class="form-group">					

                            <label for="password">Password&nbsp;</label>
                            <input type="password" size="53" id="password" name="password" value="" class="form-control" placeholder="Enter password"  />
							<span id="password_err"></span>
						</div>
						<div class="form-group">					

                             <label for="password2">Verify Password&nbsp;</label>
                            <span class="field"><input type="password" size="53" id="password2" name="passwd" value="" class="form-control" placeholder="Re-enter password"  /></span>
							<span id="password2_err"></span>
						</div>
						<div class="form-group">					

                             <label for="email">Valid Email&nbsp;</label>
                            <span class="field"><input type="text" size="53" id="email" name="email" value="" class="form-control"   placeholder="Enter Email Address" /></span>
							<span id="email_err"></span>
						</div>
						<div class="form-group">					

                             <label for="email2">Verify Email&nbsp;</label>
                            <span class="field"><input type="text" size="53" id="email2" name="vemail" value="" class="form-control"   placeholder="Re-enter Email Address" /></span>
							<span id="email2_err"></span>
						</div>
						<div class="form-group">					

						 <span class="label">&nbsp;</span>
						<span class="field"><div class="g-recaptcha" data-sitekey="6LeryRMUAAAAABvuvFxpoDjh2WpXR3S-Z34QdK-l"></div></span>
						</div>
						<div class="form-group">					

                            <span class="label">&nbsp;</span>
                            <span class="field"><input type="submit" name="action" value=" Register " class="buttonstyle" /></span>
                            <span class="field"><input type="reset" value=" Clear Form " class="buttonstyle" /></span>
							<span id="captcha_err"></span>
                        </div>
                    </form>
      
            <!-- </div> -->
		</div>
		<div class="col-sm-3 "></div>
	</div>
</div>

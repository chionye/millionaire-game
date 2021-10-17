<?php include 'header.php'; ?>
<img src="../images/lof.jpg" width="100%">
<div class="container p-2">
  <div class="w3_mail_grids dp-2">
    <ul class="nav nav-tabs navtabs">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home">Login</a>
      </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active container" id="home">
        <form>
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-11 col-md-12 col-lg-12 m-3">
                  <input class="input__field input__field--jiro" type="email" name="email" placeholder="Your Email Address" required="" id="email" />
                  <label class="input__label input__label--jiro">
                    <span class="input__label-content input__label-content--jiro">Your Username</span>
                  </label>
              </div>
              <div class="col-12 col-sm-11 col-md-12 col-lg-12 m-3">
                  <input class="input__field input__field--jiro" type="password" name="pass3" placeholder="Phone Number" required="" id="pass3" />
                  <label class="input__label input__label--jiro">
                    <span class="input__label-content input__label-content--jiro">Password</span>
                  </label>
              </div>
            </div>
          </div>
          <input type="submit" value="Submit" onclick="logadmin();return false">
        </form>
      </div>
    </div>
    
  </div>
</div>
<?php include 'footer.php'; ?>
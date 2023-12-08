

<?php @include("includes/head.php"); ?>
  <body class="hold-transition login-page">
    <!-- Logo box -->
    <div class="login-box">  
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <div class="login-logo">
            <p><b>
            </b></p><!-- Link can also be removed -->
            <center><img src="img/logo.png" width="150" height="130" class="user-image" alt="User Image"/></center>
          </div>
          <p class="login-box-msg"><b> <h4> <center> Student</center></h4> </b></p>

          <form action="stu_parent.php" method="post">
            <div class="input-group mb-3">
              <input type="text" name="studentName" class="form-control" placeholder="studentName" required value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
                <input name="stream" placeholder="Select date" type="date" id="example" class="form-control" value="">
                <div class="input-group-append">
                <div class="input-group-text">
                  <span>dob</span>
                </div>
              </div>
            </div>
            <div class="input-group mb-4">
              <select type="select" class="form-control" id="class" name="class" required>
                <option>Select Class</option>
                <option value="Admin">Admin</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
                <option value="S4">S4</option>
                <option value="S5">S5</option>
                <option value="S6">S6</option>
              </select>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember"  <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>>
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" name="parent" class="btn btn-primary btn-block">Login</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <p class="mb-1">
            <a href="index.php">Teacher</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <?php @include("includes/foot.php"); ?>
    <script src="assets/js/core/js.cookie.min.js"></script>
  </body>
  </html>
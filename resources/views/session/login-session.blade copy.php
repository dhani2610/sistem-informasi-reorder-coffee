

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Login</title>

    <style>
      .login,
      .image {
        min-height: 100vh;
      }
  
      .bg-image {
        background-image: url('{{ asset('assets/img/login.jpg') }}');
        background-size: cover;
        background-position: center center;
      }
      .form-control:focus{
        background: white!important
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row no-gutter">
        
          <!-- The content half -->
          <div class="col-md-6" style="background: #4357bf">
            <div class="login d-flex align-items-center py-5">
  
                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto" >
                            <h3 class="text-light display-4" style="font-weight: 600" style="color: white!important">Selamat Datang!</h3>
                            <p class="text-light  mb-4" style="font-weight: 600" style="color: white!important">Aplikasi RuSaJu Kosabangsa.</p>
                            <form method="POST" action="/login-post">
                              @csrf
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" name="email" value="admin@gmail.com" placeholder="Email address" required="" autofocus="" class="form-control  border-0 shadow-sm px-4" required>
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password" name="password" value="secret" placeholder="Password" required="" class="form-control  border-0 shadow-sm px-4 text-primary" required>
                                </div>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                  <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2  shadow-sm">Sign in</button>
                            </form>
                        </div>
                    </div>
                </div><!-- End -->
  
            </div>
        </div><!-- End -->
          <!-- The image half -->
          <div class="col-md-6 d-none d-md-flex bg-image"></div>
    
    
    
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>

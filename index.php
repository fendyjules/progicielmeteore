<?php
session_start();
include_once "parametresgeneraux/configbd.php";
 
    if (isset($_POST['formconnexion']))
        {
	       $username = htmlspecialchars($_POST['username']);
	       $password = htmlspecialchars($_POST['password']);
	        if(!empty($username) AND !empty($password))
	            {
		            $requser=$bdd->prepare("SELECT * FROM compte_utilisateur
                    INNER JOIN employesmeteore ON compte_utilisateur.id_employe=employesmeteore.id_employe
                     WHERE identifiant_user=? AND mdp_user=?");
		            $requser->execute(array($username, $password));
		            $userexist = $requser->rowCount();

		            if($userexist == 1)
		              {
			            $userinfo = $requser->fetch();
			            $_SESSION['nomemploye']= $userinfo['nomemploye'];
                        $_SESSION['prenomemploye']= $userinfo['prenomemploye'];	
                        $_SESSION['unique_id']= $userinfo['unique_id'];				
			            $_SESSION['fonction_user']= $userinfo['fonction_user'];	
                        $_SESSION['id_user']= $userinfo['id_user'];	
			           
                        header("location:html/ltr/bureau.php?id=".$_SESSION['id_user']);
			 	 
		              }
		            else
                  {
			            $erreur1 ="pas de correspondance";
		              }
		
	            }
	            
        }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Connexion / Progicielmeteore</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="librairies/img/cropped-Logo.png" rel="icon">
  <link href="librairies/img/cropped-Logo.png">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="librairies/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="librairies/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="librairies/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="librairies/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="librairies/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="librairies/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="librairies/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="librairies/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="" class="logo d-flex align-items-center w-auto">
                  <img src="librairies/img/cropped-Logo.png" alt="">
                  <span class="d-none d-lg-block">Meteore Conseil</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Connexion</h5>
                    <p class="text-center small">Entrez vos identifiants</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="#"  novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Nom d'utilisateur</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Nom d'utilisateur requis !</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Mot de passe requis!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="formconnexion">se connecter</button>
                    </div>
                    
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> 
              </div>
              <div class="credits">
                 And powered by <a href="https://bootstrapmade.com/">Ohuru Tech</a> 
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="librairies/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="librairies/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="librairies/vendor/chart.js/chart.min.js"></script>
  <script src="librairies/vendor/echarts/echarts.min.js"></script>
  <script src="librairies/vendor/quill/quill.min.js"></script>
  <script src="librairies/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="librairies/vendor/tinymce/tinymce.min.js"></script>
  <script src="librairies/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="librairies/js/main.js"></script>

</body>

</html>
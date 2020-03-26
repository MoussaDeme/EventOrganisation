<!DOCTYPE html>
<html lang="fr">
<head>
  <title> <?php echo $this->title; ?></title>

  <meta charset="utf-8">
  <link rel="stylesheet" href="feuille.css">
  <!--<link rel="stylesheet" href="bootstrap/bootstrap.css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>
<body>
  <!-- -----------------------affichahe du titre et du contenu 
	<?php
  /*echo "<ul>";
  foreach ($this->getMenu() as $text => $link) {
  	echo "<li><a href=\"$link\">$text</a></li>";
  }
  echo "</ul>";*/?> -->
      <?php //echo '<h1 class="po">'.$this->title.'</h1>'; ?>
      <?php //echo $this->content; ?>
   
         <section id="header">
              <div class="container-fluid">
                  <nav class="navbar navbar-expand-lg navbar-dark">
                      <div class="container">
                          <a href="#" class="navbar-brand">EVENT ORGANISATION</a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                             </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                              <ul class="navbar-nav ml-auto">
                                <?php
                                   
                                   if($this->menu!=null){
                                  foreach ($this->menu as $text => $link) {
                                 echo '<li class="nav-item active">
                                       <a href="'.$link.'" class="nav-link">'.$text.'</a>
                                  </li>';
                                   }
                                  }
                                  ?>                               
                              </ul>
                              
                            </div>            
                      </div>
                    
                  </nav>
              </div>
         </section>
    
        <section class="main">
           <!-- <div class="container">
              
            </div>>-->
            <?php                 
            ?>
        </section>
             <?php echo $this->feedback; ?>
            
            <?php echo '<section class="bodySec">'.$this->content;
            if(key_exists('ajouter un programme', $this->menu))
                                   {

                                      echo '<br><br><br><br><a href="AdminIndex.php?action=telechargerLists">generer la liste  des inscrits au format excel</a><br><br>';
                                      echo '<a href="AdminIndex.php?action=deconnecter">se deconnecter</a>';                                      
                                   }             
            echo '</section >'; ?>
        


    <!-- script javascript pour bootstrap --> 
       
</body>
<footer class="bg-secondary">
     <div class="container">
       <div class="row">
         <div class="col text-center">
                 <h1 class="text-white text-capitalize font-weight-light">
                 <p>&copy; 2020 Tous droits réservés<p>
                 </h1>   
         </div>
       </div>
     </div>
</footer>

</html>
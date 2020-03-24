<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Identity and Access Management</title>
  <?php require 'config.php';?> 
  <!-- Bootstrap -->
  <link href="<?=ROOT?>assests/css/bootstrap.min.css" rel="stylesheet">  
  <link href="<?=ROOT?>assests/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?=ROOT?>assests/css/animate.min.css" rel="stylesheet">
  <link href="<?=ROOT?>assests/css/animate.css" rel="stylesheet" />
  <link href="<?=ROOT?>assests/css/prettyPhoto.css" rel="stylesheet">
  <link href="<?=ROOT?>assests/css/styles.css" rel="stylesheet">  
  
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="row">
        <div class="site-logo">
          <a href="index.html" class="brand">Identity and Access Management</a>          
        </div>

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="menu">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Home</a></li>
            <li><a href="#about">About Us</a><li>            
          </ul>
        </div>
        <!-- /.Navbar-collapse -->
      </div>
    </div>
  </nav>
    <?php 
      require 'db.php';     
      $db = db_connect();
      $sql = "SELECT * FROM users_management ORDER BY date DESC";
      $query = $db->prepare($sql);
      $query->execute();
      $users = $query->fetchAll(PDO::FETCH_OBJ);            
    ?>
  <main>
    <div class="main-block">
      <!-- Add section -->
      <div class="add-block">
        
        <div class="container">
          <div class="row">
            <div class="col-sm-1">
              <button type="button" class="btn btn-danger" id="open_modal" data-toggle="modal" data-target="#staticBackdrop">Add</button>
            </div>
            
              <form action="">
                <div class="col-sm-5">
                <select class="form-control" id="status" name="status">
                  <option value="0" selected="selected" disabled>Please select</option>
                  <option value="1">Set active</option>
                  <option value="2">Set not active</option>
                  <option value="3">Delete</option>                       
                </select>
                </div>
                <div class="col-sm-4">
                  <button type="button" class="btn btn-primary" id="action_user">OK</button>
                </div>
              </form>
            </div>
          </div>
        </div>        
      </div>  
        
      <div class="container bootstrap snippet">
          <div class="table-responsive">            
            <table class="table colored-header datatable project-list">
              <thead>
                <tr>
                  <th class="first-column">
                    <input type="checkbox" id="group_checkbox_all" name="group_checkbox_all" class="form-check-input">
                    <label for="group_checkbox_all">Select all:</label>
                  </th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th>Options</th>            
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $user) : ?>
                  <tr>
                    <td><input type="checkbox" name="<?=$user->id_user?>" value="<?=$user->id_user?>" class="group_checkbox"></td>
                    <td><?=$user->firstName?></td>
                    <td><?=$user->lastName?></td>
                    <td><span class="<?=$user->status?>"><i class="fa fa-minus-circle" aria-hidden="true"></i><span></td>      
                    <td><?=$user->role?></td>                    
                    <td>
                      <span class="edit-icon" id="edit_user" onclick="edit(<?=$user->id_user?>)">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </span>
                      <span class="del-icon" id="del_user" onclick="del_user(<?=$user->id_user?>)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                      </span>                      
                    </td>
                  </tr>  
                <?php endforeach; ?>                                                   
              </tbody>
            </table>            
          </div>
      </div>
  </div>
  </main>
  

  <section>
    <div>
      <!-- Button trigger modal -->
            

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container my-cont col-sm-12">
                 <div class="row">
                  <div class="col-md-10 mb-3">
                    <h4 class="toggle_mode">Add user</h4>                  
                    <form action="" method="post">
                      <label for="firstName">First Name</label>
                      <input type="text" name="firstName" id="firstName" class="form-control">

                      <label for="lastName">Last Name</label>
                      <input type="text" name="lastName" id="lastName" class="form-control lastName">

                       <label>Status:</label>               
                       <div class="form-check form-check-inline my-radio">
                          <input class="form-check-input" type="radio" name="status" id="active" value="active">
                          <label class="form-check-label" for="active">
                            <span class="active"><i class="fa fa-minus-circle" aria-hidden="true"></i></span>      
                          </label>
                          <span class="check-act">Active</span>
                          
                      </div>
                      <div class="form-check form-check-inline my-radio">
                          <input class="form-check-input" type="radio" name="status" id="not-active" value="not-active">
                          <label class="form-check-label" for="not-active"><span class="not-active"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></label>
                          <span class="check-act">Not-Active</span>
                          
                            
                          
                      </div>
                      <div class="alert alert-danger" id=""></div>

                      <label for="role">Role</label>
                      <select class="form-control role" id="role" name="role">
                        <option>admin</option>
                        <option>user</option>                        
                      </select>             

                      <div class="alert alert-danger" id="errorBlock1"></div>

                      <button type="button" class="btn btn-success btn-sm mb-5" id="user_send">Send</button>   
                    </form>
                  </div>
                </div> 
              </div>             
           </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal" id="close-bt">Close</button>                    
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer id="footer" class="midnight-blue">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="text-center">
            <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
          </div>
          &copy; OnePage Theme. All Rights Reserved.
          <div class="credits">            
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>

        <div class="top-bar">
          <div class="col-lg-12">
            <div class="social">
              <ul class="social-share">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-skype"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/#footer-->  
  <script src="<?=ROOT?>assests/js/jquery.js"></script>  
  <script src="<?=ROOT?>assests/js/bootstrap.min.js"></script>  
  <script src="<?=ROOT?>assests/js/ajax.js"></script>
</body>

</html>

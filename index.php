<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Identity and Access Management</title>
  <?php 
        require 'wp-config.php';
  ?> 
  
  <link href="/assests/css/bootstrap.min.css" rel="stylesheet" type="text/css">    
  <link href="/assests/css/font-awesome.min.css" rel="stylesheet" type="text/css">   
  <link href="/assests/css/styles.css" rel="stylesheet"> 
  <link href="/assests/img/tripico.png" rel="shortcut icon" type="image/png" > 
  
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="row">
      <div class="site-logo">
        <a href="/" class="brand">Identity and Access Management</a>          
      </div> 
      <div class="nav-links">
        <ul>
          <li><a href="/">About us</a></li>
          <li><a href="/">Contacts</a></li>
        </ul>
      </div >
      </div>
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
    <form>
      <div class="container action-bar">
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
              <button type="button" class="btn btn-outline-info open-m" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>        
            <div class="col-sm-3 my-1">
              <select class="custom-select action_status" name="status">
                <option value="0" selected="selected" disabled>Please select</option>
                <option value="1">Set active</option>
                <option value="2">Set not active</option>
                <option value="3">Delete</option>
              </select>
            </div>       
            <div class="col-auto my-1">
              <button type="button" class="btn btn-outline-success action_user">OK</button>
            </div>            
        </div>
      </div>
  </form>   

  <div class="container bootstrap snippet">
      <div class="table-responsive">            
        <table class="table colored-header datatable project-list">
          <thead>
            <tr>
              <th class="first-column">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input group_checkbox" id="group_checkbox_all" name="group_checkbox_all">
                    <label class="custom-control-label" for="group_checkbox_all"></label>
                </div>
              </th>
              <th>Name (First Name, Last Name)</th>              
              <th>Status</th>
              <th>Role</th>
              <th>Options</th>            
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>                
                <td>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input group_checkbox" id="<?=$user->id_user?>" name="<?=$user->id_user?>" value="<?=$user->id_user?>">
                    <label class="custom-control-label" for="<?=$user->id_user?>"></label>
                  </div>
                </td>
                <td><?=$user->name?></td>                
                <td><span class="<?=$user->status?>"><i class="fa fa-circle"></i></i></i><span></td>      
                <td><?=$user->role?></td>                    
                <td>
                  <span class="edit-icon" id="edit_user" onclick="edit(<?=$user->id_user?>)">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </span>
                  <span class="del-icon" id="del_user" onclick="del_user(<?=$user->id_user?>, {<?= str_replace(' ', '_', $user->name) ?>: ''})">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </span>                                       
                </td>
              </tr>  
            <?php endforeach; ?>                                                   
          </tbody>
        </table>            
      </div>
  </div>     

  
  <form>
      <div class="container action-bar">
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
              <button type="button" class="btn btn-outline-info open-m" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>        
            <div class="col-sm-3 my-1">
              <select class="custom-select action_status" name="status">
                <option value="0" selected="selected" disabled>Please select</option>
                <option value="1">Set active</option>
                <option value="2">Set not active</option>
                <option value="3">Delete</option>
              </select>
            </div>       
            <div class="col-auto my-1">
              <button type="button" class="btn btn-outline-success action_user">OK</button>
            </div>            
        </div>
      </div>
  </form> 
</main>

<section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="firstName" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="firstName">
          </div>

          <div class="form-group">
            <label for="lastName" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastName">
          </div>
          
          <div class="form-group">
            <span>Status:</span>
            <div class="custom-control custom-switch">              
              <input type="checkbox" class="custom-control-input" id="customSwitch1">
              <label class="custom-control-label" for="customSwitch1">Not-active</label>
          </div>
          </div>
          <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control role" id="role" name="role">
              <option value="Admin">Admin</option>
              <option value="User">User</option>                        
            </select>
          </div>          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-bt">Close</button>
        <button type="button" class="btn btn-primary test1" id="user_send">Add</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;</h6>        
        <div class="modal-title" id="exampleModalLabel">Are you sure that you want to delete <strong class="person-del"></strong>?</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary yes-modal">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="alertModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;</h6>        
        <h6>Please select <span class="alerm-item"></span>!</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">OK</button>        
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
                <li><a href="/"><i class="fa fa-facebook"></i></a></li>
                <li><a href="/"><i class="fa fa-twitter"></i></a></li>
                <li><a href="/"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="/"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="/"><i class="fa fa-skype"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/#footer-->  
  <script src="/assests/js/jquery.js"></script>  
  <script src="/assests/js/bootstrap.min.js"></script>  
  <script src="/assests/js/ajax.js"></script>
</body>

</html>

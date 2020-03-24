let editMode = false;
let idUser = '';

    
$('#user_send').click(async function() {
  let id_user;
  let url;
  let status = '';
  if (editMode) {
    url = '/IAM/ajax/edit_user.php';
    id_user = idUser;        
  } else {
    url = '/IAM/ajax/add_user.php';
    id_user = null;
  }
  
  let firstName = $('#firstName').val();
  let lastName = $('#lastName').val();      
  let role = $('#role').val();
  if ($('input[value=active]')[0].checked) {
      status = $('input[value=active]').val(); 
  } else if ($('input[value=not-active]')[0].checked) {
      status = $('input[value=not-active]').val();
  };        

  $.ajax({
    url,
    method: 'POST',
    cache: false,
    data: {
      id_user,
      firstName,
      lastName,
      role,
      status          
    },
    dataType: 'html',
    success(data) {
      
      if (data == 'Done') {
        $('#firstName').val("");
        $('#lastName').val("");   
        
        $('#close-bt').click();
        editMode = false;
        $('.toggle_mode').text('Edit user');
        document.location.reload(true);
                 
      } else {
        $('#errorBlock1').show();
        $('#errorBlock1').text(data);
      }
    }
  });

});
async function edit(id_user) {
  
  $('.toggle_mode').text('Edit user');
  console.log($('.toggle_mode').text());
  idUser = id_user;
  editMode = true;
  $.ajax({
    url: '/IAM/ajax/get_user.php',
    method: 'POST',
    cache: false,
    data: {
      id_user          
    },
    dataType: 'html',
    success(data) { 
      let [firstName, lastName, status, role] = data.split('-@-');          
      $('#firstName').val(firstName);
      $('#lastName').val(lastName);      
      $('#role').val(role);
      if (status === 'active') {
        $('#active')[0].checked = true;
      } else {
        $('#not-active')[0].checked = true;
      }
      $('#open_modal').click();                    
    }
  });
  
}

async function del_user(id_user) {
  let conf = confirm('Are you sure?');  
  if (conf) {
    $.ajax({
      url: '/IAM/ajax/del_user.php',
      method: 'POST',
      cache: false,
      data: { id_user },       
      dataType: 'html',
      success(data) {          
        if (data == 'Done') {
          document.location.reload(true);
        }
      }
    });
  } 
  else {
    return;
  }   
  
}

$('#action_user').click(async function() { 

  let actionUsers = [];
  $('.group_checkbox').each(function(n) {
    if (this.checked) {
      actionUsers.push($(this).val());
    }        
  });     
  let action_id = $('#status').val();
  if (!action_id) {
    alert('Please select action!');
    return;
  } else if (!actionUsers.length) {
    alert('Please select user!');
    return;
  }
  
  $.ajax({
    url: '/IAM/ajax/action_user.php',
    method: 'POST',
    cache: false,
    data: { 
      action_id,
      actionUsers: actionUsers.join(',')
    },       
    dataType: 'html',
    success(data) {
      
      document.location.reload(true);       
      if (data == 'Done') {
        document.location.reload(true);
      }
    }
  });
  

});

$('#group_checkbox_all').change(function() {
  console.log($('.group_checkbox'));
    if (this.checked) {
      $('.group_checkbox').each(function() {
        console.log(this);
        this.checked = true;
      })
    } 
    if (!this.checked) {
      $('.group_checkbox').each(function() {
        console.log(this);
        this.checked = false;
      })
    }
  
});
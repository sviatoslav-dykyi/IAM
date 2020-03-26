let editMode = false;
let idUser = '';

$('.open-m').click(function() {  
  $('#exampleModalLabel').text('Add user');
  $('#user_send').text('Add');
});
    
$('#user_send').click(async function() {
  let id_user;
  let url;
  let status = '';
  if (editMode) {
    url = '/ajax/edit_user.php';
    id_user = idUser;        
  } else {
    url = '/ajax/add_user.php';
    id_user = null;
  }
  
  let name = $('#name').val();      
  let role = $('#role').val();
  if ($('#customSwitch1')[0].checked) {
      status = 'active';
  } else if (!$('#customSwitch1')[0].checked) {
      status = 'not-active';
  };        

  $.ajax({
    url,
    method: 'POST',
    cache: false,
    data: {
      id_user,
      name,
      role,
      status          
    },
    dataType: 'html',
    success(data) {
      
      if (data == 'Done') {
        $('#name').val("");        
        $('#close-bt').click();
        editMode = false;                
        document.location.reload(true);
                 
      } 
    }
  });

});
async function edit(id_user) {    
  idUser = id_user;
  editMode = true;
  $.ajax({
    url: '/ajax/get_user.php',
    method: 'POST',
    cache: false,
    data: {
      id_user          
    },
    dataType: 'html',
    success(data) { 
      
      let [name, status, role] = data.split('-@-');          
      $('#name').val(name);            
      $('#role').val(role);
      if (status === 'active') {
        $('#customSwitch1')[0].checked = true;
        $('label[for=customSwitch1]').text('Active');
      } else {
        $('#customSwitch1')[0].checked = false;
        $('label[for=customSwitch1]').text('Not-active');
      }
      $('#exampleModalLabel').text('Edit user');       
      $('#user_send').text('Save');      
      $('#exampleModal').modal('show');                         
    }
  });
  
}

async function del_user(id_user, obj) {  
  let name = Object.keys(obj)[0];
  name = name.replace('_', ' ');
  popup('#confirmModal', '.person-del', name);  
  
  $('#confirmModal').click(function(e) {
    if ($(e.target).is('.yes-modal')) {      
      conf = true;
      $.ajax({
        url: '/ajax/del_user.php',
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
      $('#confirmModal').modal('hide');      
    }
  });
   
  
}

$('.action-bar').click(function(e) {
  
  if ($(e.target).hasClass('action_user')) {

    let actionUsers = [];
    $('.group_checkbox').each(function(n) {
      if (this.checked) {
        actionUsers.push($(this).val());
      }        
    });     
    let action_id = $(this).find('.action_status').val(); 
    if (!action_id) { 
      popup('#alertModal', '.alerm-item', 'action'); 
      return;
    } else if (!actionUsers.length) {
      popup('#alertModal', '.alerm-item', 'user'); 
      return;
    }

    $.ajax({
      url: '/ajax/action_user.php',
      method: 'POST',
      cache: false,
      data: { 
        action_id,
        actionUsers: actionUsers.join(',')
      },       
      dataType: 'html',
      success(data) {
        
        //document.location.reload(true);       
        if (data == 'Done') {
          document.location.reload(true);
        }
      }
    });        
  }  
});



$('#group_checkbox_all').change(function() {  
  if (this.checked) {
    $('.group_checkbox').each(function() {
      console.log(this);
      this.checked = true;
    })
  } 
});
$('.group_checkbox').change(function() {
  if (!this.checked) {
    $('#group_checkbox_all')[0].checked = false;
  }
  else {
    return;
  }  
});

$('#customSwitch1').change(function() {
  if (!this.checked) {
    $('label[for=customSwitch1]').text('Not-active');
  } else {    
    $('label[for=customSwitch1]').text('Active');
  }
}); 

function popup(id, selector, text) {  
  $(id).find(selector).text(text);
  $(id).modal('show');
}
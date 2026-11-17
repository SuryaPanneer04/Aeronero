function add_project_assign() {
	console.log('Assign button clicked');
    $.ajax({
    type:"POST",
    url:"qvision/project_management/project_assign/new.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

  function edit_project_assign(id) {
	console.log('Edit button clicked for ID:', id);
    $.ajax({
    type:"POST",
    url:"qvision/project_management/project_assign/edit.php",
    data: { id: id },
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

  function mark_project_completed(id) {
    if(confirm('Are you sure you want to mark this project as Completed?')) {
        $.ajax({
            type: 'POST',
            url: 'qvision/project_management/project_assign/mark_completed.php',
            data: { id: id },
            success: function(response) {
                if(response.trim() == 'Success') {
                    alert('Project marked as completed successfully!');
                    project_assign();
                } else {
                    alert('Error: ' + response);
                }
            }
        });
    }
  }




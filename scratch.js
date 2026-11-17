
    function project_master() {
        $.ajax({
            type: "POST",
            url: "qvision/project_management/project_master/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }
    function project_assign() {
        $.ajax({
            type: "POST",
            url: "qvision/project_management/project_assign/main.php",
            success: function(data) {
                $("#main_content").html(data);
            }
        })
    }


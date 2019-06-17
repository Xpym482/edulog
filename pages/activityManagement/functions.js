deleteActivity = function(id) {
    $.ajax({
        type: "POST",
        url: 'deleteActivity.php',
        data: { activity_id: id },
        dataType: 'JSON',
        success: function () {
            window.location = window.location;
        }
    });
};

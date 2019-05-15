fetchCsv = function(id) {
    $.ajax({
        type: "GET",
        url: 'createCsv.php',
        data: { lesson_id: id },
        dataType: 'JSON',
        success: function () {
            var downloadLink = document.createElement("a");
            downloadLink.href = "downloadCsv.php";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    });
};

deleteLog = function(id) {
    $.ajax({
        type: "POST",
        url: 'deleteLog.php',
        data: { lesson_id: id },
        dataType: 'JSON',
        success: function () {
            window.location = window.location;
        }
    });
};

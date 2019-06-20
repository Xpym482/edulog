// TRACKER
var logs = {};
var records = {};
var logTime = { start: null, end: null };
var lifeTime = null;
var hasInfo = false;
var sentMail = false;
var logUuid = null;
let goingactivities = [];

$(document).ready(function() {
  function voidAjaxRequest(data, path) {
    $.ajax({
      type: "POST",
      url: path,
      data: data,
      success: null
    });
  }

  function dateformatter(phpdate) {
    var d = new Date(phpdate.replace(/\+/g, " ").replace(/-/g, "/"));
    d.setHours(d.getHours() + 0);
    return d;
  }

  var locale = "en";

  var structure = {
    en: {
      enterInfo: "Please enter your name and email",
      startBtn: "Start",
      endBtn: "End logging",
      saveInfo: "Save",
      resetBtn: "Reset",
      sendToEmail: "Send log to email",
      totalDuration: "Total duration: ",
      groups: {
        teacher: {
          header: "Teacher's activities",
          activities: {
            organizing: "Organizing",
            teaching: "Teaching",
            discussion: "Discussion",
            feedback: "Feedback"
          }
        },
        student: {
          header: "Students' activities",
          activities: {
            questions: "Questions",
            individualwork: "Individual work",
            groupwork: "Group work",
            test: "Test"
          }
        }
      }
    },
    et: {
      enterInfo: "Alustamiseks sisesta oma nimi ja email",
      startBtn: "Alusta",
      endBtn: "Lõpeta logimine",
      saveInfo: "Salvesta",
      resetBtn: "Lähtesta",
      sendToEmail: "Saada tulemused emailile",
      totalDuration: "Tunni pikkus: ",
      groups: {
        teacher: {
          header: "Õpetaja tegevused",
          activities: {
            organizing: "Organiseerimine",
            teaching: "Õpetamine",
            discussion: "Diskussioon",
            feedback: "Tagasiside"
          }
        },
        student: {
          header: "Õpilase tegevused",
          activities: {
            questions: "Küsimused",
            individualwork: "Individuaalne töö",
            groupwork: "Grupitöö",
            test: "Test"
          }
        }
      }
    }
  };

  // appended to url http://saargraafika.ee/edulog/gradients/
  var backgrounds = {
    teacher: {
      organizing: "1-min.png",
      teaching: "2-min.png",
      discussion: "3-min.png",
      feedback: "4-min.png"
    },
    student: {
      questions: "10-min.png",
      individualwork: "11-min.png",
      groupwork: "12-min.png",
      test: "13-min.png"
    }
  };

  // indicates if activity is being tracked or not
  // eg. teacher_questions: false
  var trackingStatuses = {};

  // if lesson is ongoing
  if (Cookies.get("lesson_start")) {
    console.log(Cookies.get("lesson_start"));
    $("#startBtn").addClass("away");
    $("#endBtn").addClass("show");
    $(".overlay").addClass("away");

    // get ongoing activities
    var data = {
      lesson_id: Cookies.get("lesson_id")
    };
    $.ajax({
      type: "POST",
      url: "get_ongoing_logs.php",
      data: data,
      dataType: "JSON",
      success: function(response) {
        response.forEach(function(log) {
          createStopwatch(
            log["type"] + "_" + log["slug"],
            dateformatter(log["started_at"]),
            false
          );
          $("#" + log["type"] + "_" + log["slug"]).addClass("open");
        });
      }
    });

    // parse date format
    var my_date = Cookies.get("lesson_start");
    my_date = dateformatter(my_date);

    // set time that logging started
    logTime.start = new Date(my_date);

    // start logging lesson duration
    lifeTime = setInterval(function() {
      logTime.end = new Date();
      $("#timer")[0].innerText = secondsToHMS(
        Math.floor((logTime.end - logTime.start) / 1000)
      );
    }, 1000);
  }

  // prepare activities to DOM from structure
  function createActivities() {
    // populate #activities
    Object.keys(structure[locale].groups).forEach(function(key) {
      // create group of activities to DOM
      $("#activities").append(
        `
                <div class="group" id="` +
          key +
          `">
                    <header class="group-header">
                        <h3>` +
          structure[locale].groups[key].header +
          `</h3>
                    </header>
                    <div class="list"></div>
                </div>
            `
      );

      // create activities
      Object.keys(structure[locale].groups[key].activities).forEach(function(
        activity_key
      ) {
        // populate trackingStatuses
        trackingStatuses[key + "_" + activity_key] = false;

        // add activity to DOM
        $("#" + key + " .list").append(
          `
                    <a class="activity" style="background-image: url('../../gradients/` +
            backgrounds[key][activity_key] +
            `');" id="` +
            key +
            "_" +
            activity_key +
            `">

                        <span>` +
            structure[locale].groups[key]["activities"][activity_key] +
            `</span> <br>

            <div class="bg"><span class="timer">00:00:00</span></div>
                    </a>
                    `
        );
      });
    });
  }

  // INIT
  function draw() {
    // set locale
    locale = Cookies.get("locale");
    createActivities();
    translate();
  }
  draw(); // init

  // to be populated by activity : {start<Date>, end<Date>, timer<function>}
  var stopwatches = {};

  function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
  }

  function createStopwatch(key, started_at = new Date(), request = false) {
  //  console.log(key);
    if (request) {
      // prepare ajax request to db
      var tmp = key.split("_");
      var data = {
        type: tmp[0],
        slug: tmp[1],
        lesson_id: Cookies.get("lesson_id")
      };

      // start stopwatch in DB
      voidAjaxRequest(data, "start_stopwatch.php");
    }

    // make logger
    stopwatches[key] = {
      start: started_at,
      end: null,
      timer: setInterval(function() {
        stopwatches[key].end = new Date();

        // update timer text in DOM
        $("#" + key + " .timer")[0].innerHTML = secondsToHMS(
          Math.floor((stopwatches[key].end - stopwatches[key].start) / 1000)
        );
      }, 1000)
    };
    goingactivities.push(key);
    // update entry that timer is logging
    trackingStatuses[key] = true;
    //console.log(trackingStatuses);
  }

  // will be populated with log records
  var logs = [];

  function deleteStopwatch(key) {
    // prepare ajax request to db
    var tmp = key.split("_");
    var data = {
      type: tmp[0],
      slug: tmp[1],
      lesson_id: Cookies.get("lesson_id")
    };

    // stop stopwatch in DB
    voidAjaxRequest(data, "stop_stopwatch.php");

    // stop timer
    clearInterval(stopwatches[key].timer);

    // add new log record
    logs.push({
      key: key,
      start: stopwatches[key].start,
      end: stopwatches[key].end
    });

    // delete stopwatch instance
    delete stopwatches[key];

    // reset timer text in DOM
    $("#" + key + " .timer")[0].innerHTML = "00:00:00";

    // make activity trackable
    trackingStatuses[key] = false;
    removeA(goingactivities, key);
    //goingactivities = [];
  }

  // assign eventListeners to activities
  $(".activity").click(function(e) {
    // if currently not tracking activity
    if (!trackingStatuses[e.target.id]) {
      $(this).addClass("open");
      createStopwatch(e.target.id, new Date(), (request = true));
    } else {
      $(this).removeClass("open");
      deleteStopwatch(e.target.id);
    }
  });

  // start logger
  $("#startBtn").click(function() {
    var data = {
      user_id: Cookies.get("user_id")
    };

    // start lesson in DB
    voidAjaxRequest(data, "start_lesson.php");
    $(this).addClass("away");
    $("#endBtn").addClass("show");
    $(".overlay").addClass("away");

    // set time that logging started
    logTime.start = new Date();

    // start logging lesson duration
    lifeTime = setInterval(function() {
      logTime.end = new Date();
      $("#timer")[0].innerText = secondsToHMS(
        Math.floor((logTime.end - logTime.start) / 1000)
      );
    }, 1000);
  });

  // end logger
  $("#endBtn").click(function() {
    console.log(goingactivities);
    if(goingactivities.length != 0){
      alert("Stop activities first!");
    }
    else{
    $(this).addClass("away");
    $(".container").addClass("hide");
    // stop not user invalidated timers to setup results view
    /*Object.keys(stopwatches).forEach(function(key) {
      deleteStopwatch(key);
    });*/

    var data = {
      user_id: Cookies.get("user_id"),
      lesson_id: Cookies.get("lesson_id")
    };

    // stop lesson in DB
    $.ajax({
      type: "POST",
      url: "stop_lesson.php",
      data: data,
      success: function() {
        // stop log time
        clearInterval(lifeTime);

        // redirect to results
        var lessonid = Cookies.get("lesson_id");
        Cookies.remove("lesson_id");
        Cookies.remove("lesson_start");
        Cookies.remove("tunditeema");
        window.location.href = "../logs/single/index.php?log=" + lessonid;
      }
    });
    }
  });

    $("#resetBtn").click(function() {
    $("#results").addClass("hide");
    $("#endBtn").removeClass("show");
    $(".activity").removeClass("open");
    $("#startBtn").removeClass("away");
    $(".overlay").removeClass("away");
    $(".container").removeClass("hide");
    $("#timer")[0].innerText = "EduLog";
    reset();
  });

  function reset() {
    // clear cookies
    Cookies.remove("lesson_id");
    Cookies.remove("lesson_start");
    logs = [];
    clearInterval(lifeTime);
    sentMail = false;
    $("#sendToEmail").text("Saada tulemused emailile");
    $("#total_duration")[0].innerText = "Total duration: 00:00:00";
    $("#detailed_graph")
      .children()
      .remove();
    $("#resultsList")
      .children()
      .remove();
  }

  function translate() {
    $("#endBtn").html(structure[locale].endBtn);
  }

  function secondsToHMS(secs) {
    function z(n) {
      return (n < 10 ? "0" : "") + n;
    }
    var sign = secs < 0 ? "-" : "";
    secs = Math.abs(secs);
    return (
      sign +
      z((secs / 3600) | 0) +
      ":" +
      z(((secs % 3600) / 60) | 0) +
      ":" +
      z(secs % 60)
    );
  }


});

function sendData(){

  var name = document.getElementById("addStudentActivity").value;
   console.log("Sending data...");
  var httpr = new XMLHttpRequest();
  httpr.open("POST", "addActivities.php", true);
  httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  httpr.onreadystatechange=function(){
     if(httpr.readyState == 4 && httpr.status == 200) {
         document.getElementById("response").innerHTML = httpr.responseText;
     }
 }
 httpr.send("name_en="+addStudentActivity);
}

$(document).ready(function() {

    locale = 'en';

    var structure = {
        en : {
            sendToEmail: 'Send log to email',
            totalDuration: 'Total duration: ',
            groups : {
                teacher : {
                    header : "Teacher's activities",
                    activities : {
                        organizing : 'Organizing',
                        teaching : 'Teaching',
                        discussion : 'Discussion',
                        feedback : 'Feedback'
                    }

                },
                student : {
                    header : "Students' activities",
                    activities : {
                        questions : 'Questions',
                        individualwork : 'Individual work',
                        groupwork : 'Group work',
                        test : 'Test',
                    }
                }
            }
        },
        et : {
            sendToEmail: 'Saada tulemused emailile',
            totalDuration: 'Tunni pikkus: ',
            groups : {
                teacher : {
                    header : "Õpetaja tegevused",
                    activities : {
                        organizing : 'Organiseerimine',
                        teaching : 'Õpetamine',
                        discussion : 'Diskussioon',
                        feedback : 'Tagasiside'
                    }

                },
                student : {
                    header : "Õpilase tegevused",
                    activities : {
                        questions : 'Küsimused',
                        individualwork : 'Individuaalne töö',
                        groupwork : 'Grupitöö',
                        test : 'Test',
                    }
                }
            }
        }
    }

    // appended to url http://saargraafika.ee/edulog/gradients/
    var backgrounds = {
        teacher : {
            organizing : '1-min.png',
            teaching : '2-min.png',
            discussion : '3-min.png',
            feedback : '4-min.png'
        },
        student : {
            questions : '10-min.png',
            individualwork : '11-min.png',
            groupwork : '12-min.png',
            test : '13-min.png'
        }
    }

    // helper functions
    function getParameterByName( name ){
        var regexS = "[\\?&]"+name+"=([^&#]*)",
        regex = new RegExp( regexS ),
        results = regex.exec( window.location.search );
        if( results == null ){
            return "";
        } else{
            return decodeURIComponent(results[1].replace(/\+/g, " "));
        }
    }

    function dateformatter(phpdate) {
        var d = new Date(phpdate.replace(/\+/g, " ").replace(/-/g, "/"))
        d.setHours(d.getHours() - 2);
        return d;
    }

    function toDateTime(secs) {
        var t = new Date(1970, 0, 1); // Epoch
        t.setSeconds(secs);
        return t;
    }

    function secondsToHMS(secs) {
        function z(n){return (n<10?'0':'') + n;}
        var sign = secs < 0? '-':'';
        secs = Math.abs(secs);
        return sign + z(secs/3600 |0) + ':' + z((secs%3600) / 60 |0) + ':' + z(secs%60);
    }

    // get logs
    var lesson;
    var logs = [];
    function getLogs() {
        $.ajax({
            type: "POST",
            url: 'get_logs.php',
            data: { lesson_id: getParameterByName('log') },
            dataType: 'JSON',
            success: function(response) {
                lesson = response[0]
                logs = response[1]

                // edit DOM
                setupResultsView();
            }
        })

    }


    var currentHoverBackground = ''
    function setupResultsView() {

        // change title
        $('#title').html(lesson['started_at'])
        makeDetailedGraph()

        $('.activity').hover(function() {
            currentHoverBackground = $('.minibar').eq($(this).index()).css('backgroundImage')
            $('.minibar').eq($(this).index()).css('background', 'white');
        }, function() {
            $('.minibar').eq($(this).index()).css('background', currentHoverBackground);
            currentHoverBackground = ''
        })
    }

    function makeDetailedGraph() {



        // total time
        var total = (dateformatter(lesson['ended_at']) - dateformatter(lesson['started_at'])) / 1000
        $('#total_duration span').html( "Total duration: " + secondsToHMS(Math.floor(total)));

        // group by type
        var grouped_by_type = logs.reduce(function (r, a) {
            r[a.type] = r[a.type] || [];
            r[a.type].push(a);
            return r;
        }, Object.create(null));

        // group by slug
        var grouped_by_slug = {};

        Object.keys(grouped_by_type).forEach(function(group) {
            grouped_by_slug[group] = grouped_by_type[group].reduce(function (r, a) {
                r[a.slug] = r[a.slug] || [];
                r[a.slug].push(a);
                return r;
            }, Object.create(null));

            // create group of activities to DOM
            $('#resultsList').append(`
                <div class="group" id="` + group + `">
                    <header class="group-header">
                        <h3>`+ structure[locale].groups[group].header +`</h3>
                    </header>
                    <div class="list"></div>
                </div>
            `)
        })

        Object.keys(grouped_by_slug).forEach(function(group) {

            Object.keys(grouped_by_slug[group]).forEach(function(slug) {

                //add container
                $('#detailed_graph').append(jQuery('<div/>', {
                   class: 'bar',
                   id: group +'_'+ slug
                }))

                grouped_by_slug[group][slug].forEach(function(log, index) {

                    // calculate duration
                    var part = (dateformatter(log['ended_at']) - dateformatter(log['started_at'])) / 1000
                    $('.bar#' + group +'_'+ slug).append(jQuery('<div/>', {
                           class: 'minibar',
                           css: {
                               background: "url('http://saargraafika.ee/edulog/gradients/" + backgrounds[group][slug] + "')",
                               width: Math.floor((part / total) * 100) + 'vw',
                               marginLeft: Math.floor((((dateformatter(log['started_at']) - dateformatter(lesson['started_at'])) / 1000) / total) * 100) + 'vw'
                           }
                       }));
                    // add log to list
                    $('#'+group +' .list').append(
                        `
                        <a class="activity" id="`+ group +'_'+ slug + '_' + index +`">
                            <div class="bg" style="background-image: url('http://saargraafika.ee/edulog/gradients/`+ backgrounds[group][slug]+`');">
                                <span class="timer">`+ Math.floor((part / total) * 100) + '%' +`</span>
                            </div>
                            <span>`+ structure[locale].groups[group]['activities'][slug] + ' - ' + secondsToHMS(Math.floor(part)) +`</span>
                        </a>
                        `
                    )
                })


            })
        })

    }

    function draw() {
        locale = Cookies.get('locale');
        getLogs();
    }

    draw();



})

$(document).ready(function() {

    /* DEBUG */
    // $('#register-email').val('rank.henrik@gmail.com')
    // $('#register-password').val('123')
    // $('#register-password-again').val('123')

    var locale = 'et'
    var translation = {
        'et': {
            'title' : 'Registreerumine',
            'locale' : 'Keel',
            'email' : 'E-mail',
            'password' : 'Salasõna',
            'password-again' : 'Salasõna uuesti',
            'submit-btn' : 'Registreeru',
            'login' : 'On juba kasutaja olemas? Logi sisse',
            'password-conflict' : 'Paroolid ei kattu, palun kontrollige väljad üle'
        },
        'en': {
            'title' : 'Registration',
            'locale' : 'Language',
            'email' : 'Email',
            'password' : 'Password',
            'password-again' : 'Password again',
            'submit-btn' : 'Submit',
            'login' : 'Already have an account? Login here',
            'password-conflict' : 'Passwords don\'t match'
        }
    }

    // handle form submission
    $('#register-form').submit(function() {

        var isValid = true;

        // form validation
        if( $('#register-locale').val().length == 0 ) {
            $('#register-locale').addClass('invalid');
            isValid = false;
        } else {
            $('#register-locale').removeClass('invalid');
        }

        if( $('#register-email').val().length == 0 ) {
            $('#register-email').addClass('invalid');
            isValid = false;
        } else {
            $('#register-email').removeClass('invalid');
        }

        if( $('#register-password').val().length == 0 ) {
            $('#register-password').addClass('invalid');
            isValid = false;
        } else {
            $('#register-password').removeClass('invalid');
        }

        if( $('#register-password-again').val().length == 0 ) {
            $('#register-password-again').addClass('invalid');
            isValid = false;
        } else {
            $('#register-password-again').removeClass('invalid');
        }
        // passwords match check

        if( $('#register-password').val() != $('#register-password-again').val() ) {
            $('#register-password').addClass('invalid');
            $('#register-password-again').addClass('invalid');
            alert(translation[locale]['password-conflict'])
            isValid = false;
        }

        return isValid;
    })

    // set language
    $('#register-locale').change(function() {
        locale = $(this).val();
        $('#title').text(translation[locale]['title'])
        $('#label-locale').text(translation[locale]['locale'])
        $('#label-email').text(translation[locale]['email'])
        $('#label-password').text(translation[locale]['password'])
        $('#label-password-again').text(translation[locale]['password-again'])
        $('#submit-btn').text(translation[locale]['submit-btn'])
        $('#cta-login').text(translation[locale]['login'])
    })

    const offset = -new Date().getTimezoneOffset();

    $.ajax({
        type: "GET",
        url: 'index.php',
        data: { time_offset: offset},
        dataType: 'JSON'
    });

})

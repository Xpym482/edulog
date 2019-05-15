$(document).ready(function() {

    var locale = 'et'
    var translation = {
        'et': {
            'title' : 'Logi sisse',
            'locale' : 'Keel',
            'email' : 'E-mail',
            'password' : 'Salasõna',
            'login-btn' : 'Edasi',
            'cta-register' : 'Ei ole veel kasutaja? Registreeru siin',
            'invalid-combination' : 'Vale salasõna või emaili kombinatsioon'
        },
        'en': {
            'title' : 'Login',
            'locale' : 'Language',
            'email' : 'Email',
            'password' : 'Password',
            'login-btn' : 'Submit',
            'cta-register' : 'No account yet? Register here',
            'invalid-combination' : 'Invalid email/password combination'
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

        return isValid;
    })

    // set language
    $('#login-locale').change(function() {
        locale = $(this).val();
        $('#title').text(translation[locale]['title'])
        $('#label-locale').text(translation[locale]['locale'])
        $('#label-email').text(translation[locale]['email'])
        $('#label-password').text(translation[locale]['password'])
        $('#login-btn').text(translation[locale]['login-btn'])
        $('#cta-register').text(translation[locale]['cta-register'])
    })

    const offset = -new Date().getTimezoneOffset();

    $.ajax({
        type: "GET",
        url: 'index.php',
        data: { time_offset: offset},
        dataType: 'JSON'
    });
})

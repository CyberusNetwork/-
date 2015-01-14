/**
 * Created by Adrien on 12/01/2015.
 */


/*
 jQuery document ready.
 */
$(document).ready(function()
{
    /*
     assigning keyup event to password field so everytime user type code will execute
     */

    $('#password').keyup(function()
    {
        $('#result').html(checkStrength($('#password').val()))
    })

    /*
     checkStrength is function which will do the main password strength checking for us
     */

    function checkStrength(password)
    {
        //initial strength
        var strength = 0

        //if the password length is less than 8, return message.
        if (password.length < 8) {
            $('#result').removeClass()
            $('#result').addClass('short')
            return '<p class="text-danger"><b>Le mot de passe doit avoir au moins 8 caractères</b></p>'
        }

        //length is ok, lets continue.

        //if length is 8 characters or more, increase strength value
        if (password.length > 8) strength += 1

        //if password contains both lower and uppercase characters, increase strength value
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1

        //if it has numbers and characters, increase strength value
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1

        //if it has one special character, increase strength value
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~,"])/))  strength += 1

        //if it has two special characters, increase strength value
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~,"].*[!,%,&,@,#,$,^,*,?,_,~,"])/)) strength += 1

        //now we have calculated strength value, we can return messages

        //if value is less than 2
        if (strength < 2 )
        {
            $('#result').removeClass()
            $('#result').addClass('weak')
            return '<p class="text-danger"><b>Faible</b></p>'
        }
        else if (strength == 2 )
        {
            $('#result').removeClass()
            $('#result').addClass('good')
            return '<p class="text-warning"><b>Bien</b></p>'
        }
        else
        {
            $('#result').removeClass()
            $('#result').addClass('strong')
            return '<p class="text-success"><b>Fort</b></p>'
        }
    }

    $('#passwordCheck').keyup(function()
    {
        $('#result').html(checkSamePassword($('#passwordCheck').val()))
    })

    /*
     checkSamePassword is function which will do the checking btw passwords
     */

    function checkSamePassword(passwordCheck) {
        //initial Checking
        var equal = 0

        //if the password is NOT equal, return message.
        if (passwordCheck.match(/password/i))  equal += 1

        if (equal < 1) {
            $('#result').removeClass()
            $('#result').addClass('NOK')
            return '<p class="text-danger"><b>Le mot de passe doit être identique</b></p>'
        }
        else
        {
            $('#result').removeClass()
            $('#result').addClass('OK')
            return '<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-check"></i> Valider</button>'
        }
    }
});
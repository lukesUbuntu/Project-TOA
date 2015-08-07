/**
 * Created by Luke Hardiman on 4/08/2015.
 */
//global scopes
window.register_form = null , window.login_form = null;

$(function() {
    /**
     * Bind our button click events
     */
    $('#login-form-link').click(function(element){
        login_form();
        element.preventDefault();
    });
    $('#register-form-link').click(function(element){
        register_form();
        element.preventDefault();
    });


    /**
     * @description window event for login form button or changing login tab
     * @param element
     */
    window.login_form = function(element){
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $("#login-form-link").addClass('active');
    }

    /**
     * @description window event for register form button or changing register tab
     * @param element
     */
    window.register_form = function(element){
        console.log("clicked")
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $('#register-form-link').addClass('active');

        //prevent submit from button click
        if (typeof element != "undefined")
        element.preventDefault();
    }

    
    //swap between tab views and call function of tab delegated
    if (typeof login_tab == "string" && login_tab.length > 4){
        $("#"+login_tab).addClass("active").css('display','block');
        //declare the function we want to call
        var func = window[login_tab];
        if(typeof func === 'function') {
            func();
        }
    }

    console.log("login.js loaded")
});
$(function() {


$("#form-index-login").submit(function (event) {
    event.preventDefault();
}).validate({
    rules:{
        formIndexEmail:{
            required:true,
            email:true
        },
        formIndexSenha:{
            required:true
        }
    },
    submitHandler: function(form){
        location.href = 'dashboard.html'
    }
});



})
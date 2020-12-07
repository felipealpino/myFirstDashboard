$(function() {

    // $('#Cpf-form-cadastrar').mask("000.000.000-00")

    function validarCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))  Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
        return true;
    }

    jQuery.validator.addMethod("CPF",(value, element) => {
        if(validarCPF(value)){
            return true 
        } else {
            return false
        }
    }, 'CPF inválido')



    $("#form-cadastrar-login").submit(function (event) {
        event.preventDefault();
    }).validate({
        rules:{
            formCadastrarNome:{
                required:true,
            },
            formCadastrarEmail:{
                required:true,
                email:true
            },
            formCadastrarCpf:{
                required: true,
                CPF: true
            },
            formCadastrarSenha:{
                required:true,
            },
            formCadastrarConfirmarSenha:{
                required:true,
                equalTo: "#senha-form-cadastrar"
            }
        },
        submitHandler: function(form){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Registrado com sucesso!',
                showConfirmButton: false,
                timer: 1500
            })
        },
    });
       
  
    
})
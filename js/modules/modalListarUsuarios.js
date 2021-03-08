export default function initListarUsuariosModal(){
    const abrirFecharModalListarUsuarios = document.querySelector('#listar_usuarios_link');
    // const modalListarUsuarios = document.querySelector('[data-modal=ModalListarUsuarios]');
    const modalListarUsuarios = document.querySelector('.container-popup-usuarios');
    const botaoXlistarUsuarios = document.querySelector('.logout-fecharListarUsuarios-botao');
    
    function abrirModalListarUsuarios(event){
        event.preventDefault();
        modalListarUsuarios.classList.toggle('closepopup-usuarios');
    }
    
    function clicarForaModalListarUsuarios(event){
        if(event.target === this){
            modalListarUsuarios.classList.toggle('closepopup-usuarios');
        }
    }   
    
    abrirFecharModalListarUsuarios.addEventListener('click', abrirModalListarUsuarios);
    modalListarUsuarios.addEventListener('click', clicarForaModalListarUsuarios);
    botaoXlistarUsuarios.addEventListener('click', abrirModalListarUsuarios)
}


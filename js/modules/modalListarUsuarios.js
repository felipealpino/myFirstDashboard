export default function initListarUsuariosModal(){

}

const abrirFecharModalListarUsuarios = document.querySelector('#listar_usuarios_link');
const modalListarUsuarios = document.querySelector('[data-modal=ModallistarUsuarios]');
function abrirModalListarUsuarios(event){
    event.preventDefault();
    modalListarUsuarios.classList.toggle('closepopup-usuarios');
    
}


abrirFecharModalListarUsuarios.addEventListener('click', abrirModalListarUsuarios);
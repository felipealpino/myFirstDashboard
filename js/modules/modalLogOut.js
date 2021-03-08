export default function initLogOutModal(){
    const botaoAbrirFechar = document.querySelectorAll('[data-modal=modalLogout]');
    const containerLogout = document.querySelector('[data-modal=logout]');
    
    function abrirFecharModalLogout(event){
        event.preventDefault();
        containerLogout.classList.toggle('ativo');
    }
    
    function clicouForaModalLogout(event){
        if(event.target === this){
            abrirFecharModalLogout();
        }
    }
    
    botaoAbrirFechar.forEach(element => {
        element.addEventListener('click', abrirFecharModalLogout);
    });
    containerLogout.addEventListener('click', clicouForaModalLogout);
}


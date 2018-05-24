function resizeButtons(){
    $( window ).resize(function() {
        resizeOnload();
    });
}
function resizeOnload(){
    if($( window ).width() <= 767){
        $('.text-excluir').text('');       
        $('.text-editar').text('');   
        $('.btn-editar').css('float', 'left'); 
        $('.btn-editar').css('width', 28);
        $('.btn-excluir').css('float', 'left'); 
        $('.btn-excluir').css('width', 28);
    }else{
        $('.text-excluir').text('Excluir');       
        $('.text-editar').text('Editar');
        $('.btn-editar').css('float', ''); 
        $('.btn-editar').css('width', 'auto');
        $('.btn-excluir').css('float', ''); 
        $('.btn-excluir').css('width', 'auto');
    }
}
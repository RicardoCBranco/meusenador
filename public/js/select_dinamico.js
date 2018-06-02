function dados(s1,s2){
    var sel1 = document.getElementById(s1);
    var id = sel1.options[sel1.selectedIndex].value;
    $.get("show.php?parlamentar="+id,function(dados){
        $("#"+s2).empty();
        $("#"+s2).html(dados);
    });
}
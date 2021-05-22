$(document).ready(function(){
    $('.sort_th').on('click',function(){
        var tbody = $('tbody:eq(1)');
        console.log(tbody);
        tbody.html($('tr',tbody).get().reverse());
    })
})
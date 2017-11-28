$('#bagla').click(function(){
   $('#basliq').slideUp();
});

$('#currency').find('>span>span').click(function (e) {
   e.stopPropagation();
   $(this).parent('span').next('ul').slideToggle(300);
});

$('#currency').find('ul>li>a').click(function (e) {
   e.stopPropagation();
});

$('#currency').find('ul').click(function (e) {
    e.stopPropagation();
});

$(document).click(function () {
   $('#currency').find('>ul').slideUp();
    if($('#wish-search').find('>span:nth-of-type(2)').find('input').css('display')!='none'){
        $('#wish-search').find('>span:nth-of-type(2)').find('input').stop().animate({
            width: "0",
            padding: "8px 0"
        }, 400,function(){
            $('#wish-search').find('>span:nth-of-type(2)').find('input').fadeOut(50)
        });
    }
});

$('#wish-search').find('>span:nth-of-type(2)').click(function () {
    if($(this).find('input').css('display')=='none'){
        $(this).find('input').stop().show().animate({
            width: "250px",
            padding: "8px 10px"
        }, 300);
    }else{
        $(this).find('input').stop().animate({
            width: "0",
            padding: "8px 0"
        }, 300,function(){
            $(this).fadeOut(50)
        });
    }
});

$('#wish-search').find('>span:nth-of-type(2) input').click(function (e) {
    e.stopPropagation();
});
$('#wish-search').find('>span:nth-of-type(2)').click(function (e) {
    e.stopPropagation();
});


$('.altkateqoriyali').hover(function(){
    $(this).find('>section').fadeIn(300);
},function(){
    $(this).find('>section').fadeOut(300);
});
/**
 * Created by Administrator on 2016/9/12.
 */
window.onload=function(){
    //搜索框居中
    $(".ssBox").css({
        marginLeft:($(".headerSearchBox").width()-$(".logo").width()-$(".shopCar").width()-20-$(".ssBox").width())/2+"px"
    });
};
$(function(){
    //点击搜索关键词
    $(".ssKeywords span").each(function(){
       $(this).click(function(){
           $(".ssKeywords span").removeClass("ssKeywordsClick");
           $(this).addClass("ssKeywordsClick");
           $(".shuru").val($(this).text())
       });
    });
    $(".allBox,.allOtherBox").hover(function(){
        console.log("!");
        $(".allOtherBox").show();
    },function(){
        console.log("2");
        $(".allOtherBox").hide();
    });
});
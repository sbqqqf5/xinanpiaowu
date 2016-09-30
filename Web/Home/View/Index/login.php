<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name = "format-detection" content = "telephone=no">
    <title>登陆</title>
    <link rel="stylesheet" href="/Public/home_pc/css/com.css">
    <link rel="stylesheet" href="/Public/home_pc/css/footer.css">
    <style>
        .header{
            width:100%;
            font-size:13px;
            color:#666666;
            line-height:80px;
        }
        .headerMain img{
            height:40px;
            margin:20px 0;
            padding-right:30px;
            border-right:1px solid #d8d8d8;
            margin-right:30px;
        }
        .bj{
            width:100%;
        }
        .loginBox{
            width: 500px;
            height:350px;
            overflow:hidden;
            background-color:#fff;
        }
        .loginTitle{
            background-color:#f2f2f2;
            height:40px;
            font-size: 14px;
        }
        .loginTitle img{
            margin: 10px 11px;
        }
        .loginTitle div{
            line-height:40px;
            color:#80c41f;
        }
        .dengluBg{
            position: absolute;
            left:0;
            bottom:0;
        }
        .weixin{
            background-color:#fff;
            width: 166px;
            height:166px;
            box-sizing: border-box;
            border:1px solid #d8d8d8;
        }
        .weixin img{
            width:100%;
            height:100%;
        }
        .saomiao{
            width:165px;
            text-align:center;
            top:220px;
            height:30px;
            position:relative;
            z-index: 2;
            line-height:30px;
        }
        .state1{
            width:100%;
            height:100%;
            position: absolute;
            top:0;
            left:0;
        }
        .state2{
            width:100%;
            height:100%;
            position: absolute;
            top:0;
            left:0;
        }
        .state3{
            width:100%;
            height:100%;
            position: absolute;
            top:0;
            left:0;
        }
        .bindBox{
            position: absolute;
            z-index: 2;
            height: 162px;
            top:0px;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }
        .bdBox{
            border:1px solid #e5e5e5;
            box-sizing: border-box;
            width:300px;
            height:44px;
            background-color:#fff;
            margin:15px auto;
            font-size:14px;
            border-radius:5px;
        }
        .bdIcon{
            padding: 5px 10px;
            border-right: 1px solid #e5e5e5;
            margin-top:6px;
        }
        .phone {
            border: 1px solid #fff;
            line-height: 20px;
            height: 22px;
            box-sizing: border-box;
            padding:21px 20px;
        }
        .deleteText{
            display:none;
            padding:11px;
            cursor: pointer;
        }
        .bdBox2{
            border:1px solid #e5e5e5;
            box-sizing: border-box;
            width:180px;
            height:44px;
            background-color:#fff;
            font-size:14px;
        }
        .yzm{
            border: 1px solid #fff;
            line-height: 20px;
            height: 22px;
            box-sizing: border-box;
            padding:21px 20px;
            width:135px;
            border-radius:5px;
        }
        .yzmBtn{
            cursor: pointer;
            width:110px;
            height:44px;
            text-align: center;
            line-height:44px;
            color:#fff;
            border-radius:5px;
            background-color:#b3b3b3;
            /*background-color:#99d04c;*/
        }
        .bdBtn{
            width:300px;
            height:44px;
            color:#fff;
            text-align: center;
            line-height:44px;
            background-color:#b3b3b3;
            margin:15px auto;
            display: block;
            border-radius:5px;
        }
    </style>
</head>
<body>
    <div class="header">
         <div class="headerMain wp">
             <img src="/Public/home_pc/images/logo.png" alt="">
             登陆
         </div>
    </div>
    <div class="content pr">
        <img src="/Public/home_pc/images/login_bg_big.jpg" class="bj" alt="">
        <div class="loginBox cl paAuto">
            <div class="state1 ">
                <div class="loginTitle cl">
                    <img src="/Public/home_pc/images/login_wechat.png" class="z" alt="">
                    <div class="z">微信登陆</div>
                </div>
                <div class="weixin cl paAuto">
                    <img src="/Public/home_pc/images/qr.png" alt="">
                </div>
                <div class="saomiao paAuto"><span style="color:#80c41f">微信</span>扫描二维码</div>
                <img src="/Public/home_pc/images/dengluBG.png" class="dengluBg" alt="">
            </div>
            <div class="state2 none">
                <div class="loginTitle cl">
                    <img src="/Public/home_pc/images/login_wechat.png" class="z" alt="">
                    <div class="z">微信登陆</div>
                </div>
                <img src="/Public/home_pc/images/saomiaocg.png" class="dengluIcon paAuto" alt="">
                <div class="saomiao paAuto fs14 addShou" style="color:#62d12a">返回微信登录</div>
                <img src="/Public/home_pc/images/dengluBG.png" class="dengluBg" alt="">
            </div>
            <div class="state3 none">
                <div class="loginTitle cl">
                    <img src="/Public/home_pc/images/login_tel_green.png" class="z" alt="">
                    <div class="z">绑定手机</div>
                </div>
                <div class="bindBox">
                    <div class="bdBox cl">
                        <img src="/Public/home_pc/images/login_tel_gray.png" class="bdIcon z" alt="">
                        <input type="text" class="z phone" onfocus="phoneFocus()" onblur="phoneBlur()" onkeyup="phoneOnkey()" placeholder="请输入电话号码">
                        <img src="/Public/home_pc/images/deleteText.png" class="y deleteText" alt="">
                    </div>
                    <div class="bdBox cl" style="border:0">
                        <div class="bdBox2 z">
                            <img src="/Public/home_pc/images/login_confirm_gray.png" class="bdIcon z"  alt="">
                            <input type="text" class="z yzm" onkeyup="yzmFun()" placeholder="请输入验证码" onfocus="yzmFocus()" onblur="yzmBlur()">
                        </div>
                        <div class="yzmBtn y">发送验证码</div>
                    </div>
                    <input type="button" class="bdBtn fs18" value="绑  定">
                </div>
                <img src="/Public/home_pc/images/dengluBG.png" class="dengluBg" alt="">
            </div>
        </div>
        <img src="/Public/home_pc/images/loginText.png" class="loginText pa" alt="">
    </div>
    <?php require dirname(__FILE__).'/../Public/_footer.php' ?>
</body>
<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script>
    var regBox = {
        regMobile : /^0?1[3|4|5|7|8][0-9]\d{8}$/
    };
    //手机验证
    var phoneB=false;

    //验证码状态；
    var yzmB=false;
    //验证码倒计时
    var yzmNum=5;
    $(function(){
       $(".loginText").css({
          left:($(window).width()-900)/2+"px",
           top:"100px"
       });
        if($(window).height()<800){
            $(".loginText").css({
                top:"10px"
            });
        }

        //状态1点击进入状态2
        $(".state1").click(function(){
            $(".state1").hide();
            $(".state2").show();
        });

        //状态2点击回到状态1
        $(".saomiao").eq(1).click(function(){
            $(".state2").hide();
            $(".state1").show();
        });

        //状态2进入到状态3(绑定手机)
        $(".state2").click(function(){
            $(".state2").hide();
            $(".state3").show();
        });
        //删除输入的手机号码
        $(".deleteText").click(function(){
           $(".phone").val("");
            $(".deleteText").hide();
        });
        //点击发送验证码
        $(".yzmBtn").click(function(){
            if(phoneB){
                $(".yzmBtn").css({
                    backgroundColor:"#b3b3b3"
                });
                $(".yzmBtn").text(yzmNum);
                var yzmFun=setInterval(function(){
                    yzmNum--;
                    $(".yzmBtn").text(yzmNum);
                    if(yzmNum<0){
                        clearInterval(yzmFun);
                        phoneB=false;
                        $(".yzmBtn").css({
                            backgroundColor:"#99d04c"
                        });
                        $(".yzmBtn").text("发送验证码");
                    }
                },1000);
            }
        });

        //点击绑定
        $(".bdBtn").click(function(){
           if(yzmB){
               alert("绑定成功")
           }
        });
    });

    function phoneFocus(){
        $(".bdBox").eq(0).css({
            border:"1px solid #99d04c"
        });
        $(".bdIcon").eq(0).css({
            borderRight:"1px solid #99d04c"
        });
        $(".bdIcon").eq(0).attr("src","/Public/home_pc/images/login_tel_green.png");
    }
    function phoneBlur(){
        $(".bdBox").eq(0).css({
            border:"1px solid #e5e5e5"
        });
        $(".bdIcon").eq(0).css({
            borderRight:"1px solid #e5e5e5"
        });
        $(".bdIcon").eq(0).attr("src","/Public/home_pc/images/login_tel_gray.png");
    }
    function phoneOnkey(){
         if($(".phone").val().length>0){
             $(".deleteText").show();
             phoneB=regBox.regMobile.test($(".phone").val());
             if(phoneB){
                    $(".yzmBtn").css({
                        backgroundColor:"#99d04c"
                    })
             }else {
                 $(".yzmBtn").css({
                     backgroundColor:"#b3b3b3"
                 })
             }
         }else {
             $(".deleteText").hide();
         }
    }



    function yzmFocus(){
        $(".bdBox2").eq(0).css({
            border:"1px solid #99d04c"
        });
        $(".bdIcon").eq(1).css({
            borderRight:"1px solid #99d04c"
        });
        $(".bdIcon").eq(1).attr("src","/Public/home_pc/images/login_confirm_green.png");
    }
    function yzmBlur(){
        $(".bdBox2").eq(0).css({
            border:"1px solid #e5e5e5"
        });
        $(".bdIcon").eq(1).css({
            borderRight:"1px solid #e5e5e5"
        });
        $(".bdIcon").eq(1).attr("src","/Public/home_pc/images/login_confirm_gray.png");
    }

    function  yzmFun(){
        if($(".yzm").length>0){
            yzmB=true;
            $(".bdBtn").css({
                backgroundColor:"#99d04c"
            });
        }else {
            yzmB=false;
            $(".bdBtn").css({
                backgroundColor:"#e5e5e5"
            });
        }
    }
</script>
</html>
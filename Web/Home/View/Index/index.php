<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name = "format-detection" content = "telephone=no">
    <title>首页</title>
    <link rel="stylesheet" href="/Public/home_pc/css/com.css">
    <link rel="stylesheet" href="/Public/home_pc/css/head.css">
    <link rel="stylesheet" href="/Public/home_pc/css/footer.css">
    <link rel="stylesheet" href="/Public/home_pc/css/index.css">
</head>
<body>
    <div class="header">
        <div class="headerTop cl">
             <div class="headerTopContent wp cl">
                <div class="z">所选位置 ：</div>
                 <div class="z">成都</div>
                 <div class="z xia"></div>
                 <div class="y shop">购票指南</div>
                 <div class="y shoucang">我的收藏</div>
                 <div class="y weixin">西南票务网微信</div>
                 <img src="/Public/home_pc/images/header_wechat.png" class="y weixinIcon" alt="">
                 <div class="y center">
                     <div class="z">个人中心</div>
                     <div class="z xia2"></div></div>
                 <a href="javascript:void(0)" class="y loginBtn">
                     登陆
                 </a>
                 <div class="y">欢迎来到西南票务网，你好</div>

             </div>
        </div>
        <div class="headerBottom cl">
            <div class="headerSearchBox wp cl">
                <img src="/Public/home_pc/images/logo.png" class="z logo" alt="">
                <div class="ssBox z">
                    <div class="smallSsBox cl">
                        <input type="text" class="shuru" placeholder="西南票务网   欢迎你！"><input type="button" value="搜索" class="fs16 ssBtn">
                        <div class="ssKeywords ellipse">
                            <span class="ssKeywordsClick">周杰伦</span>
                            <span>南征北战</span>
                            <span>西域骆驼</span>
                            <span>王尼玛</span>
                        </div>
                    </div>
                </div>
                <div class="shopCar y">
                    <img src="/Public/home_pc/images/shoppingCart_green.png" class="z shopCarIcon" alt="">
                    <div class="z">购物车</div>
                    <div class="zuo y"></div>
                    <div class="shopNum">
                        99
                    </div>
                </div>
            </div>
        </div>
        <div class="titleBox cl wp">
            <div class="allBox z">
                <div class="allTitle">全部票务分类</div>
            </div>
            <div class="navTitle z">
                <a href="javascript:void(0)" class="liClick">首页</a>
                <?php foreach($columns as $column): ?>
                <a href="javascript:void(0)"><?=$column['name'] ?></a>
                <?php endforeach; ?>

                <a href="/star">明星周边</a>
                <a href="javascript:void(0)">代理加盟</a>
            </div>
        </div>
        <div class="xian"></div>
    </div>
    <div class="content cl">
        <div class="bannerBox wp cl">
            <div class="allOtherBox z">
            <?php foreach($menus as $menu): ?>
                <a href="javascript:void(0)" class="cl fenlei">
                    <img src="<?=$menu['icon'] ?>" class="z" alt="">
                    <div class="y"><?=$menu['name'] ?></div>
                </a>
            <?php endforeach ?>
                <!-- <a href="javascript:void(0)" class="cl fenlei">
                    <img src="/Public/home_pc/images/ticket_category_musicale.png" class="z" alt="">
                    <div class="y">音乐会</div>
                </a>
                <a href="javascript:void(0)" class="cl fenlei">
                    <img src="/Public/home_pc/images/ticket_category_sports.png" class="z" alt="">
                    <div class="y">体育</div>
                </a>
                <a href="javascript:void(0)" class="cl fenlei">
                    <img src="/Public/home_pc/images/ticket_category_exhibition.png" class="z" alt="">
                    <div class="y">行业展会</div>
                </a>
                <a href="javascript:void(0)" class="cl fenlei">
                    <img src="/Public/home_pc/images/ticket_category_drama.png" class="z" alt="">
                    <div class="y">话剧</div>
                </a>
                <a href="javascript:void(0)" class="cl fenlei">
                    <img src="/Public/home_pc/images/ticket_category_view.png" class="z" alt="">
                    <div class="y">景点门票</div>
                </a> -->
            </div>
            <div class="y pptBox">
                <div class="pptBoxTop pr">
                <?php foreach($banners as $banner): ?>
                   <a href="<?=$banner['link']?$banner['link']:'javascript:;' ?>"><img src="<?=$banner['img'] ?>" alt=""></a>
                <?php endforeach; ?>
                </div>
                <div class="pptBoxBottom cl" data-show=0>
                <?php foreach($banners as $banner): ?>
                    <div class="smallPPTbox z">
                        <div class="san"></div>
                        <div class="pptImgBox">
                            <img src="<?=$banner['img'] ?>" alt="">
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="wp tuijian cl pr">
             <div class="tuijianTitle z">
                 <div class="tui z tuiClick">本月推荐</div>
                 <div class="tui z">九月推荐</div>
                 <div class="tui z">十月推荐</div>
                 <div class="tui z">即将预售</div>
             </div>
             <div class="city z">
                 <div class="cityText z cityTextClick">成都</div>
                 <div class="cityText z">重庆</div>
                 <div class="cityText z">北京</div>
                 <div class="cityText z">昆明</div>
                 <div class="cityText z">南州</div>
                 <div class="cityText z">上海</div>
                 <div class="cityText z">大理</div>
                 <div class="cityText z">德阳</div>
             </div>
             <div class="huan pa">
                 <div class="z">换一批</div>
                 <img src="/Public/home_pc/images/index_reload.png" alt="" class="z">
             </div>
            <div class="tuijianBox cl">
                <div class="tuiBox z">
                    <img src="/Public/home_pc/images/detail_main_img.png" alt="">
                    <div class="tuiBoxText">
                    </div>
                </div>
                <div class="tuiBox z">
                    <img src="/Public/home_pc/images/img_concert_left.png" alt="">
                    <div class="tuiBoxText">

                    </div>
                </div>
                <div class="tuiBox z">
                    <img src="/Public/home_pc/images/img_recommend.png" alt="">
                    <div class="tuiBoxText">

                    </div>
                </div>
                <div class="tuiBox z">
                    <img src="/Public/home_pc/images/detail_main_img.png" alt="">
                    <div class="tuiBoxText">
                      >
                    </div>
                </div>
                <div class="tuiBox z">
                    <img src="/Public/home_pc/images/img_concert_left.png" alt="">
                    <div class="tuiBoxText">

                    </div>
                </div>
                <div class="tuiBox z">
                    <img src="/Public/home_pc/images/img_recommend.png" alt="">
                    <div class="tuiBoxText">

                    </div>
                </div>
            </div>
            <div class="guanggao cl wp">
                <a href="javascript:void(0)">
                    <img src="/Public/home_pc/images/classify_presell_left.png" alt="">
                </a>
                <a href="javascript:void(0)">
                    <img src="/Public/home_pc/images/classify_presell_left.png" alt="">
                </a>
                <a href="javascript:void(0)">
                    <img src="/Public/home_pc/images/classify_presell_left.png" alt="">
                </a>
                <a href="javascript:void(0)">
                    <img src="/Public/home_pc/images/classify_presell_left.png" alt="">
                </a>
            </div>
            <div class="listTemplate listTemplate1 cl wp">
                <div class="templateTitle cl fs12">
                    <span class="fs18">演唱会</span>  华语、欧美、日韩，音乐LIVE一网打尽
                    <a href="javascript:void(0)" class="y">查看全部>></a>
                </div>
                <div class="templateMain cl">
                    <div class="templateRight y">
                        <div class="templateRightT cl">
                            <div class="z fs18">即将预售</div>
                            <a class="y" href="javascript:void(0)">查看全部>></a>
                        </div>
                        <div class="yushouCover">
                            <img src="/Public/home_pc/images/img_concert_left.png" alt="">
                        </div>
                        <div class="yushouName ellipse fs14">
                            【成都】周杰伦 地表最强开唱百场巡演
                        </div>
                        <div class="yushouOther cl">
                            <div class="yudingBtn z">
                                去支付定金
                            </div>
                            <div class="yushouX z">
                                <div>时间：2015-09-21</div>
                                <div class="ellipse">地点：骄子音乐大厅</div>
                            </div>
                        </div>
                        <div class="yushouHint cl">
                            注：当预售票开售时用户并未交款项也不申请取消
                            订单退款，商家不退还定金
                        </div>
                    </div>
                    <div class="templateMainBig pr z">
                        <img src="/Public/home_pc/images/change1.png" class="coverImg" alt="">
                        <div class="coverText pa">
                            <div class="coverD paAuto">
                                <div class="money fs12">
                                    <span class="fs18">￥185/</span>起
                                </div>
                                <div class="introduce fs14" >
                                    2016亚洲全频段唱跳女王
                                    首席女艺人
                                </div>
                                <div class="other fs12 cl">
                                    <span class="z">2016-12-08</span>
                                    <span style="margin-left:20px">星期六</span>
                                    <span class="y">成都</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change2.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change3.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change4.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change5.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listTemplate listTemplate2 cl wp">
                <div class="templateTitle cl fs12">
                    <span class="fs18">话剧表演</span>华语、欧美、日韩，音乐LIVE一网打尽
                    <a href="javascript:void(0)" class="y">查看全部>></a>
                </div>
                <div class="templateMain cl">
                    <div class="templateRight y">
                        <div class="templateRightT cl">
                            <div class="z fs18">即将预售</div>
                            <a class="y" href="javascript:void(0)">查看全部>></a>
                        </div>
                        <div class="yushouCover">
                            <img src="/Public/home_pc/images/img_concert_left.png" alt="">
                        </div>
                        <div class="yushouName ellipse fs14">
                            【成都】周杰伦 地表最强开唱百场巡演
                        </div>
                        <div class="yushouOther cl">
                            <div class="yudingBtn z">
                                去支付定金
                            </div>
                            <div class="yushouX z">
                                <div>时间：2015-09-21</div>
                                <div class="ellipse">地点：骄子音乐大厅</div>
                            </div>
                        </div>
                        <div class="yushouHint cl">
                            注：当预售票开售时用户并未交款项也不申请取消
                            订单退款，商家不退还定金
                        </div>
                    </div>
                    <div class="templateMainBig pr z">
                        <img src="/Public/home_pc/images/change1.png" class="coverImg" alt="">
                        <div class="coverText pa">
                            <div class="coverD paAuto">
                                <div class="money fs12">
                                    <span class="fs18">￥185/</span>起
                                </div>
                                <div class="introduce fs14" >
                                    2016亚洲全频段唱跳女王
                                    首席女艺人
                                </div>
                                <div class="other fs12 cl">
                                    <span class="z">2016-12-08</span>
                                    <span style="margin-left:20px">星期六</span>
                                    <span class="y">成都</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change2.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change3.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change4.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change5.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listTemplate listTemplate3 cl wp">
                <div class="templateTitle cl fs12">
                    <span class="fs18">体育赛事</span>  华语、欧美、日韩，音乐LIVE一网打尽
                    <a href="javascript:void(0)" class="y">查看全部>></a>
                </div>
                <div class="templateMain cl">
                    <div class="templateRight y">
                        <div class="templateRightT cl">
                            <div class="z fs18">即将预售</div>
                            <a class="y" href="javascript:void(0)">查看全部>></a>
                        </div>
                        <div class="yushouCover">
                            <img src="/Public/home_pc/images/img_concert_left.png" alt="">
                        </div>
                        <div class="yushouName ellipse fs14">
                            【成都】周杰伦 地表最强开唱百场巡演
                        </div>
                        <div class="yushouOther cl">
                            <div class="yudingBtn z">
                                去支付定金
                            </div>
                            <div class="yushouX z">
                                <div>时间：2015-09-21</div>
                                <div class="ellipse">地点：骄子音乐大厅</div>
                            </div>
                        </div>
                        <div class="yushouHint cl">
                            注：当预售票开售时用户并未交款项也不申请取消
                            订单退款，商家不退还定金
                        </div>
                    </div>
                    <div class="templateMainBig pr z">
                        <img src="/Public/home_pc/images/change1.png" class="coverImg" alt="">
                        <div class="coverText pa">
                            <div class="coverD paAuto">
                                <div class="money fs12">
                                    <span class="fs18">￥185/</span>起
                                </div>
                                <div class="introduce fs14" >
                                    2016亚洲全频段唱跳女王
                                    首席女艺人
                                </div>
                                <div class="other fs12 cl">
                                    <span class="z">2016-12-08</span>
                                    <span style="margin-left:20px">星期六</span>
                                    <span class="y">成都</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change2.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change3.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change4.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change5.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listTemplate listTemplate4 cl wp">
                <div class="templateTitle cl fs12">
                    <span class="fs18">展会展览</span>  华语、欧美、日韩，音乐LIVE一网打尽
                    <a href="javascript:void(0)" class="y">查看全部>></a>
                </div>
                <div class="templateMain cl">
                    <div class="templateRight y">
                        <div class="templateRightT cl">
                            <div class="z fs18">即将预售</div>
                            <a class="y" href="javascript:void(0)">查看全部>></a>
                        </div>
                        <div class="yushouCover">
                            <img src="/Public/home_pc/images/img_concert_left.png" alt="">
                        </div>
                        <div class="yushouName ellipse fs14">
                            【成都】周杰伦 地表最强开唱百场巡演
                        </div>
                        <div class="yushouOther cl">
                            <div class="yudingBtn z">
                                去支付定金
                            </div>
                            <div class="yushouX z">
                                <div>时间：2015-09-21</div>
                                <div class="ellipse">地点：骄子音乐大厅</div>
                            </div>
                        </div>
                        <div class="yushouHint cl">
                            注：当预售票开售时用户并未交款项也不申请取消
                            订单退款，商家不退还定金
                        </div>
                    </div>
                    <div class="templateMainBig pr z">
                        <img src="/Public/home_pc/images/change1.png" class="coverImg" alt="">
                        <div class="coverText pa">
                            <div class="coverD paAuto">
                                <div class="money fs12">
                                    <span class="fs18">￥185/</span>起
                                </div>
                                <div class="introduce fs14" >
                                    2016亚洲全频段唱跳女王
                                    首席女艺人
                                </div>
                                <div class="other fs12 cl">
                                    <span class="z">2016-12-08</span>
                                    <span style="margin-left:20px">星期六</span>
                                    <span class="y">成都</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change2.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change3.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change4.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                    <div class="templateMainSmall pr z">
                        <div class="templateMainSmallZ z">
                            <img src="/Public/home_pc/images/change5.png" class="coverImg" alt="">
                        </div>
                        <div class="templateMainSmallR pr y">
                            <div class="templateMainSmallRTitle">
                                【成都】周杰伦 地表最
                                强开唱百场巡演
                            </div>
                            <div class="fs12 time ellipse">演出时间：2016-09-27</div>
                            <div class="fs12 addres ellipse">演出地点：骄子音乐厅 </div>
                            <div class="moneyQ ellipse"><span>￥80/</span>起 </div>
                            <div class="buyBox cl">
                                <div class="fs14">加入购物车</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require __DIR__.'/../Public/_footer.php' ?>
</body>
<script src="http://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/Public/home_pc/js/com.js"></script>
<script>
    //ppt小图点击
    $(".pptBoxBottom .smallPPTbox").each(function(e){
        $(".smallPPTbox").eq(e).click(function(){
            $(".smallPPTbox").removeClass("clickPPT");
            $(".smallPPTbox").eq(e).addClass("clickPPT");
            $(".pptBoxTop img").fadeOut();
            $(".pptBoxTop img").eq(e).fadeIn();
        });
    });
    //ppt小图初始化
    $(".smallPPTbox").eq(0).click();
    //推荐点击
    $(".tui").click(function(e){
        $(".tui").removeClass("tuiClick");
        $(this).addClass("tuiClick");
    });
    $(".cityText").click(function(e){
        $(".cityText").removeClass("cityTextClick");
        $(this).addClass("cityTextClick");
    });
    for(var i=0;i<6;i++){
        var str="2016陈奕迅 ANOTHER EASON’S LIFE OMG Love Love Love Love";
//          var str="被欺骗算什麽早已习惯难过眼神空眼眶红但记得别过执着寂静无声的我还能够说什麽眼神憔悴脆弱用烟燻妆来盖过"
        if (str.length >20) {
            str = str.substring(0,20)+"...";
            $(".tuiBoxText").eq(i).text(str);
        }
    }


</script>
</html>
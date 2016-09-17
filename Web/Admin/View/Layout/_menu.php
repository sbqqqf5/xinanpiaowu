
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/token">西南票务—后台管理</a>
            </div>

            <div class="header-right">

              <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
                <a href="login.html" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>


            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <!-- <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />
                    
                            <div class="inner-text">
                                Jhon Deo Alex
                            <br />
                                <small>Last Login : 2 Weeks Ago </small>
                            </div>
                        </div>
                    
                    </li> -->

<!-- class="active-menu-top" 活动的一级菜单 class="active-menu" 活动的菜单 collapse in 折叠 赋在ul上 -->
                    <li>
                        <a href="<?=U('Index/index') ?>"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-desktop "></i>UI Elements <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="panel-tabs.html"><i class="fa fa-toggle-on"></i>Tabs & Panels</a>
                            </li>
                            <li>
                                <a href="notification.html"><i class="fa fa-bell "></i>Notifications</a>
                            </li>
                             <li>
                                <a href="progress.html"><i class="fa fa-circle-o "></i>Progressbars</a>
                            </li>
                             <li>
                                <a href="buttons.html"><i class="fa fa-code "></i>Buttons</a>
                            </li>
                             <li>
                                <a href="icons.html"><i class="fa fa-bug "></i>Icons</a>
                            </li>
                             <li>
                                <a href="wizard.html"><i class="fa fa-bug "></i>Wizard</a>
                            </li>
                             <li>
                                <a href="typography.html"><i class="fa fa-edit "></i>Typography</a>
                            </li>
                             <li>
                                <a href="grid.html"><i class="fa fa-eyedropper "></i>Grid</a>
                            </li>
                            
                           
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-yelp "></i>商品管理 <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#"><i class="fa fa-coffee"></i>明星周边商品<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="<?=U('Star/cateList') ?>"><i class="fa fa-plus "></i>商品分类</a>
                                    </li>
                                    <li>
                                        <a href="<?=U('Star/index') ?>"><i class="fa fa-comments-o "></i>商品列表</a>
                                    </li>
                                    <li>
                                        <a href="<?=U('Star/productProperty') ?>"><i class="fa fa-comments-o "></i>商品规格设置</a>
                                    </li>
                                    <li>
                                        <a href="<?=U('Star/starList') ?>"><i class="fa fa-comments-o ">明星品牌</i></a>
                                    </li>
                                </ul>

                            </li>
                            <li>
                                <a href="#"><i class="fa fa-flash "></i>票务商品<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="<?=U('Ticket/columnList') ?>"><i class="fa fa-plus "></i>票务栏目</a>
                                    </li>
                                    <li>
                                        <a href="<?=U('Ticket/index') ?>"><i class="fa fa-comments-o "></i>商品列表</a>
                                    </li>
                                    <li>
                                        <a href="<?=U('Ticket/cityList') ?>"><i class="fa fa-comments-o "></i>票务城市</a>
                                    </li>
                                    <li>
                                        <a href="<?=U('Ticket/cateList') ?>"><i class="fa fa-comments-o ">票务类型</i></a>
                                    </li>
                                </ul>
                            </li>
                             <li>
                                <a href="component.html"><i class="fa fa-key "></i>Components</a>
                            </li>
                             <li>
                                <a href="social.html"><i class="fa fa-send "></i>Social</a>
                            </li>
                            
                             <li>
                                <a href="message-task.html"><i class="fa fa-recycle "></i>Messages & Tasks</a>
                            </li>
                            
                           
                        </ul>
                    </li>
                    <li>
                        <a href="<?=U('Index/table') ?>"><i class="fa fa-flash "></i>Data Tables </a>
                        
                    </li>
                     <li>
                        <a href="#" ><i class="fa fa-bicycle "></i>Forms <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level ">
                           
                             <li>
                                <a href="<?=U('form') ?>" ><i class="fa fa-desktop "></i>Basic </a>
                            </li>
                             <li>
                                <a href="form-advance.html"><i class="fa fa-code "></i>Advance</a>
                            </li>
                             
                           
                        </ul>
                    </li>
                    <li>
                        <a href="#" ><i class="fa fa-bicycle "></i>网站管理 <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level ">
                           
                             <li>
                                <a href="<?=U('Info/vipPrice') ?>" ><i class="fa fa-desktop "></i>会员充值积分 </a>
                            </li>
                            <li>
                                <a href="<?=U('Info/preSale') ?>" ><i class="fa fa-desktop "></i>预售票提示信息 </a>
                            </li>
                            <li>
                                <a href="<?=U('Info/promotion') ?>" ><i class="fa fa-desktop "></i>推广说明图片 </a>
                            </li>
                            <li>
                                <a href="<?=U('Info/seoAndRight') ?>" ><i class="fa fa-desktop "></i>SEO及版权设置 </a>
                            </li>
                            <li>
                                <a href="<?=U('Info/adminList') ?>" ><i class="fa fa-desktop "></i>管理员列表 </a>
                            </li>
                             <li>
                                <a href="form-advance.html"><i class="fa fa-code "></i>Advance</a>
                            </li>
                             
                           
                        </ul>
                    </li>
                      <li>
                        <a href="gallery.html"><i class="fa fa-anchor "></i>Gallery</a>
                    </li>
                     <li>
                        <a href="error.html"><i class="fa fa-bug "></i>Error Page</a>
                    </li>
                    <li>
                        <a href="login.html"><i class="fa fa-sign-in "></i>Login Page</a>
                    </li>
                    <li>
                        <a href="#" ><i class="fa fa-sitemap "></i>Multilevel Link <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#"><i class="fa fa-bicycle "></i>Second Level Link</a>
                            </li>
                             <li>
                                <a href="#"><i class="fa fa-flask "></i>Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="<?=U('multi') ?>"><i class="fa fa-plus "></i>Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-comments-o "></i>Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                   
                    <li>
                        <a href="blank.html"><i class="fa fa-square-o "></i>Blank Page</a>
                    </li>
                </ul>

            </div>

        </nav>

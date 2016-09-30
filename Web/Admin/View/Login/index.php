<!DOCTYPE html>
<head>
    <title>Admin Management</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="/Public/admin/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/Public/admin/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <!-- <link href="/Public/admin/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"> -->
    <link href="/Public/admin/assets/css/templatemo_style.css" rel="stylesheet" type="text/css">
</head>
<body class="templatemo-bg-image-1">
    <div class="container">
        <div class="col-md-12">         
            <form class="form-horizontal templatemo-contact-form-1" role="form" action="<?=U('index') ?>" method="post" autocomplete="off">
                <input type="hidden" name="token" value="<?=$token ?>">
                <div class="form-group">
                    <div class="col-md-12">
                        <h1 class="margin-bottom-15">Admin Management</h1>
                    </div>
                </div>              
                <div class="form-group">
                  <div class="col-md-12">                   
                    <label for="name" class="control-label">Name *</label>
                    <div class="templatemo-input-icon-container">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="name" placeholder="" name="user">
                    </div>                                                          
                  </div>              
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <label for="password" class="control-label">Password *</label>
                    <div class="templatemo-input-icon-container">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" class="form-control" id="password" placeholder="" name="password">
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" value="Login" class="btn btn-success pull-right">
                  </div>
                </div>
              </form>
        </div>
    </div>
</body>
</html>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo !empty($data['post_count']) ? $data['post_count'] : 0;?></h3>

                <p><?php echo __('Bài viết');?></p>
            </div>
            <div class="icon">
                <i class="ion ion-document-text"></i>
            </div>
            <a href="<?php echo $BASE_URL;?>/articles" class="small-box-footer"><?php echo __('LABEL_MORE_INFO');?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo !empty($data['notice_count']) ? $data['notice_count'] : 0;?></h3>

                <p><?php echo __('Thông báo');?></p>
            </div>
            <div class="icon">
                <i class="ion ion-flag"></i>
            </div>
            <a href="<?php echo $BASE_URL;?>/notices" class="small-box-footer"><?php echo __('LABEL_MORE_INFO');?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo !empty($data['cate_count']) ? $data['cate_count'] : 0;?></h3>

                <p><?php echo __('Danh mục');?></p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-browsers"></i>
            </div>
            <a href="<?php echo $BASE_URL;?>/cates" class="small-box-footer"><?php echo __('LABEL_MORE_INFO');?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo !empty($data['contact_count']) ? $data['contact_count'] : 0;?></h3>

                <p><?php echo __('Liên hệ');?></p>
            </div>
            <div class="icon">
                <i class="ion-android-people"></i>
            </div>
            <a href="<?php echo $BASE_URL;?>/contacts" class="small-box-footer"><?php echo __('LABEL_MORE_INFO');?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

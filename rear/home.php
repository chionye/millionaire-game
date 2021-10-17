<?php 
//header('Content-Type: application/json');
require_once('../database/connect.php');
require_once('../processor/cache.php');
require_once('../processor/date_diff.php');
$site_dir = '';
$nav = json_decode(get_nav(), true);
$page_data = json_decode(get_pageData($nav[0]['id']), true);
$insights = json_decode(get_insights(1, '', 'article', ''), true);
$insights = (object) $insights;
?>


<!doctype html>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Digital Dreams LTD</title>
<?php require_once('../components/csslinks.php')?>
</head>
<body>
<?php require_once('../components/nav.php')?>
<div class='float-left posRel fullWidth'>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach($page_data['image'] as $k => $image){?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$k?>" class="<?php if($k==0)echo 'active'; ?>"></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php foreach($page_data['image'] as $k => $image){ $image = (object) $image;?>
			<div class="carousel-item <?php if($k==0)echo ' active'; ?>">
                <div class="float-right posAbs" style="padding: 50px; right: 0; margin: 120px 150px 0 0px;width: 600px;z-index: 1;">
                    <h1 class="site_title text_bold_7 text-white text-right animated bounceInUp" style="animation-delay: 0.01s;animation-duration: 1.5s;"><?=$image->title?></h1>
                    <h5 class="text-white text-right animated bounceInUp" style="font-weight:200; animation-delay: 0.11s;animation-duration: 1.5s;"><?=$image->desc?></h5>
                    <?php if(isset($image->anchor)){ ?>
                    	<button href="<?=$image->anchor['href']?>" class="btn btn-lg btn-info float-right animated bounceInUp" style="animation-delay: 0.21s;animation-duration: 1.5s;"><?= $image->anchor['name']?></button>
					<?php }?>
                </div>
                <div class="custom-overlay posAbs float-left fullWidth fullHeight"></div>
                <img class="d-block" src="<?=str_replace('../','',$image->src)?>" alt="First slide">
                <!--<div class="carousel-caption d-none d-md-block">
                    <h5>Digital Dreams Limited, Nigeria</h5>
                </div>-->
            </div>
			<?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <i class="now-ui-icons arrows-1_minimal-left"></i>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="now-ui-icons arrows-1_minimal-right"></i>
        </a>
    </div>
</div>



<div class="fullWidth posRel float-left">
    <div class="brief float-left">
        <div class="posRel col-sm-12 float-left">
            <h2 class="text_bold_7 text-left text-capitalize mt-4 pl-3 pr-3">Thoughts around us</h2>
        </div>
        <?php foreach($insights->list as $k => $insight){
			$insight = (object) $insight;
			if($k < 6){
				$insight = (object) $insight;
				require('../components/card_vertical.php');
			}
		} ?>
    </div>
</div>

<hr class="style-two">

<div class="float-left posRel fullWidth overflow-h" style="min-height: 600px;margin-top: 100px">

    <div class="posRel">

        <div class="col-sm-12 col-md-10 mr-auto ml-auto" style="margin-bottom: 30px">
            <h2 class="text_bold_7 text-left">Overview of Projects Completed</h2>
        </div>

        <div id="projects_slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#projects_slide" data-slide-to="0" class="active"></li>
                <li data-target="#projects_slide" data-slide-to="1" class=""></li>
                <li data-target="#projects_slide" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner" role="listbox" style="box-shadow: unset !important;">
                <div class="carousel-item active">

                    <div class="col-md-10 mr-auto ml-auto">
                        <h5 class="text_bold_2 myGray text-left" style="font-size: 18px;">
                            <a href="../www.linkskool.com" class="text_bold_7 text-black">Link Skool</a>
                            is an online Management platform for managing school financial and academic processes.
                        </h5>
                        <div class="col-md-6 float-left posRel" style="margin-bottom: 50px;">
                            <img src="../asset/images/ipad2-inverted.png" alt="digital dreams" class="posRel float-left" style="width: 100%;">
                        </div>
                        <div class="col-md-6 float-left posRel" style="margin-bottom: 50px;">
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons education_hat icon-success"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Education Management Platform</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons tech_tv icon-info"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Ease of Use</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons business_chart-bar-32 icon-primary"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Higher Productivity</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item">


                    <div class="col-md-10 mr-auto ml-auto">
                        <h5 class="text_bold_2 myGray text-left" style="font-size: 18px;">
                            <a href="../www.linkskool.com" class="text_bold_7 text-black">Link Skool</a>
                            is an online Management platform for managing school financial and academic processes.
                        </h5>
                        <div class="col-md-6 float-left posRel" style="margin-bottom: 50px;">
                            <img src="../asset/images/ipad2-inverted.png" alt="digital dreams" class="posRel float-left" style="width: 100%;">
                        </div>
                        <div class="col-md-6 float-left posRel" style="margin-bottom: 50px;">
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons education_hat icon-success"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Education Management Platform</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons tech_tv icon-info"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Ease of Use</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons business_chart-bar-32 icon-primary"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Higher Productivity</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item">


                    <div class="col-md-10 mr-auto ml-auto">
                        <h5 class="text_bold_2 myGray text-left" style="font-size: 18px;">
                            <a href="../www.linkskool.com" class="text_bold_7 text-black">Link Skool</a>
                            is an online Management platform for managing school financial and academic processes.
                        </h5>
                        <div class="col-md-6 float-left posRel" style="margin-bottom: 50px;">
                            <img src="../asset/images/ipad2-inverted.png" alt="digital dreams" class="posRel float-left" style="width: 100%;">
                        </div>
                        <div class="col-md-6 float-left posRel" style="margin-bottom: 50px;">
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons education_hat icon-success"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Education Management Platform</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons tech_tv icon-info"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Ease of Use</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                            <div class="posRel float-left project">
                                <div class="posRel float-left icon"><i class="now-ui-icons business_chart-bar-32 icon-primary"></i></div>
                                <div class="posRel float-left description">
                                    <h4 class="text-black">Higher Productivity</h4>
                                    <p class="myGray text_bold_2">Integrate the apps your team already uses directly into your workflow.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <a class="carousel-control-prev" href="#projects_slide" role="button" data-slide="prev">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
            </a>
            <a class="carousel-control-next" href="#projects_slide" role="button" data-slide="next">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
            </a>
        </div>




    </div>






</div>



<div class="float-left posRel fullWidth" style="background-image: url('../asset/images/mockup-2443050.jpg');min-height: 480px;background-size: cover; background-repeat: no-repeat;margin-top: 40px;">



    <div class="float-left posRel fullWidth fullHeight" style="background: linear-gradient(60deg, rgba(0,0,0,0.9) 0%, rgba(0, 0, 0, 0.6) 100%);">

        <div class="container" style="padding: 80px;">


            <h2 class="text-center text_bold_7 text-white" style="margin-top: 40px">Subscribe To Our Newsletter!</h2>
            <h5 class="text-center text_bold_2 text-white" style="padding: 0 60px;">By Subscribing to our newsletters you will get our latest ICT related Publications and articles.</h5>

            <div class="col-sm-12 float-left posRel" style="padding: 50px;background-color: white; border-radius:0 0 5px 5px;margin-bottom: 80px;margin-top: 40px;border-top: 4px solid #f96332;">
                <div class="col-md-9 float-left posRel">

                    <label for="email" class="text_bold_7 myGray">*Email</label>
                    <div class="input-group">

                        <input type="email" class="form-control" id="subscribe_email" placeholder="Please enter your email">
                        <span class="input-group-addon">
                        <i class="now-ui-icons ui-1_email-85"></i>
                    </span>
                    </div>

                </div>
                <div class="col-md-3 float-left posRel" style="padding-top: 24px">

                    <button class="btn btn-primary btn-round btn-block">Subscribe! <i class="now-ui-icons ui-1_send"></i></button>

                </div>
            </div>


        </div>

    </div>

</div>


<div class="posRel float-left fullWidth">
    <div class="container">
        <div class="float-left posRel fullWidth connect">
            <div class="row">
                <div class="float-left posRel col-md">
                    <h2 class="text_bold_7">Connect with us</h2>
                </div>
            </div>
            <div class="row">
                <div class="float-left posRel col-md-6 overflow-h">

                    <a href="https://web.facebook.com/digitaldreamsng/" target="_blank" class="noDeco-h">
                        <h4 class="text-capitalize noMTop">Like Us on Facebook</h4>
                    </a>

                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdigitaldreamsng&tabs=timeline&width=500&height=560&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=394632000929584" width="500" height="560" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>

                </div>
                <div class="float-left posRel col-md-6">

                    <a href="https://twitter.com/DigitalDreamsNG" target="_blank" class="noDeco-h">
                        <h4 class="text-capitalize noMTop">Follow Us on Twitter</h4>
                    </a>

                    <a class="twitter-timeline" data-width="500" data-height="590" data-theme="light" href="https://twitter.com/DigitalDreamsNG?ref_src=twsrc%5Etfw">Tweets by DigitalDreamsNG</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('../components/footer.php')?>
	</body>
</html>
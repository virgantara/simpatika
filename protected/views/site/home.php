<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Home';
$this->breadcrumbs=array(
	'Home',
);
?>
<section id="home" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title">Sistem Terintegrasi Penjadwalan Perkuliahan (SIMPATIKA)<br> Universitas Darussalam Gontor</h2>
      <span>Services</span>
      <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p>
    </div>
     <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h3 class="media-heading">Dasar Hukum</h3>
                            <p> <ol>
                                <li>UU No 12 tahun 2012: TENTANG PENDIDIKAN TINGGI</li>
                                <li>Permendikbud No 49 Tahun 2014: STANDAR NASIONAL PENDIDIKAN TINGGI</li>
                                </ol>
                            </p>
                </div><!--/.col-md-6-->
                <div class="col-md-6 col-sm-6">
                   <h3 class="media-heading">SIMPATIKA </h3>
                            <p>SIMPATIKA adalah aplikasi sistem penjadwalan perkuliahan yang terintegrasi dengan seluruh sistem informasi yang ada di di Universitas Darussalam Gontor dan FEEDER DIKTI</p>
                </div><!--/.col-md-6-->
            </div>
  </div>
</section>
 <section id="dates" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title">Tanggal Penting</h2>
      <span>Services</span>
      <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.2s">
          <div class="icon color-1">
            <i class="lni-pencil"></i>
          </div>
          <h4>Pengisian Data Mata Kuliah</h4>
          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.4s">
          <div class="icon color-2">
            <i class="lni-cog"></i>
          </div>
          <h4>Pengisian Jadwal</h4>
          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="item-boxes services-item wow fadeInDown" data-wow-delay="0.6s">
          <div class="icon color-3">
            <i class="lni-stats-up"></i>
          </div>
          <h4>Sinkronisasi Jadwal</h4>
          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
        </div>
      </div>
     
    </div>
  </div>
</section>
<section id="flow">
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-center">Alur SIMPATIKA</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
      <ul class="timeline">
        <li>
          <div class="timeline-image">
            <img class="img-circle img-responsive" src="<?=Yii::app()->baseUrl;?>/images/logonew.jpg" alt="">
          </div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4>Step One</h4>
              <h4 class="subheading">Subtitle</h4>
            </div>
            <div class="timeline-body">
              <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="line"></div>
        </li>
        <li class="timeline-inverted">
          <div class="timeline-image">
          	<img class="img-circle img-responsive" src="<?=Yii::app()->baseUrl;?>/images/logonew.jpg" alt="">
          </div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4>Step Two</h4>
              <h4 class="subheading">Subtitle</h4>
            </div>
            <div class="timeline-body">
              <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="line"></div>
        </li>
        <li>
          <div class="timeline-image">
          	<img class="img-circle img-responsive" src="<?=Yii::app()->baseUrl;?>/images/logonew.jpg" alt="">
          </div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4>Step Three</h4>
              <h4 class="subheading">Subtitle</h4>
            </div>
            <div class="timeline-body">
              <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="line"></div>
        </li>
        <li class="timeline-inverted">
          <div class="timeline-image">
          	<img class="img-circle img-responsive" src="<?=Yii::app()->baseUrl;?>/images/logonew.jpg" alt="">
          </div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4>Step Three</h4>
              <h4 class="subheading">Subtitle</h4>
            </div>
            <div class="timeline-body">
              <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="line"></div>
        </li>
        <li>
          <div class="timeline-image">
          	<img class="img-circle img-responsive" src="<?=Yii::app()->baseUrl;?>/images/logonew.jpg" alt="">
          </div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4>Bonus Step</h4>
              <h4 class="subheading">Subtitle</h4>
            </div>
            <div class="timeline-body">
              <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</section>

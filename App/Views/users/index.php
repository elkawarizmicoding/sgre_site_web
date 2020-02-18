<?php
    $dh = $variables["dashboard"];
?>
<div class="tab-panel">
    <div class="tab-panel-he">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="tab-intreview clR">
                    <div class="intr-left">
                        <i class="icofont-link-alt"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number"><?= $dh["total_links"] ?></span>
                                <!--<span class="pin">K</span>-->
                            </div>
                            <p class="intr-title">Links Created</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  col-md-6 col-sm-12">
                <div class="tab-intreview clB">
                    <div class="intr-left">
                        <i class="icofont-broken"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number"><?= $dh["total_click"] ?></span>
                                <!--<span class="pin">K</span>-->
                            </div>
                            <p class="intr-title">Links Clicked</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4  col-md-12 col-sm-12">
                <div class="tab-intreview clD">
                    <div class="intr-left">
                        <i class="icofont-eye-alt"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number"><?= $dh["image_views"] ?></span>
                                <!--<span class="pin">K</span>-->
                            </div>
                            <p class="intr-title">Image Views</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-panel-bo">
        <div class="tab-center">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="tab-dh-show btnCreateLink">
                        <div class="tab-logo">
                            <i class="icofont-link-alt"></i>
                        </div>
                        <div class="tab-title">
                            <p>Create a Link</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="tab-dh-show btnViewStatistics">
                        <div class="tab-logo">
                            <i class="icofont-dashboard-web"></i>
                        </div>
                        <div class="tab-title">
                            <p>View Statistics</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 text-center">
                    <p class="bottom-text">Need Help? <a href="?p=users/about">Click Here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
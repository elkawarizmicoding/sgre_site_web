<?php
    $dah = $variables["data_dashboard"];
?>
<div class="tab-panel">
    <div class="tab-panel-he">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="tab-intreview clR">
                    <div class="intr-left">
                        <i class="icofont-users-social"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number"><?= $dah["total_users"] ?></span>
                                <!--<span class="pin">K</span>-->
                            </div>
                            <p class="intr-title">Total users</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-lg-4  col-md-6 col-sm-12">
                <div class="tab-intreview clB">
                    <div class="intr-left">
                        <i class="icofont-designfloat"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number">250</span>
                                <span class="pin">K</span>
                            </div>
                            <p class="intr-title">Total design</p>
                        </div>
                    </div>
                </div>
            </div>-->
            <!--<div class="col-lg-3 col-md-6 col-xs-12">
                <div class="tab-intreview clD">
                    <div class="intr-left">
                        <i class="icofont-users-social"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number">150</span>
                                <span class="pin"></span>
                            </div>
                            <p class="intr-title">Total users</p>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="tab-intreview clG">
                    <div class="intr-left">
                        <i class="icofont-link-alt"></i>
                    </div>
                    <div class="intr-right">
                        <div class="intr-right-tab">
                            <div class="load-number">
                                <span class="number"><?= $dah["total_links"] ?></span>
                                <!--<span class="pin">K</span>-->
                            </div>
                            <p class="intr-title">Total links</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-panel-bo">
        <div class="row">
            <h3 class="tab-title-pages">Users by package</h3>
            <div class="col-lg-5 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Package name</th>
                            <th>Users</th>
                        </tr>
                        </thead>
                        <tbody id="loadDataPackage">
                            <?php
                                foreach ($dah["data_package"] as $data_package) {
                                    ?>
                            <tr>
                                    <td class="labels"><?= $data_package->name_package ?></td>
                                    <td class="values"><?= $data_package->total ?></td>
                            </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <h3 class="tab-title-pages" style="padding: 0">Quick Stats</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Action name</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Link Clicked</td>
                            <td><?= $dah["total_click"] ?></td>
                        </tr>
                        <tr>
                            <td>Image Views</td>
                            <td><?= $dah["image_views"] ?></td>
                        </tr>
                        <tr>
                            <td>Domain</td>
                            <td><?= $dah["total_domain"] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 col-xs-12">
                <div class="tab-graph">
                    <div class="graph-header">
                        <div class="graph-icon"><i class="icofont-expand"></i></div>
                        <div class="graph-icon right display"><i class="icofont-bin"></i></div>
                        <div class="graph-icon right minus"><i class="icofont-minus"></i></div>
                    </div>
                    <div class="graph-body">
                        <input type="hidden" id="dataPackage" value="">
                        <div id="myDiv"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        var data_val = [], data_lab = [];
        jQuery.each($("#loadDataPackage").find("td"), function(index, item){
            if($(item).attr("class") == "values")
                data_val.push(parseInt($(item).text()));
            else
                data_lab.push($(item).text());
        });
        var data = [{
            values: data_val,
            labels: data_lab,
            type: 'pie'
        }];
        Plotly.newPlot('myDiv', data, {}, {showSendToCloud:false});
        $(".load-number .number").counterUp({delay:10,time:1000});
    });
</script>
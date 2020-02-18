<div class="tab-panel">
    <div class="wrap-content">
        <h2 class="text-center">Analytics</h2>
        <section class="section-data package">
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th>C. Name</th>
                        <th>Link</th>
                        <th>Click</th>
                        <th>Views</th>
                        <th>See status</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php foreach ($variables["links"] as $links){
                            //$url_link = $links->value_domain."/?".$variables["info_setting"]->img_psize_setting."=".$links->vsize_link;
                            $url_link = $links->value_domain."/?id=".$links->id_link."&n=name";
                        ?>
                        <tr>
                            <td><?= $links->name_link ?></td>
                            <td class="long-text"><?= $url_link ?></td>
                            <td><?= $links->total_click ?></td>
                            <td><?= $links->total_click ?></td>
                            <td>
                                <button class="btn btn-success see-status">See status</button>
                                <input type="hidden" value="<?= $links->id_link ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
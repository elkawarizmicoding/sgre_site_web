<div class="tab-panel">
    <div class="wrap-content">
        <h2 class="text-center">Manage Links</h2>
        <form id="formSearchLinks" class="form-search-users links">
            <input class="form-control" type="text" placeholder="put your search" id="searchAction">
            <div class="search-btn">
                <button class="btn btn-default" type="button" id="searchLinksBtn">Search</button>
            </div>
        </form>
        <section class="section-data package">
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th>C. Name</th>
                        <th>Link</th>
                        <th>Target Url</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Edit/Delete</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php foreach ($variables["links"] as $links){
                            $url_link = $links->value_domain."/?id=".$links->id_link."&n=name";
                        ?>
                        <tr>
                            <td><?= $links->name_link ?></td>
                            <td class="long-text">
                                <p><?= $url_link ?></p>
                                <span><a href="<?= $url_link ?>" target="_blank"><i class="icofont-eye"></i></a></span>
                            </td>
                            <td class="long-text">
                                <p><?= $links->target_link ?></p>
                                <span><a href="<?= $links->target_link ?>" target="_blank"><i class="icofont-eye"></i></a></span>
                            </td>
                            <td class="long-text">
                                <p><?= $links->img_full_link ?></p>
                                <span><a href="<?= $links->img_full_link ?>" target="_blank"><i class="icofont-eye"></i></a></span>
                            </td>
                            <td class="long-text"><?= $links->title_link ?></td>
                            <td class="long-text"><?= $links->description_link ?></td>
                            <td>
                                <button class="btn btn-success edit_link">Edit</button>
                                <input type="hidden" value="<?= $links->id_link ?>">
                                <button class="btn btn-danger delete">Delete</button>
                                <input type="hidden" value="link">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
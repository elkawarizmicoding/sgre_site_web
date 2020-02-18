<div class="tab-panel">
    <div class="wrap-content">
        <h2 class="text-center">Manage Packages</h2>
        <div class="package-btn">
            <button class="btn btn-default" type="button" id="addPackage"><i class="icofont-plus"></i> Add package</button>
        </div>
        <section class="section-data package">
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th>Package name</th>
                        <th>Permissions</th>
                        <th>Rotation rate</th>
                        <th>Link limit</th>
                        <th>user count</th>
                        <th>Edit/Delete</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php
                        //print_r($variables["packages"]);
                        $i = 0;
                        foreach ($variables["packages"]["info"] as $packages){
                            $perm = '';
                            foreach ($variables["packages"]["permissions"][$i] as $permissions){
                                $perm .= $permissions->name_permissions.',';
                            }
                        ?>
                        <tr>
                            <td><?= $packages->name_package ?></td>
                            <td><?= $perm ?></td>
                            <td><?= $packages->link_rotation_package ?></td>
                            <td><?= $packages->link_limit_package ?></td>
                            <td><?= $packages->count_users ?></td>
                            <td>
                                <button class="btn btn-success edit_package">Edit</button>
                                <input type="hidden" value="<?= $packages->id_package ?>">
                                <button class="btn btn-danger delete">Delete</button>
                                <input type="hidden" value="package">
                            </td>
                        </tr>
                    <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
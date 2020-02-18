<div class="tab-panel">
    <div class="wrap-content">
        <h2 class="text-center">Manage Users</h2>
        <form id="formSearchUsers" class="form-search-users">
            <input class="form-control" type="text" placeholder="put your search" id="searchAction">
            <div class="search-btn">
                <button class="btn btn-default" type="button" id="searchUsersBtn">Find</button>
                <button class="btn btn-default" type="button" id="addUsers"><i class="icofont-plus"></i> Add user</button>
            </div>
        </form>
        <section class="section-data users">
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Package</th>
                        <th>Expiration Date</th>
                        <th>Total links</th>
                        <th>Total Click</th>
                        <th>Edit/Delete</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php
                        $i = 0;
                        foreach($variables["users"]["info"] as $users){
                            $exp_date = $users->type_expiration_system == 1 ? $users->expiration_system : "Unlimited";
                        ?>
                    <tr>
                        <td><?= $users->user_system ?></td>
                        <td style="max-width: 180px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?= $users->email_system ?></td>
                        <td><?= $users->name_package ?></td>
                        <td>
                            <p><?= $exp_date ?></p>
                            <span class="up_time">update time</span>
                            <input type="hidden" value="<?= $users->id_system ?>">
                        </td>
                        <td>
                            <p><?= $variables["users"]["count"][$i] ?></p>
                            <span class="see-link">See status</span>
                            <input type="hidden" value="<?= $users->id_system ?>">
                        </td>
                        <td>500</td>
                        <td>
                            <button class="btn btn-success edit_user">Edit</button>
                            <input type="hidden" value="<?= $users->id_system ?>">
                            <button class="btn btn-danger delete">Delete</button>
                            <input type="hidden" value="users">
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
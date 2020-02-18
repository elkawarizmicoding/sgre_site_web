<div class="tab-panel">
    <div class="wrap-content">
        <h2 class="text-center">Manage Your Domains</h2>
        <form class="form-search-users" id="addDomain">
            <div class="form-group">
                <input class="form-control" placeholder="Add New Domain Name" name="value_domain">
                <div class="search-btn">
                    <button id="btnAddDomain" type="button" style="width: 100%">Add Domain</button>
                    <input type="hidden" name="ajax_action" value="users.index.addDomain">
                </div>
            </div>
        </form>
        <?php
            $domains = $variables["domain"];
            if(count($domains)) {
                ?>
                <section class="section-data package">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <th>N.Domain</th>
                                <th>Domain Name</th>
                                <th>Status</th>
                                <th>Verify / Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                            <?php
                                $i = 1;
                                foreach ($domains as $domain) {
                                $active_domain = $domain->active_domain == 1 ? "verified" : "unverified";
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $domain->value_domain ?></td>
                                    <td><?= $active_domain ?></td>
                                    <td>
                                        <?php
                                            if($domain->active_domain == 0) {
                                                ?>
                                                <button class="btn btn-warning download"><i class="icofont-download"></i></button>
                                                <button class="btn btn-info verify">Verify</button>
                                                <?php
                                            }
                                        ?>
                                        <input type="hidden" value="<?= $domain->id_domain ?>">
                                        <button class="btn btn-danger delete">Delete</button>
                                        <input type="hidden" value="domain">
                                        <input id="loadPage" type="hidden" value="users/domains">
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
                <?php
            }
        ?>
    </div>
</div>
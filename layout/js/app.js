$(function(){
    $("#myModal,#mi-modal").modal({
        show: false,
        backdrop: 'static'
    });
    function setSettings(){
        $.post("index.php", {"ajax_action": "admin.index.json_settings"}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                var tr_sttings = '';
                jQuery.each(xData["data"]["domains"], function(index, item){
                    var verify = '';
                    if(item["active_domain"] != 1) {
                        verify = '<button type="button" class="btn btn-warning download"><i class="icofont-download"></i></button>' +
                            '<button type="button" class="btn btn-success verify">Verify</button>';
                    }
                    tr_sttings += '<tr>' +
                        '<td class="text-center">' + item["value_domain"] + '</td>' +
                        '<td class="text-center">' + verify +
                        '<input type="hidden" value="' + item["id_domain"] + '">' +
                        '<button type="button" class="btn btn-danger delete">Delete</button>' +
                        '<input type="hidden" value="domainAdmin">' +
                        '<input id="loadPage" type="hidden" value="admin/index">' +
                        '</td>' +
                        '</tr>' +
                        '<tr>';
                });
                var info_settings = xData["data"]["info_settings"],
                    allow_rolation = '<input type="checkbox" id="allowRotation">',
                    url_rolation_val = '<input class="form-control" type="text" name="target_vurl_setting" id="targetUrlValue" value="' + info_settings["target_vurl_setting"] + '" disabled>',
                    url_rolation_par = '<input class="form-control" type="text" name="target_purl_setting" id="targetUrlParameter" value="' + info_settings["target_purl_setting"] + '" disabled>';
                console.log(xData["data"]["info_settings"]);
                if(parseInt(info_settings["target_active_setting"]) == 1){
                    allow_rolation = '<input type="checkbox" id="allowRotation" checked>',
                        url_rolation_par = '<input class="form-control" type="text" name="target_purl_setting" id="targetUrlParameter" value="' + info_settings["target_purl_setting"] + '">';
                    url_rolation_val = '<input class="form-control" type="text" name="target_vurl_setting" id="targetUrlValue" value="' + info_settings["target_vurl_setting"] + '">';
                }
                var logo_html = '<div class="form-group">\n' +
                    '   <label for="upLogo" class="lbUpload">\n' +
                    '       <span>Logo</span>\n' +
                    '       <span class="pin">Choose Logo</span>\n' +
                    '   </label>\n' +
                    '   <input type="file" class="upload" data-action="logo" id="upLogo">\n' +
                    '</div>\n';
                if(xData["logo"]){
                    logo_html = '<div class="form-group">\n' +
                        '   <label for="upLogo" class="lbUpload in">\n' +
                        '       <span>Logo</span>\n' +
                        '       <span class="pin">\n' +
                        '           <span class="text">Change Logo</span>\n' +
                        '           <span class="img">\n' +
                        '               <img src="' + xData["logo"] + '">\n' +
                        '           </span>\n' +
                        '       </span>\n' +
                        '   </label>\n' +
                        '   <input type="file" class="upload" data-action="logo" id="upLogo">\n' +
                        '</div>\n';
                }
                var favicon_html = '<div class="form-group">\n' +
                    '   <label for="upFavicon" class="lbUpload">\n' +
                    '       <span>Favicon</span>\n' +
                    '       <span class="pin">Choose Favicon</span>\n' +
                    '   </label>\n' +
                    '   <input type="file" class="upload" data-action="favicon" id="upFavicon">\n' +
                    '</div>\n';
                if(xData["favicon"]){
                    favicon_html = '<div class="form-group">\n' +
                        '   <label for="upFavicon" class="lbUpload in">\n' +
                        '       <span>Favicon</span>\n' +
                        '       <span class="pin">\n' +
                        '           <span class="text">Change Favicon</span>\n' +
                        '           <span class="img">\n' +
                        '               <img src="' + xData["favicon"] + '">\n' +
                        '           </span>\n' +
                        '       </span>\n' +
                        '   </label>\n' +
                        '   <input type="file" class="upload" data-action="favicon" id="upFavicon">\n' +
                        '</div>\n';
                }
                var form_settings = '<form id="formSettings" method="post">\n' +
                    '\t<div class="row">\n' +
                    '\t\t<div class="col-md-5">\n' +
                    '\t\t\t<h4 class="text-left">Site Display</h4>\n' + logo_html + favicon_html +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="footerText">Footer text</label>\n' +
                    '\t\t\t\t<input class="form-control" type="text" name="footer_setting" id="footerText" value="' + info_settings["footer_setting"] + '">\n' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<h4 class="text-left">Image Link Settings</h4>\n' +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="ssiezParameter">Set size parameter</label>\n' +
                    '\t\t\t\t<input class="form-control" type="text" name="img_psize_setting" id="ssiezParameter" value="' + info_settings["img_psize_setting"] + '">\n' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="snameParameter">Set name parameter</label>\n' +
                    '\t\t\t\t<input class="form-control" type="text" name="img_pname_setting" id="snameParameter" value="' + info_settings["img_pname_setting"] + '">\n' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="urlUpgrade">Url Upgrade</label>\n' +
                    '\t\t\t\t<input class="form-control" type="text" name="url_upgrade_setting" id="urlUpgrade" value="' + info_settings["url_upgrade_setting"] + '">\n' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="urlSignup">Url Sign up</label>\n' +
                    '\t\t\t\t<input class="form-control" type="text" name="url_upgrade_setting" id="urlSignup" value="' + info_settings["url_signup_setting"] + '">\n' +
                    '\t\t\t</div>\n' +
                    '\t\t</div>\n' +
                    '\t\t<div class="col-md-7">\n' +
                    '\t\t\t<h4 class="text-left">Rotation Settings</h4>\n' +
                    '\t\t\t<div class="form-group">\n' + allow_rolation +
                    '\t\t\t\t<input type="hidden" name="target_active_setting" value="' + info_settings["target_active_setting"] + '">' +
                    '\t\t\t\t<label for="allowRotation">Allow Rolation</label>\n' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="targetUrlParameter">Target Url Rotation Parameter</label>\n' + url_rolation_par +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="form-group">\n' +
                    '\t\t\t\t<label for="targetUrlValue">Target Url Rotation Value</label>\n' + url_rolation_val +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="form-group">' +
                    '\t\t\t\t<h4 class="text-center">Default Domains</h4>' +
                    '\t\t\t\t<span class="pin" data-toggle="collapse" data-target="#demo">' +
                    '\t\t\t\t\t<i class="icofont-plus"></i>' +
                    '\t\t\t\t\t<span>Add Domain</span>' +
                    '\t\t\t\t</span>' +
                    '\t\t\t\t<div class="form_add_domain collapse" id="demo">' +
                    '\t\t\t\t\t<input type="text" class="form-control" placeholder="Put Domain Name Exmple ( http://domain.com )">' +
                    '\t\t\t\t\t<button type="button" class="btn btnInInput" id="btnAdDomain">Add</button>' +
                    '\t\t\t\t</div>' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="tbl-header">\n' +
                    '\t\t\t\t<table cellpadding="0" cellspacing="0" border="0">\n' +
                    '\t\t\t\t\t<thead>\n' +
                    '\t\t\t\t\t\t<tr>\n' +
                    '\t\t\t\t\t\t\t<th>Domain Name</th>\n' +
                    '\t\t\t\t\t\t\t<th>Verify / Delete</th>\n' +
                    '\t\t\t\t\t\t</tr>\n' +
                    '\t\t\t\t\t</thead>\n' +
                    '\t\t\t\t</table>\n' +
                    '\t\t\t</div>\n' +
                    '\t\t\t<div class="tbl-content">\n' +
                    '\t\t\t\t<table cellpadding="0" cellspacing="0" border="0">\n' +
                    '\t\t\t\t\t<tbody>\n' + tr_sttings + '</table>\n' +
                    '\t\t\t</div>' +
                    '\t\t</div>\n' +
                    '\t</div>\n' +
                    '\t<input type="hidden" name="ajax_action" value="admin.index.update_settings">' +
                    '\t<input type="hidden" name="id_setting" value="' + info_settings["id_setting"] + '">' +
                    '</form>';
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("set-settings");
                $(".modal-title").text("Manage Settings");
                $(".modal-body").html(form_settings);
                $(".modal-footer").html('<button id="updateSettings" type="button" class="btn btn-info">Save</button>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                $(".modal-footer").show();
            }else{
                alert("error in set Settings => \n" + xData);
            }
        });
    }
    function addUsers(){
        $(".modal-dialog").attr("class", "modal-dialog");
        $(".modal-dialog").addClass("set-add-users");
        $(".modal-title").text("Add User");
        $.post("index.php", {"ajax_action": "admin.users.load_package"}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                var package_option = '<option value="">Select Package</option>';
                jQuery.each(xData["data"], function(index, item){
                    package_option += '<option value="' + item["id_package"] + '">' + item["name_package"] + '</option>';
                });
                $(".modal-body").html('<form id="formAddUsers">' +
                    '<div class="form-group">' +
                    '<label for="fName">Full Name</label>' +
                    '<input class="form-control" type="text" name="fname_system" placeholder="Put your full name" id="fName">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="fEmail">Email</label>' +
                    '<input class="form-control" type="email" name="email_system" placeholder="Put your email" id="fEmail">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="fUser">Username</label>' +
                    '<input class="form-control" type="text" name="user_system" placeholder="Put your username" id="fUser">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="fPass">Password</label>' +
                    '<input class="form-control" type="password" name="pass_system" placeholder="Put your password" id="fPass">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="fSPackage">Choose Package</label>' +
                    '<select class="form-control" name="id_package_system" id="fSPackage">' + package_option +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Expiration Date</label>' +
                    '<div class="users-input-radio">' +
                    '<input data-radio="close" class="set-user-radio" type="radio" name="type_expiration_system" value="unlimited" checked> Unlimited' +
                    '<input data-radio="open" class="set-user-radio" type="radio" name="type_expiration_system" value="1"> Ends at' +
                    '<input id="expirationSystem" class="form-control" type="date" name="expiration_system" disabled>' +
                    '</div>' +
                    '<input type="hidden" name="ajax_action" value="login.system.register">' +
                    '</div>' +
                    '</form>');
            }
        });
        $(".modal-footer").html('<button id="setAddUsers" type="button" class="btn btn-info">Submit</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
        $(".modal-footer").show();
        $("#myModal").modal("show");
    }
    function editUsers(id_user) {
        $.post("index.php", {"ajax_action":"admin.users.getUser", "id_user":id_user}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("set-add-users");
                $(".modal-title").text("Edit User");
                $.post("index.php", {"ajax_action": "admin.users.load_package"}, function (data1) {
                    xData1 = JSON.parse(data1);
                    if(xData1["status"]){
                        var package_option = '<option value="">Select Package</option>';
                        jQuery.each(xData1["data"], function(index1, item1){
                            if(xData["data"]["id_package_system"] == item1["id_package"])
                                package_option += '<option value="' + item1["id_package"] + '" selected>' + item1["name_package"] + '</option>';
                            else
                                package_option += '<option value="' + item1["id_package"] + '">' + item1["name_package"] + '</option>';
                        });
                        var inpRadio = "";
                        if(xData["data"]["type_expiration_system"] == 1){
                            inpRadio += '<input data-radio="close" class="set-user-radio" type="radio" name="type_expiration_system" value="unlimited"> Unlimited' +
                                '<input data-radio="open" class="set-user-radio" type="radio" name="type_expiration_system" value="1" checked> Ends at' +
                                '<input id="expirationSystem" class="form-control" type="date" name="expiration_system" value="'+xData["data"]["expiration_system"]+'">';
                        }else{
                            inpRadio += '<input data-radio="close" class="set-user-radio" type="radio" name="type_expiration_system" value="unlimited" checked> Unlimited' +
                                '<input data-radio="open" class="set-user-radio" type="radio" name="type_expiration_system" value="1"> Ends at' +
                                '<input id="expirationSystem" class="form-control" type="date" name="expiration_system" disabled>';
                        }
                        $(".modal-body").html('<form id="formEditUsers">' +
                            '<div class="form-group">' +
                            '<label for="fName">Full Name</label>' +
                            '<input class="form-control" type="text" name="fname_system" placeholder="Put your full name" id="fName" value="'+xData["data"]["fname_system"]+'">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="fEmail">Email</label>' +
                            '<input class="form-control" type="email" name="email_system" placeholder="Put your email" id="fEmail" value="'+xData["data"]["email_system"]+'">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="fUser">Username</label>' +
                            '<input class="form-control" type="text" name="user_system" placeholder="Put your username" id="fUser" value="'+xData["data"]["user_system"]+'">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="fPass">Password</label>' +
                            '<input class="form-control" type="password" name="pass_system" placeholder="Put your password" id="fPass">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="fSPackage">Choose Package</label>' +
                            '<select class="form-control" name="id_package_system" id="fSPackage">' + package_option +
                            '</select>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label>Expiration Date</label>' +
                            '<div class="users-input-radio">' + inpRadio +
                            '</div>' +
                            '<input type="hidden" name="ajax_action" value="login.system.editUsers">' +
                            '<input type="hidden" value="'+id_user+'" name="id_system">' +
                            '</div>' +
                            '</form>');
                    }
                });
                $(".modal-footer").html('<button id="setEditUsers" type="button" class="btn btn-info">Update</button>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                $(".modal-footer").show();
                $("#myModal").modal("show");
            }
        });
    }
    function addPackage(){
        $.post("index.php", {"ajax_action":"admin.packages.load_permissions"}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]) {
                var permission = '<div class="checkbox-pin">\n';
                var i = 0;
                jQuery.each(xData["data"], function (index, item) {
                    if (i < 2) {
                        permission += '        <div class="checkbox-input">\n' +
                            '            <input class="set-checkbox" type="checkbox" name="packages[]"> \n' +
                            '            <input type="hidden" name="active_package[]" value="0">' +
                            '            <input type="hidden" name="id_set_package[]" value="' + item["id_permissions"] + '">' +
                            '            <span>' + item["name_permissions"] + '</span>\n' +
                            '        </div>\n';
                    } else {
                        i = 0;
                        permission += '</div>\n' +
                            '<div class="checkbox-pin">\n' +
                            '<div class="checkbox-input">\n' +
                            '            <input class="set-checkbox" type="checkbox" name="packages[]"> \n' +
                            '            <input type="hidden" name="active_package[]" value="0">' +
                            '            <input type="hidden" name="id_set_package[]" value="' + item["id_permissions"] + '">' +
                            '            <span>' + item["name_permissions"] + '</span>\n' +
                            '        </div>\n';
                    }
                    i++;
                });
                permission += '</div>';
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("set-add-pakaage");
                $(".modal-title").text("Add Package");
                $(".modal-body").html('<form id="formAddPackage" enctype="multipart/form-data">' +
                    '<div class="form-group">' +
                    '<label for="NPackage">Package name</label>' +
                    '<input class="form-control" type="text" name="name_package" placeholder="Package name" id="NPackage">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="linkLimit">Link limit</label>' +
                    '<input class="form-control" type="number" name="link_limit_package" placeholder="Link limit" id="linkLimit">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="linkRotation">Link rotation rate</label>' +
                    '<input class="form-control" type="number" name="link_rotation_package" placeholder="Link rotation rate" id="linkRotation">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Expiration Date</label>' +
                    '<div class="users-input-checkbox">\n' + permission +
                    '</div>' +
                    '</div>' +
                    '<input type="hidden" name="ajax_action" value="admin.packages.add_package">' +
                    '</form>');
                $(".modal-footer").html('<button id="setAddPackage" type="button" class="btn btn-info">Submit</button>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                $(".modal-footer").show();
                $("#myModal").modal("show");
            }
        });
    }
    function editPackage(id_package) {
        $.post("index.php", {"ajax_action":"admin.packages.getPackage", "id_package": id_package}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                $.post("index.php", {"ajax_action":"admin.packages.load_permissions"}, function (data1) {
                    xData1 = JSON.parse(data1);
                    if (xData1["status"]){
                        var permission = '<div class="checkbox-pin">\n';
                        var i = 0;
                        jQuery.each(xData1["data"], function (index, item) {
                            console.log(xData["data"]["data_pr"][index]);
                            if (i < 2) {
                                var checked = '';
                                if(xData["data"]["data_pr"][index] == 1) checked = 'checked';
                                permission += '<div class="checkbox-input">\n' +
                                    '            <input class="set-checkbox" type="checkbox" name="packages[]" '+checked+'> \n' +
                                    '            <input type="hidden" name="active_package[]" value="'+xData["data"]["data_pr"][index]+'">' +
                                    '            <input type="hidden" name="id_set_package[]" value="' + item["id_permissions"] + '">' +
                                    '            <span>' + item["name_permissions"] + '</span>\n' +
                                    '        </div>\n';
                            } else {
                                i = 0;
                                var checked = '';
                                if(xData["data"]["data_pr"][index] == 1) checked = 'checked';
                                permission += '</div>\n' +
                                    '<div class="checkbox-pin">\n' +
                                    '   <div class="checkbox-input">\n' +
                                    '            <input class="set-checkbox" type="checkbox" name="packages[]" '+checked+'> \n' +
                                    '            <input type="hidden" name="active_package[]" value="'+xData["data"]["data_pr"][index]+'">' +
                                    '            <input type="hidden" name="id_set_package[]" value="' + item["id_permissions"] + '">' +
                                    '            <span>' + item["name_permissions"] + '</span>\n' +
                                    '        </div>\n';
                            }
                            i++;
                        });
                        permission += '</div>';
                        $(".modal-dialog").attr("class", "modal-dialog");
                        $(".modal-dialog").addClass("set-add-pakaage");
                        $(".modal-title").text("Edit Package");
                        $(".modal-body").html('<form id="formEditPackage" enctype="multipart/form-data">' +
                            '<div class="form-group">' +
                            '<label for="NPackage">Package name</label>' +
                            '<input class="form-control" type="text" name="name_package" placeholder="Package name" id="NPackage" value="'+xData["data"]["info"]["name_package"]+'">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="linkLimit">Link limit</label>' +
                            '<input class="form-control" type="number" name="link_limit_package" placeholder="Link limit" id="linkLimit" value="'+xData["data"]["info"]["link_limit_package"]+'">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="linkRotation">Link rotation rate</label>' +
                            '<input class="form-control" type="number" name="link_rotation_package" placeholder="Link rotation rate" id="linkRotation" value="'+xData["data"]["info"]["link_rotation_package"]+'">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label>Expiration Date</label>' +
                            '<div class="users-input-checkbox">\n' + permission +
                            '</div>' +
                            '</div>' +
                            '<input type="hidden" name="ajax_action" value="admin.packages.edit_package">' +
                            '<input type="hidden" value="' + id_package + '" name="id_package">' +
                            '</form>');
                        $(".modal-footer").html('<button id="setEditPackage" type="button" class="btn btn-info">Update</button>' +
                            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                        $(".modal-footer").show();
                        $("#myModal").modal("show");
                    }
                });
            }
        });
    }
    function createLink(){
        $.post("index.php", {"ajax_action": "users.index.getDomain"}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]) {
                var option_domain = '<option value="">Choose Domain</option>';
                jQuery.each(xData["data"]['my_domain'], function (index, item) {
                    option_domain += '<option value="' + item["id_domain"] + '">' + item["value_domain"] + '</option>';
                });
                jQuery.each(xData["data"]['you_domain'], function (index, item) {
                    option_domain += '<option value="' + item["id_domain"] + '">' + item["value_domain"] + '</option>';
                });
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("create-link");
                $(".modal-title").text("Create Link");
                $(".modal-body").html('<form id="createLink">\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="campain">Campain:</label>\n' +
                    '                        <input type="text" class="form-control" id="campain" name="name_link">\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="imageLink">Image Link:</label>\n' +
                    '                        <input type="text" class="form-control" id="imageLink" name="img_full_link">\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="imageSize">Image size:</label>\n' +
                    '                        <input type="number" class="form-control" id="imageSize" name="vsize_link">\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="title">Title:</label>\n' +
                    '                        <input type="text" class="form-control" id="title" name="title_link">\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="description">Description:</label>\n' +
                    '                        <textarea type="text" class="form-control" id="description" name="description_link"></textarea>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="chooseDomain">Choose Domain:</label>\n' +
                    '                        <select class="form-control" id="chooseDomain" name="domain_id">\n' + option_domain +
                    '                        </select>\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group">\n' +
                    '                        <label for="targetUrl">Target Url:</label>\n' +
                    '                        <input type="text" class="form-control" id="targetUrl" name="target_link">\n' +
                    '                    </div>\n' +
                    '                    <div class="form-group form-note">\n' +
                    '                        <p>Note : You can add "{{NAME}}" to further personnalize the target url.</p>\n' +
                    '                    </div>\n' +
                    '                    <input type="hidden" name="ajax_action" value="users.index.createLink">' +
                    '                </form>');
                $(".modal-footer").html('<button id="setCreateLink" type="button" class="btn btn-info">Create Link</button>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                $(".modal-footer").show();
                $('#myModal').modal('show');
            }
        });
    }
    function editLink(id_link) {
        $.post("index.php", {"ajax_action": "users.links.get_data_link", "id_link": id_link}, function (data) {
            console.log(data);
            xData = JSON.parse(data);
            if(xData["status"]){
                $.post("index.php", {"ajax_action": "users.index.getDomain"}, function (data1) {
                    xData1 = JSON.parse(data1);
                    if (xData1["status"]) {
                        var option_domain = '<option value="">Choose Domain</option>';
                        jQuery.each(xData1["data"]['my_domain'], function (index1, item1) {
                            if(xData["data"]["domain_id"] == item1["id_domain"])
                                option_domain += '<option value="' + item1["id_domain"] + '" selected>' + item1["value_domain"] + '</option>';
                            else
                                option_domain += '<option value="' + item1["id_domain"] + '">' + item1["value_domain"] + '</option>';
                        });
                        jQuery.each(xData1["data"]['you_domain'], function (index1, item1) {
                            if(xData["data"]["domain_id"] == item1["id_domain"])
                                option_domain += '<option value="' + item1["id_domain"] + '" selected>' + item1["value_domain"] + '</option>';
                            else
                                option_domain += '<option value="' + item1["id_domain"] + '">' + item1["value_domain"] + '</option>';
                        });
                        $(".modal-dialog").attr("class", "modal-dialog");
                        $(".modal-dialog").addClass("create-link");
                        $(".modal-title").text("Edit Link");
                        $(".modal-body").html('<form id="fromEditLink">\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="campain">Campain:</label>\n' +
                            '                        <input type="text" class="form-control" id="campain" name="name_link" value="' + xData["data"]["name_link"] + '">\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="imageLink">Image Link:</label>\n' +
                            '                        <input type="text" class="form-control" id="imageLink" name="img_full_link" value="' + xData["data"]["img_full_link"] + '">\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="imageSize">Image size:</label>\n' +
                            '                        <select class="form-control" id="imageSize" name="vsize_link">\n' +
                            '                            <option>500</option>\n' +
                            '                            <option>1000</option>\n' +
                            '                        </select>\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="title">Title:</label>\n' +
                            '                        <input type="text" class="form-control" id="title" name="title_link" value="' + xData["data"]["title_link"] + '">\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="description">Description:</label>\n' +
                            '                        <textarea type="text" class="form-control" id="description" name="description_link">' + xData["data"]["description_link"] + '</textarea>\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="chooseDomain">Choose Domain:</label>\n' +
                            '                        <select class="form-control" id="chooseDomain" name="domain_id">\n' + option_domain +
                            '                        </select>\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group">\n' +
                            '                        <label for="targetUrl">Target Url:</label>\n' +
                            '                        <input type="text" class="form-control" id="targetUrl" name="target_link" value="' + xData["data"]["target_link"] + '">\n' +
                            '                    </div>\n' +
                            '                    <div class="form-group form-note">\n' +
                            '                        <p>Note : You can add "{{NAME}}" to further personnalize the target url.</p>\n' +
                            '                    </div>\n' +
                            '                    <input type="hidden" name="ajax_action" value="users.links.editLink">' +
                            '                    <input type="hidden" name="id_link" value="' + id_link + '">' +
                            '                </form>');
                        $(".modal-footer").html('<button id="setEditLink" type="button" class="btn btn-info">Edit Link</button>' +
                            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                        $(".modal-footer").show();
                        $('#myModal').modal('show');
                    }
                });
            }else{

            }
        });
    }
    function setProfile(){
        $.post("index.php", {"ajax_action": "login.index.getInfo"}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                var ispackage = '';
                if(xData["data"]["info"]["type_system"] == "users"){
                    var valPackage = xData["data"]["info"]["name_package"].charAt(0).toUpperCase() + xData["data"]["info"]["name_package"].slice(1);
                    ispackage = '<div class="form-group">' +
                        '   <div class="text-line">' +
                        '       <span class="text">Package: <span>' + valPackage + '</span></span>' +
                        '       <a class="upgrade" href="'+ xData["data"]["info"]["url_upgrade"] +'" target="_blank">Upgrade</a>' +
                        '   </div>' +
                        '</div>';
                }
                var setActionUp = $("#isAction").val() == "disabled" ? '<button type="button" class="btn btn-danger" disabled="disabled">Delete</button>' : '<button type="button" class="btn btn-danger" id="delImgProfile">Delete</button>';
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("edit-profile");
                $(".modal-title").text("Edit Profile");
                $(".modal-body").html('<form class="edit-profile" id="editProfile">\n' +
                    '<div class="form-group">' +
                    '<label for="fName">Full Name</label>' +
                    '<input type="text" class="form-control" id="fName" name="fname_system" placeholder="Put Full Name" value="' + xData["data"]["info"]["fname_system"] + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="fEmail">Email</label>' +
                    '<input type="email" class="form-control" id="fEmail" name="email_system" placeholder="Put Email" value="' + xData["data"]["info"]["email_system"] + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="upload" for="profileImage">' +
                    '   <span class="text">Profile Image</span>' +
                    '   <span class="pin text-center">Upload Image</span>' +
                    '</label>' + setActionUp +
                    '<input class="file-hidden" type="file" class="upload" data-action="profile">' +
                    '</div>' + ispackage +
                    '<h3>Reset Password</h3>' +
                    '<div class="form-group">' +
                    '<label for="oPass">Old Password</label>' +
                    '<input type="password" class="form-control" id="oPass" name="old_pass" placeholder="Put Old Password">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="nPass">New Password</label>' +
                    '<input type="password" class="form-control" id="nPass" name="pass_system" placeholder="Put New Password">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="rPass">Retype New Password</label>' +
                    '<input type="password" class="form-control" id="rPass" name="retype_pass" placeholder="Retype New Password">' +
                    '<input type="hidden" name="ajax_action" value="users.index.editProfile">' +
                    '</div>' +
                    '</form>');
                $(".modal-footer").html('<button id="setEditProfile" type="button" class="btn btn-success">Save</button>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                $(".modal-footer").show();
                $('#myModal').modal('show');
            }
        });
    }
    function up_time(id_user){
        $.post("index.php", {"ajax_action": "admin.users.get_time_user", "id_user": id_user}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]) {
                var exp_time = xData["data"]["type_expiration_system"] == 1 ? xData["data"]["expiration_system"] : "Unlimited";
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("upTime-profile");
                $(".modal-title").text("User expiration date");
                $(".modal-body").html('<form id="valid_time">' +
                    '<div class="form-group">' +
                    '<h3>Username: <span>' + xData["data"]["user_system"] + '</span></h3>' +
                    '<h3>Expiration date: <span>' + exp_time + '</span></h3>' +
                    '</div>' +
                    '<h2 class="text-center">Change Time</h2>' +
                    '<div class="users-input-radio">' +
                    '<input data-radio="close" class="set-user-radio" type="radio" name="type_expiration_system" value="0" checked=""> Unlimited' +
                    '<input data-radio="open" class="set-user-radio" type="radio" name="type_expiration_system" value="1"> Ends at' +
                    '<input id="expirationSystem" class="form-control" type="date" name="expiration_system" disabled=""></div>' +
                    '<input type="hidden" name="id_user" value="' + id_user + '">' +
                    '<input type="hidden" name="ajax_action" value="admin.users.validate">' +
                    '</form>');
                $(".modal-footer").html('<button id="setValidTime" type="button" class="btn btn-success">Validate</button>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                $(".modal-footer").show();
                $('#myModal').modal('show');
            }else{
                alert(xData["msg"]);
            }
        });
    }
    function dataGraph(data) {
        //ClicksViews
        /*var val = [],lab = [];
        jQuery.each(data["clicks"], function (index, item){
            val.push(item["click"]);
            lab.push(item["date_analytics"]);
        });
        console.log(lab);
        console.log(val);*/
        var val = [30,40,45,50,49,60,70,91,125],lab = ["2019-09-19", "2019-09-25", "2020-09-30", "2019-10-05", "2019-10-25", "2020-11-15", "2019-12-01", "2019-12-28", "2020-01-12"];

        var options = {
            series: [{
                data: val
            }, {
                data: val
            }],
            chart: {
                height: 350,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: lab
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#ClicksViews"), options);
        chart.render();
    }
    function setShowGraph(title, id = null){
        $(".modal-dialog").attr("class", "modal-dialog");
        $(".modal-dialog").addClass("full-show-graph");
        $(".modal-title").text(title);
        $(".modal-body").html('<iframe id="anaGraph" src="test.php?id='+id+'" style="border: none;" width="100%" height="100%"></iframe>');
        $("#myModal").modal("show");
    }
    function upload(This, action){
        var formData = new FormData(),files = This[0].files[0];
        formData.append('ajax_upload', files);
        formData.append('action_path', action);
        $.ajax({
            url : 'index.php',
            type : 'POST',
            data : formData,
            processData: false,
            contentType: false,
            success : function(data) {
                console.log(data);
            }
        });
    }
    function load_links(id_user){
        $.post("index.php", {"ajax_action": "admin.users.loadLinks", "id_user": id_user}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                var tr_html = '';
                jQuery.each(xData["data"], function (index, item) {
                    var url = item["value_domain"]+"/?n=name&id="+item["id_link"];
                    tr_html += '<tr>\n' +
                        '<td>' + item["name_link"] + '</td>\n' +
                        '<td class="long-text">' + url + '</td>\n' +
                        '<td>' + item["total_click"] + '</td>\n' +
                        '<td>\n' +
                        '   <button class="btn btn-success see-status">See status</button>\n' +
                        '   <input type="hidden" value="' + item["id_link"] + '">\n' +
                        '</td>\n' +
                        '</tr>\n';
                });
                $(".modal-dialog").attr("class", "modal-dialog");
                $(".modal-dialog").addClass("analytics-links");
                $(".modal-title").text("Analytics");
                $(".modal-body").html('<div class="wrap-content">\n' +
                    '        <section class="section-data package">\n' +
                    '            <div class="tbl-header">\n' +
                    '                <table cellpadding="0" cellspacing="0" border="0">\n' +
                    '                    <thead>\n' +
                    '                    <tr>\n' +
                    '                        <th>C. Name</th>\n' +
                    '                        <th>Link</th>\n' +
                    '                        <th>Click</th>\n' +
                    '                        <th>Views</th>\n' +
                    '                        <th>See status</th>\n' +
                    '                    </tr>\n' +
                    '                    </thead>\n' +
                    '                </table>\n' +
                    '            </div>\n' +
                    '            <div class="tbl-content">\n' +
                    '                <table cellpadding="0" cellspacing="0" border="0">\n' +
                    '                    <tbody>\n'+ tr_html +
                    '                    </tbody>\n' +
                    '                </table>\n' +
                    '            </div>\n' +
                    '        </section>\n' +
                    '    </div>');
                //$(".modal-footer").show();
                $("#myModal").modal("show");
            }else{
                alert(xData["msg"]);
            }
        });
    }
    function status_modal(setClass, action = null){
        var title, content;
        switch (setClass) {
            case "msg-success":
                title = '<span class="confirm-title msg-success">Success!</span>';
                content = '<div class="confirm-content">' +
                    '<div class="set-svg"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">\n' +
                    '  <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>\n' +
                    '  <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>\n' +
                    '</svg></div>' +
                    '</div>';

                break;
            case "msg-error":
                title = '<span class="confirm-title msg-error">Error!</span>';
                content = '<div class="confirm-content">' +
                    '<div class="set-svg svg-error"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">\n' +
                    '  <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>\n' +
                    '  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>\n' +
                    '  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>\n' +
                    '</svg></div><span class="error">' + action + '</span>'+
                    '</div>';
                action = null;
                break;
            default:
                setClass = false;
        }
        if(setClass) {
            $.confirm({
                animation: 'zoom',
                title: title,
                content: content,
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-blue',
                        action: function () {
                            if (action != null) window.location.href = action;
                        }
                    }
                }
            });
        }
    }
    $("#formLogin").on("submit", function (e) {
        e.preventDefault();
        var This = $(this);
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    if($("#loadMessage").hasClass("msg-error")) $("#loadMessage").removeClass("msg-error");
                    $("#loadMessage").addClass("msg-success");
                    $("#loadMessage .form-control").html('<span class="pin">\n' +
                        '                                <i class="icofont-verification-check"></i>\n' +
                        '                            </span>\n' +
                        '                            <span class="text">'+xData["subject"]+'</span>');
                    var wait = setInterval(function () {
                        window.location.href = "?p=index";
                    }, 3000);
                }else{
                    if($("#loadMessage").hasClass("msg-success")) $("#loadMessage").removeClass("msg-success");
                    $("#loadMessage").addClass("msg-error");
                    $("#loadMessage .form-control").html('<span class="pin">\n' +
                        '                                <i class="icofont-error"></i>\n' +
                        '                            </span>\n' +
                        '                            <span class="text">'+xData["subject"]+'</span>');
                    var wait = setInterval(function () {
                        $("#loadMessage").removeClass("msg-error");
                    }, 3000);
                }
            }
        });
    });
    $("#btnLogin").on("click", function () {
        $("#formLogin").submit();
    });
    $("#formLogin").on("keydown", function(e){
        var key = e.which;
        if (key == 13){
            $(this).submit();
            return false;
        }
    });
    $("#formRest").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data){
                xData = JSON.parse(data);
                if(xData["status"]){
                    window.location.href = "?p=index";
                }else{
                    alert(xData["msg"]);
                }
            }
        });
    });
    $("#btnRest").on("click", function () {
        $("#formRest").submit();
    });
    $("#formRest").on("keydown", function (e) {
        var key = e.which;
        if (key == 13){
            $(this).submit();
            return false;
        }
    });
    $(".tab-nav .switch input").change(function(){
        if($(this).is(":checked")){
            $(".tab-aside").removeClass("on");
            $(".tab-panel").removeClass("on");
            return;
        }
        $(".tab-aside").addClass("on");
        $(".tab-panel").addClass("on");
    });
    $(".tab-nav-cn .menu").on("click", function(){
        if($(this).hasClass("on")){
            $(this).removeClass("on");
            $(".tab-nav-rg").removeClass("on");
            return;
        }
        $(this).addClass("on");
        $(".tab-nav-rg").addClass("on");
    });
    $(".minus").on("click", function () {
        if($(this).hasClass("on")){
            $(this).removeClass("on");
            $(this).parent().removeClass("on");
            $(this).parent().next().removeClass("on");
            return;
        }
        $(this).addClass("on");
        $(this).parent().addClass("on");
        $(this).parent().next().addClass("on");
    });
    $(document).on("keydown", "#myFormPayment", function(e){
        var key = e.which;
        if (key == 13){
            $(this).submit();
            return false;
        }
    });
    $(document).on("submit", "#myFormPayment", function (e) {
        e.preventDefault();
        $('button[type="button"]').prop('disabled', false);
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
            }
        });
    });
    $(".tab-aside .item").on("click", function () {
        if($(this).attr("data-url") == "modal"){
            var isModal = false;
            switch ($(this).attr("data-modal")) {
                case "settings":
                    isModal = true;
                    setSettings();
                    break;
                default:
                    isModal = false;
            }
            if(isModal) $("#myModal").modal("show");
        }else {
            window.location.href = $(this).attr("data-url");
        }
    });
    $(document).on("change", "#allowRotation", function() {
        if ($(this).is(':checked')){
            $("#targetUrlParameter").prop('disabled', false);
            $("#targetUrlValue").prop('disabled', false);
            $(this).next().val(1);
            return;
        }
        $(this).next().val(0);
        $("#targetUrlParameter").prop('disabled', true);
        $("#targetUrlValue").prop('disabled', true);
    });
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();
    $(document).on("submit", "#formSettings", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=index");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#updateSettings", function () {
        $("#formSettings").submit();
    });
    $("#addUsers").on("click", function () {
        addUsers();
    });
    $("#formSearchUsers").on("submit", function (e) {
        e.preventDefault();
        window.location.href = "?p=admin/users&search="+$("#searchAction").val();
    });
    $("#searchUsersBtn").on("click", function () {
        $("#formSearchUsers").submit();
    });
    $("#formSearchLinks").on("submit", function (e) {
        e.preventDefault();
        window.location.href = "?p=users/links&search="+$("#searchAction").val();
    });
    $("#searchLinksBtn").on("click", function () {
        $("#formSearchLinks").submit();
    });
    $(document).on("submit", "#formAddUsers", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=admin/users");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#setAddUsers", function () {
        $("#formAddUsers").submit();
    });
    $(document).on("submit", "#formEditUsers", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=admin/users");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#setEditUsers", function () {
        $("#formEditUsers").submit();
    });
    $(document).on("change", ".set-user-radio", function () {
        if($(this).attr("data-radio") == "open"){
            $("#expirationSystem").prop("disabled", false);
            return;
        }
        $("#expirationSystem").prop("disabled", true);
    });
    $("#addPackage").on("click", function () {
        addPackage();
    });
    $(document).on("click", "#setAddPackage", function () {
        $("#formAddPackage").submit();
    });
    $(document).on("submit", "#formAddPackage", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=admin/packages");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#setEditPackage", function () {
        $("#formEditPackage").submit();
    });
    $(document).on("submit", "#formEditPackage", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=admin/packages");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("change", ".checkbox-input input.set-checkbox", function () {
        if($(this).prop("checked")){
            $(this).next().val("1");
            return;
        }
        $(this).next().val("0");
    });
    $(".btnCreateLink").on("click", function () {
        createLink();
    });
    $(".btnViewStatistics").on("click", function () {
        window.location.href = "?p=users/analytics";
    })
    $(document).on("submit", "#createLink", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=users/links");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#setCreateLink", function () {
        $("#createLink").submit();
    });
    $(document).on("submit", "#fromEditLink", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=users/links");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#setEditLink", function () {
        $("#fromEditLink").submit();
    });
    $(document).on("click", "#setEditProfile", function () {
        $("#editProfile").submit();
    });
    $(document).on("submit", "#editProfile", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=index");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $("#addDomain").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=users/domains");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $("#btnAddDomain").on("click", function () {
        $("#addDomain").submit();
    });
    $("#logout").on("click", function () {
        window.location.href = "?p=login/logout";
    });
    $("#profile").on("click", function () {
        setProfile();
    });
    $(document).on("click", ".download", function () {
        $.post("index.php", {"ajax_action": "users.domains.download", "id_domain": $(this).next().next().val()}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                window.location = xData["filename"];
            }else{
                status_modal("msg-error", xData["msg"]);
            }
        });
    });
    $(document).on("click", ".verify", function () {
        $.post("index.php", {"ajax_action": "users.domains.verify", "id_domain": $(this).next().val()}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                status_modal("msg-success", "?p="+$("#loadPage").val());
            }else{
                status_modal("msg-error", xData["msg"]);
            }
        });
    });
    $(".edit_link").on("click", function () {
        editLink($(this).next().val());
    });
    $(document).on("click", "#btnAdDomain", function () {
        $.post("index.php", {"ajax_action": "admin.index.add_domain", "value_domain": $(this).prev().val()}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                window.location.href = "?p=admin/index";
            }else{
                alert(xData["msg"]);
            }
        });
    });
    $(".up_time").on("click", function () {
        up_time($(this).next().val());
    });
    $(document).on("submit", "#valid_time", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'index.php',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                xData = JSON.parse(data);
                if(xData["status"]){
                    status_modal("msg-success", "?p=admin/users");
                }else{
                    status_modal("msg-error", xData["msg"]);
                }
            }
        });
    });
    $(document).on("click", "#setValidTime", function () {
        $("#valid_time").submit();
    });
    $(".edit_user").on("click", function () {
        editUsers($(this).next().val());
    });
    $(".edit_package").on("click", function () {
        editPackage($(this).next().val());
    });
    $(document).on("click", ".see-status", function () {
        /*$.post("index.php", {"ajax_action":"users.analytics.getAnalytics", "id_analytics": $(this).next().val()}, function (data) {
            xData = JSON.parse(data);
            if(xData["status"]){
                setShowGraph(xData["title"], xData["data"]);
            }else{
                alert(xData["msg"]);
            }
        });*/
        setShowGraph($(this).parent().parent().find("td:first-child").text(), $(this).next().val());
    });
    $(".see-link").on("click", function () {
        load_links($(this).next().val());
    });
    $(document).on("change", ".upload", function () {
        upload($(this), $(this).attr("data-action"));
    });
    var THIS;
    var modalConfirm = function(callback){
        $(document).on("click", ".delete", function(){
            THIS = $(this);
            $("#mi-modal").modal('show');
            $(".modal-footer").show();
        });
        $("#modal-btn-si").on("click", function(){
            callback(true);
            $("#mi-modal").modal('hide');
        });
        $("#modal-btn-no").on("click", function(){
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };
    modalConfirm(function(confirm){
        if(confirm){
            switch (THIS.next().val()) {
                case "domain":
                    post = {"ajax_action": "users.domains.delete", "id_domain": THIS.prev().val()}
                    break;
                case "link":
                    post = {"ajax_action": "users.links.delete", "id_link": THIS.prev().val()}
                    break;
                case "users":
                    post = {"ajax_action": "admin.users.delete", "id_users": THIS.prev().val()}
                    break;
                case "domainAdmin":
                    post = {"ajax_action": "admin.index.delete_domain", "id_domain": THIS.prev().val()}
                    break;
                default:
                    post = false;
            }
            if(post){
                $.post("index.php", post, function (data) {
                    xData = JSON.parse(data);
                    if (xData["status"]) {
                        window.location.href = xData["page"];
                    } else {
                        alert(xData["msg"]);
                    }
                });
            }else{
                alert("Post empty");
            }
        }
    });
});
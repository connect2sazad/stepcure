<div id="custom-context-menu">
    <div class="item has-submenu">
        <i class="fas fa-plus"></i> New
        <div class="submenu">
            <div class="submenu-item" onclick="createNew('page')"><i class="bx bx-file-blank"></i> Page</div>
            <div class="submenu-item" onclick="createNew('menu')"><i class="bx bx-menu"></i> Menu</div>
            <div class="submenu-item" onclick="createNew('site')"><i class="fas fa-clinic-medical"></i> Treatment Site</div>
            <div class="submenu-item" onclick="createNew('user-group')"><i class="fas fa-users"></i> User Group</div>
            <div class="submenu-item" onclick="createNew('user-designation')"><i class="fas fa-id-badge"></i> User Designation</div>
            <div class="submenu-item" onclick="createNew('user')"><i class="fas fa-user"></i> User</div>
        </div>
    </div>
    <div class="item" onclick="focusSearch()"><i class="fas fa-search"></i> Find</div>
    <div class="item" onclick="location.reload()"><i class="fas fa-sync"></i> Reload</div>
    <div class="item" onclick="history.back()"><i class="fas fa-arrow-left"></i> Back</div>
    <div class="item" onclick="history.forward()"><i class="fas fa-arrow-right"></i> Forward</div>
    <div class="item" onclick="window.location.href='<?= systemVariable('SITE_HOME') ?>admin'"><i class="bx bx-home-circle"></i> Dashboard</div>
    <div class="item" onclick="window.location.href='<?= systemVariable('SITE_HOME') ?>'"><i class="fas fa-globe"></i> Website</div>

    <div class="item" onclick="window.location.href='<?= systemVariable('SITE_HOME') ?>admin/settings'"><i class="fas fa-cog"></i> Settings</div>
    <div class="item" onclick="window.open('<?= systemVariable('SITE_HOME') ?>admin/logs')"><i class="fas fa-box"></i> Logs</div>
    <div class="item dynamic" id="copyTextItem" onclick="copySelectedText()"><i class="fas fa-copy"></i> Copy Text</div>
    <div class="item dynamic" id="cutTextItem" onclick="cutInputText()"><i class="fas fa-cut"></i> Cut</div>
    <div class="item dynamic" id="copyInputTextItem" onclick="copyInputText()"><i class="fas fa-copy"></i> Copy</div>
    <div class="item dynamic" id="pasteTextItem" onclick="pasteIntoInput()"><i class="fas fa-paste"></i> Paste</div>
    <div class="item" id="openImageInNewTabItem" style="display: none;">
        <i class="fas fa-image"></i> Open Image in New Tab
    </div>
    <div class="item" id="copyImageAddressItem" style="display: none;">
        <i class="fas fa-link"></i> Copy Image Address
    </div>

    <div class="item dynamic" id="openInNewTabItem" onclick="openLinkInNewTab()">
        <i class="fas fa-external-link-alt"></i> Open Link in New Tab
    </div>
    <div class="item dynamic" id="openInNewWindowItem" onclick="openLinkInNewWindow()">
        <i class="fas fa-window-restore"></i> Open Link in New Window
    </div>

</div>


<script>
    function createNew(type) {
        switch (type) {
            case 'page':
                window.location.href = '<?= systemVariable("SITE_HOME") ?>admin/pages/?new_page';
                break;
            case 'menu':
                window.location.href = '<?= systemVariable("SITE_HOME") ?>admin/menus/?new_menu';
                break;
            case 'site':
                window.location.href = '<?= systemVariable("SITE_HOME") ?>admin/treatment-sites/?new_treatment_site';
                break;
            case 'user-group':
                window.location.href = '<?= systemVariable("SITE_HOME") ?>admin/user-groups/?new_user_group';
                break;
            case 'user-designation':
                window.location.href = '<?= systemVariable("SITE_HOME") ?>admin/user-designations/?new_user_designation';
                break;
            case 'user':
                window.location.href = '<?= systemVariable("SITE_HOME") ?>admin/users/?new_user';
                break;
        }

        // Close the context menu
        document.getElementById('custom-context-menu').style.display = 'none';
    }
</script>
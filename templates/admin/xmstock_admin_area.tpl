<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons success.png}>';
    IMG_OFF = '<{xoAdminIcons cancel.png}>';
</script>
<div>
    <{$renderbutton}>
</div>
<{if $error_message != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$error_message}>
    </div>
<{/if}>
<div>
    <{$form}>
</div>
<{if $area_count != 0}>
    <table id="xo-xmdoc-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_AREA_LOGO}></th>
            <th class="txtleft width15"><{$smarty.const._MA_XMSTOCK_AREA_NAME}></th>
            <th class="txtleft"><{$smarty.const._MA_XMSTOCK_AREA_DESC}></th>
            <th class="txtleft width15"><{$smarty.const._MA_XMSTOCK_AREA_LOCATION}></th>            
            <th class="txtcenter width5"><{$smarty.const._MA_XMSTOCK_AREA_WEIGHT}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMSTOCK_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=area from=$area}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtcenter"><{$area.logo}></td>
                <td class="txtleft"><{$area.name}></td>
                <td class="txtleft"><{$area.description}></td>
                <td class="txtleft"><{$area.location}></td>
                <td class="txtcenter"><{$area.weight}></td>
                <td class="xo-actions txtcenter">
                    <img id="loading_sml<{$area.id}>" src="../assets/images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
                    alt="<{$smarty.const._AM_SYSTEM_LOADING}>"/><img class="cursorpointer tooltip" id="sml<{$area.id}>"
                    onclick="system_setStatus( { op: 'area_update_status', area_id: <{$area.id}> }, 'sml<{$area.id}>', 'area.php' )"
                    src="<{if $area.status}><{xoAdminIcons success.png}><{else}><{xoAdminIcons cancel.png}><{/if}>"
                    alt="<{if $area.status}><{$smarty.const._MA_XMSTOCK_STATUS_NA}><{else}><{$smarty.const._MA_XMSTOCK_STATUS_A}><{/if}>"
                    title="<{if $area.status}><{$smarty.const._MA_XMSTOCK_STATUS_NA}><{else}><{$smarty.const._MA_XMSTOCK_STATUS_A}><{/if}>"/>
                </td>
                <td class="xo-actions txtcenter">
					<a class="tooltip" href="stock.php?op=list&amp;article_area=<{$area.id}>" title="<{$smarty.const._MA_XMSTOCK_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._MA_XMSTOCK_VIEW}>">
					</a>
                    <a class="tooltip" href="area.php?op=edit&amp;area_id=<{$area.id}>" title="<{$smarty.const._MA_XMSTOCK_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._MA_XMSTOCK_EDIT}>"/>
                    </a>
                    <a class="tooltip" href="area.php?op=del&amp;area_id=<{$area.id}>" title="<{$smarty.const._MA_XMSTOCK_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._MA_XMSTOCK_DEL}>"/>
                    </a>
                </td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu}>
        <div class="floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
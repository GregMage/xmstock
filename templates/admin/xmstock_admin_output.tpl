<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons success.png}>';
    IMG_OFF = '<{xoAdminIcons cancel.png}>';
</script>
<div>
    <{$renderbutton|default:''}>
</div>
<{if $error_message|default:'' != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$error_message}>
    </div>
<{/if}>
<div>
    <{$form|default:''}>
</div>
<{if $output_count|default:0 != 0}>
    <table id="xo-xmdoc-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft width15"><{$smarty.const._MA_XMSTOCK_OUTPUT_NAME}></th>
            <th class="txtleft"><{$smarty.const._MA_XMSTOCK_OUTPUT_DESC}></th>
            <th class="txtleft width15"><{$smarty.const._MA_XMSTOCK_OUTPUT_USERID}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMSTOCK_OUTPUT_WEIGHT}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMSTOCK_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=output from=$output}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$output.name}></td>
                <td class="txtleft"><{$output.description}></td>
                <td class="txtleft"><{$output.receiver}></td>
                <td class="txtcenter"><{$output.weight}></td>
                <td class="xo-actions txtcenter">
                    <img id="loading_sml<{$output.id}>" src="../assets/images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
                    alt="<{$smarty.const._AM_SYSTEM_LOADING}>"/><img class="cursorpointer tooltip" id="sml<{$output.id}>"
                    onclick="system_setStatus( { op: 'output_update_status', output_id: <{$output.id}> }, 'sml<{$output.id}>', 'output.php' )"
                    src="<{if $output.status}><{xoAdminIcons success.png}><{else}><{xoAdminIcons cancel.png}><{/if}>"
                    alt="<{if $output.status}><{$smarty.const._MA_XMSTOCK_STATUS_NA}><{else}><{$smarty.const._MA_XMSTOCK_STATUS_A}><{/if}>"
                    title="<{if $output.status}><{$smarty.const._MA_XMSTOCK_STATUS_NA}><{else}><{$smarty.const._MA_XMSTOCK_STATUS_A}><{/if}>"/>
                </td>
                <td class="xo-actions txtcenter">
                    <a class="tooltip" href="output.php?op=edit&amp;output_id=<{$output.id}>" title="<{$smarty.const._MA_XMSTOCK_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._MA_XMSTOCK_EDIT}>"/></a>
                    <a class="tooltip" href="output.php?op=del&amp;output_id=<{$output.id}>" title="<{$smarty.const._MA_XMSTOCK_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._MA_XMSTOCK_DEL}>"/></a>
                </td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu|default:false}>
        <div class="floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
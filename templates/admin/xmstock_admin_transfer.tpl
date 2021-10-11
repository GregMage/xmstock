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
<{if $transfer_count|default:0 != 0}>
    <table id="xo-xmdoc-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft width15"><{$smarty.const._MA_XMSTOCK_TRANSFER_DATE}></th>
            <th class="txtleft width20"><{$smarty.const._MA_XMSTOCK_TRANSFER_ARTICLE}></th>
            <th class="txtleft"><{$smarty.const._MA_XMSTOCK_TRANSFER_REF}></th>
            <th class="txtleft width5"><{$smarty.const._MA_XMSTOCK_TRANSFER_AMOUNT}></th>            
            <th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_TRANSFER_USER}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMSTOCK_TRANSFER_TYPE}></th>
            <th class="txtcenter width5"><{$smarty.const._MA_XMSTOCK_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=transfer from=$transfer}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$transfer.date}></td>
                <td class="txtleft"><{$transfer.article}></td>
                <td class="txtleft"><{$transfer.ref}></td>
                <td class="txtcenter"><{$transfer.amount}></td>
                <td class="txtcenter"><{$transfer.user}></td>
                <td class="txtcenter"><{$transfer.type}></td>
                <td class="xo-actions txtcenter">
					<{if $transfer.status == 0}>
						<a class="tooltip" href="transfer.php?op=update_status&amp;transfer_id=<{$transfer.id}>" title="<{$smarty.const._MA_XMSTOCK_STATUS_WAITING}>">
							<img src="<{xoAdminIcons exec.png}>" alt="<{$smarty.const._MA_XMSTOCK_STATUS_WAITING}>"/>
						</a>
					<{else}>
						<img src="<{xoAdminIcons success.png}>" alt="<{$smarty.const._MA_XMSTOCK_STATUS_EXECUTED}>"/>
					<{/if}>
                </td>
                <td class="xo-actions txtcenter">
					<{if $transfer.status == 0}>
						<a class="tooltip" href="transfer.php?op=edit&amp;transfer_id=<{$transfer.id}>" title="<{$smarty.const._MA_XMSTOCK_EDIT}>">
							<img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._MA_XMSTOCK_EDIT}>"/>
						</a>
						<a class="tooltip" href="transfer.php?op=del&amp;transfer_id=<{$transfer.id}>" title="<{$smarty.const._MA_XMSTOCK_DEL}>">
							<img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._MA_XMSTOCK_DEL}>"/>
						</a>
					<{else}>	
						<a class="tooltip" href="transfer.php?op=view&amp;transfer_id=<{$transfer.id}>" title="<{$smarty.const._MA_XMSTOCK_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._MA_XMSTOCK_VIEW}>">
						</a>
					<{/if}>
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
<{if $view|default:false}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft width20"><{$smarty.const._MA_XMSTOCK_TITLE}></th>
            <th class="txtleft"><{$smarty.const._MA_XMSTOCK_INFORMATION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$transfer_arr key=title item=information}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$title}></td>
                <td class="txtleft"><{$information}></td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
<{/if}>
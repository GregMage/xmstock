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
<{if $stock_count != 0}>
    <table id="xo-xmdoc-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft width20"><{$smarty.const._MA_XMSTOCK_STOCK_AREA}></th>
            <th class="txtleft"><{$smarty.const._MA_XMSTOCK_STOCK_ARTICLE}></th>
            <th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_STOCK_AMOUNT}></th>            
        </tr>
        </thead>
        <tbody>
        <{foreach item=stock from=$stock}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$stock.area}></td>
                <td class="txtleft"><{$stock.article}></td>
                <td class="txtcenter"><{$stock.amount}></td>
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
<div>
    <{$renderbutton|default:''}>
</div>
<{if $error_message|default:'' != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$error_message}>
    </div>
<{/if}>
<{if $form|default:''}>
    <div>
        <{$form|default:''}>
    </div>
<{/if}>
<{if $filter|default:false}>
	<div align="right">
		<form id="form_stock_tri" name="form_stock_tri" method="get" action="stock.php">
			<{$smarty.const._MA_XMSTOCK_STOCK_AREA}>
			<select name="stock_filter" id="stock_filter" onchange="location='stock.php?start=<{$start}>&article_area='+this.options[this.selectedIndex].value">
				<{$article_area_options}>
			<select>
		</form>
	</div>
<{/if}>
<{if $stock_count|default:0 != 0}>
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
    <{if $nav_menu|default:false}>
        <div class="floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $xmstock_viewstocks == true}>
	<ul class="list-group">
    <{foreach item=stock from=$stock}>
		<li class="list-group-item">
			<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$stock.area_id}>"><{$stock.name}></a></span> (<{$stock.location}>)
			<span class="badge"><{$stock.amount}></span>
		</li>
    <{/foreach}>
	</ul>
	<div class="xm-stock-general-total">
		<span class="xm-stock-general-bold"><{$smarty.const._MA_XMSTOCK_RENDERSTOCKS_TOTAL}> </span>
		<span class="badge"><{$total_amount}></span>
	</div>
	<div class="xm-stock-general-button">
		<div class="btn-group" role="group" aria-label="...">
			<a href="<{$xoops_url}>/modules/xmstock/action.php?op=order&amp;article_id=<{$article_id}>">
				<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></button>
			</a>
		</div>
	</div>
<{/if}>
<!-- .xmstock -->
<{if $xmstock_viewstocks == true}>
	<ul class="list-group">
    <{foreach item=stock from=$stock}>
		<li class="list-group-item">
			<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$stock.area_id}>"><{$stock.name}></a></span> (<{$stock.location}>)
			<span class="badge"><{$stock.amount}></span>
			<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
		</li>
    <{/foreach}>
	</ul>
	<div class="xm-stock-general-total">
		<span class="xm-stock-general-bold"><{$smarty.const._MA_XMSTOCK_RENDERSTOCKS_TOTAL}> </span>
		<span class="badge"><{$total_amount}></span>
	</div>
<{/if}>
<!-- .xmstock -->
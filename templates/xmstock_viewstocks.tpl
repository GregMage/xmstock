<{if $xmstock_viewstocks == true}>
	<ul class="list-group">
    <{foreach item=stock from=$stock}>
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<div>
				<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$stock.area_id}>"><{$stock.name}></a></span> (<{$stock.location}>)
				<{if $stock.order == true}>
					<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
				<{/if}>
			</div>
			<span class="badge badge-info badge-pill"><{$stock.amount}></span>
		</li>
    <{/foreach}>
	</ul>
	<div class="xm-stock-general-total">
		<span class="xm-stock-general-bold"><{$smarty.const._MA_XMSTOCK_RENDERSTOCKS_TOTAL}> </span>
		<span class="badge"><{$total_amount}></span>
	</div>
<{/if}>
<!-- .xmstock -->
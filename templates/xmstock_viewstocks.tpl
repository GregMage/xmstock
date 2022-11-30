<{if $xmstock_viewstocks == true}>
	<script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<ul class="list-group">
    <{foreach item=stock from=$stock}>
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<div>
				<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$stock.area_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_AREA_LOCATION}>: <{$stock.location_s|default:''}>"><{$stock.name}></a></span> (<{$stock.location}>)
				<{if $stock.price|default:'' != ''}>
					<a href="<{$xoops_url}>/modules/xmstock/viewprice.php?article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="badge badge-info" target="_blank"><{$stock.price}></a>
				<{/if}>
				<{if $stock.manage|default:false == true}>
					<a href="<{$xoops_url}>/modules/xmstock/action.php?op=editstock&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-secondary btn-sm" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a>
				<{/if}>
				<{if $stock.order|default:false == true}>
					<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
				<{/if}>
			</div>
			<span class="badge badge-info badge-pill"><{$stock.amount}></span>
		</li>
    <{/foreach}>
	</ul>
	<{if $total_amount != 0}>
	<div class="xm-stock-general-total">
		<span class="xm-stock-general-bold"><{$smarty.const._MA_XMSTOCK_RENDERSTOCKS_TOTAL}> </span>
		<span class="badge"><{$total_amount}></span>
	</div>
	<{/if}>
<{/if}>
<!-- .xmstock -->
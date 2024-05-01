<{if $xmstock_viewstocks == true}>
	<{if $transfert == true}>
		<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=E&article_id=<{$article_id}>" class="btn btn-light" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}>"><span class="fa fa-sign-in"></span></a>
	<{else}>
		<script>
			$(function () {
			$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		<ul class="list-group">
		<{foreach item=stock from=$stocks}>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<div>
					<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$stock.area_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_AREA_LOCATION}>: <{$stock.location_s|default:''}>"><{$stock.name}></a></span> (<{$stock.location}>)
					<{if $stock.price|default:'' != ''}>
						<a href="<{$xoops_url}>/modules/xmstock/viewprice.php?article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="badge badge-info" target="_blank"><{$stock.price}></a>
					<{/if}>
					<{if $stock.manage|default:false == true}>
						<a href="<{$xoops_url}>/modules/xmstock/action.php?op=editstock&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>&amp;return=article" class="btn btn-secondary btn-sm" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a>
						<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=E&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}>"><span class="fa fa-sign-in"></span></a>
						<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=O&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_OUTOFSTOCK}>"><span class="fa fa-sign-out"></span></a>
						<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=T&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK}>"><span class="fa fa-external-link"></span></a>
						<a href="<{$xoops_url}>/modules/xmstock/transfer.php?article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_LIST}>"><span class="fa fa-search"></span></a>

						<{if $stock.loan|default:false == true && $stock.amount == 0}>
							<span class="fa fa-exchange" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"></span>
						<{/if}>
						<{if $stock.order|default:false == true && $stock.type != 4}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
						<{/if}>
					<{/if}>
					<{if $stock.loan|default:false == true && $stock.amount != 0}>
						<{if $stock.manage|default:false == true}>
						<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
						<{else}>
						<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
						<{/if}>
					<{/if}>
				</div>
				<{if $stock.type != 4}>
					<span class="badge badge-info badge-pill"><{$stock.amount}></span>
				<{else}>
					<span class="badge badge-success badge-pill"><{$smarty.const._MA_XMSTOCK_STOCK_FREE}></span>
				<{/if}>
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
<{/if}>
<!-- .xmstock -->
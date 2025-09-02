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
			<li class="list-group-item">
				<div class="row">
					<div class="col-8 text-left">
						<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$stock.area_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_AREA_LOCATION}>: <{$stock.location_s|default:''}>"><{$stock.name}></a></span> (<{$stock.location}>)
						<{if $stock.price|default:'' != ''}>
							<a href="<{$xoops_url}>/modules/xmstock/viewprice.php?article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="badge badge-info" target="_blank"><{$stock.price}></a>
						<{/if}>
						<{if $stock.manage|default:false == true}>
							<a href="<{$xoops_url}>/modules/xmstock/action.php?op=editstock&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>&amp;return=article" class="btn btn-secondary btn-sm" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a>
							<{if $stock.type != 4}>
								<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=E&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}>"><span class="fa fa-sign-in"></span></a>
								<{if $stock.amount > 0}>
									<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=O&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_OUTOFSTOCK}>"><span class="fa fa-sign-out"></span></a>
									<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=T&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK}>"><span class="fa fa-external-link"></span></a>
									<a href="<{$xoops_url}>/modules/xmstock/loan.php?op=add&article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_LOAN}>"><span class="fa fa-share "></span></a>
								<{/if}>
								<a href="<{$xoops_url}>/modules/xmstock/transfer.php?article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_LIST}>"><span class="fa fa-search"></span></a>
							<{/if}>
						<{/if}>
						<{if $stock.infoloan|default:false == true}>
							<span class="fa fa-exchange" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"></span>
						<{/if}>
						<{if $stock.order|default:false == true && $stock.type != 3 && $stock.type != 4}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm <{if $stock.permorder|default:0 == 1}>disabled<{/if}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
						<{/if}>
						<{if $stock.loan|default:false == true && $stock.type == 3 && $stock.amount != 0}>
							<{if $stock.manage|default:false == true}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm <{if $stock.permorder|default:0 == 1}>disabled<{/if}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
							<{else}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$article_id}>&amp;area_id=<{$stock.area_id}>" class="btn btn-light btn-sm <{if $stock.permorder|default:0 == 1}>disabled<{/if}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
							<{/if}>
						<{/if}>
					</div>
					<div class="col-2 text-center">
						<{if $stock.manage|default:false == true}>
							<{if $stock.mini|default:0 != 0}>
								<{if $stock.amount == $stock.mini}>
								<span class="badge badge-pill badge-warning" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_STOCK_MINI}>">
								<{/if}>
								<{if $stock.amount < $stock.mini}>
								<span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_STOCK_MINI}>">
								<{/if}>
								<{if $stock.amount > $stock.mini}>
									<span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_STOCK_MINI}>">
								<{/if}>
								<{$stock.mini}> <{if $stock.type == 2}><{$smarty.const._MA_XMSTOCK_CHECKOUT_UNIT}><{/if}><{if $stock.type == 5}><{$smarty.const._MA_XMSTOCK_CHECKOUT_UNITS}><{/if}>
								</span>
							<{/if}>
						<{/if}>
					</div>
					<div class="col-2 text-right">
					<{if $stock.type != 4}>
						<span class="badge badge-info badge-pill"><{$stock.amount}> <{if $stock.type == 2}><{$smarty.const._MA_XMSTOCK_CHECKOUT_UNIT}><{/if}><{if $stock.type == 5}><{$smarty.const._MA_XMSTOCK_CHECKOUT_UNITS}><{/if}></span>
					<{else}>
						<span class="badge badge-success badge-pill"><{$smarty.const._MA_XMSTOCK_STOCK_FREE}></span>
					<{/if}>
					</div>
				</div>
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
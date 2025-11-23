 <div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<li class="breadcrumb-item active" aria-current="page"><{$name}></li>
	  </ol>
	</nav>
	<div class="row mb-2">
		<{if $logo != ''}>
		<div class="col-3 col-md-4 col-lg-3 text-center">
			<img class="rounded img-fluid" src="<{$logo}>" alt="<{$name}>">
		</div>
		<{/if}>
		<div class="col-9 col-md-8 col-lg-9 " style="padding-bottom: 5px; padding-top: 5px;">
			<h4 class="mt-0"><{$name}> (<{$location}>)</h4>
			<{$description}>
		</div>
	</div>
	<div class="mb-2 mt-3">
		<{$form}>
	</div>
	<{if $xmstock_viewarticles|default:false == true}>
		<script>
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2"><{$smarty.const._MA_XMSTOCK_STOCK_ARTICLE}></h1>
			<{if $export == true && $manage == true}>
			<a href="<{xoAppUrl 'modules/xmstats/export.php?op=stock'}>" class="btn btn-sm btn-secondary">
				<{$smarty.const._MA_XMSTOCK_VIEWPRICE_EXPORT}>
			</a>
			<{/if}>
		</div>
		<ul class="list-group">
		<{foreach item=stock from=$stocks}>
			<li class="list-group-item">
				<div class="row">
					<div class="col-8 text-left">
						<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?article_id=<{$stock.article_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_AREA_LOCATION}>: <{$stock.location_s}>"><{$stock.name}></a></span> (<{$stock.reference}>)
						<{if $stock.price != ''}>
							<a href="<{$xoops_url}>/modules/xmstock/viewprice.php?article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="badge badge-info" target="_blank"><{$stock.price}></a>
						<{/if}>
						<{if $manage == true}>
							<a href="<{$xoops_url}>/modules/xmstock/action.php?op=editstock&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-secondary btn-sm" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a>
							<{if $stock.type != 4}>
								<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=E&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}>"><span class="fa fa-sign-in"></span></a>
								<{if $stock.amount > 0}>
									<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=O&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_OUTOFSTOCK}>"><span class="fa fa-sign-out"></span></a>
									<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=T&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK}>"><span class="fa fa-external-link"></span></a>
									<a href="<{$xoops_url}>/modules/xmstock/loan.php?op=add&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_LOAN}>"><span class="fa fa-share "></span></a>
								<{/if}>
								<a href="<{$xoops_url}>/modules/xmstock/transfer.php?article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_LIST}>"><span class="fa fa-search"></span></a>
								<{if $stock.loan|default:false == true && $stock.amount == 0}>
									<span class="fa fa-exchange" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"></span>
								<{/if}>
							<{/if}>
						<{/if}>
						<{if $order == true && $stock.type != 3 && $stock.type != 4}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm <{if $stock.order|default:0 == 1}>disabled<{/if}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
						<{/if}>
						<{if $order == true && $stock.type == 3 && $stock.amount != 0}>
							<{if $manage == true}>
								<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm <{if $stock.order|default:0 == 1}>disabled<{/if}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
							<{else}>
								<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light btn-sm <{if $stock.order|default:0 == 1}>disabled<{/if}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
							<{/if}>
						<{/if}>
						<{if $outflow == true && $stock.amount != 0}>
							<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=O&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>&outflow=true" class="btn btn-light btn-sm" title="<{$smarty.const._MA_XMSTOCK_TRANSFER_OUTFLOW}>"><span class="fa fa-sign-out"></span> <{$smarty.const._MA_XMSTOCK_TRANSFER_OUTFLOW}></a>
						<{/if}>
					</div>
					<div class="col-2 text-center">
					<{if $manage|default:false == true}>
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
		<div class="clear spacer"></div>
		<{if $nav_menu|default:false}>
			<div class="floatright"><{$nav_menu}></div>
			<div class="clear spacer"></div>
		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
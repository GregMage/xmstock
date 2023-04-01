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
		<ul class="list-group">
		<{foreach item=stock from=$stock}>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<div>
					<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?category_id=<{$stock.article_cid}>&article_id=<{$stock.article_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_AREA_LOCATION}>: <{$stock.location_s}>"><{$stock.name}></a></span> (<{$stock.reference}>)
					<{if $stock.price != ''}>
						<a href="<{$xoops_url}>/modules/xmstock/viewprice.php?article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="badge badge-info" target="_blank"><{$stock.price}></a>
					<{/if}>
					<{if $manage == true}>
						<a href="<{$xoops_url}>/modules/xmstock/action.php?op=editstock&article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-secondary btn-sm" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a>
						<a href="<{$xoops_url}>/modules/xmstock/transfer.php?article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light"><span class="fa fa-search"></span> <{$smarty.const._MI_XMSTOCK_SUB_TRANSFER}></a>
						<{if $stock.loan|default:false == true && $stock.amount == 0}>
							<span class="fa fa-exchange" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"></span>
						<{/if}>
					<{/if}>
					<{if $order == true && $stock.type != 3}>
						<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></a>
					<{/if}>
					<{if $order == true && $stock.type == 3 && $stock.amount != 0}>
						<{if $manage == true}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_XMSTOCK_LOAN_USERSLIST}>: <{$stock.borrower|default:''}>"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
						<{else}>
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>&amp;area_id=<{$area_id}>" class="btn btn-light"><span class="fa fa-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_LOAN}></a>
						<{/if}>
					<{/if}>
				</div>
				<span class="badge badge-info badge-pill"><{$stock.amount}></span>
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
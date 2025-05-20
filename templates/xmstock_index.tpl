<div class="xmstock">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="active"><{$index_module}></li>
		</ol>
	</nav>
	<{if ($order == true) || ($manage == true)}>
	<div class="text-center pt-2">
		<div class="btn-group text-center" role="group">
		<{if $order == true}>
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_CADDY}>" class="btn btn-light btn-lg" href="<{$xoops_url}>/modules/xmstock/caddy.php">
				<span class="fa fa-shopping-cart fa-2x"></span><p class="mt-2"><{$smarty.const._MI_XMSTOCK_SUB_CADDY}></p>
			</a>
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_ORDERS}>" class="btn btn-light btn-lg" href="<{$xoops_url}>/modules/xmstock/order.php">
				<span class="fa fa-list-alt fa-2x"></span><p class="mt-2"><{$smarty.const._MI_XMSTOCK_SUB_ORDERS}></p>
			</a>
		<{/if}>
		<{if $manage == true}>
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}>" class="btn btn-light btn-lg" href="<{$xoops_url}>/modules/xmstock/management.php">
				<span class="fa fa-cogs fa-2x"></span><p class="mt-2"><{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}></p>
			</a>
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_TRANSFER}>" class="btn btn-light btn-lg" href="<{$xoops_url}>/modules/xmstock/transfer.php">
				<span class="fa fa-random fa-2x"></span><p class="mt-2"><{$smarty.const._MI_XMSTOCK_SUB_TRANSFER}></p>
			</a>
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_LOAN}>" class="btn btn-light btn-lg" href="<{$xoops_url}>/modules/xmstock/loan.php">
				<span class="fa fa-exchange fa-2x"></span><p class="mt-2"><{$smarty.const._MI_XMSTOCK_SUB_LOAN}></p>
			</a>
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_OVERDRAFT}>" class="btn btn-light btn-lg" href="<{$xoops_url}>/modules/xmstock/overdraft.php">
				<span class="fa fa-battery-quarter fa-2x"></span><p class="mt-2"><{$smarty.const._MI_XMSTOCK_SUB_OVERDRAFT}></p>
			</a>
		<{/if}>
		</div>
	</div>
	<{/if}>

	<{if $area_count != 0}>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2"><{$smarty.const._MA_XMSTOCK_STOCK_AREA}></h1>
			<{if $export == true && $manage == true}>
			<a href="<{xoAppUrl 'modules/xmstats/export.php?op=stock'}>" class="btn btn-sm btn-secondary">
				<{$smarty.const._MA_XMSTOCK_VIEWPRICE_EXPORT}>
			</a>
			<{/if}>
		</div>
		<div class="row justify-content-center">
			<{foreach item=area from=$areas}>
				<div class="col-6 col-sm-4 col-md-3 col-lg-3 p-2">
					<div class="card xmarticle-border" <{if $area.color != false}>style="border-color : <{$area.color}>;"<{/if}>>
						<a class="text-decoration-none" title="<{$area.name}>" href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$area.id}>">
							<div class="card-header text-center" <{if $area.color != false}>style="background-color : <{$area.color}>;"<{/if}>>
								<{$area.name}>
							</div>
						</a>
						<div class="card-body h-md-550 text-center">
							<div class="row" style="height: 150px;">
								<div class="col-12 h-75">
									<{if $area.logo != ''}>
										<a title="<{$area.name}>" href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$area.id}>">
											<img class="rounded img-fluid mh-100" src="<{$area.logo}>" alt="<{$area.name}>">
										</a>
									<{/if}>
									<div class="col-12 p-2">
										<{if $area.description != ""}>
											<button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#xmDesc-<{$area.id}>">+</button>
										<{else}>
											<button class="btn btn-secondary btn-sm" disabled data-toggle="modal">+</button>
										<{/if}>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="xmDesc-<{$area.id}>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title aligncenter"><{$area.name}></h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<{$area.description}>
							</div>
							<div class="modal-footer">
								<a title="<{$area.name}>" href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$area.id}>"
								   class="btn btn-secondary">
									<{$area.totalarticle}>
								</a>
							</div>
						</div>
					</div>
				</div>
			<{/foreach}>
		</div>
		<div class="clear spacer"></div>
		<{if $nav_menu|default:false}>
			<div class="floatright"><{$nav_menu}></div>
			<div class="clear spacer"></div>
		<{/if}>
	<{else}>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<{$smarty.const._MA_XMSTOCK_ERROR_NOAREA}>
		</div>
	<{/if}>
</div><!-- .xmstock -->
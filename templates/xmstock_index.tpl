<div class="xmstock">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="active"><{$index_module}></li>
		</ol>
	</nav>
	<div class="row text-center">
		<div class="col-lg-<{if $manage == true}>3<{else}>6<{/if}>">
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_CADDY}>" href="<{$xoops_url}>/modules/xmstock/caddy.php">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/Caddy.png" alt="<{$smarty.const._MI_XMSTOCK_SUB_CADDY}>">
					<h5><{$smarty.const._MI_XMSTOCK_SUB_CADDY}></h5>
				</div>
			</a>
		</div>
		<div class="col-lg-<{if $manage == true}>3<{else}>6<{/if}>">
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_ORDERS}>" href="<{$xoops_url}>/modules/xmstock/order.php">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/Orders.png" alt="<{$smarty.const._MI_XMSTOCK_SUB_ORDERS}>">
					<h5><{$smarty.const._MI_XMSTOCK_SUB_ORDERS}></h5>
				</div>
			</a>
		</div>
		<{if $manage == true}>
		<div class="col-lg-3">
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}>" href="<{$xoops_url}>/modules/xmstock/management.php">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/Management.png" alt="<{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}>">
					<h5><{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}></h5>
				</div>
			</a>
		</div>
		<div class="col-lg-3">
			<a title="<{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}>" href="<{$xoops_url}>/modules/xmstock/transfer.php">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/Manage.png" alt="<{$smarty.const._MI_XMSTOCK_SUB_ORDERSMANAGEMENT}>">
					<h5><{$smarty.const._MI_XMSTOCK_SUB_TRANSFER}></h5>
				</div>
			</a>
		</div>
		<{/if}>
    </div>
	<{if $area_count != 0}>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2"><{$smarty.const._MA_XMSTOCK_STOCK_AREA}></h1>
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
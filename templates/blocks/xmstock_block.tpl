<div class="row">
	<div class="col">
		<{if $block.order|default:'' != ''}>
		<div class="list-group">
			<{foreach item=blockorder from=$block.order}>
				<{if $block.type == 'myorders'}>
				<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$blockorder.id}>" class="list-group-item list-group-item-action">
				<{else}>
				<a href="<{$xoops_url}>/modules/xmstock/action.php?op=next&&order_id=<{$blockorder.id}>" class="list-group-item list-group-item-action">
				<{/if}>
					<div class="row">
						<div class="col-12 col-sm-4 col-lg-3 text-left">
							<b><{$smarty.const._MA_XMSTOCK_VIEWORDER_ORDER}> <{$blockorder.id}></b>
						</div>
						<div class="col-12 col-sm-4 col-lg-3 text-left">
							<span class="fa fa-calendar fa-fw" aria-hidden="true"></span> <{$blockorder.dorder}>
						</div>
						<div class="col-12 col-sm-4 col-lg-3 text-left">
							<span class="fa fa-folder-o fa-fw" aria-hidden="true"></span><{$blockorder.area_name}>
						</div>
						<div class="col-12 col-sm-12 col-lg-3 text-right">
							<span class="badge badge-secondary fa-lg text-primary">
							<small><{$blockorder.status_icon}> <{$blockorder.status_text}></small>
							</span>
						</div>
					</div>
				</a>
			<{/foreach}>
		</div>
		<{if $block.type == 'myorders'}>
			<a href="<{$xoops_url}>/modules/xmstock/order.php" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
		<{else}>
			<a href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=1" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
		<{/if}>
		<{else}>
			<div class="alert alert-warning" role="alert">
				<{$smarty.const._MB_XMSTOCK_NOORDER}>
			</div>
		<{/if}>
	</div>
</div>
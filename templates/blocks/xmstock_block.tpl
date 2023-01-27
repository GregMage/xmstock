<div class="row">
	<div class="col">
		<{if $block.order|default:'' != ''}>
		<div class="list-group">
			<{foreach item=blockorder from=$block.order}>
			<{if $block.type == 'myorders'}>
			<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$blockorder.id}>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<{else}>
			<a href="<{$xoops_url}>/modules/xmstock/action.php?op=next&&order_id=<{$blockorder.id}>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
			<{/if}>
				<b><{$smarty.const._MA_XMSTOCK_VIEWORDER_ORDER}> <{$blockorder.id}></b>
				<div>
				<span class="fa fa-calendar fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}>
				<{$blockorder.dorder}></div>
				<span class="badge badge-secondary fa-lg text-primary ml-2">
				<small><{$blockorder.status_icon}> <{$blockorder.status_text}></small>
				</span>
			</a>
			<{/foreach}>
		</div>
		<{/if}>
	</div>
</div>
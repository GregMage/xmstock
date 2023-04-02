<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<{if $error_message|default:'' != '' || $op == 'del'}>
			<li class="breadcrumb-item"><a href="order.php"><{$smarty.const._MA_XMSTOCK_ORDERS}></a></li>
		<{else}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ORDERS}></li>
		<{/if}>
	  </ol>
	</nav>
	<{if $error_message|default:'' != ''}>
		<div class="alert alert-danger" role="alert"><{$error_message}></div>
	<{else}>
		<{if $op == 'list'}>
			<h2><{$smarty.const._MA_XMSTOCK_ORDERS}></h2>
			<div class="list-group">
			  <{if $pill_1 != 0}>
				<a href="order.php?status=1" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $status == 1}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_1}><span class="badge badge-primary badge-pill"><{$pill_1}></span></a>
			  <{else}>
				<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_1}></a>
			  <{/if}>
			  <{if $pill_2 != 0}>
				<a href="order.php?status=2" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $status == 2}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_2}><span class="badge badge-primary badge-pill"><{$pill_2}></span></a>
			  <{else}>
				<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_2}></a>
			  <{/if}>
			  <{if $pill_3 != 0}>
			  <a href="order.php?status=3" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $status == 3}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_3}><span class="badge badge-primary badge-pill"><{$pill_3}></span></a>
			  <{else}>
				<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_3}></a>
			  <{/if}>
			  <{if $pill_4 != 0}>
			  <a href="order.php?status=4" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $status == 4}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_4}><span class="badge badge-primary badge-pill"><{$pill_4}></span></a>
			  <{else}>
				<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_4}></a>
			  <{/if}>
			  <{if $pill_0 != 0}>
				<a href="order.php?status=0" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $status == 0}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_0}><span class="badge badge-primary badge-pill"><{$pill_0}></span></a>
			  <{else}>
				<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_TITLE_0}></a>
			  <{/if}>
			</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DESCRIPTION}></th>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></th>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDESIRED}></th>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY}></th>
						<th class="text-center width15" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
					</tr>
				</thead>
				<tbody>
					<{foreach item=order from=$orders}>
					<tr>
						<th class="text-center" scope="row"><{$order.id}></th>
						<td><{$order.description}></td>
						<td class="text-center"><{$order.dorder}></td>
						<td class="text-center"><{$order.ddesired}></td>
						<td class="text-center">
							<{if $order.delivery == 1}>
							<span class="fa fa-truck"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY_DELIVERY}>
							<{/if}>
							<{if $order.delivery == 0}>
							<span class="fa fa-industry"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY_WITHDRAWAL}>
							<{/if}>
						</td>
						<td class="text-center">
							<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
							<{if $order.status == 1}><a href="<{$xoops_url}>/modules/xmstock/order.php?op=del&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_DEL}>"><span class="fa fa-trash"></span></a><{/if}>
						</td>
					</tr>
					<{/foreach}>
				</tbody>
			</table>
			<div class="clear spacer"></div>
			<{if $nav_menu|default:false}>
				<div class="floatright"><{$nav_menu}></div>
				<div class="clear spacer"></div>
			<{/if}>

		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
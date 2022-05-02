<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ORDERS}></li>
	  </ol>
	</nav>

	<h2><{$smarty.const._MA_XMSTOCK_ORDERS}></h2>
	<div class="list-group">
	  <{if $pill_A != 0}>
		<a href="order.php?op=1" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $op == 1}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_A}><span class="badge badge-primary badge-pill"><{$pill_A}></span></a>
	  <{else}>
		<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_A}></a>
	  <{/if}>
	  <{if $pill_B != 0}>
		<a href="order.php?op=2" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $op == 2}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_B}><span class="badge badge-primary badge-pill"><{$pill_B}></span></a>
	  <{else}>
		<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_B}></a>
	  <{/if}>
	  <{if $pill_C != 0}>
	  <a href="order.php?op=3" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $op == 3}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_C}><span class="badge badge-primary badge-pill"><{$pill_C}></span></a>
	  <{else}>
		<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_C}></a>
	  <{/if}>
	  <{if $pill_D != 0}>
	  <a href="order.php?op=4" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $op == 4}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_D}><span class="badge badge-primary badge-pill"><{$pill_D}></span></a>
	  <{else}>
		<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_D}></a>
	  <{/if}>
	  <{if $pill_E != 0}>
		<a href="order.php?op=5" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $op == 5}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_E}><span class="badge badge-primary badge-pill"><{$pill_E}></span></a>
	  <{else}>
		<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_E}></a>
	  <{/if}>
	  <{if $pill_F != 0}>
		<a href="order.php?op=6" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<{if $op == 6}> active<{/if}>"><{$smarty.const._MA_XMSTOCK_ORDER_F}><span class="badge badge-primary badge-pill"><{$pill_F}></span></a>
	  <{else}>
		<a href="" class="list-group-item list-group-item-action disabled"><{$smarty.const._MA_XMSTOCK_ORDER_F}></a>
	  <{/if}>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="text-center" scope="col">#</th>
				<th scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DESCRIPTION}></th>
				<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_ORDERDATE}></th>
				<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_ORDERDESIRED}></th>
				<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY}></th>
				<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
			</tr>
		</thead>
		<tbody>
			<{foreach item=order from=$order}>
			<tr>
				<th class="text-center" scope="row"><{$order.id}></th>
				<td><{$order.description}></td>
				<td class="text-center"><{$order.dorder}></td>
				<td class="text-center"><{$order.ddesired}></td>
				<td class="text-center">
					<{if $order.delivery == 1}>
					<span class="fa fa-truck"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY_DELIVERY}>
					<{/if}>
					<{if $order.delivery == 2}>
					<span class="fa fa-industry"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY_DELIVERY}>
					<{/if}>
				</td>
				<td class="text-center">
					<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
					<{if $order.id != 0}><a href="<{$xoops_url}>/modules/xmstock/order.php?op=edit&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a><{/if}>
					<{if $order.id != 0}><a href="<{$xoops_url}>/modules/xmstock/order.php?op=del&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_DEL}>"><span class="fa fa-trash"></span></a><{/if}>
				</td>
			</tr>
			<{/foreach}>
		</tbody>
	</table>
</div><!-- .xmstock -->
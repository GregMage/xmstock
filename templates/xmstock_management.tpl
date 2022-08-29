<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<{if $error_message|default:'' != '' || $op == 'del'}>
			<li class="breadcrumb-item"><a href="order.php"><{$smarty.const._MA_XMSTOCK_ORDERS}></a></li>
		<{else}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></li>
		<{/if}>
	  </ol>
	</nav>
	<{if $error_message|default:'' != ''}>
		<div class="alert alert-danger" role="alert"><{$error_message}></div>
	<{else}>
		<h2><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></h2>
		<div class="row justify-content-center">
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
				<div class="card xmstock-border">
					<a class="text-decoration-none" title="<{$smarty.const._MA_XMSTOCK_MANAGEMENT_TOPROCESS}>" href="<{$xoops_url}>/modules/xmstock/management.php?op=view">
						<div class="card-header text-center">
							<{$smarty.const._MA_XMSTOCK_MANAGEMENT_TOPROCESS}>
						</div>
					</a>
					<div class="card-body text-center">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="text-center" scope="col">#</th>
									<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></th>
									<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDESIRED}></th>
									<th class="text-center width15" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
								</tr>
							</thead>
							<tbody>
								<{foreach item=order_toprocess from=$order_toprocess}>
								<tr>
									<th class="text-center" scope="row"><{$order_toprocess.id}></th>
									<td class="text-center"><{$order_toprocess.dorder}></td>
									<td class="text-center"><{$order_toprocess.ddesired}></td>
									<td class="text-center">
										<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order_toprocess.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
										<{if $order_toprocess.status == 1}><a href="<{$xoops_url}>/modules/xmstock/order.php?op=del&order_id=<{$order_toprocess.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_DEL}>"><span class="fa fa-trash"></span></a><{/if}>
									</td>
								</tr>
								<{/foreach}>
							</tbody>
						</table>
					</div>				
				</div>
			</div>			
		</div>
		
	<{/if}>
</div><!-- .xmstock -->
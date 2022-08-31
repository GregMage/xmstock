<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<{if $op == 'view'}>
			<li class="breadcrumb-item"><a href="management.php?op=list"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_MANAGEMENT_VIEW}></li>
		<{else}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></li>
		<{/if}>
	  </ol>
	</nav>
	<{if $error_message|default:'' != ''}>
		<div class="alert alert-danger" role="alert"><{$error_message}></div>
	<{else}>
		<{if $op|default:'list' == 'list'}>
			<h2><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></h2>
			<div class="row justify-content-center">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
					<div class="card xmstock-border">
						<a class="text-decoration-none" title="<{$smarty.const._MA_XMSTOCK_MANAGEMENT_TOPROCESS}>" href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=1">
							<div class="card-header text-center">
								<{$smarty.const._MA_XMSTOCK_MANAGEMENT_TOPROCESS}>
							</div>
						</a>
						<div class="card-body text-center">
							<{if $error_message_1|default:'' != ''}>
								<div class="alert alert-danger" role="alert"><{$error_message_1}></div>
							<{else}>
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
										<{foreach item=order_1 from=$order_1}>
										<tr>
											<th class="text-center" scope="row"><{$order_1.id}></th>
											<td class="text-center"><{$order_1.dorder}></td>
											<td class="text-center"><{$order_1.ddesired}></td>
											<td class="text-center">
												<a href="<{$xoops_url}>/modules/xmstock/management.php?op=view&order_id=<{$order_1.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
											</td>
										</tr>
										<{/foreach}>
									</tbody>
								</table>
								<a href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=1" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
							<{/if}>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
					<div class="card xmstock-border">
						<a class="text-decoration-none" title="<{$smarty.const._MA_XMSTOCK_MANAGEMENT_PREPARATION}>" href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=2">
							<div class="card-header text-center">
								<{$smarty.const._MA_XMSTOCK_MANAGEMENT_PREPARATION}>
							</div>
						</a>
						<div class="card-body text-center">
							<{if $error_message_2|default:'' != ''}>
								<div class="alert alert-danger" role="alert"><{$error_message_2}></div>
							<{else}>
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
										<{foreach item=order_2 from=$order_2}>
										<tr>
											<th class="text-center" scope="row"><{$order_2.id}></th>
											<td class="text-center"><{$order_2.dorder}></td>
											<td class="text-center"><{$order_2.ddesired}></td>
											<td class="text-center">
												<a href="<{$xoops_url}>/modules/xmstock/management.php?op=view&order_id=<{$order_2.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
											</td>
										</tr>
										<{/foreach}>
									</tbody>
								</table>
							<{/if}>
						</div>
					</div>
				</div>
			</div>
		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
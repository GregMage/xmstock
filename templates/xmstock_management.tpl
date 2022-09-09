<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<{if $op == 'view'}>
			<li class="breadcrumb-item"><a href="management.php?op=list"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_MANAGEMENT_VIEW}></li>
		<{/if}>
		<{if $op == 'viewall'}>
			<li class="breadcrumb-item"><a href="management.php?op=list"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_MANAGEMENT_VIEWALL}></li>
		<{/if}>
		<{if $op == 'list'}>
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
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL}></th>
											<th class="text-center width15" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
										</tr>
									</thead>
									<tbody>
										<{foreach item=order_2 from=$order_2}>
										<tr>
											<th class="text-center" scope="row"><{$order_2.id}></th>
											<td class="text-center"><{$order_2.dorder}></td>
											<td class="text-center"><{$order_2.delivery}></td>
											<td class="text-center">
												<a href="<{$xoops_url}>/modules/xmstock/management.php?op=view&order_id=<{$order_2.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
											</td>
										</tr>
										<{/foreach}>
									</tbody>
								</table>
								<a href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=2" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
							<{/if}>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
					<div class="card xmstock-border">
						<a class="text-decoration-none" title="<{$smarty.const._MA_XMSTOCK_MANAGEMENT_READY}>" href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=3">
							<div class="card-header text-center">
								<{$smarty.const._MA_XMSTOCK_MANAGEMENT_READY}>
							</div>
						</a>
						<div class="card-body text-center">
							<{if $error_message_3|default:'' != ''}>
								<div class="alert alert-danger" role="alert"><{$error_message_3}></div>
							<{else}>
								<table class="table table-hover">
									<thead>
										<tr>
											<th class="text-center" scope="col">#</th>
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></th>
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEREADY}></th>
											<th class="text-center width15" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
										</tr>
									</thead>
									<tbody>
										<{foreach item=order_3 from=$order_3}>
										<tr>
											<th class="text-center" scope="row"><{$order_3.id}></th>
											<td class="text-center"><{$order_3.dorder}></td>
											<td class="text-center"><{$order_3.dready}></td>
											<td class="text-center">
												<a href="<{$xoops_url}>/modules/xmstock/management.php?op=view&order_id=<{$order_3.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
											</td>
										</tr>
										<{/foreach}>
									</tbody>
								</table>
								<a href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=3" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
							<{/if}>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
					<div class="card xmstock-border">
						<a class="text-decoration-none" title="<{$smarty.const._MA_XMSTOCK_MANAGEMENT_DELIVRED}>" href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=4">
							<div class="card-header text-center">
								<{$smarty.const._MA_XMSTOCK_MANAGEMENT_DELIVRED}>
							</div>
						</a>
						<div class="card-body text-center">
							<{if $error_message_4|default:'' != ''}>
								<div class="alert alert-danger" role="alert"><{$error_message_4}></div>
							<{else}>
								<table class="table table-hover">
									<thead>
										<tr>
											<th class="text-center" scope="col">#</th>
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></th>
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL_R}></th>
											<th class="text-center width15" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
										</tr>
									</thead>
									<tbody>
										<{foreach item=order_4 from=$order_4}>
										<tr>
											<th class="text-center" scope="row"><{$order_4.id}></th>
											<td class="text-center"><{$order_4.dorder}></td>
											<td class="text-center"><{$order_4.delivery_r}></td>
											<td class="text-center">
												<a href="<{$xoops_url}>/modules/xmstock/management.php?op=view&order_id=<{$order_4.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
											</td>
										</tr>
										<{/foreach}>
									</tbody>
								</table>
								<a href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=4" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
							<{/if}>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 p-2">
					<div class="card xmstock-border">
						<a class="text-decoration-none" title="<{$smarty.const._MA_XMSTOCK_MANAGEMENT_CANCELED}>" href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=0">
							<div class="card-header text-center">
								<{$smarty.const._MA_XMSTOCK_MANAGEMENT_CANCELED}>
							</div>
						</a>
						<div class="card-body text-center">
							<{if $error_message_0|default:'' != ''}>
								<div class="alert alert-danger" role="alert"><{$error_message_0}></div>
							<{else}>
								<table class="table table-hover">
									<thead>
										<tr>
											<th class="text-center" scope="col">#</th>
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></th>
											<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATECANCELLATION}></th>
											<th class="text-center width15" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
										</tr>
									</thead>
									<tbody>
										<{foreach item=order_0 from=$order_0}>
										<tr>
											<th class="text-center" scope="row"><{$order_0.id}></th>
											<td class="text-center"><{$order_0.dorder}></td>
											<td class="text-center"><{$order_0.dcancellation}></td>
											<td class="text-center">
												<a href="<{$xoops_url}>/modules/xmstock/management.php?op=view&order_id=<{$order_0.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>
											</td>
										</tr>
										<{/foreach}>
									</tbody>
								</table>
								<a href="<{$xoops_url}>/modules/xmstock/management.php?op=viewall&status=0" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_ALLORDERS}></a>
							<{/if}>
						</div>
					</div>
				</div>
			</div>
		<{/if}>
		<{if $op|default:'list' == 'viewall'}>
			<div class="pull-right">
				<form id="form_order_tri" name="form_order_tri" method="get" action="management.php" class="form-inline">
					<div class="form-group mb-2">
					    <label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_STATUS}> </label>
						<select class="form-control form-control-sm" id="statut_filter" onchange="location='management.php?op=viewall&sort=<{$sort}>&status='+this.options[this.selectedIndex].value">
							<option value="all" <{if $status == 'all'}>selected="selected"<{/if}>><{$smarty.const._ALL}></option>
							<option value="1" <{if $status == '1'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_1}></option>
							<option value="2" <{if $status == '2'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_2}></option>
							<option value="3" <{if $status == '3'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_3}></option>
							<option value="4" <{if $status == '4'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_4}></option>
							<option value="0" <{if $status == '0'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_STATUS_0}></option>
						</select>
					</div>
					<div class="form-group mb-2">
					    <label class="my-1 mr-2">&nbsp;<{$smarty.const._MA_XMSTOCK_SORTBY}> </label>
						<select class="form-control form-control-sm" id="sort_filter" onchange="location='management.php?op=viewall&status=<{$status}>&sort='+this.options[this.selectedIndex].value">
							<option value="all" <{if $sort == 'all'}>selected="selected"<{/if}>><{$smarty.const._ALL}></option>
							<option value="1" <{if $sort == '1'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_MANAGEMENT_SORTORDER}></option>
							<option value="2" <{if $sort == '2'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></option>
							<option value="3" <{if $sort == '3'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_DATEDESIRED}></option>
							<{if ($status > 1 || $status == 0) && $status != 'all'}>
							<option value="4" <{if $sort == '4'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL}></option>
							<{/if}>
							<{if ($status > 2 || $status == 0) && $status != 'all'}>
							<option value="5" <{if $sort == '5'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_DATEREADY}></option>
							<{/if}>
							<{if ($status > 3 || $status == 0) && $status != 'all'}>
							<option value="6" <{if $sort == '6'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL_R}></option>
							<{/if}>
							<{if $status == 0}>
							<option value="8" <{if $sort == '8'}>selected="selected"<{/if}>><{$smarty.const._MA_XMSTOCK_ORDER_DATECANCELLATION}></option>
							<{/if}>
						</select>
					</div>
				</form>
			</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DESCRIPTION}></th>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}></th>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDESIRED}></th>
						<{if ($status > 1 || $status == 0) && $status != 'all'}>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL}></th>
						<{/if}>
						<{if ($status > 2 || $status == 0) && $status != 'all'}>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEREADY}></th>
						<{/if}>
						<{if ($status > 3 || $status == 0) && $status != 'all'}>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL_R}></th>
						<{/if}>
						<{if $status == 0}>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_ORDER_DATECANCELLATION}></th>
						<{/if}>
						<{if $status == 'all'}>
						<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_STATUS}></th>
						<{/if}>
						<th class="text-center width20" scope="col"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
					</tr>
				</thead>
				<tbody>
					<{foreach item=order from=$order}>
					<tr>
						<th class="text-center" scope="row"><{$order.id}></th>
						<td><{$order.description}></td>
						<td class="text-center"><{$order.dorder}></td>
						<td class="text-center"><{$order.ddesired}></td>
						<{if ($status > 1 || $status == 0) && $status != 'all'}>
						<td class="text-center"><{$order.ddelivery}></td>
						<{/if}>
						<{if ($status > 2 || $status == 0) && $status != 'all'}>
						<td class="text-center"><{$order.dready}></td>
						<{/if}>
						<{if ($status > 3 || $status == 0) && $status != 'all'}>
						<td class="text-center"><{$order.ddelivery_r}></td>
						<{/if}>
						<{if $status == 0}>
						<td class="text-center"><{$order.dcancellation}></td>
						<{/if}>
						<{if $status == 'all'}>
						<td class="text-center"><{$order.status_text}></td>
						<{/if}>
						<td class="text-center">
							<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_PROCESS}>"><span class="fa fa-angle-double-right"></span></a>
							<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_EDIT}>"><span class="fa fa-edit"></span></a>
							<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order.id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span></a>

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
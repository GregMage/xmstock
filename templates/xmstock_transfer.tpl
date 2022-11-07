<div class="xmstock">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MI_XMSTOCK_SUB_TRANSFER}></li>
		</ol>
	</nav>

	<div class="row text-center">
		<div class="col-lg-4">
			<a title="<{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}>" href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=E">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/In.png" alt="<{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}>">
					<h5><{$smarty.const._MA_XMSTOCK_TRANSFER_ENTRYINSTOCK}></h5>
				</div>
			</a>
		</div>
		<div class="col-lg-4">
			<a title="<{$smarty.const._MA_XMSTOCK_TRANSFER_OUTOFSTOCK}>" href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=O">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/Out.png" alt="<{$smarty.const._MA_XMSTOCK_TRANSFER_OUTOFSTOCK}>">
					<h5><{$smarty.const._MA_XMSTOCK_TRANSFER_OUTOFSTOCK}></h5>
				</div>
			</a>
		</div>
		<div class="col-lg-4">
			<a title="<{$smarty.const._MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK}>" href="<{$xoops_url}>/modules/xmstock/transfer.php?op=add&type=T">
				<div class="btn m-2 border">
					<img class="bd-placeholder-img mt-3 rounded" height="100" src="<{$xoops_url}>/modules/xmstock/assets/images/Transfer.png" alt="<{$smarty.const._MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK}>">
					<h5><{$smarty.const._MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK}></h5>
				</div>
			</a>
		</div>
    </div>
	<div>
		<{$form|default:''}>
	</div>
	<{if $transfer_count != 0}>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2"><{$smarty.const._MA_XMSTOCK_TRANSFER_LIST}></h2>
			<div class="btn-toolbar mb-2 mb-md-0">
				<div class="btn-group mr-2">
					<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_STOCK_AREA}> </label>
					<select class="form-control form-control-sm" id="statut_filter" onchange="location='transfer.php?sort=<{$sort}>&filter=<{$filter}>&area_id='+this.options[this.selectedIndex].value">
						<{$area_options}>
					</select>
					&nbsp;<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_DATE}>&nbsp;</label>
					<div class="form-check form-check-inline">
						&nbsp;<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" <{if $sort == 'DESC'}>checked<{/if}> onchange="location='transfer.php?area_id=<{$area_id}>&sort=DESC&filter=<{$filter}>'">
						<label class="form-check-label" for="inlineRadio1"><span class="fa fa-arrow-down"></span></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" <{if $sort == 'ASC'}>checked<{/if}> onchange="location='transfer.php?area_id=<{$area_id}>&sort=ASC&filter=<{$filter}>'">
						<label class="form-check-label" for="inlineRadio2"><span class="fa fa-arrow-up"></span></label></label>
					</div>
					<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_FILTER}> </label>
					<select class="form-control form-control-sm" id="statut_filter" onchange="location='transfer.php?area_id=<{$area_id}>&sort=<{$sort}>&filter='+this.options[this.selectedIndex].value">
						<option value=10 <{if $filter == 10}>selected="selected"<{/if}>>10&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
						<option value=20 <{if $filter == 20}>selected="selected"<{/if}>>20&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
						<option value=50 <{if $filter == 50}>selected="selected"<{/if}>>50&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
						<option value=100 <{if $filter == 100}>selected="selected"<{/if}>>100&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					</select>
				</div>
				<button type="button" class="btn btn-sm btn-secondary" onclick="saveData()"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_EXPORT}></button>
			</div>
		</div>
		<script>
			let export_data = '<{$export_head}>';
			let name = 'Transfert';
		</script>
		<div class="row justify-content-center">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_DATE}></th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_ARTICLE}></th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_REF}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_AMOUNT}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_STAREA}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_DESTINATION}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_TYPE}></th>
					</tr>
				</thead>
				<tbody>
					<{foreach item=transfer from=$transfers}>
					<tr>
						<th class="text-center" scope="row">
							<a class="text-decoration-none" title="<{$transfer.id}>" data-toggle="modal" data-target="#xmDesc-<{$transfer.id}>">
								<{$transfer.id}>
							</a>
						</th>
						<td><{$transfer.date}></td>
						<td><{$transfer.article}></td>
						<td><{$transfer.ref}></td>
						<td class="text-center"><{$transfer.amount}></td>
						<td class="text-center"><{$transfer.starea}></td>
						<td class="text-center"><{$transfer.destination}></td>
						<td class="text-center"><{$transfer.type}></td>
					</tr>
					<script>
						export_data += '<{$transfer.export}>';
					</script>
					<div class="modal fade" id="xmDesc-<{$transfer.id}>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title aligncenter"># <{$transfer.id}></h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<span><{$transfer.description}></span>
									<hr>
									<div class="row mt-2">
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_ARTICLE}></b>
										</div>
											<div class="col-6">
											<{$transfer.article}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_REF}></b>
										</div>
											<div class="col-6">
											<{$transfer.ref}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_TYPE}></b>
										</div>
											<div class="col-6">
											<{$transfer.type}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_DATE}></b>
										</div>
											<div class="col-6">
											<{$transfer.date}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_AMOUNT}></b>
										</div>
											<div class="col-6">
											<span class="badge badge-pill badge-info"><{$transfer.amount}></span>
										</div>
										<{if $transfer.code_type != 'E'}>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_STAREA}></b>
										</div>
											<div class="col-6">
											<{$transfer.starea}>
										</div>
										<{/if}>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_DESTINATION}></b>
										</div>
											<div class="col-6">
											<{$transfer.destination}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_USER}></b>
										</div>
											<div class="col-6">
											<{$transfer.user}>
										</div>
									</div>
								</div>
								<div class="modal-footer">
								    <button type="button" class="btn btn-secondary" data-dismiss="modal"><{$smarty.const._CLOSE}></button>
								</div>
							</div>
						</div>
					</div>
					<{/foreach}>
				</tbody>
			</table>
		</div>
		<div class="clear spacer"></div>
		<{if $nav_menu|default:false}>
			<div class="floatright"><{$nav_menu}></div>
			<div class="clear spacer"></div>
		<{/if}>
	<{else}>
		<{if $form|default:'' == ''}>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<{$smarty.const._MA_XMSTOCK_ERROR_NOTRANSFER}>
		</div>
		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
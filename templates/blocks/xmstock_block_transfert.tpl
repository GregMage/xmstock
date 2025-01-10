<div class="row">
	<div class="col">
		<{if $block.transfer != ''}>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_DATE}></th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_ARTICLE}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
					</tr>
				</thead>
				<tbody>
				<{foreach item=blocktransfer from=$block.transfer}>
					<tr>
						<th class="text-center" scope="row">
							<a class="text-decoration-none" title="<{$blocktransfer.id}>" data-toggle="modal" data-target="#xmDesc-<{$blocktransfer.id}>">
								<{$blocktransfer.id}>
							</a>
						</th>
						<td><{$blocktransfer.date}></td>
						<td><{$blocktransfer.article}></td>
						<td class="text-center">
							<{if $blocktransfer.action == true}>
							<a href="<{$xoops_url}>/modules/xmstock/transfer.php?op=valid&transfer_id=<{$blocktransfer.id}>" class="btn btn-secondary btn-sm" title="<{$smarty.const._MA_XMSTOCK_VALID}>"><span class="fa fa-check-square-o"></span></a>
							<{/if}>
						</td>
					</tr>
					<div class="modal fade" id="xmDesc-<{$blocktransfer.id}>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title aligncenter"># <{$blocktransfer.id}></h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<span><{$blocktransfer.description}></span>
									<hr>
									<div class="row mt-2">
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_ARTICLE}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.article}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_REF}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.ref}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_TYPE}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.type}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_DATE}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.date}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_AMOUNT}></b>
										</div>
											<div class="col-6">
											<span class="badge badge-pill badge-info"><{$blocktransfer.amount}></span>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_STAREA}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.starea}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_DESTINATION}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.destination}>
										</div>
										<div class="col-6">
											<b><{$smarty.const._MA_XMSTOCK_TRANSFER_USER}></b>
										</div>
											<div class="col-6">
											<{$blocktransfer.user}>
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
			<a href="<{$xoops_url}>/modules/xmstock/transfer.php" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_TRANSFER_ALL}></a>
		<{else}>
			<div class="alert alert-warning" role="alert">
				<{$smarty.const._MB_XMSTOCK_NOTRANSFER}>
			</div>
		<{/if}>
	</div>
</div>
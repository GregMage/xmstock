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
			<h1 class="h2"><{$smarty.const._MA_XMSTOCK_TRANSFER_LIST}></h1>
		</div>
		<div class="row justify-content-center">			
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_DATE}></th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_ARTICLE}></th>
						<th><{$smarty.const._MA_XMSTOCK_TRANSFER_REF}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_AMOUNT}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_USER}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_TRANSFER_TYPE}></th>
					</tr>
				</thead>
				<tbody>
					<{foreach item=transfer from=$transfers}>
					<tr>
						<td><{$transfer.date}></td>
						<td><{$transfer.article}></td>
						<td><{$transfer.ref}></td>
						<td class="text-center"><{$transfer.amount}></td>
						<td class="text-center"><{$transfer.user}></td>
						<td class="text-center"><{$transfer.type}></td>
					</tr>
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
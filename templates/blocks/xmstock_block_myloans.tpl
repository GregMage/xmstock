<div class="row">
	<div class="col">
		<{if $block.loan != ''}>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th><{$smarty.const._MA_XMSTOCK_LOAN_DATE}></th>
						<th><{$smarty.const._MA_XMSTOCK_LOAN_LARTICLE}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_LOAN_AMOUNT}></th>
					</tr>
				</thead>
				<tbody>
				<{foreach item=blockloan from=$block.loan}>
					<tr>
						<th class="text-center" scope="row"><{$blockloan.id}></th>
						<td><{$blockloan.date}></td>
						<td><{$blockloan.article}></td>
						<td class="text-center"><{$blockloan.amount}></td>
					</tr>
				<{/foreach}>
				</tbody>
			</table>
		<{else}>
			<div class="alert alert-warning" role="alert">
				<{$smarty.const._MB_XMSTOCK_NOLOAN}>
			</div>
		<{/if}>
	</div>
</div>
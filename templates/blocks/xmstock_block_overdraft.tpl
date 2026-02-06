<div class="row">
	<div class="col">
		<{if $block.overdraft|default:'' != ''}>
		<div class="list-group">
			<{foreach item=blockoverdraft from=$block.overdraft}>
				<a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?article_id=<{$blockoverdraft.article_id}>" class="list-group-item list-group-item-action">
					<div class="row">
						<div class="col-7 text-left">
							<b><{$blockoverdraft.article_ref}></b> <{$blockoverdraft.article_name}>
						</div>
						<div class="col-3 text-left">
							<span class="fa fa-folder-o fa-fw" aria-hidden="true"></span><{$blockoverdraft.area_name}>
						</div>
						<div class="col-2 text-right">
							<{if $blockoverdraft.amount == $blockoverdraft.mini}>
							<span class="badge badge-pill badge-warning">
							<{else}>
							<span class="badge badge-pill badge-danger">
							<{/if}>
							<{$blockoverdraft.amount}>/<{$blockoverdraft.mini}> <{if $blockoverdraft.type == 2}><{$smarty.const._MA_XMSTOCK_CHECKOUT_UNIT}><{/if}><{if $blockoverdraft.type == 5}><{$smarty.const._MA_XMSTOCK_CHECKOUT_UNITS}><{/if}>
							</span>
						</div>
					</div>
				</a>
			<{/foreach}>
		</div>
		<a href="<{$xoops_url}>/modules/xmstock/overdraft.php" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-list-alt"></span> <{$smarty.const._MA_XMSTOCK_OVERDRAFT_ALL}></a>
		<{else}>
			<div class="alert alert-warning" role="alert">
				<{$smarty.const._MB_XMSTOCK_NOOVERDRAFT}>
			</div>
		<{/if}>
	</div>
</div>
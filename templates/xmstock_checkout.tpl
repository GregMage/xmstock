<div class="xmstock">
	<{if $confirm|default:false}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item active"><{$smarty.const._MA_XMSTOCK_CHECKOUT_CONFIRM}></li>
		  </ol>
		</nav>
		<div class="alert alert-success" role="alert">
			<{$smarty.const._MA_XMSTOCK_CHECKOUT_CONFIRM_SEND}>
		</div>
		<table class="table table-striped table-bordered">
			<tr>
				<th class="txtcenter" colspan="2"><{$order_title}></th>
			</tr>
			<{foreach from=$order_arr key=title item=information}>
				<tr>
					<td class="txtleft"><{$title}></td>
					<{if $title == $smarty.const._MA_XMSTOCK_CADDY_ITMES}>
						<td class="txtleft">
						<div class="list-group">
						<{foreach from=$information key=item_id item=item_info}>
							<a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?category_id=<{$item_info.cid}>&article_id=<{$item_info.id}>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
							<{$item_info.name}>
							<{if $item_info.type|default:'' != ''}>
								<span class="badge badge-pill badge-info"><{$item_info.type}></span>
							<{/if}>
							<span class="badge badge-primary badge-pill"><{$item_info.amount}><{if $item_info.length|default:'' != ''}> x <{$item_info.length}> <{$smarty.const._MA_XMSTOCK_CHECKOUT_UNIT}><{/if}></span>
							</a>

							</div>
						<{/foreach}>
						</td>
					<{else}>
						<td class="txtleft"><{$information}></td>
					<{/if}>
				</tr>
			<{/foreach}>
		</table>
		<div class="col-12 pl-4 pr-4 pb-2">
			<div class="text-center pt-2">
				<a href="<{$xoops_url}>/modules/xmstock/vieworder.php?op=view&order_id=<{$order_id}>" class="btn btn-secondary" title="<{$smarty.const._MA_XMSTOCK_VIEW}>"><span class="fa fa-eye"></span> <{$smarty.const._MA_XMSTOCK_CHECKOUT_VIEW}></a>
			</div>
		</div>
	<{else}>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
				<li class="breadcrumb-item"><a href="caddy.php"><{$smarty.const._MA_XMSTOCK_CADDY}></a></li>
				<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_CHECKOUT}></li>
			</ol>
		</nav>
		<{if $error_message|default:'' != ''}>
			<div class="alert alert-danger" role="alert"><{$error_message}></div>
		<{else}>
			<h3><{$smarty.const._MA_XMSTOCK_CHECKOUT_SUMMARY}></h3>
			<table class="table table-striped">
				<tr>
					<th><{$smarty.const._MA_XMSTOCK_CADDY_ITMES}></th>
					<th class="width30"><{$smarty.const._MA_XMSTOCK_CADDY_AREA}></th>
					<{if $displayneedsyear == true}><th class="txtcenter width15"><{$smarty.const._MA_XMSTOCK_CADDY_NEEDSYEARS}></th><{/if}>
					<th class="txtcenter width30"><{$smarty.const._MA_XMSTOCK_CADDY_QUANTITY}><{if $mml == true}> - <{$smarty.const._MA_XMSTOCK_CADDY_LENGHT}><{/if}></th>
				</tr>
				<{foreach item=article from=$articles}>
					<tr>
						<td>
							<{$article.name}>
							<{if $article.warning == true}>
								<span class="badge badge-pill badge-warning"><{$smarty.const._MA_XMSTOCK_WARNING}></span>
							<{/if}>
							<{if $article.error == true}>
								<span class="badge badge-pill badge-danger"><{$smarty.const._MA_XMSTOCK_ERROR}></span>
							<{/if}>
						</td>
						<td>
							<{$article.area}>
							<span class="badge badge-info badge-pill">
								<{$article.amount}> <{if $article.unit|default:'' == $smarty.const._MA_XMSTOCK_CHECKOUT_UNIT}><{$article.unit}><{/if}>
							</span>
							<{if $article.unit|default:'' == $smarty.const._MA_XMSTOCK_STOCK_LOAN}><span class="badge badge-light badge-pill"><{$article.unit}></span><{/if}>
						</td>
						<{if $article.needsyear != ''}>
							<td class="txtcenter"><{$article.needsyear}></td>
						<{else}>
							<{if $displayneedsyear == true}>
								<td>&nbsp;</td>
							<{/if}>
						<{/if}>
						<td class="txtcenter width10">
							<{$article.qty}><{if $article.unit|default:'' == $smarty.const._MA_XMSTOCK_CHECKOUT_UNIT}> x <{$article.length}> <span class="badge badge-pill badge-info"><{$article.unit}></span><{/if}>
						</td>
					</tr>
				<{/foreach}>
				<tr>
					<td class="txtright" colspan="2"><h3>Total</h3></td>
					<{if $displayneedsyear == true}><td>&nbsp;</td><{/if}>
					<td class="txtcenter"><h3><{$total}></h3></td>
				</tr>
			</table>
			<{if $warning == true}>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<h4 class="alert-heading"><{$smarty.const._MA_XMSTOCK_WARNING}></h4>
					<p><{$smarty.const._MA_XMSTOCK_CHECKOUT_WARNINGQTY}></p>
					<p><{$smarty.const._MA_XMSTOCK_CHECKOUT_WARNINGQTY2}></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<{/if}>
			<{if $error == true}>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<h4 class="alert-heading"><{$smarty.const._MA_XMSTOCK_ERROR}></h4>
					<p><{$smarty.const._MA_XMSTOCK_CHECKOUT_ERRORQTY}></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<{/if}>
			<{if $info == true}>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
					<h4 class="alert-heading"><{$smarty.const._MA_XMSTOCK_INFORMATION}></h4>
					<p><{$smarty.const._MA_XMSTOCK_CHECKOUT_INFORMATION}></p>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<{/if}>
			<{$form}>
			<table class="xmstock_step_body">
				<tr>
					<td class="xmstock_step_active">
						<span><{$smarty.const._MA_XMSTOCK_CADDY_STEP1}></span>
					</td>
					<td class="xmstock_step_img">
						<img src="<{$xoops_url}>/modules/xmstock/assets/images/step3.png" alt="">
					</td>
					<td class="xmstock_step_active">
						<span><{$smarty.const._MA_XMSTOCK_CADDY_STEP2}></span>
					</td>
					<td class="xmstock_step_img">
						<img src="<{$xoops_url}>/modules/xmstock/assets/images/step2.png" alt="">
					</td>
					<td class="xmstock_step">
						<span><{$smarty.const._MA_XMSTOCK_CADDY_STEP3}></span>
					</td>
				</tr>
			</table>
		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
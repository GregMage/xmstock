<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_CADDY}></li>
	  </ol>
	</nav>
	<{if $warning_message|default:'' != ''}>
		<div class="alert alert-warning txtcenter" role="alert"><{$warning_message}></div>
	<{/if}>
	<{if $error_message|default:'' != ''}>
		<div class="alert alert-danger" role="alert"><{$error_message}></div>
	<{else}>
		<form class="" name="formcaddy" id="formcaddy" action="caddy.php" method="post">
			<table class="table table-striped">
				<tr>
					<th><{$smarty.const._MA_XMSTOCK_CADDY_ITMES}></th>
					<th class="width20"><{$smarty.const._MA_XMSTOCK_CADDY_AREA}></th>
					<th class="txtcenter width30"><{$smarty.const._MA_XMSTOCK_CADDY_QUANTITY}><{if $mml == true}> - <{$smarty.const._MA_XMSTOCK_CADDY_LENGHT}><{/if}><{if $mm2 == true}> - <{$smarty.const._MA_XMSTOCK_CADDY_WIDTH}><{/if}></th>
					<{if $displayneedsyear == true}><th class="txtcenter width15"><{$smarty.const._MA_XMSTOCK_CADDY_NEEDSYEARS}></th><{/if}>
					<th class="txtcenter width15"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
				</tr>
				<{foreach item=article from=$articles}>
					<tr>
						<td><{$article.name}></td>
						<td>
							<{$article.area}>
							<input type="hidden" name="area_<{$article.count}>" id="area_<{$article.count}>" value="<{$article.areaid}>">
							<span class="badge badge-info badge-pill"><{$article.amount}></span> <{if $article.unit == $smarty.const._MA_XMSTOCK_STOCK_LOAN}><span class="badge badge-light badge-pill"><{$article.unit}></span><{/if}>
						</td>
						<td>
							<div class="form-row">
								<div class="form-group col-4">
									<input class="form-control" type="number" name="qty_<{$article.count}>" id="qty_<{$article.count}>" value="<{$article.qty}>" min = "1" <{$article.max}> onchange="refreshcaddy()">
								</div>
								<{if $article.unit == $smarty.const._MA_XMSTOCK_STOCK_LENGHT || $article.unit == $smarty.const._MA_XMSTOCK_STOCK_WIDTH}>
									<div class="form-group col-4">
										<input class="form-control" type="number" name="length_<{$article.count}>" id="length_<{$article.count}>" value="<{$article.length}>" onchange="refreshcaddy()">
										<span class="badge badge-pill badge-info"><{$smarty.const._MA_XMSTOCK_STOCK_LENGHT}></span>
									</div>
								<{/if}>
								<{if $article.unit == $smarty.const._MA_XMSTOCK_STOCK_WIDTH}>
									<div class="form-group col-4">
										<input class="form-control" type="number" name="width_<{$article.count}>" id="width_<{$article.count}>" value="<{$article.width}>" onchange="refreshcaddy()">
										<span class="badge badge-pill badge-info"><{$smarty.const._MA_XMSTOCK_STOCK_WIDTH}></span>
									</div>
								<{/if}>
							</div>
						</td>
						<{if $article.needsyear != ''}>
							<td class="txtcenter">
								<div class="form-group">
									<select class="form-control" name="needsyear_<{$article.count}>" id="needsyear_<{$article.count}>" onchange="refreshcaddy()">
										<{$article.needsoptions}>
									</select>
								</div>
							</td>
						<{else}>
							<{if $displayneedsyear == true}>
								<td>&nbsp;</td>
							<{/if}>

							<input type="hidden" id="needsyears_<{$article.count}>" name="needsyears_<{$article.count}>" value="" />
						<{/if}>
						<td class="txtcenter width10">
							<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=del&article_id=<{$article.id}>&area_id=<{$article.areaid}>" class="btn btn-secondary"><span class="fa fa-trash"></span></a>
						</td>
					</tr>

				<{/foreach}>
				<tr>
					<td class="txtright" colspan="2"><h3>Total</h3></td>
					<td class="txtcenter"><h3><{$total}></h3></td>
					<td>&nbsp;</td>
					<{if $displayneedsyear == true}><td>&nbsp;</td><{/if}>
				</tr>
			</table>
			<input type="hidden" name="op" id="op" value="update">
			<div class="xm-stock-general-button">
				<div class="btn-group" role="group" aria-label="...">
					<button class="btn btn-secondary" type="submit"><span class="fa fa-refresh"></span> <{$smarty.const._MA_XMSTOCK_CADDY_UPDATE}></button>
					<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=empty" class="btn btn-secondary"><span class="fa fa-trash"></span> <{$smarty.const._MA_XMSTOCK_CADDY_EMPTY}></a>
					<a href="<{$return_url}>" class="btn btn-secondary"><span class="fa fa-undo"></span> <{$smarty.const._MA_XMSTOCK_CADDY_CONTINUE}></a>
				</div>
			</div>
		</form>
		<script>
		function refreshcaddy() {
			document.forms["formcaddy"].submit();
		}
		</script>
		<div class="xm-stock-general-button">
			<a href="<{$xoops_url}>/modules/xmstock/checkout.php" class="btn btn-success"><span class="fa fa-check-circle"></span> <{$smarty.const._MA_XMSTOCK_CADDY_STEP1_2}></a>
		</div>

		<table class="xmstock_step_body">
			<tr>
				<td class="xmstock_step_active">
					<span><{$smarty.const._MA_XMSTOCK_CADDY_STEP1}></span>
				</td>
				<td class="xmstock_step_img">
					<img src="<{$xoops_url}>/modules/xmstock/assets/images/step2.png" alt="">
				</td>
				<td class="xmstock_step">
					<span><{$smarty.const._MA_XMSTOCK_CADDY_STEP2}></span>
				</td>
				<td class="xmstock_step_img">
					<img src="<{$xoops_url}>/modules/xmstock/assets/images/step1.png" alt="">
				</td>
				<td class="xmstock_step">
					<span><{$smarty.const._MA_XMSTOCK_CADDY_STEP3}></span>
				</td>
			</tr>
		</table>
	<{/if}>
</div><!-- .xmstock -->
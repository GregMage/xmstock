<div class="xmstock">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MI_XMSTOCK_SUB_OVERDRAFT}></li>
		</ol>
	</nav>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2 class="h2"><{$smarty.const._MI_XMSTOCK_SUB_OVERDRAFT}></h2>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_STOCK_AREA}> </label>
				<select class="form-control form-control-sm" id="area_filter" onchange="location='overdraft.php?sort=<{$sort}>&filter=<{$filter}>&area_id='+this.options[this.selectedIndex].value">
					<{$area_options}>
				</select>
				&nbsp;<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_OVERDRAFT_AMOUNT}>&nbsp;</label>
				<div class="form-check form-check-inline">
					&nbsp;<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" <{if $sort == 'DESC'}>checked<{/if}> onchange="location='overdraft.php?area_id=<{$area_id}>&sort=DESC&filter=<{$filter}>'">
					<label class="form-check-label" for="inlineRadio1"><span class="fa fa-sort-numeric-desc"></span></label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" <{if $sort == 'ASC'}>checked<{/if}> onchange="location='overdraft.php?area_id=<{$area_id}>&sort=ASC&filter=<{$filter}>'">
					<label class="form-check-label" for="inlineRadio2"><span class="fa fa-sort-numeric-asc"></span></label></label>
				</div>
				<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_FILTER}> </label>
				<select class="form-control form-control-sm" id="nb_filter" onchange="location='overdraft.php?area_id=<{$area_id}>&sort=<{$sort}>&filter='+this.options[this.selectedIndex].value">
					<option value=10 <{if $filter == 10}>selected="selected"<{/if}>>10&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					<option value=20 <{if $filter == 20}>selected="selected"<{/if}>>20&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					<option value=50 <{if $filter == 50}>selected="selected"<{/if}>>50&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					<option value=100 <{if $filter == 100}>selected="selected"<{/if}>>100&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
				</select>
			</div>
		</div>
	</div>
	<{if $overdraft_count|default:0 != 0}>
		<div class="row justify-content-center">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th><{$smarty.const._MA_XMSTOCK_OVERDRAFT_ARTICLE}></th>
						<{if $area_id == 0}>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_OVERDRAFT_AREA}></th>
						<{/if}>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_OVERDRAFT_AMOUNT}></th>
					</tr>
				</thead>
				<tbody>
					<{foreach item=overdraft from=$overdrafts}>
					<tr>
						<td><a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?article_id=<{$overdraft.article_id}>"><b><{$overdraft.article_ref}></b> <{$overdraft.article_name}></a></td>
						<{if $area_id == 0}>
						<td class="text-center"><span class="fa fa-folder-o fa-fw" aria-hidden="true"></span><{$overdraft.area_name}></td>
						<{/if}>
						<td class="text-center">
							<{if $overdraft.amount == $overdraft.mini}>
							<span class="badge badge-pill badge-warning">
							<{else}>
							<span class="badge badge-pill badge-danger">
							<{/if}>
							<{$overdraft.amount}>/<{$overdraft.mini}>
							</span>
						</td>
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
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<{$smarty.const._MA_XMSTOCK_OVERDRAFT_NOOVERDRAFT}>
		</div>
	<{/if}>
</div><!-- .xmstock -->
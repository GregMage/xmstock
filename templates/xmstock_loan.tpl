<div class="xmstock">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<{if $op == 'list'}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MI_XMSTOCK_SUB_LOAN}></li>
			<{else}>
			<li class="breadcrumb-item"><a href="loan.php?op=list"><{$smarty.const._MI_XMSTOCK_SUB_LOAN}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_LOAN_FORM}></li>
			<{/if}>
		</ol>
	</nav>
	<{if $error_message|default:'' != ''}>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<{$error_message}>
	</div>
	<{/if}>
	<{if $form|default:'' != ''}>
	<div>
		<{$form}>
	</div>
	<{else}>
	<div class="row text-center">
		<div class="col-lg-12">
			<a title="<{$smarty.const._MA_XMSTOCK_LOAN_ADD}>" href="<{$xoops_url}>/modules/xmstock/loan.php?op=add" class="btn btn-primary btn-lg">
				<{$smarty.const._MA_XMSTOCK_LOAN_ADD}>
			</a>
		</div>
    </div>
	<{/if}>

	<{if $loan_count|default:0 != 0}>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h2 class="h2"><{$smarty.const._MA_XMSTOCK_LOAN_LIST}></h2>
			<div class="btn-toolbar mb-2 mb-md-0">
				<div class="btn-group mr-2">
					<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_STOCK_AREA}> </label>
					<select class="form-control form-control-sm" id="statut_filter" onchange="location='loan.php?sort=<{$sort}>&filter=<{$filter}>&area_id='+this.options[this.selectedIndex].value">
						<{$area_options}>
					</select>
					&nbsp;<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_DATE}>&nbsp;</label>
					<div class="form-check form-check-inline">
						&nbsp;<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" <{if $sort == 'DESC'}>checked<{/if}> onchange="location='loan.php?area_id=<{$area_id}>&sort=DESC&filter=<{$filter}>'">
						<label class="form-check-label" for="inlineRadio1"><span class="fa fa-arrow-down"></span></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" <{if $sort == 'ASC'}>checked<{/if}> onchange="location='loan.php?area_id=<{$area_id}>&sort=ASC&filter=<{$filter}>'">
						<label class="form-check-label" for="inlineRadio2"><span class="fa fa-arrow-up"></span></label></label>
					</div>
					<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_FILTER}> </label>
					<select class="form-control form-control-sm" id="statut_filter" onchange="location='loan.php?area_id=<{$area_id}>&sort=<{$sort}>&filter='+this.options[this.selectedIndex].value">
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
			let name = 'Prêt';
		</script>
		<div class="row justify-content-center">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" scope="col">#</th>
						<th><{$smarty.const._MA_XMSTOCK_LOAN_DATE}></th>
						<th><{$smarty.const._MA_XMSTOCK_LOAN_LARTICLE}></th>
						<th><{$smarty.const._MA_XMSTOCK_LOAN_RDATE}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_LOAN_USERID}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_LOAN_STATUS}></th>
						<th class="text-center"><{$smarty.const._MA_XMSTOCK_ACTION}></th>
					</tr>
				</thead>
				<tbody>
					<{foreach item=loan from=$loans}>
					<tr>
						<th class="text-center" scope="row"><{$loan.id}></th>
						<td><{$loan.date}></td>
						<td><{$loan.article}></td>
						<td><{$loan.rdate}></td>
						<td class="text-center"><{$loan.user}></td>
						<td class="text-center"><{$loan.text_status}></td>
						<td class="text-center">A faire</td>
					</tr>
					<script>
						export_data += '<{$loan.export}>';
					</script>
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
			<{$smarty.const._MA_XMSTOCK_ERROR_NOLOAN}>
		</div>
		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
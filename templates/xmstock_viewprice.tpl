<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<li class="breadcrumb-item active"><{$breadcrumb}></li>
	  </ol>
	</nav>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_DASHBOARD}> "<{$article_name}>"</h1>
	</div>
	<canvas class="my-4 w-100" id="myChart" width="400" height="200"></canvas>
	<h5><{$smarty.const._MA_XMSTOCK_VIEWPRICE_AVERAGEPRICE}> <{$price_a}></h5>
	<hr>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2><{$smarty.const._MA_XMSTOCK_VIEWPRICE_PRICE}></h2>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_DATE}>&nbsp;</label>
				<div class="form-check form-check-inline">
					&nbsp;<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" <{if $sort == 'DESC'}>checked<{/if}> onchange="location='viewprice.php?article_id=<{$article_id}>&area_id=<{$area_id}>&sort=DESC&filter=<{$filter}>'">
					<label class="form-check-label" for="inlineRadio1"><span class="fa fa-arrow-down"></span></label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" <{if $sort == 'ASC'}>checked<{/if}> onchange="location='viewprice.php?article_id=<{$article_id}>&area_id=<{$area_id}>&sort=ASC&filter=<{$filter}>'">
					<label class="form-check-label" for="inlineRadio2"><span class="fa fa-arrow-up"></span></label></label>
				</div>
				<label class="my-1 mr-2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_FILTER}> </label>
				<select class="form-control form-control-sm" id="statut_filter" onchange="location='viewprice.php?article_id=<{$article_id}>&area_id=<{$area_id}>&sort=<{$sort}>&filter='+this.options[this.selectedIndex].value">
					<option value=10 <{if $filter == 10}>selected="selected"<{/if}>>10&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					<option value=20 <{if $filter == 20}>selected="selected"<{/if}>>20&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					<option value=50 <{if $filter == 50}>selected="selected"<{/if}>>50&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
					<option value=100 <{if $filter == 100}>selected="selected"<{/if}>>100&nbsp;<{$smarty.const._MA_XMSTOCK_VIEWPRICE_PERPAGE}></option>
				</select>
			</div>
			<button type="button" class="btn btn-sm btn-secondary" onclick="saveData()"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_EXPORT}></button>
		</div>
	</div>
	<div class="table-responsive">
		<script>
			addChart();
		</script>
		<{foreach item=graph from=$price_graph}>
			<script>
				myChart.data.labels.push('<{$graph.date}>');
				myChart.data.datasets.forEach((dataset) => {
					dataset.data.push(<{$graph.price}>);
				});
				myChart.update();
			</script>
		<{/foreach}>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th><{$smarty.const._MA_XMSTOCK_VIEWPRICE_DATE}></th>
					<th class="text-center"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_AMOUNT}></th>
					<th class="text-center"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_PRICECHF}></th>
				</tr>
			</thead>
			<tbody>
				<{foreach item=price from=$prices}>
				<tr>
					<td><{$price.date}></td>
					<td class="text-center"><{$price.amount}></td>
					<td class="text-center"><{$price.price}></td>
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
</div><!-- .xmstock -->
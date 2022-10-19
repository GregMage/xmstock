<div class="xmstock">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_DASHBOARD}> "<{$article_name}>"</h1>
	</div>
	<canvas class="my-4 w-100" id="myChart" width="400" height="200"></canvas>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2><{$smarty.const._MA_XMSTOCK_VIEWPRICE_PRICE}></h2>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
				<button type="button" class="btn btn-sm btn-secondary" onclick="saveChart()"><{$smarty.const._MA_XMSTOCK_VIEWPRICE_EXPORT}></button>
			</div>
			<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
			<span data-feather="calendar"></span>
			This week
			</button>
		</div>
	</div>
	<div class="table-responsive">
		<script>
			addChart();
			let export_data = '';
			let name = '<{$file_name}>';
		</script>
		<{foreach item=graph from=$price_graph}>
			<script>
				myChart.data.labels.push('<{$graph.date}>');
				myChart.data.datasets.forEach((dataset) => {
					dataset.data.push(<{$graph.price}>);
				});
				myChart.update();
				export_data += '<{$graph.date}>' + ';' + <{$graph.price}> + '\n';
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
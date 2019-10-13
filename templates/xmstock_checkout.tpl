<div class="xmstock">
	<ol class="breadcrumb">
        <li><a href="index.php"><{$smarty.const._MA_XMSTOCK_HOME}></a></li>
        <li><a href="caddy.php"><{$smarty.const._MA_XMSTOCK_CADDY}></a></li>
		<li class="active"><{$smarty.const._MA_XMSTOCK_CHECKOUT}></li>
    </ol>	
	<{if $error_message != ''}>
		<div class="alert alert-danger" role="alert"><{$error_message}></div>	
	<{else}>	
		<h3><{$smarty.const._MA_XMSTOCK_CHECKOUT_SUMMARY}></h3>
		<table class="table table-striped">
			<tr>
				<th><{$smarty.const._MA_XMSTOCK_CADDY_ITMES}></th>
				<th class="width30"><{$smarty.const._MA_XMSTOCK_CADDY_AREA}></th>
				<th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_CADDY_QUANTITY}></th>
			</tr>
			<{foreach item=article from=$articles}>
				<tr>
					<td><{$article.name}></td>
					<td>
						<{$article.area}>				
					</td>       
					<td class="txtcenter width10">
						<{$article.qty}>
					</td>
				</tr>				
			<{/foreach}>
			<tr>
				<td class="txtright" colspan="2"><h3>Total</h3></td>
				<td class="txtcenter"><h3><{$total}></h3></td>
			</tr>		
		</table>
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
</div><!-- .xmstock -->
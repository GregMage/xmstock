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
		<table class="table table-striped">
			<tr>
				<th class="txtleft width40">titre</th>
				<th class="txtleft">info</th>
			</tr>
			<{foreach from=$request_arr key=title item=information}>
				<tr>
					<td class="txtleft"><{$title}></td>
					<td class="txtleft"><{$information}></td>
				</tr>
			<{/foreach}>
		</table>			
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
					<th class="txtcenter width10"><{$smarty.const._MA_XMSTOCK_CADDY_QUANTITY}></th>
				</tr>
				<{foreach item=article from=$articles}>
					<tr>
						<td>
							<{$article.name}>
							<{if $article.warning == true}>
								<span class="badge badge-pill badge-warning"><{$smarty.const._MA_XMSTOCK_WARNING}></span>
							<{/if}>
						</td>
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
			<{if $warning == true}>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<h4 class="alert-heading"><{$smarty.const._MA_XMSTOCK_WARNING}></h4>
					<p><{$smarty.const._MA_XMSTOCK_CHECKOUT_WARNINGQTY}></p>
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
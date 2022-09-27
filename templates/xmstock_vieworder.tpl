<div class="xmstock">
	<{if $opt|default:'' == 'man'}>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item"><a href="management.php?op=list"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_MANAGEMENT_VIEW}></li>
	  </ol>
	</nav>
	<{else}>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<li class="breadcrumb-item"><a href="order.php"><{$smarty.const._MA_XMSTOCK_ORDERS}></a></li>
		<{if $error_message|default:'' == ''}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_VIEWORDER}></li>
		<{/if}>
	  </ol>
	</nav>
	<{/if}>
	<{if $error_message|default:'' != ''}>
		<div class="alert alert-danger" role="alert"><{$error_message}></div>
	<{else}>
		<div class="row mb-2">
			<div class="col-md-12">
				<div class="card border border-primary">
					<div class="card-header bg-primary text-white">
						<div class="d-flex justify-content-between">
							<h3 class="mb-0 text-white"><{$smarty.const._MA_XMSTOCK_VIEWORDER_ORDER}><{$orderid}></h3>
							<div class="row align-items-center text-right">
								<div class="col">
									<span class="badge badge-secondary fa-lg text-primary ml-2"><small><{$status_icon}> <{$status_text}></small></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row border-bottom border-secondary mx-1 pl-1">
						<figure class="figure text-muted my-1 pr-2 text-center border-right border-secondary">
							  <span class="fa fa-calendar fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DATEORDER}>
							  <figcaption class="figure-caption text-center"><{$dorder}></figcaption>
						</figure>
						<figure class="figure text-muted my-1 pr-2 text-center border-right border-secondary">
							  <span class="fa fa-repeat fa-fw" aria-hidden="true"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DATEDESIRED}>
							  <figcaption class="figure-caption text-center"><{$ddesired}></figcaption>
						</figure>
						<figure class="figure text-muted my-1 pr-2 text-center border-right border-secondary">
							<{if $delivery == 1}>
								<span class="fa fa-truck fa-fw"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY}>
								<figcaption class="figure-caption text-center"> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY_DELIVERY}></figcaption>
							<{/if}>
							<{if $delivery == 0}>
								<span class="fa fa-industry fa-fw"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY}>
								<figcaption class="figure-caption text-center"><{$smarty.const._MA_XMSTOCK_ORDER_DELIVERY_WITHDRAWAL}></figcaption>
							<{/if}>
						</figure>
						<{if $status > 1 || $status ==0}>
						<figure class="figure text-muted my-1 pr-2 text-center border-right border-secondary">
							<{if $delivery == 1}>
								<span class="fa fa-long-arrow-right"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERY}>
								<figcaption class="figure-caption text-center"><{$ddelivery}></figcaption>
							<{/if}>
							<{if $delivery == 0}>
								<span class="fa fa-exchange"></span> <{$smarty.const._MA_XMSTOCK_ORDER_DATEWITHDRAWAL}>
								<figcaption class="figure-caption text-center"><{$ddelivery}></figcaption>
							<{/if}>
						</figure>
						<{/if}>
						<figure class="figure text-muted my-1 pr-2 text-center border-right border-secondary">
							  <span class="fa fa fa-user" aria-hidden="true"></span> <{$smarty.const._MA_XMSTOCK_MANAGEMENT_CUSTOMER}>
							  <figcaption class="figure-caption text-center"><{$user}></figcaption>
						</figure>
					</div>
					<div class="card-body">
						<p class="card-text mb-auto">
							<div class="row">
								<div class="col">
									<p>
									<{$description}>
									</p>
								</div>
							</div>
						</p>
						<{if $status != 1}>
							<h4><{$smarty.const._MA_XMSTOCK_ORDER_HISTORY}></h4>
							<div class="row">
								<div class="col-md-4 col-sm-8">
									<{$smarty.const._MA_XMSTOCK_ORDER_DATEVALIDATION}>
								</div>
								<div class="col-md-2 col-sm-4">
									<{$dvalidation}>
								</div>
								<{if $status > 2 || $status == 0}>
									<div class="col-md-4 col-sm-8">
										<{$smarty.const._MA_XMSTOCK_ORDER_DATEREADY}>
									</div>
									<div class="col-md-2 col-sm-4">
										<{$dready}>
									</div>
									<{if $status > 3 || $status == 0}>
										<div class="col-md-4 col-sm-8">
											<{if $delivery == 1}>
											<{$smarty.const._MA_XMSTOCK_ORDER_DATEDELIVERY_R}>
											<{else}>
											<{$smarty.const._MA_XMSTOCK_ORDER_DATEWITHDRAWAL_R}>
											<{/if}>
										</div>
										<div class="col-md-2 col-sm-4">
											<{$ddelivery_r}>
										</div>
									<{/if}>
									<{if $status == 0}>
										<div class="col-md-4 col-sm-8">
											<{$smarty.const._MA_XMSTOCK_ORDER_DATECANCELLATION}>
										</div>
										<div class="col-md-2 col-sm-4">
											<{$dcancellation}>
										</div>
									<{/if}>
								<{/if}>
							</div>
						<{/if}>
						<h4><{$smarty.const._MA_XMSTOCK_ORDER_ARTICLES}></h4>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col"><{$smarty.const._MA_XMSTOCK_VIEWORDER_ARTICLE}></th>
									<th class="text-center" scope="col"><{$smarty.const._MA_XMSTOCK_VIEWORDER_AMOUNT}></th>
								</tr>
							</thead>
							<tbody>
								<{foreach item=article from=$item}>
								<tr>
									<td>
										<a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?category_id=<{$article.cid}>&article_id=<{$article.id}>" title="<{$article.name}>" target="_blank">
											<{$article.name}>
										</a>
										(<{$article.reference}>)
									</td>
									<td class="text-center"><span class='badge badge-primary badge-pill'><{$article.amount}></span></td>
								</tr>
								<{/foreach}>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<{/if}>
</div><!-- .xmstock -->
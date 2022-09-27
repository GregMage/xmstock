<div class="xmstock">
    <{if $form|default:false}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item"><a href="management.php?op=list"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></a></li>
			<{if $op|default:'' == 'next'}>
				<{if $status|default:1 == 1}>
				<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ACTION_NEXT1}></li>
				<{/if}>
				<{if $status|default:1 == 2}>
				<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ACTION_NEXT2}></li>
				<{/if}>
				<{if $status|default:1 == 3}>
				<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ACTION_NEXT3}></li>
				<{/if}>
			<{else}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ACTION_EDIT}></li>
			<{/if}>
		  </ol>
		</nav>
		<{if $error_message|default:false}>
			<div class="alert alert-danger" role="alert"><{$error_message}></div>
		<{/if}>
		<{if $op|default:'' == 'next' || $op|default:'' == 'savenext'}>
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
					</div>
				</div>
			</div>
		</div>
		<{/if}>
		<{if $status|default:1 == 2}>
		<div class="alert alert-warning" role="alert">
			<{$smarty.const._MA_XMSTOCK_ACTION_WARNING_STATUS2}>
		</div>
		<{/if}>
        <{$form}>

    <{/if}>
</div><!-- .xmstock -->
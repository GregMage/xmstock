 <div class="xmstock">   
	<ol class="breadcrumb">
        <li><a href="index.php"><{$smarty.const._MA_XMSTOCK_HOME}></a></li>
        <li class="active"><{$name}></li>
    </ol>
	<div class="media">
		<div class="media-left">
			<a href="#">
			  <img class="media-object" src="<{$logo}>" alt="<{$name}>">
			</a>
		</div>
		<div class="media-body">
			<h4 class="media-heading"><{$name}> (<{$location}>)</h4>
			<{$description}>
		</div>
	</div>
	<br>
	<{$form}>
	<br>
	<{if $xmstock_viewarticles == true}>
		<ul class="list-group">
		<{foreach item=stock from=$stock}>
			<li class="list-group-item">
				<span class="xm-stock-general-bold"><a href="<{$xoops_url}>/modules/xmarticle/viewarticle.php?category_id=<{$stock.article_cid}>&article_id=<{$stock.article_id}>"><{$stock.name}></a></span> (<{$stock.reference}>)
				<span class="badge"><{$stock.amount}></span>
				<a href="<{$xoops_url}>/modules/xmstock/caddy.php?op=add&amp;article_id=<{$stock.article_id}>">
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> <{$smarty.const._MA_XMSTOCK_ORDER}></button>
				</a>
			</li>
		<{/foreach}>
		</ul>
		<{if $nav_menu}>
			<div class="floatright"><{$nav_menu}></div>
			<div class="clear spacer"></div>
		<{/if}>
	<{/if}>
</div><!-- .xmstock -->
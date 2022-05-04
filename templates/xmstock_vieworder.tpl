<div class="xmstock">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
		<li class="breadcrumb-item"><a href="order.php"><{$smarty.const._MA_XMSTOCK_ORDERS}></a></li>
		<{if $error_message|default:'' == ''}>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_VIEWORDER}></li>
		<{/if}>
	  </ol>
	</nav>
	
</div><!-- .xmstock -->
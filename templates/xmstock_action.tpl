<div class="xmstock">
    <{if $form|default:false}>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php"><{$index_module}></a></li>
			<li class="breadcrumb-item"><a href="management.php?op=list"><{$smarty.const._MA_XMSTOCK_MANAGEMENT}></a></li>
			<li class="breadcrumb-item active" aria-current="page"><{$smarty.const._MA_XMSTOCK_ACTION_EDIT}></li>
		  </ol>
		</nav>
		<{if $error_message|default:false}>
			<div class="alert alert-danger" role="alert"><{$error_message}></div>
		<{/if}>

            <{$form}>

    <{/if}>    
</div><!-- .xmstock -->
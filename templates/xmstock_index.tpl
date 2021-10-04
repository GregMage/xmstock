<div class="xmstock">
    <ol class="breadcrumb">
        <li class="active"><{$index_module}></li>
    </ol>
	<{if $area_count != 0}>
    <div class="xm-area row">
        <{foreach item=area from=$areas}>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 xm-area-list">
                <a class="btn btn-primary btn-md btn-block" title="<{$area.name}>"
                   href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$area.id}>">
                    <{$area.name}>
                </a>

                <a title="<{$area.name}>" href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$area.id}>" class="xm-area-image">
                    <img src="<{$area.logo}>" alt="<{$area.name}>">
                </a>

                <!-- area Description -->
                <div class="aligncenter">
                    <{if $area.description != ""}>
                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#xmDesc-<{$area.id}>">+</button>
                    <{else}>
                        <button class="btn btn-xs disabled" data-toggle="modal">+</button>
                    <{/if}>
                </div>

                <div class="modal fade" id="xmDesc-<{$area.id}>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h4 class="modal-title aligncenter"><{$area.name}></h4></div>
                            <div class="modal-body">
                                <{$area.description}>
								<div class="xm-area-location"><span class="glyphicon glyphicon-hdd" title="<{$smarty.const._MA_XMDOC_FORMDOC_DATE}>"></span>
									<{$smarty.const._MA_XMSTOCK_AREA_LOCATION}>: <{$area.location}>
								</div>
                            </div>
                            <div class="modal-footer">
                                <a title="<{$area.name}>" href="<{$xoops_url}>/modules/xmstock/viewarea.php?area_id=<{$area.id}>"
                                   class="pull-left btn btn-success">
                                    <{$area.totalarticle}>
                                </a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End area Description -->
            </div>
            <!-- .xm-area-list -->
        <{/foreach}>
    </div><!-- .xm-area -->
    <div class="clear spacer"></div>
    <{if $nav_menu}>
        <div class="floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
    <{else}>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <{$smarty.const._MA_XMSTOCK_ERROR_NOAREA}>
        </div>
    <{/if}>
</div><!-- .xmstock -->
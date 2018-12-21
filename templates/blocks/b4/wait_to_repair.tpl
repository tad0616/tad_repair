<dl>
  <{foreach item=data from=$block.content}>
    <dt style="font-size:12px;">
      <{$data.repair_date}> <{$data.unit_title}> <{$data.fixed_status}> <{$data.repair_status}>
    </dt>

	<dd>
      <span class="badge badge-success"><{$data.repair_name}></span>
      <a href="<{$xoops_url}>/modules/tad_repair/index.php?repair_sn=<{$data.repair_sn}>"><{$data.repair_title}></a>
    </dd>
  <{/foreach}>
</dl>

<a href="<{$xoops_url}>/modules/tad_repair/index.php" class="btn btn-sm btn-info pull-right">more...</a>
<div class="clearfix"></div>

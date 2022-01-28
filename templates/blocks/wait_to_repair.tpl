<ul class="vertical_menu">
    <{foreach item=data from=$block.content}>
        <li>
            <b style="font-size: 0.8em;">
                <{$data.repair_date}> <{$data.unit_title}> <{$data.repair_status}>
            </b>

            <div>
                <span class="badge badge-success"><{$data.repair_name}></span>
                <a href="<{$xoops_url}>/modules/tad_repair/index.php?repair_sn=<{$data.repair_sn}>"><{$data.repair_title}></a>
            </div>
        </li>
    <{/foreach}>
</ul>
<div class="text-right text-end">
    <a href="<{$xoops_url}>/modules/tad_repair/index.php" class="btn btn-sm btn-xs btn-info">more...</a>
</div>
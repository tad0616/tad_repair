<{if $block.content|default:false}>
    <ul class="vertical_menu">
        <{foreach from=$block.content item=data}>
            <li>
                <b style="font-size: 0.8em;">
                    <{$data.repair_date}> <{$data.unit_title}> <{$data.repair_status}>
                </b>

                <div>
                    <span class="badge badge-success bg-success"><{$data.repair_name}></span>
                    <a href="<{$xoops_url}>/modules/tad_repair/index.php?repair_sn=<{$data.repair_sn}>"><{$data.repair_title}></a>
                    <{if $data.repair_place|default:false}> (<{$data.repair_place}>)<{/if}>
                </div>
            </li>
        <{/foreach}>
    </ul>
    <div class="text-right text-end">
        <a href="<{$xoops_url}>/modules/tad_repair/index.php" class="btn btn-sm btn-xs btn-info">more...</a>
    </div>
<{/if}>
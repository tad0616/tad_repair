<{if $all_content|default:false}>
    <table class="table table-striped table-hover">
        <tr>
            <th><{$smarty.const._MA_TADREPAIR_UNIT_TITLE}></th>
            <th><{$smarty.const._MA_TADREPAIR_UNIT_ADMIN}></th>
            <th><{$smarty.const._TAD_FUNCTION}></th>
        </tr>

        <tbody>
            <{foreach from=$all_content item=unit}>
            <tr>
                <td><a href="../index.php?unit_sn=<{$unit.unit_sn}>"><{$unit.unit_title}></a></td>
                <td><{$unit.unit_admin_list}></td>
                <td>
            <a href="unit.php?op=tad_repair_unit_form&unit_sn=<{$unit.unit_sn}>" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>  <{$smarty.const._TAD_EDIT}></a>
            <a href="javascript:delete_tad_repair_unit_func(<{$unit.unit_sn}>);" class="btn btn-sm btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
            </td>
            </tr>
            <{/foreach}>
        </tbody>

    </table>
<{/if}>

<div class="text-center">
    <a href="unit.php?op=tad_repair_unit_form" class="btn btn-info"><i class="fa fa-square-plus" aria-hidden="true"></i>  <{$smarty.const._TAD_ADD}></a>
</div>

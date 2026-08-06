<{if $all_content|default:false}>

    <table id="repair_list" data-classes="table table-striped table-hover" data-pagination="false" data-search="false" data-show-refresh="false" data-toggle="table" data-mobile-responsive="true" data-thead-classes="thead-style">
        <caption class="sr-only visually-hidden"><{$smarty.const._MA_TAD_RE_UNIT_FORM|default:'Unit List'}></caption>
        <thead>
            <tr>
                <th scope="col"><{$smarty.const._MA_TADREPAIR_UNIT_TITLE}></th>
                <th scope="col"><{$smarty.const._MA_TADREPAIR_UNIT_ADMIN}></th>
                <th scope="col"><{$smarty.const._TAD_FUNCTION}></th>
            </tr>
        </thead>

        <tbody>
            <{foreach from=$all_content item=unit}>
            <tr>
                <td><a href="../index.php?unit_sn=<{$unit.unit_sn}>"><{$unit.unit_title}></a></td>
                <td><{$unit.unit_admin_list}></td>
                <td>
            <a href="unit.php?op=tad_repair_unit_form&unit_sn=<{$unit.unit_sn}>" class="btn btn-sm btn-xs btn-warning" aria-label="<{$smarty.const._TAD_EDIT}> <{$unit.unit_title}>"><i class="fa fa-pencil" aria-hidden="true"></i>  <{$smarty.const._TAD_EDIT}></a>
            <a href="javascript:delete_tad_repair_unit_func(<{$unit.unit_sn}>);" class="btn btn-sm btn-xs btn-danger" aria-label="<{$smarty.const._TAD_DEL}> <{$unit.unit_title}>"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
            </td>
            </tr>
            <{/foreach}>
        </tbody>

    </table>
<{/if}>

<div class="text-center">
    <a href="unit.php?op=tad_repair_unit_form" class="btn btn-info" aria-label="<{$smarty.const._TAD_ADD}>"><i class="fa fa-square-plus" aria-hidden="true"></i>  <{$smarty.const._TAD_ADD}></a>
</div>

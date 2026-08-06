
<{if $all_content|default:false}>

    <table id="repair_list" data-classes="table table-striped table-hover" data-pagination="false" data-search="false" data-show-refresh="false" data-toggle="table" data-mobile-responsive="true" data-thead-classes="thead-style">
    <caption class="sr-only visually-hidden">Admin Repair List</caption>
    <thead>
    <tr>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_REPAIR_SN}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_REPAIR_DATE}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_REPAIR_TITLE}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_REPAIR_UID}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_UNIT}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_REPAIR_STATUS2}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_FIXED_UID}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_FIXED_DATE}></th>
        <th nowrap scope="col"><{$smarty.const._MA_TADREPAIR_FIXED_STATUS2}></th>
        <th scope="col"><{$smarty.const._TAD_FUNCTION}></th>
    </tr>
    </thead>

    <tbody>
    <{foreach from=$all_content item=repair}>
        <tr>
        <td><{$repair.repair_sn}></td>
        <td><{$repair.repair_date}></td>
        <td><{$repair.prefix}><a href="../index.php?repair_sn=<{$repair.repair_sn}>"><{$repair.repair_title}></a></td>
        <td nowrap><{$repair.repair_name}></td>
        <td nowrap><{$repair.unit_title}></td>
        <td nowrap><{$repair.repair_status}></td>
        <td nowrap><{$repair.fixed_name}></td>
        <td><{$repair.fixed_date}></td>
        <td nowrap><{$repair.fixed_status}></td>
        <td>
            <a href="javascript:delete_tad_repair_func(<{$repair.repair_sn}>);" class="btn btn-sm btn-xs btn-danger" aria-label="<{$smarty.const._TAD_DEL}> <{$repair.repair_title}>"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
        </td>
        </tr>
    <{/foreach}>
    </tbody>

    <tfoot>
    <tr>
        <td colspan=12 class="bar">
        <{$bar|default:''}>
        </td>
    </tr>
    </tfoot>
    </table>
<{else}>
    <div class="jumbotron bg-light p-5 rounded-lg m-3">
    <{$smarty.const._MA_TADREPAIR_EMPTY}>
    </div>
<{/if}>
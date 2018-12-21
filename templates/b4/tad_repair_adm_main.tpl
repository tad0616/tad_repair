<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<div class="container-fluid">
  <{if $all_content}>
    <script>
    function delete_tad_repair_func(repair_sn){
      var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
      if (!sure)  return;
      location.href="main.php?op=delete_tad_repair&repair_sn=" + repair_sn;
    }
    </script>

    <table class="table table-striped table-hover">
      <tr>
        <th nowrap><{$smarty.const._MA_TADREPAIR_REPAIR_SN}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_REPAIR_DATE}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_REPAIR_TITLE}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_REPAIR_UID}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_UNIT}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_REPAIR_STATUS2}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_FIXED_UID}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_FIXED_DATE}></td>
        <th nowrap><{$smarty.const._MA_TADREPAIR_FIXED_STATUS2}></td>
        <th><{$smarty.const._TAD_FUNCTION}></td>
      </tr>

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
            <a href="javascript:delete_tad_repair_func(<{$repair.repair_sn}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
          </td>
        </tr>
      <{/foreach}>
      </tbody>

      <tr>
        <td colspan=12 class="bar">
        <{$bar}>
        </td>
      </tr>
    </table>
  <{else}>
    <div class="jumbotron">
      <{$smarty.const._MA_TADREPAIR_EMPTY}>
    </div>
  <{/if}>
</div>
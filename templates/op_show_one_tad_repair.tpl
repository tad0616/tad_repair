<{$modify_link|default:''}>

<h2>[<{$repair_sn|default:''}>] <{$smarty.const._MD_TADREPAIR_FIXED_NOTICE}></h2>

<table class="table table-striped table-bordered table-hover">
    <tr>
      <th nowrap style="width:80px;">
        <{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>
      </th>
      <td>
        <{$repair_title|default:''}>
      </td>
    </tr>

      <{if 'repair_place'|in_array:$unuse_cols}>
      <{else}>
        <tr>
          <th>
            <{$smarty.const._MD_TADREPAIR_PLACE}>
          </th>
          <td>
            <{$repair_place|default:''}>
          </td>
        </tr>
      <{/if}>


    <tr>
      <th nowrap>
        <{$smarty.const._MD_TADREPAIR_REPAIR_DATE}>
      </th>
      <td>
        <{$repair_date|default:''}>
      </td>
    </tr>

    <{if 'repair_status'|in_array:$unuse_cols}>
    <{else}>
      <tr>
        <th nowrap>
          <{$smarty.const._MD_TADREPAIR_REPAIR_STATUS}>
        </th>
        <td>
          <{$repair_status|default:''}>
        </td>
      </tr>
    <{/if}>


    <tr>
      <th nowrap>
        <{$smarty.const._MD_TADREPAIR_REPAIR_UID}>
      </th>
      <td>
        <{$repair_name|default:''}>
      </td>
    </tr>
    <tr>
      <th nowrap>
        <{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT}>
      </th>
      <td>
        <{$repair_content|default:''}>
      </td>
    </tr>
    <tr>
      <th nowrap>
        <{$smarty.const._MD_TADREPAIR_IMG}>
      </th>
      <td>
        <{$show_files|default:''}>
      </td>
    </tr>
  </table>


<{$fixed_link|default:''}>
<h2><{$smarty.const._MD_TADREPAIR_FIXED_STATUS}></h2>

<table class="table table-striped table-bordered table-hover">
  <tr><th nowrap style="width:80px;"><{$smarty.const._MD_TADREPAIR_FIXED_UNIT_SN}></th><td>
    <{if $fixed_link and $fixed_uid==''}>
      <form action="index.php" method="post">
        <select name="new_unit_sn" id="new_unit_sn">
          <{foreach from=$unit_menu key=sn item=title}>
            <option value="<{$sn|default:''}>" <{if $unit_sn==$sn}>selected<{/if}>><{$title|default:''}></option>
          <{/foreach}>
        </select>
        <input type="hidden" name="repair_sn" value="<{$repair_sn|default:''}>">
        <input type="hidden" name="unit_sn" value="<{$unit_sn|default:''}>">
        <button type="submit" name="op" value="move_to_unit" class="btn btn-warning btn-sm btn-xs"><{$smarty.const._MD_TADREPAIR_CHANGE_DEPARTMENT}></button>
      </form>
    <{else}>
      <{$unit_title|default:''}>
    <{/if}>
  </td></tr>
  <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_STATUS}></th><td><{$fixed_status|default:''}></td></tr>
  <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_CONTENT}></th><td><{$fixed_content|default:''}></td></tr>
  <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_DATE}></th><td><{$fixed_date|default:''}></td></tr>
  <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_UID}></th><td><{$fixed_name|default:''}></td></tr><tr>
  <th nowrap>
    <{$smarty.const._MD_TADREPAIR_IMG}>
  </th>
  <td>
    <{$show_fixed|default:''}>
  </td>
</tr>
</table>
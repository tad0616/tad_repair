<{$toolbar}>

<{if $now_op=="show_one"}>

    <{$modify_link}>

    <h2>[<{$repair_sn}>] <{$smarty.const._MD_TADREPAIR_FIXED_NOTICE}></h2>

      <table class="table table-striped table-bordered table-hover">
        <tr>
          <th nowrap style="width:80px;">
            <{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>
          </th>
          <td>
            <{$repair_title}>
          </td>
        </tr>

          <{if 'repair_place'|in_array:$unuse_cols}>
          <{else}>
            <tr>
              <th>
                <{$smarty.const._MD_TADREPAIR_PLACE}>
              </th>
              <td>
                <{$repair_place}>
              </td>
            </tr>
          <{/if}>


        <tr>
          <th nowrap>
            <{$smarty.const._MD_TADREPAIR_REPAIR_DATE}>
          </th>
          <td>
            <{$repair_date}>
          </td>
        </tr>

        <{if 'repair_status'|in_array:$unuse_cols}>
        <{else}>
          <tr>
            <th nowrap>
              <{$smarty.const._MD_TADREPAIR_REPAIR_STATUS}>
            </th>
            <td>
              <{$repair_status}>
            </td>
          </tr>
        <{/if}>


        <tr>
          <th nowrap>
            <{$smarty.const._MD_TADREPAIR_REPAIR_UID}>
          </th>
          <td>
            <{$repair_name}>
          </td>
        </tr>
        <tr>
          <th nowrap>
            <{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT}>
          </th>
          <td>
            <{$repair_content}>
          </td>
        </tr>
        <tr>
          <th nowrap>
            <{$smarty.const._MD_TADREPAIR_IMG}>
          </th>
          <td>
            <{$show_files}>
          </td>
        </tr>
      </table>


    <{$fixed_link}>
    <h2><{$smarty.const._MD_TADREPAIR_FIXED_STATUS}></h2>

    <table class="table table-striped table-bordered table-hover">
      <tr><th nowrap style="width:80px;"><{$smarty.const._MD_TADREPAIR_FIXED_UNIT_SN}></th><td>
        <{if $fixed_link and $fixed_uid==''}>
          <form action="index.php" method="post">
            <select name="new_unit_sn" id="new_unit_sn">
              <{foreach from=$unit_menu key=sn item=title}>
                <option value="<{$sn}>" <{if $unit_sn==$sn}>selected<{/if}>><{$title}></option>
              <{/foreach}>
            </select>
            <input type="hidden" name="repair_sn" value="<{$repair_sn}>">
            <input type="hidden" name="unit_sn" value="<{$unit_sn}>">
            <button type="submit" name="op" value="move_to_unit" class="btn btn-warning btn-sm btn-xs"><{$smarty.const._MD_TADREPAIR_CHANGE_DEPARTMENT}></button>
          </form>
        <{else}>
          <{$unit_title}>
        <{/if}>
      </td></tr>
      <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_STATUS}></th><td><{$fixed_status}></td></tr>
      <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_CONTENT}></th><td><{$fixed_content}></td></tr>
      <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_DATE}></th><td><{$fixed_date}></td></tr>
      <tr><th nowrap><{$smarty.const._MD_TADREPAIR_FIXED_UID}></th><td><{$fixed_name}></td></tr><tr>
      <th nowrap>
        <{$smarty.const._MD_TADREPAIR_IMG}>
      </th>
      <td>
        <{$show_fixed}>
      </td>
    </tr>
    </table>
<{/if}>

<{if $now_op=="list_tad_repair"}>
  <{$FooTableJS}>
  <h2 class="sr-only visually-hidden">List Repair</h2>

  <div class="row">
    <div class="col-sm-6">
      <form action="index.php" method="get" id="myForm" class="form-horizontal"  role="form">
        <div class="form-group row mb-3">
          <div class="col-sm-6">
            <{html_options name='unit_menu_sn' title='select unit' options=$unit_menu  selected=$def_unit_menu_sn  class="form-control" onchange="submit();"}>
          </div>
          <div class="col-sm-6">
            <{html_options name='fixed_status' title='select status' options=$fixed_status_list selected=$def_fixed_status  class="form-control" onchange="submit();"}>
          </div>
        </div>
      </form>
    </div>

    <div class="col-sm-6">
      <form action="excel.php" method="post" class="form-horizontal" role="form">
        <div class="form-group row mb-3">
          <div class="col-sm-6">
            <select name="ym" class="form-control" title="select year">
              <{foreach item=report from=$repair_ym}>
                <option value="<{$report.ym}>"><{$report.ym}></option>
              <{/foreach}>
            </select>
          </div>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><{$smarty.const._MD_TADREPAIR_DL_REPORT}></button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <{if $content|default:false}>

    <div class="row">
      <div class="col-sm-12">
        <table class="table table-striped table-hover footable">
          <thead>
          <tr>
            <{if 'repair_date'|in_array:$show_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_REPAIR_DATE}></th>
            <{/if}>
              <th nowrap data-class="expand"><{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}></th>

            <{if 'repair_place'|in_array:$unuse_cols}>
            <{elseif 'repair_place'|in_array:$show_cols and 'repair_place'|in_array:$unuse_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_PLACE}></th>
            <{/if}>

            <{if 'repair_uid'|in_array:$show_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_REPAIR_UID}></th>
            <{/if}>
            <{if 'unit_sn'|in_array:$show_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_UNIT}></th>
            <{/if}>


            <{if 'repair_status'|in_array:$unuse_cols}>
            <{elseif 'repair_status'|in_array:$show_cols and 'repair_status'|in_array:$unuse_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_REPAIR_STATUS2}></th>
            <{/if}>

            <{if 'fixed_uid'|in_array:$show_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_FIXED_UID}></th>
            <{/if}>
            <{if 'fixed_date'|in_array:$show_cols}>
              <th nowrap data-hide="phone"><{$smarty.const._MD_TADREPAIR_FIXED_DATE}></th>
            <{/if}>
            <{if 'fixed_status'|in_array:$show_cols}>
              <th><{$smarty.const._MD_TADREPAIR_FIXED_STATUS2}></th>
            <{/if}>

          </tr>
          </thead>

          <tbody>
          <{foreach item=repair from=$content}>
            <tr>
            <{if 'repair_date'|in_array:$show_cols}>
              <td nowrap><{$repair.repair_date}></td>
            <{/if}>
              <td><span class="badge badge-success bg-success"><{$repair.repair_sn}></span> <{$repair.repair_title}></a></td>

            <{if 'repair_place'|in_array:$unuse_cols}>
            <{elseif 'repair_place'|in_array:$show_cols and 'repair_place'|in_array:$unuse_cols}>
              <td nowrap><{$repair.repair_place}></td>
            <{/if}>
            <{if 'repair_uid'|in_array:$show_cols}>
              <td nowrap><{$repair.repair_name}></td>
            <{/if}>
            <{if 'unit_sn'|in_array:$show_cols}>
              <td nowrap><{$repair.unit_title}></td>
            <{/if}>


            <{if 'repair_status'|in_array:$unuse_cols}>
            <{elseif 'repair_status'|in_array:$show_cols and 'repair_status'|in_array:$unuse_cols}>
              <td nowrap><{$repair.repair_status}></td>
            <{/if}>

            <{if 'fixed_uid'|in_array:$show_cols}>
              <td nowrap><{$repair.fixed_name}></td>
            <{/if}>
            <{if 'fixed_date'|in_array:$show_cols}>
              <td nowrap><{$repair.fixed_date}></td>
            <{/if}>
            <{if 'fixed_status'|in_array:$show_cols}>
              <td nowrap><{$repair.fixed_status}></td>
            <{/if}>
            </tr>
          <{/foreach}>
          </tbody>
        </table>
      </div>
    </div>

    <div class="text-center">
      <{$add_button}>
      <{$bar}>
    </div>

  <{else}>
    <div class="jumbotron bg-light p-5 rounded-lg m-3">
      <{$smarty.const._MD_TADREPAIR_EMPTY}>
    </div>

  <{/if}>
<{/if}>

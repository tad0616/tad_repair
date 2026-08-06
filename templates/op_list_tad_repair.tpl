<{$FooTableJS|default:''}>
<h2 class="sr-only visually-hidden">List Repair</h2>

<div class="row">
  <div class="col-sm-6">
    <form action="index.php" method="get" id="myForm" class="form-horizontal"  role="form">
      <div class="form-group row mb-3">
        <div class="col-sm-6">
          <label for="unit_menu_sn" id="select_hint_unit_menu_sn" class="sr-only visually-hidden"><{$smarty.const._MD_TADREPAIR_JUMP_TO}><{$smarty.const._MD_TADREPAIR_UNIT_SN}></label>
          <{html_options id='unit_menu_sn' aria-describedby="select_hint_unit_menu_sn" name='unit_menu_sn' title="`$smarty.const._MD_TADREPAIR_JUMP_TO``$smarty.const._MD_TADREPAIR_UNIT_SN`" options=$unit_menu  selected=$def_unit_menu_sn  class="form-control form-select" onchange="submit();"}>
        </div>
        <div class="col-sm-6">
          <label for="fixed_status" id="select_hint_fixed_status" class="sr-only visually-hidden"><{$smarty.const._MD_TADREPAIR_JUMP_TO}><{$smarty.const._MD_TADREPAIR_FIXED_STATUS}></label>
          <{html_options id='fixed_status' aria-describedby="select_hint_fixed_status" name='fixed_status' title="`$smarty.const._MD_TADREPAIR_JUMP_TO``$smarty.const._MD_TADREPAIR_FIXED_STATUS`" options=$fixed_status_list selected=$def_fixed_status  class="form-control form-select" onchange="submit();"}>
        </div>
      </div>
    </form>
  </div>

  <div class="col-sm-6">
    <form action="excel.php" method="post" class="form-horizontal" role="form">
      <div class="form-group row mb-3">
        <div class="col-sm-6">
          <label for="ym" id="select_hint_ym" class="sr-only visually-hidden"><{$smarty.const._MD_TADREPAIR_JUMP_TO}><{$smarty.const._MD_TADREPAIR_REPORT}></label>
          <select id="ym" aria-describedby="select_hint_ym" name="ym" class="form-control form-select" title="<{$smarty.const._MD_TADREPAIR_JUMP_TO}><{$smarty.const._MD_TADREPAIR_REPORT}>">
            <{foreach item=report from=$repair_ym}>
              <option value="<{$report.ym}>"><{$report.ym}></option>
            <{/foreach}>
          </select>
        </div>
        <{if $xoops_isuser}>
        <div class="col-sm-6">
          <button type="submit" class="btn btn-primary"><{$smarty.const._MD_TADREPAIR_DL_REPORT}></button>
        </div>
        <{/if}>
      </div>
    </form>
  </div>
</div>

<{if $content|default:false}>

  <div class="row">
    <div class="col-sm-12">

      <table id="repair_list" data-classes="table table-striped table-hover" data-pagination="false" data-search="false" data-show-refresh="false" data-toggle="table" data-mobile-responsive="true" data-thead-classes="thead-style">
        <caption class="sr-only visually-hidden"><{$smarty.const._MD_TADREPAIR_HOME}></caption>
        <thead>
        <tr>
          <{if 'repair_date'|in_array:$show_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_REPAIR_DATE}></th>
          <{/if}>
            <th nowrap data-class="expand" scope="col"><{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}></th>

          <{if 'repair_place'|in_array:$unuse_cols}>
          <{elseif 'repair_place'|in_array:$show_cols and 'repair_place'|in_array:$unuse_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_PLACE}></th>
          <{/if}>

          <{if 'repair_uid'|in_array:$show_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_REPAIR_UID}></th>
          <{/if}>
          <{if 'unit_sn'|in_array:$show_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_UNIT}></th>
          <{/if}>


          <{if 'repair_status'|in_array:$unuse_cols}>
          <{elseif 'repair_status'|in_array:$show_cols and 'repair_status'|in_array:$unuse_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_REPAIR_STATUS2}></th>
          <{/if}>

          <{if 'fixed_uid'|in_array:$show_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_FIXED_UID}></th>
          <{/if}>
          <{if 'fixed_date'|in_array:$show_cols}>
            <th nowrap data-hide="phone" scope="col"><{$smarty.const._MD_TADREPAIR_FIXED_DATE}></th>
          <{/if}>
          <{if 'fixed_status'|in_array:$show_cols}>
            <th scope="col"><{$smarty.const._MD_TADREPAIR_FIXED_STATUS2}></th>
          <{/if}>

        </tr>
        </thead>

        <tbody>
        <{foreach item=repair from=$content}>
          <tr>
          <{if 'repair_date'|in_array:$show_cols}>
            <td nowrap><{$repair.repair_date}></td>
          <{/if}>
            <td><span class="badge badge-success bg-success"><{$repair.repair_sn}></span> <{$repair.repair_title}></td>

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
    <{$add_button|default:''}>
    <{$bar|default:''}>
  </div>

<{else}>
  <div class="jumbotron bg-light p-5 rounded-lg m-3">
    <{$smarty.const._MD_TADREPAIR_EMPTY}>
  </div>

<{/if}>
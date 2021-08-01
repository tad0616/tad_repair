<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<div class="container-fluid">

  <{if $op=="tad_repair_unit_form"}>

    <h3><{$smarty.const._MA_TAD_REPAIR_UNIT_FORM}></h3>

    <script type="text/javascript" src="<{$xoops_url}>/modules/tad_repair/class/tmt_core.js"></script>
    <script type="text/javascript" src="<{$xoops_url}>/modules/tad_repair/class/tmt_spry_linkedselect.js"></script>
    <script type="text/javascript">
    function getOptions()
      {
      var x=document.getElementById("destination");
      txt="";
      for (i=0;i<x.length;i++)
        {
        txt=txt + "," + x.options[i].value;
        }
      document.getElementById("unit_admin").value=txt;
      }
    </script>
    <form action="unit.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
      <div class="form-group row">
        <div class="col-sm-9">
          <!--單位名稱-->
          <input type="text" name="unit_title" value="<{$unit_title}>" id="unit_title" class="form-control validate[required]" placeholder="<{$smarty.const._MA_TADREPAIR_UNIT_TITLE}>">
        </div>
      </div>


      <!--管理人員-->
      <h3><{$smarty.const._MA_TADREPAIR_UNIT_ADMIN}></h3>

      <div class="row">
        <div class="col-sm-4">
          <select name="repository" id="repository" size="12" multiple="multiple" tmt:linkedselect="true" class="form-control">
            <{$option}>
          </select>
        </div>
        <div class="col-sm-1 text-center">
          <img src="../images/right.png" onclick="tmt.spry.linkedselect.util.moveOptions('repository', 'destination');getOptions();"><br>
          <img src="../images/left.png" onclick="tmt.spry.linkedselect.util.moveOptions('destination' , 'repository');getOptions();"><br><br>

          <img src="../images/up.png" onclick="tmt.spry.linkedselect.util.moveOptionUp('destination');getOptions();"><br>
          <img src="../images/down.png" onclick="tmt.spry.linkedselect.util.moveOptionDown('destination');getOptions();">

          <!--單位編號-->
          <div class="text-center" style="margin-top: 20px;">
            <input type="hidden" name="unit_sn" value="<{$unit_sn}>">
            <input type="hidden" name="op" value="<{$next_op}>">
            <input type="hidden" name="unit_admin" id="unit_admin" value=",<{$unit_admin}>">
            <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
          </div>
        </div>

        <div class="col-sm-4">
          <select id="destination" size="12" multiple="multiple" tmt:linkedselect="true" class="form-control">
           <{$option2}>
          </select>
        </div>
      </div>
    </form>
  <{else}>
    <{if $all_content}>
    <script type="text/javascript">
    function delete_tad_repair_unit_func(unit_sn){
      var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
      if (!sure)  return;
      location.href="unit.php?op=delete_tad_repair_unit&unit_sn=" + unit_sn;
    }
    </script>

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
      <a href="unit.php?op=tad_repair_unit_form&unit_sn=<{$unit.unit_sn}>" class="btn btn-sm btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
      <a href="javascript:delete_tad_repair_unit_func(<{$unit.unit_sn}>);" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
      </td>
      </tr>
    <{/foreach}>
    </tbody>

    </table>
    <{/if}>

    <div class="text-center">
      <a href="unit.php?op=tad_repair_unit_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    </div>

  <{/if}>

</div>
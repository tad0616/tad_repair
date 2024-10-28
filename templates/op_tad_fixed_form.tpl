<h2><{$fixed_form_title|default:''}></h2>

<table class="table table-striped table-bordered table-hover">
  <!--報修內容-->
  <tr><th nowrap style="width:80px;"><{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}></th>
  <td><{$repair_title|default:''}></td></tr>

  <!--詳細說明-->
  <tr><th><{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT}></th>
  <td><{$repair_content|default:''}></td></tr>

  <!--嚴重程度-->
  <tr><th><{$smarty.const._MD_TADREPAIR_REPAIR_STATUS}></th>
  <td>
  <{$repair_status|default:''}>
  </td></tr>

  <!--通知單位-->
  <tr><th><{$smarty.const._MD_TADREPAIR_UNIT_SN}></th>
  <td><{$unit_title|default:''}>
  </td></tr>
</table>

<form action="repair.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
  <!--回覆內容-->
  <div class="form-group row mb-3">
    <div class="col-sm-12">
    <textarea name="fixed_content" class="form-control" rows=4 id="fixed_content" placeholder="<{$smarty.const._MD_TADREPAIR_FIXED_CONTENT}>" ><{$fixed_content|default:''}></textarea>
    </div>
  </div>

  <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right  text-sm-end control-label">
      <{$smarty.const._MD_TADREPAIR_IMG}>
    </label>
    <div class="col-sm-10">
      <{$upform|default:''}>
    </div>
  </div>

  <!--處理狀況-->
  <div class="form-group row mb-3">

    <label class="col-sm-2 col-form-label text-sm-right  text-sm-end control-label">
      <{$smarty.const._MD_TADREPAIR_FIXED_STATUS}>
    </label>
    <div class="col-sm-4">
      <select name="fixed_status" size=1 class="form-select">
        <{$fixed_status|default:''}>
      </select>
    </div>
    <div class="col-sm-6">
      <input type="hidden" name="repair_sn" value="<{$repair_sn|default:''}>">
      <input type="hidden" name="op" value="update_tad_fixed">
      <button type="submit" class="btn btn-primary"><{$smarty.const._SUBMIT}></button>
    </div>
  </div>
</form>
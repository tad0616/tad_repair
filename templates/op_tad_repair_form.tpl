<h2><{$repair_form_title|default:''}></h2>
<form action="repair.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">

  <div class="row">
    <div class="col-sm-8">
      <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label text-sm-right  text-sm-end control-label">
          <{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>
        </label>
        <div class="col-sm-10">
        <{if 'repair_content'|in_array:$unuse_cols}>
          <textarea name="repair_title" rows=4 class="form-control validate[required] col-sm-12" id="repair_title" placeholder="<{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>"><{$repair_title|default:''}></textarea>
        <{else}>
          <input type="text" name="repair_title" placeholder="<{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>" value="<{$repair_title|default:''}>" id="repair_title" class="form-control validate[required]">
        <{/if}>
        </div>
      </div>

      <{if 'repair_content'|in_array:$unuse_cols}>
      <{else}>
        <div class="form-group row mb-3">
          <label class="col-sm-2 col-form-label text-sm-right  text-sm-end control-label">
            <{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT}>
          </label>
          <div class="col-sm-10">
            <textarea name="repair_content" rows=4 class="form-control validate[required] col-sm-12" id="repair_content" placeholder="<{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT_PRETEXT}>"><{$repair_content|default:''}></textarea>
          </div>
        </div>
      <{/if}>



      <div class="form-group row mb-3">
        <label class="col-sm-2 col-form-label text-sm-right  text-sm-end control-label">
          <{$smarty.const._MD_TADREPAIR_IMG}>
        </label>
        <div class="col-sm-10">
          <{$upform|default:''}>
        </div>
      </div>

    </div>
    <div class="col-sm-4">

      <{if 'repair_place'|in_array:$unuse_cols}>
      <{else}>
        <!--地點-->
        <div class="form-group row mb-3">
          <label class="col-sm-4 col-form-label text-sm-right  text-sm-end control-label">
            <{$smarty.const._MD_TADREPAIR_PLACE}>
          </label>
          <div class="col-sm-8">
            <input type="text" name="repair_place" placeholder="<{$smarty.const._MD_TADREPAIR_PLACE}>" value="<{$repair_place|default:''}>" id="repair_place" class="form-control validate[required]">
          </div>
        </div>
      <{/if}>


      <!--通知單位-->
      <div class="form-group row mb-3">
        <label class="col-sm-4 col-form-label text-sm-right  text-sm-end control-label">
          <{$smarty.const._MD_TADREPAIR_UNIT_SN}>
        </label>
        <div class="col-sm-8">
          <select name="unit_sn" size=1 class="form-control form-select">
            <{$unit_sn_menu_options|default:''}>
          </select>
        </div>
      </div>

      <{if 'repair_status'|in_array:$unuse_cols}>
      <{else}>
        <!--嚴重程度-->
        <div class="form-group row mb-3">
          <label class="col-sm-4 col-form-label text-sm-right  text-sm-end control-label">
            <{$smarty.const._MD_TADREPAIR_REPAIR_STATUS}>
          </label>
          <div class="col-sm-8">
            <select name="repair_status" size=1 class="form-control form-select">
              <{$repair_status|default:''}>
            </select>
          </div>
        </div>
      <{/if}>


      <div class="row text-center">
        <input type="hidden" name="repair_sn" value="<{$repair_sn|default:''}>">
        <input type="hidden" name="op" value="<{$op|default:''}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._SUBMIT}></button>
      </div>

    </div>
  </div>
</form>

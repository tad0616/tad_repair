<{$toolbar}>

<{if $mode=="repair_form"}>
  <h2><{$repair_form_title}></h2>
  <form action="repair.php" method="post" id="myForm" enctype="multipart/form-data" role="form">

    <div class="row">
      <div class="col-sm-8">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>
          </label>
          <div class="col-sm-10">
            <input type="text" name="repair_title" placeholder="<{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}>" value="<{$repair_title}>" id="repair_title" class="form-control validate[required]">
          </div>
        </div>

        <{if 'repair_status'|in_array:$unuse_cols}>
        <{else}>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label text-sm-right">
              <{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT}>
            </label>
            <div class="col-sm-10">
              <textarea name="repair_content" rows=4 class="form-control validate[required] col-sm-12" id="repair_content" placeholder="<{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT_PRETEXT}>"><{$repair_content}></textarea>
            </div>
          </div>
        <{/if}>



        <div class="form-group row">
          <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_TADREPAIR_IMG}>
          </label>
          <div class="col-sm-10">
            <{$upform}>
          </div>
        </div>

      </div>
      <div class="col-sm-4">

        <{if 'repair_place'|in_array:$unuse_cols}>
        <{else}>
          <!--地點-->
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-sm-right">
              <{$smarty.const._MD_TADREPAIR_PLACE}>
            </label>
            <div class="col-sm-8">
              <input type="text" name="repair_place" placeholder="<{$smarty.const._MD_TADREPAIR_PLACE}>" value="<{$repair_place}>" id="repair_place" class="form-control validate[required]">
            </div>
          </div>
        <{/if}>


        <!--通知單位-->
        <div class="form-group row">
          <label class="col-sm-4 col-form-label text-sm-right">
            <{$smarty.const._MD_TADREPAIR_UNIT_SN}>
          </label>
          <div class="col-sm-8">
            <select name="unit_sn" size=1 class="form-control">
              <{$unit_sn_menu_options}>
            </select>
          </div>
        </div>

        <{if 'repair_status'|in_array:$unuse_cols}>
        <{else}>
          <!--嚴重程度-->
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-sm-right">
              <{$smarty.const._MD_TADREPAIR_REPAIR_STATUS}>
            </label>
            <div class="col-sm-8">
              <select name="repair_status" size=1 class="form-control">
                <{$repair_status}>
              </select>
            </div>
          </div>
        <{/if}>


        <div class="row text-center">
          <input type="hidden" name="repair_sn" value="<{$repair_sn}>">
          <input type="hidden" name="op" value="<{$op}>">
          <button type="submit" class="btn btn-primary"><{$smarty.const._SUBMIT}></button>
        </div>

      </div>
    </div>
  </form>

<{else}>
  <h2><{$fixed_form_title}></h2>

  <table class="table table-striped table-bordered table-hover">
    <!--報修內容-->
    <tr><th nowrap style="width:80px;"><{$smarty.const._MD_TADREPAIR_REPAIR_TITLE}></th>
    <td><{$repair_title}></td></tr>

    <!--詳細說明-->
    <tr><th><{$smarty.const._MD_TADREPAIR_REPAIR_CONTENT}></th>
    <td><{$repair_content}></td></tr>

    <!--嚴重程度-->
    <tr><th><{$smarty.const._MD_TADREPAIR_REPAIR_STATUS}></th>
    <td>
    <{$repair_status}>
    </td></tr>

    <!--通知單位-->
    <tr><th><{$smarty.const._MD_TADREPAIR_UNIT_SN}></th>
    <td><{$unit_title}>
    </td></tr>
  </table>

  <form action="repair.php" method="post" id="myForm" enctype="multipart/form-data" role="form">
    <!--回覆內容-->
    <div class="form-group row">
      <div class="col-sm-12">
      <textarea name="fixed_content" class="form-control" rows=4 id="fixed_content" placeholder="<{$smarty.const._MD_TADREPAIR_FIXED_CONTENT}>" ><{$fixed_content}></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label text-sm-right">
        <{$smarty.const._MD_TADREPAIR_IMG}>
      </label>
      <div class="col-sm-10">
        <{$upform}>
      </div>
    </div>

    <!--處理狀況-->
    <div class="form-group row">

      <label class="col-sm-2 col-form-label text-sm-right">
        <{$smarty.const._MD_TADREPAIR_FIXED_STATUS}>
      </label>
      <div class="col-sm-4">
        <select name="fixed_status" size=1 class="form-control">
          <{$fixed_status}>
        </select>
      </div>
      <div class="col-sm-6">
        <input type="hidden" name="repair_sn" value="<{$repair_sn}>">
        <input type="hidden" name="op" value="update_tad_fixed">
        <button type="submit" class="btn btn-primary"><{$smarty.const._SUBMIT}></button>
      </div>
    </div>
  </form>

<{/if}>

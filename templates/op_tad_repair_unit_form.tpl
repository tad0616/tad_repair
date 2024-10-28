<h3><{$smarty.const._MA_TAD_REPAIR_UNIT_FORM}></h3>

<form action="unit.php" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="form-group row mb-3">
        <div class="col-sm-9">
            <!--單位名稱-->
            <input type="text" name="unit_title" value="<{$unit_title|default:''}>" id="unit_title" class="form-control validate[required]" placeholder="<{$smarty.const._MA_TADREPAIR_UNIT_TITLE}>">
        </div>
    </div>

    <!--管理人員-->
    <h3><{$smarty.const._MA_TADREPAIR_UNIT_ADMIN}></h3>

    <{$tmt_box|default:''}>

</form>
<{foreach from=$lunch key=SchoolId item=s}>
    <h3>
        <img src="images/groceries.png" alt="<{$s.SchoolName}><{$smarty.const._MD_TAD_LUNCH3_LUNCH}><{$smarty.const._MD_TAD_LUNCH3_INFO}>">
        <{$s.SchoolName}>
        <form action="index.php" method="get" style="display: inline-block;">
            <input type="text" name="period" value="<{$period|default:''}>" onClick="WdatePicker({onpicking:function(dp){window.location.href='index.php?period=' + dp.cal.getNewDateStr();},dateFmt:'yyyy-MM-dd', startDate:'%y-%M-%d'})"  style="width: 180px;border:none; color:rgb(39, 106, 145);text-align:center; cursor: pointer;" title="Please select a date">
        </form>
        <{if $s.meal.1.MenuTypeName}>
            <{$smarty.const._MD_TAD_LUNCH3_MEAL}>
        <{else}>
            <{$smarty.const._MD_TAD_LUNCH3_LUNCH}>
        <{/if}>
        <{$smarty.const._MD_TAD_LUNCH3_INFO}>
    </h3>

    <{if $s.lunch_error|default:false}>
        <div class="alert alert-danger">
            <{$s.lunch_error}>
        </div>
    <{elseif $s.meal}>
        <{if $s.meal.0.MenuTypeName!=_MD_TAD_LUNCH3_LUNCH}>
            <div id="lunch3Tab">
                <ul class="resp-tabs-list vert">
                    <{foreach from=$s.meal item=m}>
                        <li><{$m.MenuTypeName}></li>
                    <{/foreach}>
                </ul>

                <div class="resp-tabs-container vert">
                    <{foreach from=$s.meal item=m}>
                        <{include file="$xoops_rootpath/modules/tad_lunch3/templates/sub_tad_lunch3_dish.tpl"}>
                    <{/foreach}>
                </div>
            </div>
        <{else}>
            <{if $s.meal.1.KitchenName}>
                <div id="kitchenTab">
                    <ul class="resp-tabs-list vert">
                        <{foreach from=$s.meal item=m}>
                            <li><{$m.KitchenName}></li>
                        <{/foreach}>
                    </ul>

                    <div class="resp-tabs-container vert">
                        <{foreach from=$s.meal item=m}>
                            <{include file="$xoops_rootpath/modules/tad_lunch3/templates/sub_tad_lunch3_dish.tpl"}>
                        <{/foreach}>
                    </div>
                </div>
            <{else}>
                <{foreach from=$s.meal item=m}>
                    <h4><{if $m.KitchenName!=$s.SchoolName}><{$smarty.const._MD_TAD_LUNCH3_KITCHEN}><{$m.KitchenName}><{/if}></h4>
                    <{include file="$xoops_rootpath/modules/tad_lunch3/templates/sub_tad_lunch3_dish.tpl"}>
                <{/foreach}>
            <{/if}>
        <{/if}>
    <{/if}>
    <p><a href="https://fatraceschool.k12ea.gov.tw/frontend/search.html?school=<{$SchoolId|default:''}>&period=<{$period|default:''}>" target="_blank"><{$smarty.const._MD_TAD_LUNCH3_MORE_INFO}></a></p>

    <a href="<{$xoops_url}>/modules/tad_lunch3/index.php?op=re_get&SchoolId=<{$SchoolId|default:''}>&period=<{$period|default:''}>" class="btn btn-lg btn-info"><{$smarty.const._MD_TAD_LUNCH3_RE_GET}></a>
<{/foreach}>

<{if $lunch_note|default:false}>
    <div><code><{$lunch_note|default:''}></code></div>
<{/if}>

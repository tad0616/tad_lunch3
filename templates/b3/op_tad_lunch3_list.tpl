<script type="text/javascript" src="<{$xoops_url}>/modules/tadtools/My97DatePicker/WdatePicker.js"></script>
<{foreach from=$lunch item=s}>
    <h3>
        <img src="images/groceries.png" alt="<{$s.SchoolName}><{$smarty.const._MD_TAD_LUNCH3_LUNCH}><{$smarty.const._MD_TAD_LUNCH3_INFO}>">
        <{$s.SchoolName}>
        <form action="index.php" method="get" style="display: inline-block;">
            <input type="text" name="period" value="<{$period}>" onClick="WdatePicker({onpicking:function(dp){window.location.href='index.php?period=' + dp.cal.getNewDateStr();},dateFmt:'yyyy-MM-dd', startDate:'%y-%M-%d'})"  style="width: 180px;border:none; color:rgb(39, 106, 145);text-align:center; cursor: pointer;">
        </form>
        <{if $s.meal.1.MenuTypeName}>
            <{$smarty.const._MD_TAD_LUNCH3_MEAL}>
        <{else}>
            <{$smarty.const._MD_TAD_LUNCH3_LUNCH}>
        <{/if}>
        <{$smarty.const._MD_TAD_LUNCH3_INFO}>
    </h3>

    <{if $s.meal}>
        <{if $s.meal.0.MenuTypeName!=_MD_TAD_LUNCH3_LUNCH}>
            <div id="lunch3Tab">
                <ul class="resp-tabs-list vert">
                    <{foreach from=$s.meal item=m}>
                        <li><{$m.MenuTypeName}></li>
                    <{/foreach}>
                </ul>

                <div class="resp-tabs-container vert">
                    <{foreach from=$s.meal item=m}>
                        <{includeq file="$xoops_rootpath/modules/tad_lunch3/templates/sub_tad_lunch3_dish.tpl"}>
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
                            <{includeq file="$xoops_rootpath/modules/tad_lunch3/templates/sub_tad_lunch3_dish.tpl"}>
                        <{/foreach}>
                    </div>
                </div>
            <{else}>
                <{foreach from=$s.meal item=m}>
                    <h4><{if $m.KitchenName!=$s.SchoolName}><{$smarty.const._MD_TAD_LUNCH3_KITCHEN}><{$m.KitchenName}><{/if}></h4>
                    <{includeq file="$xoops_rootpath/modules/tad_lunch3/templates/sub_tad_lunch3_dish.tpl"}>
                <{/foreach}>
            <{/if}>
        <{/if}>
    <{else}>
        <a href="<{$xoops_url}>/modules/tad_lunch3/index.php?op=re_get&SchoolId=<{$s.SchoolId}>&period=<{$period}>" class="btn btn-lg btn-info"><{$smarty.const._MD_TAD_LUNCH3_RE_GET}></a>
    <{/if}>
     <p><a href="https://fatraceschool.k12ea.gov.tw/frontend/search.html?school=<{$s.SchoolId}>&period=<{$period}>" target="_blank"><{$smarty.const._MD_TAD_LUNCH3_MORE_INFO}></a></p>
<{/foreach}>

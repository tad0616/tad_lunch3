<{foreach from=$block.school key=SchoolId item=s}>
    <h3>
        <img src="<{$xoops_url}>/modules/tad_lunch3/images/groceries.png" alt="<{$s.SchoolName}><{$smarty.const._MB_TAD_LUNCH3_LUNCH}><{$smarty.const._MB_TAD_LUNCH3_INFO}>">
        <a href="<{$xoops_url}>/modules/tad_lunch3/index.php?period=<{$block.period}>">
            <{$s.SchoolName}>
            <{$block.period}>
            <{if $s.meal.1.MenuTypeName}>
                <{$smarty.const._MB_TAD_LUNCH3_MEAL}>
            <{else}>
                <{$smarty.const._MB_TAD_LUNCH3_LUNCH}>
            <{/if}>
            <{$smarty.const._MB_TAD_LUNCH3_INFO}>
        </a>
    </h3>
    <{if $s.meal}>
        <{if $s.meal.0.MenuTypeName!=_MB_TAD_LUNCH3_LUNCH}>
            <div id="lunch3Tab">
                <ul class="resp-tabs-list vert">
                    <{foreach from=$s.meal item=m}>
                        <li><{$m.MenuTypeName}></li>
                    <{/foreach}>
                </ul>

                <div class="resp-tabs-container vert">
                    <{foreach from=$s.meal item=m}>
                        <{includeq file="$xoops_rootpath/modules/tad_lunch3/templates/blocks/tad_lunch3_dish.tpl"}>
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
                            <{includeq file="$xoops_rootpath/modules/tad_lunch3/templates/blocks/tad_lunch3_dish.tpl"}>
                        <{/foreach}>
                    </div>
                </div>
            <{else}>
                <{foreach from=$s.meal item=m}>
                    <h4><{if $m.KitchenName!=$s.SchoolName}><{$smarty.const._MB_TAD_LUNCH3_KITCHEN}><{$m.KitchenName}><{/if}></h4>
                    <{includeq file="$xoops_rootpath/modules/tad_lunch3/templates/blocks/tad_lunch3_dish.tpl"}>
                <{/foreach}>
            <{/if}>
        <{/if}>
    <{/if}>
    <p><a href="https://fatraceschool.moe.gov.tw/frontend/search.html?school=<{$SchoolId}>&period=<{$block.period}>" target="_blank"><{$smarty.const._MB_TAD_LUNCH3_MORE_INFO}></a></p>
    <a href="<{$xoops_url}>/modules/tad_lunch3/index.php?op=re_get&SchoolId=<{$SchoolId}>&period=<{$block.period}>" class="btn btn-xs btn-info"><{$smarty.const._MB_TAD_LUNCH3_RE_GET}></a>
<{/foreach}>

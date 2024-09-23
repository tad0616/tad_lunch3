<{foreach from=$block.school key=SchoolId item=s}>
    <h3 style="<{$block.title_css}>">
        <img src="<{$xoops_url}>/modules/tad_lunch3/images/groceries.png" alt="<{$s.SchoolName}><{$smarty.const._MB_TAD_LUNCH3_LUNCH}><{$smarty.const._MB_TAD_LUNCH3_INFO}>">
        <a href="<{$xoops_url}>/modules/tad_lunch3/index.php?period=<{$block.period}>">
            <{$s.SchoolName}>
            <{$block.period}>
            <{if $s.meal.1.MenuTypeName|default:false}>
                <{$smarty.const._MB_TAD_LUNCH3_MEAL}>
            <{else}>
                <{$smarty.const._MB_TAD_LUNCH3_LUNCH}>
            <{/if}>
            <{$smarty.const._MB_TAD_LUNCH3_INFO}>
        </a>
    </h3>
    <div>
        <{if $block.annotated_text|default:false}>
            <div><code><{$block.annotated_text}></code></div>
        <{/if}>
        <{if $block.lunch_note|default:false}>
            <div><code><{$block.lunch_note}></code></div>
        <{/if}>

    </div>

    <{if $s.lunch_error|default:false}>
        <div class="alert alert-danger">
            <{$s.lunch_error}>
        </div>
    <{elseif $s.meal|default:false}>
        <{if $s.meal.0.MenuTypeName!=_MB_TAD_LUNCH3_LUNCH}>
            <div id="lunch3Tab">
                <ul class="resp-tabs-list vert">
                    <{foreach from=$s.meal item=m}>
                        <li><{$m.MenuTypeName}></li>
                    <{/foreach}>
                </ul>

                <div class="resp-tabs-container vert">
                    <{foreach from=$s.meal item=m}>
                        <{include file="$xoops_rootpath/modules/tad_lunch3/templates/blocks/tad_lunch3_dish.tpl"}>
                    <{/foreach}>
                </div>
            </div>
        <{else}>
            <{if $s.meal.1.KitchenName|default:false}>
                <div id="kitchenTab">
                    <ul class="resp-tabs-list vert">
                        <{foreach from=$s.meal item=m}>
                            <li><{$m.KitchenName}></li>
                        <{/foreach}>
                    </ul>

                    <div class="resp-tabs-container vert">
                        <{foreach from=$s.meal item=m}>
                            <{include file="$xoops_rootpath/modules/tad_lunch3/templates/blocks/tad_lunch3_dish.tpl"}>
                        <{/foreach}>
                    </div>
                </div>
            <{else}>
                <{foreach from=$s.meal item=m}>
                    <{if $m.KitchenName=='1'}>
                        <h4><{if $m.KitchenName!=$s.SchoolName}><{$smarty.const._MB_TAD_LUNCH3_KITCHEN}><{$m.KitchenName}><{/if}></h4>
                    <{/if}>
                    <{include file="$xoops_rootpath/modules/tad_lunch3/templates/blocks/tad_lunch3_dish.tpl"}>
                <{/foreach}>
            <{/if}>
        <{/if}>
    <{/if}>
    <p><a href="https://fatraceschool.k12ea.gov.tw/frontend/search.html?school=<{$SchoolId|default:''}>&period=<{$block.period}>" target="_blank"><{$smarty.const._MB_TAD_LUNCH3_MORE_INFO}></a></p>
    <a href="<{$xoops_url}>/modules/tad_lunch3/index.php?op=re_get&SchoolId=<{$SchoolId|default:''}>&period=<{$block.period}>" class="btn btn-sm btn-info"><{$smarty.const._MB_TAD_LUNCH3_RE_GET}></a>
<{/foreach}>

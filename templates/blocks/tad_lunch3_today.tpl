<{foreach from=$block.school item=s}>
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
    <{foreach from=$s.meal item=m}>
        <div><{if $m.KitchenName!=$s.SchoolName}><{$smarty.const._MB_TAD_LUNCH3_KITCHEN}><{$m.KitchenName}><{/if}><{if $s.meal.1.MenuTypeName}><{$m.MenuTypeName}><{/if}></div>
        <div class="row">
            <{foreach from=$m.dish item=d}>
                <{if $d.DishType}>
                    <div style="<{if $block.options.4!=1}>width:<{$block.options.0}>;display: inline-block;<{else}>width:100%;<{/if}> margin:2px; background-color: <{if $d.DishType==$smarty.const._MB_TAD_LUNCH3_MAINDISH}><{$block.options.5}><{else}><{$block.options.6}><{/if}>;">
                        <img src="https://fatraceschool.moe.gov.tw/dish/pic/<{$d.DishId}>" style="width:<{$block.options.0}>;height:<{$block.options.1}>;">
                        <{if $block.options.4!=1}>
                            <div style="color:white;padding:2px;text-align:center;<{$block.options.2}>"><{$d.DishType}></div>
                            <div style="color:white;padding:2px;text-align:center;<{$block.options.3}>"><{$d.DishName}></div>
                        <{else}>
                        <div style="display: inline-block;">
                            <div style="color:white;padding:2px;<{$block.options.2}>"><{$d.DishType}></div>
                            <div style="color:white;padding:2px;<{$block.options.3}>"><{$d.DishName}></div>
                        </div>
                        <{/if}>
                    </div>
                <{/if}>
            <{foreachelse}>    
                <div class="alert alert-danger">
                    <h3><{$smarty.const._MB_TAD_LUNCH3_NO_LUNCH}></h3>
                </div>  
            <{/foreach}>
        </div>
        <p><a href="https://fatraceschool.moe.gov.tw/frontend/search.html?school=<{$s.SchoolId}>&period=<{$period}>" target="_blank"><{$smarty.const._MB_TAD_LUNCH3_MORE_INFO}></a></p>
    <{/foreach}>
<{/foreach}>

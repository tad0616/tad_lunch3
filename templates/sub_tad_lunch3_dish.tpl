<div>
    <{foreach from=$m.dish item=d}>
        <{if $d.DishType}>
            <div style="width:150px;display: inline-block; margin:2px; background-color: <{if $d.DishType==$smarty.const._MD_TAD_LUNCH3_MAINDISH}>#cc8204<{else}>#009688<{/if}>;">
                <img src="https://fatraceschool.moe.gov.tw/dish/pic/<{$d.DishId}>" style="width:150px;height:150px;">
                <div style="color:white;padding:2px;text-align:center;"><{$d.DishType}></div>
                <div style="color:white;padding:2px;text-align:center;font-size:1.2em;"><{$d.DishName}></div>
            </div>
        <{/if}>
    <{foreachelse}>    
        <div class="alert alert-danger">
            <h3><{$smarty.const._MD_TAD_LUNCH3_NO_LUNCH}></h3>
        </div>  
    <{/foreach}>
</div>
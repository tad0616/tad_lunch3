<script type="text/javascript" src="<{$xoops_url}>/modules/tadtools/My97DatePicker/WdatePicker.js"></script>
<{foreach from=$lunch item=s}>
    <h2>
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
    </h2>
    <{foreach from=$s.meal item=m}>
        <div><{if $m.KitchenName!=$s.SchoolName}><{$smarty.const._MD_TAD_LUNCH3_KITCHEN}><{$m.KitchenName}><{/if}><{if $s.meal.1.MenuTypeName}><{$m.MenuTypeName}><{/if}></div>
        <div>
            <{foreach from=$m.dish item=d}>
                <{if $d.DishType}>
                    <div style="width:150px;display: inline-block; margin:2px; background-color: <{if $d.DishType==$smarty.const._MD_TAD_LUNCH3_MAINDISH}>#cc8204<{else}>#009688<{/if}>;">
                        <img src="https://fatraceschool.moe.gov.tw/dish/pic/<{$d.DishId}>" style="width:150px;height:150px;">
                        <div style="color:white;padding:2px;text-align:center;"><{$d.DishType}></div>
                        <div style="color:white;padding:2px;text-align:center;font-size:1.2em;"><{$d.DishName}></div>
                    </div>
                <{/if}>
            <{/foreach}>
        </div>
        <p><a href="https://fatraceschool.moe.gov.tw/frontend/search.html?school=<{$s.SchoolId}>&period=<{$period}>" target="_blank"><{$smarty.const._MD_TAD_LUNCH3_MORE_INFO}></a></p>
    <{foreachelse}>    
        <div class="alert alert-danger">
                <h3><{$smarty.const._MD_TAD_LUNCH3_NO_LUNCH}></h3>
        </div>  
    <{/foreach}>
<{/foreach}>


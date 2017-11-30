    /*
     * 左右选择js事件控制
     */
    function $(e){return document.getElementById(e);}
    function PutRightOneClk(str) {
        if($(str+"0").options.selectedIndex == -1){return false;}
        while($(str+"0").options.selectedIndex > -1){
            var id = $(str+"0").options.selectedIndex
            var varitem = new Option($(str+"0").options[id].text,$(str+"0").options[id].value);
            $(str+"1").options.add(varitem);
            $(str+"0").options.remove(id);
        }
    }
    function PutRightAllClk(str) {
        if($(str+"0").options.length == 0){return false;}
        for(var i=0;i<$(str+"0").options.length;i++){
            var varitem = new Option($(str+"0").options[i].text,$(str+"0").options[i].value);
            $(str+"1").options.add(varitem);
        }
        $(str+"0").options.length = 0;
    }
    function PutLeftOneClk(str) {
        if($(str+"1").options.selectedIndex == -1){return false;}
        while($(str+"1").options.selectedIndex > -1){
            var id = $(str+"1").options.selectedIndex
            var varitem = new Option($(str+"1").options[id].text,$(str+"1").options[id].value);
            $(str+"0").options.add(varitem);
            $(str+"1").options.remove(id);
        }
    }
    function PutLeftAllClk(str) {
        if($(str+"1").options.length == 0){return false;}
        for(var i=0;i<$(str+"1").options.length;i++){
            var varitem = new Option($(str+"1").options[i].text,$(str+"1").options[i].value);
            $(str+"0").options.add(varitem);
        }
        $(str+"1").options.length = 0;
    }

    function selectedall(str){
        if($(str+"1").options.length == 0){return false;}
        for(var i=0;i<=$(str+"1").options.length;i++){
            $(str+"1").options[i].selected = true;
        }
    }

    /*
     * 方法作用：判断是否选择一条记录
     * 输入：选择框名字
     * 输出;提示至少选择一条记录
     */
    function isSelectedOne(){
        if ($("input[type='checkbox']").is(':checked')) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 方法作用：全选或者不选
     */
    function select_all(obj) {
        $("input[type='checkbox']").prop('checked', $(obj).prop('checked'));
    }


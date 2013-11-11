dmLoader = {
    winLoadList : [],
    add: function(func){
        if (typeof(func) == 'function'){
            winLoadList.push(func)
        }
    },
    run: function(){
        for (var i in winLoadList){
            winLoadList[i]();
        }
    }
}

window.onload = dmLoader.run
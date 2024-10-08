
function remove_duplicate_object_values (arrayOfObj){
    var arrayOfObjAfter = _.map(
        _.uniq(
            _.map(arrayOfObj, function(obj){
                return JSON.stringify(obj);
            })
        ), function(obj) {
            return JSON.parse(obj);
        }
    );
    return arrayOfObjAfter;
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



function allnumeric(inputtxt){
    var numbers = /^[0-9]+$/;
    if(inputtxt.value.match(numbers)){
        return true;
    }else{
        inputtxt.value = '';
        return false;
    }
}
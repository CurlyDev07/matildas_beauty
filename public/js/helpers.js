
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



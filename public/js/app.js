let CSRFTOKEN = $('meta[name="csrf-token"]').attr('content');
let errorMaster = $('#error-master');
let successMaster = $('#success-master');

function follow(id){
    $.ajax({
        url: '/follow',
        type: 'post',
        data: {
            _token: CSRFTOKEN,
            id: id
        },
        error: function(data){
            console.log(data.responseJSON.message);
        },
        complete: function(){

        }
    })
}

function showError(msg){
    if(msg.length > 0){
        errorMaster.html(msg);
    }
    errorMaster.fadeToggle('fast', 'linear');
    setTimeout(function(){
        errorMaster.fadeToggle('slow', 'linear');
    }, 5000);
}
function showSuccess(msg){
    if(msg.length > 0){
        successMaster.html(msg);
    }
    successMaster.fadeToggle('fast', 'linear');
    setTimeout(function(){
        successMaster.fadeToggle('slow', 'linear');
    }, 1000);
}

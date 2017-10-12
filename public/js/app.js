let CSRFTOKEN = $('meta[name="csrf-token"]').attr('content');

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

let emptyPost = false;
let results = $('#posts');
$(document).ready(function(){
   $('#post').click(function(){
       sendPost();
   });

    getPosts('first');
});

$(window).scroll(function () {
    if (($(document).height()-200 <= $(window).scrollTop() + $(window).height()) && !emptyPost && $('.wait').length <= 0) {
        getPosts('last');
    }
});

function getPosts(direction){
    let loading = $('#loading');

    let lastPost = results.children();
    let url = '/getPosts';
    if(lastPost.length > 0){
        if(direction==='last') {
            lastPost = lastPost[lastPost.length-1].getAttribute('data-index');
            if(lastPost === "last"){
                emptyPost = true;
            }else{
                url += '/' +lastPost
            }
        }else if(direction ==='first'){
            url += '/'+lastPost[0].getAttribute('data-index');
            results.fadeOut(200);
        }
        url += '/'+direction;
    }
    if($('.wait').length <=0 && !emptyPost){
        $.ajax({
            url: url,
            type: 'get',
            beforeSend: function(){
                if(!results.hasClass('wait')){
                    results.addClass("wait");
                }

                loading.fadeIn(300);

            },
            success: function(data){
                if(data.count <= 0){
                    emptyPost = true;
                }
                if(direction==='last') {
                    results.append(data.html);
                }else if(direction ==='first'){
                    results.prepend(data.html).fadeIn(200);
                }

            },
            error: function(data){

            },
            complete: function(){
                loading.fadeOut(300);
                results.removeClass('wait');
            }
        })
    }else if(!emptyPost){
        return false;
    }else{
        setTimeout(getPosts(direction), 500);
    }
}

function sendPost(){

    let text = $('#postText');
    let error =  $('#postError');

    error.fadeOut(300);
    if(text.val().length > 0){
        $.ajax({
            url: '/sendPost',
            type: 'post',
            data:{
                _token: CSRFTOKEN,
                text: text.val()
            },
            beforeSend: function(){

            },
            success: function(data){
                results.prepend(data.html);
            },
            complete: function(){
                text.val('');
            },
            error: function(data){
                error.html(data.responseJSON.message)
            }
        })
    }else{
        error.fadeIn(300);
    }
}
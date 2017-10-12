let emptyPost = false;
let results = $('#posts');
let usersToFollow = $('#usersToFollow');
let actualShowingUsers;

$(document).ready(function(){
   $('#post').click(function(){
       sendPost();
   });
   $('#reloadUsersToFollow').click(function(){
       getUsersToFollow()
   });

    getPosts('first');
    getUsersToFollow();
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
                results.hide().prepend(data.html).fadeIn(300);
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

function getUsersToFollow(){
    let loading = $('#loadingUsersToFollow');
    let reload = $('#reloadUsersToFollow');
    $.ajax({
        url: '/getUsersToFollow',
        type: 'post',
        data: {
            _token: CSRFTOKEN,
            actualShowingUsers: actualShowingUsers
        },
        beforeSend: function(){
            usersToFollow.hide();
            loading.fadeIn(300);
            reload.addClass('activeReload');
        },
        success: function(data){
            actualShowingUsers = data.actualShowingUsers;
            usersToFollow.html(data.html);
        },
        complete: function(){
            loading.hide();
            usersToFollow.fadeIn(300);
            reload.removeClass('activeReload');

        },
        error: function(data){
            usersToFollow.html(data.responseJSON.message);
        }

    })
}

function onFollow(el){
    el.fadeOut(300);
    follow(el.attr('data-index'));
    let ul = el.parent().parent().parent();
    let li = el.parent().parent();
    let icon = $(el.children()[0]);

    setTimeout(function(){
        icon.html('done').parent().fadeIn(300);
    }, 500);
    setTimeout(function(){
        li.fadeOut(300);
    }, 1000);
    setTimeout(function(){
        li.remove();
        if(ul.children().length <= 0) {
            getUsersToFollow();
        }
    }, 1500);
}
$(document).ready(function(){
   $('#post').on('click', function(){
      let text = $('#postText');
       let error =  $('#post-error');
       error.fadeOut(300);
      if(text.val().length > 0){
        $.ajax({
            url: '',
            type: 'post',
            data:{
                _token: token,
                text: text.val()
            },
            beforeSend: function(){

            },
            complete: function(){
                text.val('');
                getPosts();
            }
        })
      }else{
          error.fadeIn(300);
      }
   });

    getPosts();
});

function getPosts(){
    let loading = $('#loading');
    let results = $('#posts');
    $.ajax({
        url: '/getPosts',
        type: 'get',
        beforeSend: function(){
            results.fadeOut(200);
            loading.fadeIn(300);
        },
        complete: function(){
            loading.fadeOut(300);
            results.html(data).fadeIn(200);
        }
    })
}
let express = require('express');
let app = express();
let http = require('http').Server(app);

import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '07f43a070fddea604b98'
});

Echo.channel('message'+user.id)
    .listen('NewMessage', (e) => {
        console.log(e);
    });

http.listen(3000, function(){
    console.log('listening on port 3000');
});
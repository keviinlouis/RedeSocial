let express = require('express');
let app = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
let Redis = require('ioredis');
let redis = new Redis();

redis.subscribe('test-channel', function(err, count) {

});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

io.on("connection", function (socket) {
    socket.on("newPost", function(post){
        console.log("Joined: " + post);
        socket.broadcast.emit("haveANewPost", post)
    });
});

http.listen(3000, function(){
    console.log('listening on port 3000');
});
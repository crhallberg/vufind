var io = require('socket.io').listen(4114, {log:false});

io.sockets.on('connection', function (socket) {
  socket.on('move', function (data) {
    if(data.roomless) {
      socket.join(data.path);
    }
    data.id = socket.id;
    socket.broadcast.to(data.path).emit('move', data);
  });
  socket.on('disconnect', function (data) {
    socket.broadcast.emit('leave', socket.id);
    console.log('leave', socket.id);
  });
});
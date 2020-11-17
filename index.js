// Import the 'server' module
const server = require('server');

const get = server.router.get;
const socket = server.router.socket;
const render = server.reply.render;

// Detect and mirror message to all clients
const send = ctx => {
  ctx.io.emit('message', ctx.data);
};

server([
  get('/', ctx => render('index.html')),
  socket('message', send)
]);

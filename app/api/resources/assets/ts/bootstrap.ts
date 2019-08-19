import Axios, { AxiosStatic } from 'axios';
import * as io from 'socket.io-client';
import Echo from 'laravel-echo';

declare global {
  interface Window {
    axios: AxiosStatic;
    io: SocketIOClient.Socket;
    Echo: Echo;
  }
  interface Element {
    content: string;
  }
}

export default function bootstrap() {
  window.axios = Axios;
  window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

  let token = document.head.querySelector('meta[name="csrf-token"]');

  if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  } else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
  }

  window.io = require('socket.io-client');
  window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://0.0.0.0:6001',
    namespace: 'App.Events'
  });

  window.Echo.channel('sample-event').listen('SampleEvent', (e:any) => {
    console.log(e);
  });

}

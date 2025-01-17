import { createApp } from 'vue';
import { renderToString } from 'vue-server-renderer';
import App from './App.vue';

const app = createApp(App);

renderToString(app).then(html => {
  // Aquí se puede devolver el HTML generado
  console.log(html);
});



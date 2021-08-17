import Vue from 'vue';
import App from './app.vue'
import Chat from './components/chat.vue'


new Vue({
    Chat,
    render: h => h(Chat)
}).$mount('#app');

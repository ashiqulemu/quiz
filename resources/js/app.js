require('./bootstrap');
window.Vue = require('vue');
import VeeValidate from 'vee-validate'
import vSelect from 'vue-select'

Vue.use(VeeValidate)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('auction-slots', require('./components/auction-slots.vue').default);
Vue.component('auction-slots-single', require('./components/single-auction-slots.vue').default);
Vue.component('v-select', vSelect);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
import moment from 'moment';
import VueCarousel from 'vue-carousel';

Vue.use(VueCarousel);
Vue.prototype.moment = moment
const app = new Vue({
    el: '#app',
    data() {
        return {
            message: 'This message from vue',
            form: {},
            regularHeader: true,
            serverTime: window.serverTime,
            user:{},
            termCheck:false,
            messages: [],
        }
    },
    created() {
        this.setAuth();
        his.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });

    },

    mounted() {

    },

    methods: {
        setAuth(){
            var authData=window.auth.replace(/&quot;/g,'\"')
            if(authData){this.user=JSON.parse(authData)}
        },

        placeBid(){
          alert('Place Bid under construction')
        },
        changeTerm(){
            this.termCheck =!this.termCheck
        },

        countDown(id, upTime){
            this.$nextTick(()=>{
                $("#getting-started"+id).countdown(upTime, function (event) {
                    $(this).text(
                        event.strftime('%D days %H:%M:%S')
                    );
                });
            })

        },
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }

    },

});

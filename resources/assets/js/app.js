require('./bootstrap');

import App from 'components/App.vue';
import Dashboard from '../components/Dashboard.vue';
import Home from '../components/Home.vue';
import Register from '../components/Register.vue';
import Signin from '../components/Signin.vue';

Vue.component('post-item', require('./components/Post/Item.vue'));
Vue.component('posts-list', require('./components/Post/List.vue'));
Vue.component('post-new', require('./components/Post/New.vue'));

Vue.component('sugested-users', require('./components/SugestedUsersComponent.vue'));

export let router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/signin',
            name: 'signin',
            component: Signin
        }
    ]
});

const app = new Vue({
    el: '#app',
    data: {
        posts: [],
        emptyPosts: false,
        busy: {
            'posts': false,
            'sugestedUsers': false
        },
        userSession: null,
        sugestedUsers: []
    },
    methods: {
        newPost(post) {
            // Add to existing messages
            post.created_at = new Date();
            post.user = this.userSession;
            this.posts.unshift(post);
            this.showMsg('Post enviado com sucesso', 'success');
            // Persist to the database etc
            axios.post('/posts', post).then(response => {
                this.posts.splice(this.posts.indexOf(post), 1, response.data.post);
            })
        },
        loadPosts(){
            this.busy.posts = true;
            axios.get('/posts/'+this.posts.length).then(response => {
                this.posts.push(...response.data);
                if(response.data.length < 10){
                    this.emptyPosts = true;
                }
                this.busy.posts = false;
            });
        },
        removePost(post){
            let index = this.posts.indexOf(post);
            this.posts.splice(index, 1);
            
            this.showMsg('Post deletado com sucesso', 'success');
            axios.delete('/posts', {params:  {id: post.id}}).then(response => {

            }).catch(error => {
                this.posts.splice(index, 0, post);
                this.showMsg('Ops, occoreu um erro enquanto deletavamos seu post, tente denovo', 'danger', 5000);
            });
        },
        refreshSugestedUsers(){
            this.busy.sugestedUsers = true;
            let ids = [];
            this.sugestedUsers.forEach(function(user, key){
                ids.push(user.id);
            });
            axios.post('/sugestedUsers', {"actualShowingUsers": ids}).then(response => {
                this.sugestedUsers =  response.data.sugestedUsers;
                this.busy.sugestedUsers = false;
            }).catch(error => {
                this.busy.sugestedUsers = false;
                this.showMsg('Ops, occoreu um erro: '+error.response.data.message, 'danger', 5000);
            });

        },
        follow(user){
            let index = this.sugestedUsers.indexOf(user);
            this.sugestedUsers.splice(index, 1);
            
            this.showMsg('Usuario Seguido!', 'success');
            axios.post('/follow',  {id: user.id}).then(response => {

            }).catch(error => {
                this.sugestedUsers.splice(index, 0, user);
                this.showMsg('Ops, occoreu um erro enquanto voce seguia '+user.name+', tente denovo', 'danger', 5000);
            });
        },
        showMsg(msg, type, time = 1000){
            let msgNav = $('#msg-nav');
            let alert = 'alert-'+type;
            if($('.active-msg-nav').length > 0){

                 msgNav
                    .removeAttr('class')
                    .addClass('msg-nav')
                    .addClass('alert')
                    .hide();
                 setTimeout(function(){
                     msgNav.addClass(alert).addClass('active-msg-nav').html(msg).fadeIn(300);
                 }, 1000);
            }else{
                 msgNav.addClass(alert).addClass('active-msg-nav').html(msg).fadeIn(300);
            }
            setTimeout(function(){
                msgNav.fadeOut(500);
            }, time);
            setTimeout(function(){
                msgNav.removeClass(alert).removeClass('active-msg-nav').html('');
            }, time+500);
        }
    },
    created() {
        this.loadPosts();

        axios.get('/user').then(response => {
            this.userSession =  response.data;
        });

        Echo.join(`messages.${userSession.id}`)
            .listen('NewMessage', (e) => {
                console.log(e.message);
            });
    }
});

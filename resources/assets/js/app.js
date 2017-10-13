require('./bootstrap');

Vue.component('post-item', require('./components/Post/Item.vue'));
Vue.component('posts-list', require('./components/Post/List.vue'));
Vue.component('post-new', require('./components/Post/New.vue'));

const app = new Vue({
    el: '#app',
    data: {
        posts: [],
        emptyPosts: false,
        busy: false
    },
    methods: {
        newPost(post) {
            // Add to existing messages
            this.posts.unshift(post);

            // Persist to the database etc
            axios.post('/posts', post).then(response => {
                // Do whatever;
            })
        },
        loadPosts(){
            this.busy = true;
            axios.get('/posts/'+this.posts.length).then(response => {
                this.posts.push(...response.data);
                if(response.data.length < 10){
                    this.emptyPosts = true;
                }
                this.busy = false;
            });
        }
    },
    created() {
        Echo.join('posts')
            .listen('newPost', (e) => {
                this.posts.unshift(e.post);
            });
    }
});

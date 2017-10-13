<template lang="html">
    <div id="posts" v-if="posts.length >= 0">
        <post-item
            v-for="item in posts"
            v-bind:post="item"
            v-bind:key="item.id"></post-item>


            <div id="loading" style="height: 100px" class="cssload-container" v-show="busy == true">
                <div class="cssload-whirlpool"></div>
            </div>
    </div>
     <div class="empty" v-else>
          Nothing here yet!
      </div>
</template>

<script>
    export default {
        props: ['posts', 'emptyPosts', 'busy'],
        methods: {
            getMessages() {
                this.$emit('loadposts');
            },
            scrollPage(){


            }
        },
        created() {
            $(window).scroll(() => {
                if (($(document).height()-200 <= $(window).scrollTop() + $(window).height()) && !this.emptyPosts && !this.busy) {
                    this.getMessages();
                }
            });
        }
    }
</script>

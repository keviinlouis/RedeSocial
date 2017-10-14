<template lang="html">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-10">
                    <h4>Que tal seguir esses?</h4>
                </div>
                <div class="col-md-2 pointer icons-color-default" @click="refresh">
                    <h4>
                        <i class="material-icons" v-bind:class="[ busy? 'active-rotate' : '']">autorenew</i>
                    </h4>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div v-if="sugestedUsers.length > 0">
                 <ul class="list-group">
                    <li 
                        class="list-group-item" 
                        v-for="user in sugestedUsers" 
                        v-bind:user="user"
                        v-bind:key="user.id">

                        <div class="row" style="margin-top: 3px">
                            <div class="col-md-9">
                                <p class="word-breaker">
                                    {{user.name}}
                                </p>
                            </div>
                            <div class="col-md-2 pointer text-success" @click="follow(user)">
                                <i class="material-icons">add</i>
                            </div>
                        </div>
                    </li>
              </ul>
            </div>
            <div v-else v-show="busy == false">
                <p>Opa, parece que não tem mais usuários para seguir</p>
            </div>  
            <div id="loading" style="height: 100px" class="cssload-container" v-show="busy == true">
                <div class="cssload-whirlpool"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['sugestedUsers', 'busy'],
        methods: {
            refresh() {
                this.$emit('refresh');
            },
            follow(user){
                this.$emit('follow', user);
            }

        },
        created() {
            this.refresh();
        }
    }
</script>

<style type="text/css">

</style>
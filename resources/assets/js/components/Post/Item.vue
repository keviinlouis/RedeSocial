<template lang="html">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-11 col-xs-10">
                    <p style="word-break: break-all">{{post.user.name}}</p>
                </div>

                <div 
                    class="col-md-1 col-xs-1" 
                    v-show="userSession != null && post.id != null && post.user.id == userSession.id">

                    <div class="dropdown">
                        <div  class="dropdown-toggle pointer icons-color-default" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="material-icons">keyboard_arrow_down</i>
                        </div>

                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li class="dropdown-item">
                                <div class="pointer text-danger" @click="removePost">
                                    <i class="material-icons">delete</i> 
                                    <span style="margin-top: 3px;margin-left: 3px;position: absolute;">Remover</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-9">
                    <p style="word-break:break-all ">{{post.text}}</p>
                </div>
                <div class="col-md-3">
                    {{post.created_at | moment("from", "now")}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
        props: ['post', 'userSession'],

        methods: {
            removePost(){
                event.preventDefault();
                this.$emit('removepost', this.post)
            }
        }
    }
</script>

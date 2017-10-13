<template lang="html">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-11 col-xs-10">
                    <p style="word-break: break-all">{{post.user.name}}</p>
                </div>
                <div class="col-md-1 col-xs-1">

                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="material-icons " style="color: gray"> keyboard_arrow_down</i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                                <a href="#" class="removePost">
                                    <i class="material-icons">delete</i> <span style="margin-top: 3px;margin-left: 3px;position: absolute;">Remover</span>
                                </a>
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

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post']
    }
</script>

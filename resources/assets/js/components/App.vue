<template>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <router-link :to="{ name: 'home' }">
                    RedeSocial
                    <p v-if="!auth.user.authenticated">
                        {{auth.user.profile.name}}
                    </p>
                </router-link>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Not Authentication Links -->

                    <li  v-if="!auth.user.authenticated">
                        <router-link :to="{ name: 'register' }">Login</router-link>
                    </li>
                    <li v-if="!auth.user.authenticated">
                        <router-link :to="{ name: 'signin' }">Registrar</router-link>
                    </li>

                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Hi, {{ auth.user.profile.name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="javascript:void(0)" v-on:click="signout">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="alert msg-nav" id="msg-nav">

    </div>

    <div class="panel-body">
        <router-view></router-view>
    </div>

</template>

<script>
import auth from '../auth.js'

export default {
    data() {
            return {
                auth: auth
            }
        },
        methods: {
            signout() {
                auth.signout()
            }
        },
        mounted: function () {
            this.$nextTick(function () {
                auth.check()
            })
        }
}
</script>

<template>
    <div>
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" v-link="{ name: 'home' }">
                        <img src="/images/donasangre.png" alt="Dona Sangre">
                    </a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="user-nav nav navbar-nav navbar-left" role="navigation">
                        <li v-link-active><a v-link="{ name: 'donators', exact: true }">Lista de Donadores</a></li>
                        <li v-if="user.authenticated" v-link-active><a v-link="{ name: 'donators-register', exact: true }">Quiero donar</a></li>
                    </ul>
                    <ul class="user-nav nav navbar-nav navbar-right" role="navigation">
                        <li v-show="user.authenticated" v-link-active><a v-link="{ name: 'profile' }">Tu Perfil</a></li>
                        <li v-show="user.authenticated"><a @click.prevent="logout" href="#">Salir</a></li>
                        <li v-show="! user.authenticated" v-link-active><a v-link="{ name: 'login' }">Entrar</a></li>
                        <li v-show="! user.authenticated" v-link-active><a v-link="{ name: 'register' }">Registro</a></li>
                    </ul>
                </div><!--/.navbar-collapse -->
            </div>
        </div>

        <div class="container">
            <div class="container">
                <router-view></router-view>
            </div>

            <hr>
            <footer>
                <p>Código disponible en <a href="https://github.com/osiux/donasangre.mx"><i class="fa fa-github-alt"></i> Github</a>. ¡Ayúdanos a mejorarlo! <span class="pull-right"><a href="#">Ayuda</a></span></p>
                <p>Icon made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed under <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a></p>
            </footer>
        </div>
    </div>
</template>

<script>
    import auth from './services/auth'

    export default {
        data() {
            return {
                user: auth.user
            }
        },
        methods: {
            logout: function() {
                auth.logout()
                    .then(() => {
                        this.$router.go('login')
                    })
            }
        }
    }
</script>
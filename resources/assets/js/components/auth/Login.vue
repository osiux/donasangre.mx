<template>
    <form @submit.prevent="login">
        <div class="alert alert-danger" v-show="error">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Credenciales incorrectas.
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" v-model="user.email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" v-model="user.password" class="form-control">
        </div>

        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
</template>

<script type="text/ecmascript-6">
    import auth from '../../services/auth'

    export default {
        data() {
            document.title = 'Entrar :: Dona Sangre'

            return {
                user: {
                    email: '',
                    password: ''
                },
                error: false
            }
        },
        methods: {
            login() {
                auth.login(this.user)
                    .then(() => {
                        this.$router.go('donators')
                    })
                    .catch((response) => {
                            this.error = true
                    })
            }
        }
    }
</script>
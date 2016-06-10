<template>
    <p>Teniendo una cuenta en el sitio puedes registrarte para ser donador de sangre y ayudar a salvar vidas. Del mismo modo puedes ponerte en contacto con algun posible donador, siempre y cuando el o ella lo permita.</p>

    <form @submit.prevent="register">
        <div class="form-group" :class="{ 'has-error': this.errors.name }">
            <label class="control-label" for="name">Nombre</label>
            <input type="text" id="name" v-model="user.name" class="form-control">
        </div>

        <div class="form-group" :class="{ 'has-error': this.errors.email }">
            <label class="control-label" for="email">Email</label>
            <input type="text" id="email" v-model="user.email" class="form-control">
        </div>

        <div class="form-group" :class="{ 'has-error': this.errors.password }">
            <label class="control-label" for="password">Contraseña</label>
            <input type="password" id="password" v-model="user.password" class="form-control">
        </div>

        <div class="form-group" :class="{ 'has-error': this.errors.password }">
            <label class="control-label" for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" v-model="user.password_confirmation" class="form-control">
        </div>

        <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
</template>

<script type="text/ecmascript-6">
    import auth from '../../services/auth'

    export default {
        data() {
            document.title = 'Registro :: Dona Sangre'

            return {
                user: {
                    name:'',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                formErrors: {}
            }
        },
        computed: {
            errors: function() {
                return {
                    name: !! this.formErrors.name,
                    email: !! this.formErrors.email,
                    password: !! this.formErrors.password
                }
            }
        },
        methods: {
            register() {
                auth.register(this.user)
                    .then((response) => {
                        this.$router.go('/')
                    })
                    .catch((response) => {
                        this.formErrors = response.data.errors
                    })
            }
        }
    }
</script>
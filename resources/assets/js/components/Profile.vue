<template>
    <h2>Edita tus datos</h2>

    <form @submit.prevent="updateProfile">
        <div class="alert alert-success" v-show="success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Datos editados correctamente.
        </div>

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
    import user from '../services/user'

    export default {
        data() {
            return {
                user: {
                    name:'',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                formErrors: {},
                success: false
            }
        },
        ready() {
            this.getProfile()
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
            getProfile() {
                user.getProfile()
                    .then((response) => {
                        this.user = response.json().data
                    })
                    .catch(() => {
                        this.$router.go('login')
                    })
            },
            updateProfile() {
                user.updateProfile(this.user)
                    .then((response) => {
                        this.user = response.json().data

                        this.success = true

                        this.formErrors = {}

                        setTimeout(() => {
                            this.success = false
                        }, 3000)
                    })
                    .catch((response) => {
                        this.formErrors = response.json().errors
                    })
            }
        }
    }
</script>
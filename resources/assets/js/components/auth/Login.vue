<template>
    <form @submit.prevent="login">
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

<script>
    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                console.login('login')
            }
        }
    }
</script>
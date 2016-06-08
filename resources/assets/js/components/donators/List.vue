<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Estado</th>
                <th>Localidad</th>
                <th>Tipo de Sangre</th>
                <th>Nombre</th>
                <th v-show="user.authenticated">Contactar</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>state</td>
                <td>-</td>
                <td>type</td>
                <td>name</td>
                <td v-show="user.authenticated">
                    <a href="#" title="Enviar mensaje"><i class="fa fa-send"></i> Enviar mensaje</a><br>
                    <a href="mailto:email"><i class="fa fa-envelope"></i> Enviar correo</a><br>
                    <a href="call:phone"><i class="fa fa-phone"></i> Llamar</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import auth from '../../services/auth'

    export default {
        data() {
            return {
                user: auth.user
            }
        }
    }
</script>
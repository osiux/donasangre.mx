<template>
    <div class="col-lg-6">
        <registered></registered>

        <h3>¿Por qué donar?</h3>
        <p>Lorem ipsum</p>

        <h3>¿Cómo se ponen en contacto contigo?</h3>
        <p>Por defecto, los usuarios que no tienen cuenta en el sitio no pueden ver ninguno de tus datos. Al tener una
            cuenta, el modo de ponerse en contacto contigo depende de lo que hayas elegido en este formulario.</p>
        <p>El método más sencillo es mandarte un mensaje a través del sitio, pero si elegiste mostrar tu email o número
            de teléfono, también pondrán ponerse en contacto contigo por ese medio.</p>
    </div>

    <div class="col-lg-6">
        <form @submit.prevent="addDonator">
            <div class="form-group">
                <label for="state">Estado</label>
                <select name="state" id="state" class="form-control" v-model="donator.state">
                </select>
            </div>

            <div class="form-group">
                <label for="blood_type">Tipo de Sangre</label>
                <select name="blood_type" id="blood_type" class="form-control" v-model="donator.blood_type">
                </select>
            </div>

            <div class="checkbox">
                <label for="show_email">
                    <input type="checkbox" name="show_email" id="show_email" v-model="donator.show_email" value="true">
                    Mostrar Email
                </label>
            </div>

            <div class="checkbox">
                <label for="show_phone">
                    <input type="checkbox" name="show_phone" id="show_phone" v-model="donator.show_phone" value="true">
                    Mostrar Teléfono
                </label>
            </div>

            <div class="form-group">
                <label>Expira el</label>
                <datepicker
                        :value.sync="donator.expires_at"
                        format="yyyy-MM-dd"
                        :show-reset-button="true">
                </datepicker>
                <p class="help-block">Después de esta fecha ya no aparecerás en el listado. Si lo dejas vacío, no expira.</p>
            </div>

            <input type="submit" class="btn btn-primary" value="Enviar">
        </form>
    </div>
</template>

<script type="text/ecmascript-6">
    import addWeeks from 'date-fns/add_weeks'
    import format from 'date-fns/format'
    import Datepicker from 'vue-strap/src/Datepicker.vue'
    import registered from './Registered.vue'

    export default {
        data() {
            const now = new Date()
            const future = addWeeks(now, 2)

            return {
                donator: {
                    state: '',
                    blood_type: '',
                    show_email: true,
                    show_phone: false,
                    expires_at: format(future, 'YYYY-MM-DD')
                }
            }
        },
        methods: {
            addDonator: function() {

            }
        },
        components: {
            Datepicker,
            registered
        }
    }
</script>
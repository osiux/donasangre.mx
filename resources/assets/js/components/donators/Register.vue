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
            <div class="form-group has-feedback">
                <label for="postalcode">Código Postal</label>
                <input type="text" name="postalcode" id="postalcode" class="form-control" autocomplete="off" maxlength="5"
                       v-model="donator.postalcode" @blur="searchByPostalCode" @keyup.enter="searchByPostalCode">
                <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                <p class="help-block">Escribe tu código postal para llenar automáticamente los datos.</p>
            </div>

            <div class="form-group">
                <label for="state">Estado</label>
                <select name="state" id="state" class="form-control" v-model="donator.state">
                    <option v-for="state in states" :value="state.code">
                        {{ state.name }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="city">Municipio/Delegación</label>
                <select type="text" name="city" id="city" class="form-control" v-model="donator.city" :disabled="disabled">
                    <option v-for="city in cities" :value="city">
                        {{ city }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="suburb">Colonia</label>
                <select type="text" name="suburb" id="suburb" class="form-control" v-model="donator.suburb" :disabled="disabled">
                    <option v-for="suburb in suburbs" :value="suburb">
                        {{ suburb }}
                    </option>
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
    import { uniq } from 'lodash'
    import addWeeks from 'date-fns/add_weeks'
    import format from 'date-fns/format'
    import { datepicker } from 'vue-strap'
    import registered from './Registered.vue'
    import geo from '../../services/geo'

    export default {
        data() {
            const now = new Date()
            const future = addWeeks(now, 2)

            return {
                states: {},
                cities: {},
                suburbs: {},
                donator: {
                    postalcode: '',
                    state: '',
                    city: '',
                    suburb: '',
                    blood_type: '',
                    show_email: true,
                    show_phone: false,
                    expires_at: format(future, 'YYYY-MM-DD')
                },
                disabled: true
            }
        },
        ready() {
            geo.getStates()
                .then((response) => {
                    this.states = response
                })
        },
        methods: {
            addDonator: function() {

            },
            searchByPostalCode: function() {
                if ( this.donator.postalcode.length == 5 ) {
                    geo.searchByPostalCode(this.donator.postalcode)
                        .then((response) => {
                            this.disabled = false
                            if ( response.length > 0 ) {
                                let cities = []
                                let suburbs = []
                                let that = this

                                response.forEach(function(obj) {
                                    cities.push(obj.name)
                                    suburbs.push(obj.suburb)

                                    that.cities = uniq(cities)
                                    that.suburbs = uniq(suburbs)
                                })

                                this.donator.state = response[0].state.data.code
                                this.donator.city = response[0].name
                                this.donator.suburb= response[0].suburb
                            }
                        })
                }
            }
        },
        components: {
            datepicker,
            registered
        }
    }
</script>
<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <p>Ya tienes uno o mas registros a tu nombre. Puedes editarlos desde la lista de abajo o continuar agregando uno nuevo.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th>Creada</th>
                    <th>Expira</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>date</td>
                    <td>
                        expires
                    </td>
                    <td>state</td>
                    <td>
                        <a href="#"><i class="fa fa-edit"></i></a>
                        <a href="#"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        }
    }
</script>
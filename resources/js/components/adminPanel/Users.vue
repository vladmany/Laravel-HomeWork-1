<template>
    <div>
        <div class="container">
            <h1 class="display-4" style="text-align: center">Пользователи</h1>
            <a type="button" class="btn btn-success btn-add-table" href="" role="button">Добавить</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Почта подтверждена</th>
                    <th scope="col">Создан</th>
                    <th scope="col">Изменен</th>
                    <th scope="col" class="users-table-operations-th">
                        Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="users-table-operations-td">
                        <a type="button" class="btn btn-warning d-flex" href="" role="button">Изменить</a>
                            <button type="submit" class="btn btn-danger d-flex" role="button" onclick="if (!confirm('Вы действительно хотите удалить пользователя')) { return false; }">Удалить</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Users"
    }
</script>

<style scoped>

</style>

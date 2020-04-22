<template>
    <div>
        <div class="container">
            <h1 class="display-4" style="text-align: center">Книги</h1>
            <a href="/adminpanel/books/create" type="button" class="btn btn-success btn-add-table" role="button">Добавить</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Год</th>
                    <th scope="col">Жанр</th>
                    <th scope="col">Создана</th>
                    <th scope="col">Изменена</th>
                    <th scope="col" class="users-table-operations-th">
                        Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="book in books">
                    <th scope="row"> {{ book.id }} </th>
                    <td> {{ book.title }} </td>
                    <td> {{ book.author }} </td>
                    <td> {{ book.year }} </td>
                    <td> {{ book.genre_name }} </td>
                    <td> {{ getDate(book.created_at) }} </td>
                    <td> {{ getDate(book.updated_at) }} </td>
                    <td class="users-table-operations-td">
                        <a type="button" class="btn btn-warning d-flex" :href="'/adminpanel/books/' + book.id + '/edit'" role="button">Изменить</a>
                        <form id="destroy-form" ref="form" :action="'/adminpanel/books'" method="POST" @submit="confirmDelete($event, book)">
                            <button type="submit" class="btn btn-danger d-flex" role="button">Удалить</button>
                        </form>
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
                books: {},
                deleteResponse: {}
            }
        },
        methods: {
            getDate(d) {
              let date = new Date(d);
              return `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`
            },
            confirmDelete(e, book) {
                e.preventDefault();
                const confirmDeleteSwal = swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mr-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                const selectDeleteWaySwal = swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-primary mr-2',
                        cancelButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });

                confirmDeleteSwal.fire({
                    title: 'Вы уверены?',
                    text: `Вы точно хотите удалить книгу ${book.name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Отмена',
                    confirmButtonText: 'Да, я уверен!'
                }).then((result) => {
                    if (result.value) {
                        e.preventDefault();
                        axios.delete('/api/books/' + book.id)
                            .then(function response(response) {
                                console.log(response.data.status);
                                if(response.data.status === 1)
                                {
                                    selectDeleteWaySwal.fire(
                                        'Удаллено!',
                                        'Книга успешно удалена из системы',
                                        'success'
                                    ).then((afterSuccess) => {
                                        if (afterSuccess) {
                                            location.href='/adminpanel/books'
                                        }
                                    })
                                }
                            })
                    }
                });

            }
        },
        mounted() {
            axios.get('/api/books/get')
                .then(r => this.books = r.data);
        }
    }
</script>

<style scoped>

</style>

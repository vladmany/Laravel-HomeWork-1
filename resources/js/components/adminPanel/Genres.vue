<template>
    <div>
        <div class="container">
            <h1 class="display-4" style="text-align: center">Жанры</h1>
            <a href="/adminpanel/genres/create" type="button" class="btn btn-success btn-add-table" role="button">Добавить</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Создан</th>
                    <th scope="col">Изменен</th>
                    <th scope="col" class="users-table-operations-th">
                        Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="genre in genres">
                    <th scope="row"> {{ genre.id }} </th>
                    <td> {{ genre.name }} </td>
                    <td> {{ getDate(genre.created_at) }} </td>
                    <td> {{ getDate(genre.updated_at) }} </td>
                    <td class="users-table-operations-td">
                        <a type="button" class="btn btn-warning d-flex" :href="'/adminpanel/genres/' + genre.id + '/edit'" role="button">Изменить</a>
                        <form id="destroy-form" ref="form" :action="'/adminpanel/genres'" method="POST" @submit="confirmDelete($event, genre)">
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
                genres: {},
                deleteResponse: {}
            }
        },
        methods: {
            getDate(d) {
              let date = new Date(d);
              return `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`
            },
            confirmDelete(e, genre) {
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
                    text: `Вы точно хотите удалить жанр ${genre.name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Отмена',
                    confirmButtonText: 'Да, я уверен!'
                }).then((result) => {
                    if (result.value) {
                        e.preventDefault();
                        axios.delete('/api/genres/' + genre.id)
                            .then(function response(response) {
                                console.log(response.data.status);
                                if (response.data.status === 2) {
                                    selectDeleteWaySwal.fire({
                                        title: 'Выберите действие',
                                        text: `На сайте опубликовано ${response.data.books.length} книг с этим жанром. Вы хотите удалить только жанр, или также все его книги?`,
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Только жанр',
                                        cancelButtonText: 'Также книги',
                                        reverseButtons: false
                                    }).then((result) => {
                                        if (result.value) {
                                            axios.post('/api/genres/delOnlyGenre', {
                                                genreId: response.data.genre,
                                                booksIds: response.data.books
                                            }).then(function (response) {
                                                selectDeleteWaySwal.fire(
                                                    'Удаллено!',
                                                    'Жанр успешно удалён из системы',
                                                    'success'
                                                ).then((afterSuccess) => {
                                                    if (afterSuccess) {
                                                        location.href='/adminpanel/genres'
                                                    }
                                                })
                                            })
                                        } else if (
                                            /* Read more about handling dismissals below */
                                            result.dismiss === swal.DismissReason.cancel
                                        ) {
                                            axios.post('/api/genres/delWithBooks', {
                                                genreId: response.data.genre,
                                                booksIds: response.data.books
                                            }).then(function (response) {
                                                selectDeleteWaySwal.fire(
                                                    'Удаллено!',
                                                    'Жанр успешно удалён из системы',
                                                    'success'
                                                ).then((afterSuccess) => {
                                                    if (afterSuccess) {
                                                        location.href='/adminpanel/genres'
                                                    }
                                                })
                                            })
                                        }
                                    })
                                }
                                else if(response.data.status === 1)
                                {
                                    selectDeleteWaySwal.fire(
                                        'Удаллено!',
                                        'Жанр успешно удалён из системы',
                                        'success'
                                    ).then((afterSuccess) => {
                                        if (afterSuccess) {
                                            location.href='/adminpanel/genres'
                                        }
                                    })
                                }
                            })
                    }
                });

            }
        },
        mounted() {
            axios.get('/api/genres/get')
                .then(r => this.genres = r.data);
        }
    }
</script>

<style scoped>

</style>

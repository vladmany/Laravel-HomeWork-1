<template>
    <div>
        <div class="container">
            <h1 class="display-4" style="text-align: center">Пользователи</h1>
            <a href="/adminpanel/users/create" type="button" class="btn btn-success btn-add-table" role="button">Добавить</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Создан</th>
                    <th scope="col">Изменен</th>
                    <th scope="col" class="users-table-operations-th">
                        Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users">
                    <th scope="row"> {{ user.id }} </th>
                    <td> {{ user.name }} </td>
                    <td> {{ user.email }} </td>
                    <td> {{ getDate(user.created_at) }} </td>
                    <td> {{ getDate(user.updated_at) }} </td>
                    <td class="users-table-operations-td">
                        <a type="button" class="btn btn-warning d-flex" :href="'/adminpanel/users/' + user.id + '/edit'" role="button">Изменить</a>
                        <form id="destroy-form" ref="form" :action="'/adminpanel/users'" method="POST" @submit="confirmDelete($event, user)">
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
                users: {},
                deleteResponse: {}
            }
        },
        methods: {
            getDate(d) {
              let date = new Date(d);
              return `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`
            },
            confirmDelete(e, user) {
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
                    text: `Вы точно хотите удалить пользователя ${user.name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Отмена',
                    confirmButtonText: 'Да, я уверен!'
                }).then((result) => {
                    if (result.value) {
                        e.preventDefault();
                        axios.delete('/api/users/' + user.id)
                            .then(function response(response) {
                                console.log(response.data.status);
                                if (response.data.status === 2) {
                                    selectDeleteWaySwal.fire({
                                        title: 'Выберите действие',
                                        text: `Этот пользователь является автором ${response.data.books.length} книг. Вы хотите удалить только пользователя, или также все его книги?`,
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Только пользователя',
                                        cancelButtonText: 'Также книги',
                                        reverseButtons: false
                                    }).then((result) => {
                                        if (result.value) {
                                            axios.post('/api/users/delOnlyUser', {
                                                userId: response.data.user,
                                                booksIds: response.data.books
                                            }).then(function (response) {
                                                selectDeleteWaySwal.fire(
                                                    'Удаллено!',
                                                    'Пользователь успешно удалён из системы',
                                                    'success'
                                                ).then((afterSuccess) => {
                                                    if (afterSuccess) {
                                                        location.href='/adminpanel/users'
                                                    }
                                                })
                                            })
                                        } else if (
                                            /* Read more about handling dismissals below */
                                            result.dismiss === swal.DismissReason.cancel
                                        ) {
                                            axios.post('/api/users/delWithBooks', {
                                                userId: response.data.user,
                                                booksIds: response.data.books
                                            }).then(function (response) {
                                                selectDeleteWaySwal.fire(
                                                    'Удаллено!',
                                                    'Пользователь успешно удалён из системы',
                                                    'success'
                                                ).then((afterSuccess) => {
                                                    if (afterSuccess) {
                                                        location.href='/adminpanel/users'
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
                                        'Пользователь успешно удалён из системы',
                                        'success'
                                    ).then((afterSuccess) => {
                                        if (afterSuccess) {
                                            location.href='/adminpanel/users'
                                        }
                                    })
                                }
                            })
                    }
                });

                    // e.preventDefault();
                    // axios.delete('/api/users/' + user.id)
                    //     .then(function response(response) {
                    //         console.log(response.data.status);
                    //         if (response.data.status === 2) {
                    //
                    //
                    //
                    //
                    //             swalWithBootstrapButtons.fire({
                    //                 title: 'Выберите действие',
                    //                 text: "Этот пользователь является автором 5 книг. Вы хотите удалить только пользователя, или также все его книги?",
                    //                 icon: 'warning',
                    //                 showCancelButton: true,
                    //                 confirmButtonText: 'Yes, delete it!',
                    //                 cancelButtonText: 'No, cancel!',
                    //                 reverseButtons: true
                    //             }).then((result) => {
                    //                 if (result.value) {
                    //                     swalWithBootstrapButtons.fire(
                    //                         'Deleted!',
                    //                         'Your file has been deleted.',
                    //                         'success'
                    //                     )
                    //                 } else if (
                    //                     /* Read more about handling dismissals below */
                    //                     result.dismiss === swal.DismissReason.cancel
                    //                 ) {
                    //                     swalWithBootstrapButtons.fire(
                    //                         'Deleted!',
                    //                         'Your file has been deleted.',
                    //                         'success'
                    //                     )
                    //                 }
                    //             })
                    //         }
                    //     });
            }
        },
        mounted() {
            axios.get('/api/users/get')
                .then(r => this.users = r.data);
        }
    }
</script>

<style scoped>

</style>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageData['title'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/testTask">App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
            <a class="btn btn-primary" href="/testTask/login/logout/">Выход</a>
        </ul>
    </div>
</nav>
<div id="app">
    <section class="main my-5">
        <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeModalLabel">Изменить</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/testTask/task/update/" method="POST">
<!--                            <div class="form-group">-->
<!--                                <label for="taskUsername">Имя пользователя</label>-->
<!--                                <input v-model="currentTask['user_name']" type="text" class="form-control" id="taskUsername" placeholder="Имя">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="taskEmail">Email</label>-->
<!--                                <input v-model="currentTask['email']" type="email" class="form-control" id="taskEmail" aria-describedby="emailHelp" placeholder="Enter">-->
<!--                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
<!--                            </div>-->
                            <input hidden type="text" name="id" v-model="currentTask.id">
                            <div class="form-group">
                                <label for="taskText">Текст задания</label>
                                <textarea name="text" v-model="currentTask['text']" class="form-control rounded-0" id="taskText" rows="3" required></textarea>
                            </div>
                            <div class="form-check">
                                <input name="is_active" v-model="currentTask['is_active']" type="checkbox" class="form-check-input" id="taskActive">
                                <label class="form-check-label" for="taskActive">Выполнено</label>
                            </div>
<!--                            <div class="form-check">-->
<!--                                <input v-model="currentTask['is_changed']" type="checkbox" class="form-check-input" id="taskChanged">-->
<!--                                <label class="form-check-label" for="taskChanged">Изменено</label>-->
<!--                            </div>-->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Table -->
                    <table class="table" id="tasks_table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Text</th>
                            <th scope="col">Выполнено</th>
                            <th scope="col">Изменено</th>
                            <th scope="col">Изменить</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="item_row" v-for="(task, index) in tasks">
                                <th scope="row">{{ task.id }}</th>
                                <td>{{ task["user_name"] }}</td>
                                <td>{{ task["email"] }}</td>
                                <td>{{ task["text"] }}</td>
                                <td>{{ task["is_active"] === '1' ? "Да" : "Нет" }}</td>
                                <td>{{ task["is_changed"] === '1' ? "Да" : "Нет" }}</td>
                                <td><button @click="changeTask(index)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#changeModal">Изменить</button></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            tasks: [],
            currentTask: {
                id: 0,
                "user_name": "",
                "email": "",
                "text": "",
                "is_active": "",
                "is_changed": "",
            }
        },
        created() {
            this.loadTasks();
        },
        methods: {
            async loadTasks() {
                let response = await fetch("/testTask/admin/tasks/",)
                    .then(response => response.text())
                    .then(result => this.tasks = JSON.parse(result))
                    .catch(error => console.log('error', error));
            },
            changeTask(id) {
                this.currentTask.id = this.tasks[id].id;
                this.currentTask.text = this.tasks[id].text
                this.currentTask['is_active'] = this.tasks[id]['is_active'] === "1"
                //this.currentTask['is_changed'] = this.currentTask['is_changed'] === "1"
            },

        }
    })
</script>
</body>
</html>
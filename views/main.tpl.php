<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/testTask">App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
            <a class="btn btn-primary" href="login"><?php echo (!empty($_SESSION)) ? "Профиль" : "Вход" ?></a>
        </ul>
    </div>
</nav>

<section class="main my-5">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="userInputEmail1">Имя пользователя</label>
                            <input id="usernameForm" name="user_name" type="text" class="form-control" placeholder="Имя" aria-describedby="userValid">
                            <small id="userValid" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="emailForm">Email</label>
                            <input name="email" type="email" class="form-control" id="emailForm" aria-describedby="emailHelp" placeholder="Email">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="textForm">Текст</label>
                            <textarea name="text" class="form-control rounded-0" id="textForm" rows="3" aria-describedby="textValid"></textarea>
                            <small id="textValid" class="form-text text-muted"></small>
                        </div>
                        <button id="taskAdd" type="button" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">
                    Добавить
                </button>

                <!-- Table -->
                <table class="table" id="tasks_table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя пользоватея</th>
                        <th scope="col">Email</th>
                        <th scope="col">Текст</th>
                        <th scope="col">Активно</th>
                        <th scope="col">Изменено</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    foreach ($pageData['tasks'] as $rows) :?>
                        <tr class="item_row">
                            <td scope="row"><?php echo ++$total; ?></td>
                            <td> <?php echo $rows['user_name']; ?></td>
                            <td> <?php echo $rows['email']; ?></td>
                            <td> <?php echo $rows['text']; ?></td>
                            <td> <?php echo ($rows['is_active'] == "1") ? "Да" : "Нет"; ?></td>
                            <td> <?php echo ($rows['is_changed'] == "1") ? "Да" : "Нет"; ?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $('#tasks_table').dataTable({
        pageLenght: 3,
        pagingType: 'full_numbers',
        orderMulti: true,
        lengthMenu: [3]
    })

    $('#taskAdd').click(function () {
        let username = $('#usernameForm').val();
        let email = $('#emailForm').val();
        let text = $('#textForm').val();
        let task = {
            user_name: username,
            email: email,
            text: text
        }
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (regex.test(email) && text !== '' && username !== ''){
            $.ajax({
                url: "/testTask/task/add/",
                type: "POST",
                data: task,
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === "success")
                        alert("Задача была добавлена")
                    else
                        alert('Ошибка')
                    location.reload();
                }
            });
        } else {
            if (!regex.test(email))
                $('#emailHelp').text('Неправильный формат')
            else {
                $('#textValid').text('Пусто')
                $('#userValid').text('Пусто')
            }
        }

    });
</script>
</body>
</html>
<?php
   // header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions | Simple</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./app/assets/style/dashboard_sidebar.css">
</head>
<body>
    <?php require("side_bar.php"); ?>

    <main class="main">
        <div class="Container p-4 ">
            <div class="d-flex justify-content-between border-bottom fw-bold fs-4">
                <p class="">Transactions</p>
            </div>
            <div class="d-flex justify-content-between mt-3 fw-bold">
                <div class="d-flex">
                    <p class="m-0">Show</p>
                    <select class="sort rounded mx-1" name="" id="">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="All">All</option>
                    </select>
                    <p class="m-0">entities</p>
                </div>
            </div>

            <div class="table-responsive card mt-3 p-2">
                <table style="overflow: overlay;" class="table table-striped">
                    <thead>
                        <tr class="rounded">
                            <th scope="col">Target</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_transactions as $value) {?>
                        <tr>
                            <td><?php echo $value->recipient; ?></td>
                            <?php
                                if(str_contains($value->amount, '+'))
                                {
                                    echo '<td style="color: green;">'.$value->amount.'</td>';
                                }
                                if(str_contains($value->amount, '-'))
                                {
                                    echo '<td style="color: red;">'.$value->amount.'</td>';
                                }
                                if(str_contains($value->recipient, 'Requested'))
                                {
                                    echo '<td style="color: orange;">'.$value->amount.'</td>';
                                }
                            ?>
                            <td><?php echo $value->date; ?></td>
                            <td><?php echo "Completed"; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php 
                    if($list_transactions == null)
                    {
                        echo "<p class='text-center my-3'>No transactions yet</p>";
                    }
                ?>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL."student/add"; ?>" method="POST">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="form-control form-control-lg" name="gender">
                            <option value="homme">homme</option>
                            <option value="femme">femme</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse">
                    </div>
                    <div class="mb-3">
                        <label for="naissance" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="naissance" name="naissance">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="parent" class="form-label">Parent</label>
                        <select id="parent" class="form-control form-control-lg" name="parent">
                            <?php foreach ($parents as $key => $value){?>
                            <option value="<?php echo $value->matricule; ?>"><?php echo $value->nom; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </main>

    <script src="./app\assets\js\main.js"></script>
</body>
</html>
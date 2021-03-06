<?php
  //header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Simple</title>
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
        <div class="container my-3">
            <div class="row mx-0 carte">
                <div class="col-12">
                    <h3 class="h3">Good Morning, <?php echo $_SESSION['user']->name; ?></h3>
                </div>
                <div class="col-xl-6 col-md-6 justify-content-center align-items-center">
                    <div class="item item-1">
                        <div class="img_container">
                            <img class="gif" src="app\image\gif1.gif" alt="">
                            <p class="your">Your balance</p>
                            <p class="balance"><sup>$</sup><?php echo $_SESSION['user']->balance; ?></p>
                        </div>
                            <?php 
                                if(isset($_SESSION["red_message"]))
                                {
                                    echo "<p class='alert alert-danger my-1 text-center' style='width: 80%;'>".$_SESSION['red_message']."</p>";
                                    unset($_SESSION["red_message"]);
                                }
                                if(isset($_SESSION["green_message"]))
                                {
                                    echo "<p class='alert alert-success my-1 text-center' style='width: 80%;'>".$_SESSION['green_message']."</p>";
                                    unset($_SESSION["green_message"]);
                                }
                            ?>
                        <button class="btn_" data-bs-toggle="modal" data-bs-target="#send_to">Send</button>
                        <button class="btn_" data-bs-toggle="modal" data-bs-target="#request_from">Request</button>
                        <p class="p">Recent activity</p>
                        <div class="Recent_">
                            <table class="table table-striped m-0 p-0">
                                <tbody>
                                    <?php
                                        if($list_transactions == null)
                                        {
                                            echo "<p class='text-center my-4'>No recents yet</p>";
                                        }
                                        foreach ($list_transactions as $value) {?>
                                            <tr>
                                                <td class="text_dashboard py-4"><?php echo $value->recipient; ?></td>
                                                <?php
                                                    if(str_contains($value->amount, '+'))
                                                    {
                                                        echo '<td dir="rtl" style="color: green;">'.trim($value->amount, '+').' +<br><p class="text-dark">'.$value->date.'</p></td>';
                                                    }
                                                    if(str_contains($value->amount, '-'))
                                                    {
                                                        echo '<td dir="rtl" style="color: red;">'.trim($value->amount, '-').' -<br><p class="text-dark">'.$value->date.'</p></td>';
                                                    }
                                                    if(str_contains($value->recipient, 'Requested'))
                                                    {
                                                        echo '<td dir="rtl" style="color: orange;">'.trim($value->amount, '-').' <br><p class="text-dark">'.$value->date.'</p></td>';
                                                    }
                                                ?>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 justify-content-center align-items-center">
                    <div class="item item-1">
                        <p  class="p">Send again</p>
                        <div class="Send_again">
                            <table class="table table-striped m-0 p-0">
                                <tbody>
                                    <?php
                                        if($all_users == null)
                                        {
                                            echo "<p class='text-center my-4'>No friends yet yet</p>";
                                        }
                                        foreach ($all_users as $value) {?>
                                            <tr>
                                                <td class="text_dashboard text-center py-3"><?php echo $value->name; ?></td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <p  class="p">Bank and cards</p>
                        <div class="bank_card card-body fs-5 p-3">
                            <div class="d-flex justify-content-between text-dark fw-bold">
                                <p>
                                    Bank of Morocco
                                </p>
                                <p>
                                    *9324
                                </p>
                            </div>
                            <div class="d-flex justify-content-between text-dark fw-bold">
                                <p class="m-0 mt-3">
                                    Checking
                                </p>
                                <p class="m-0 mt-3">
                                    Visa card
                                </p>
                            </div>
                        </div>
                        <div class="bank_card card-body fs-5 p-3">
                            <div class="d-flex justify-content-between text-dark fw-bold">
                                <p>
                                    Bank of Morocco
                                </p>
                                <p>
                                    *6543
                                </p>
                            </div>
                            <div class="d-flex justify-content-between text-dark fw-bold">
                                <p class="m-0 mt-3">
                                    Credit
                                </p>
                                <p class="m-0 mt-3">
                                    Master card
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-dark"><a style="text-decoration: none; color: white;" href="<?php echo URL."cards"?>"> Link a Bank or Card </a></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="send_to" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Send amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <p class="d-flex m-0 mt-3 justify-content-center" id="warning" ></p>
                <div class="modal-body">
                    <form action="<?php echo URL."dashboard/send"; ?>" method="POST" onsubmit="return modal_validation()">
                        <div class="mb-3">
                            <label for="recipient_" class="form-label">Recipient</label>
                            <select id="recipient_" class="form-control form-control-lg" name="recipient">
                                <?php foreach ($all_users as $key => $value){?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" class="form-control" id="amount_" name="amount">
                        </div>

                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="app\assets\js\main.js"></script>
    <script src="./app\assets\js\js.js"></script>
</body>
</html>
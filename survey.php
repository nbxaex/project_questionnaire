<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Server</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="manage_app/img/ico/emoji.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
             font-family: 'Sarabun', sans-serif;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="dist/css/sticky-footer-navbar.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 bg-light">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-white fixed-top bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="manage_app/">
                <h5 class="text-warning"><?= date(" F D jS"); ?></h5>
                </a>
            </div>
        </nav>
    </header>

    <?php
    if (isset($_POST['id'])) {
        $assessor_id = $_POST['id'];
    } else {
        header('location:index.php');
    }
    ?>
    <!-- Begin page content -->
    <main class="flex-shrink-0" style="margin-top: 4rem;">
        <div class="container py-5 px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-12">
                    <h2 class="text-center">กรุณาให้คะแนนความพึงพอใจ</h2>
                    <h3 class="text-center">Please Rate Satisfaction</h3>
                    <div class="row text-center my-5">
                        <div class="col">
                            <form action="answer.php" method="POST" id="id1">
                                <input type="hidden" name="vote" value="แย่มาก">
                                <input type="hidden" name="assessor_id" value="<?= $assessor_id ?>">
                                <button type="button" class="btn btn-danger rounded-circle" onclick="submitResult(event,'id1','แย่มาก')">
                                    <i class="far fa-tired fa-10x"></i>
                                </button>
                            </form>
                            <h4 class="mt-3 text-danger fw-bold">แย่มาก</h4>
                            <h5>Very Poor</h5>
                        </div>
                        <div class="col">
                            <form action="answer.php" method="POST" id="id2">
                                <input type="hidden" name="vote" value="แย่">
                                <input type="hidden" name="assessor_id" value="<?= $assessor_id ?>">
                                <button type="button" class="btn btn-warning rounded-circle text-white" onclick="submitResult(event,'id2','แย่')" style="background-color: orange;">
                                    <i class="far fa-angry fa-10x"></i>
                                </button>
                            </form>
                            <h4 class="mt-3 fw-bold" style="color:orange">แย่</h4>
                            <h5>Poor</h5>
                        </div>
                        <div class="col">
                            <form action="answer.php" method="POST" id="id3">
                                <input type="hidden" name="vote" value="พอใช้">
                                <input type="hidden" name="assessor_id" value="<?= $assessor_id ?>">
                                <button type="button" class="btn rounded-circle text-white" onclick="submitResult(event,'id3','พอใช้')" style="background-color: yellow; opacity: 0.7;">
                                    <i class="far fa-meh fa-10x"></i>
                                </button>
                            </form>
                            <h4 class="mt-3 fw-bold" style="color:yellow;opacity: 0.6;">พอใช้</h4>
                            <h5>Average</h5>
                        </div>
                        <div class="col">
                            <form action="answer.php" method="POST" id="id4">
                                <input type="hidden" name="vote" value="ดี">
                                <input type="hidden" name="assessor_id" value="<?= $assessor_id ?>">
                                <button type="button" class="btn rounded-circle text-white" onclick="submitResult(event,'id4','ดี')" style="background-color:yellowgreen;">
                                    <i class="far fa-smile fa-10x"></i>
                                </button>
                            </form>
                            <h4 class="mt-3 fw-bold" style="color:yellowgreen">ดี</h4>
                            <h5>Good</h5>
                        </div>
                        <div class="col">
                            <form action="answer.php" method="POST" id="id5">
                                <input type="hidden" name="vote" value="ดีมาก">
                                <input type="hidden" name="assessor_id" value="<?= $assessor_id ?>">
                                <button type="submit" class="btn btn-success rounded-circle" onclick="submitResult(event,'id5','ดีมาก')">
                                    <i class="far fa-smile-beam fa-10x"></i>
                                </button>
                            </form>
                            <h4 class="mt-3 fw-bold text-success">ดีมาก</h4>
                            <h5>Excellent</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-white">
        <div class="container text-end">
            <span class="text-muted">
                <h4></h4>
            </span>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function submitResult(e, ids, vt) {
            e.preventDefault();
            Swal.fire({
                title: 'ยืนยันให้คะแนน ' + '"' + vt + '"',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'ทำรายการสำเร็จ',
                        icon: 'success',
                        showConfirmButton: false,
                    })
                    document.getElementById(ids).submit();
                }
            })
        }
    </script>
</body>

</html>
<?php require 'manage_app/lib/connect.php'; ?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title> ระบบประเมินความพึงพอใจ </title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="manage_app/img/ico/emoji.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@500&display=swap" rel="stylesheet">
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

    <!-- Begin page content -->
    <main class="flex-shrink-0" style="margin-top: 4rem;">
        <div class="container py-5 px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-12">
                    <h2 class="text-center">เลือกให้คะแนนความพึงพอใจเจ้าหน้าที่ภาค</h2>
                    <h3 class="text-center">Select An Officers</h3>
                    <div class="row text-center my-5">
                        <?php $sql_assessor = " SELECT * FROM assessor ORDER BY id ASC ";
                        $result_assessor = mysqli_query($conn, $sql_assessor);
                        while ($rs_assessor = mysqli_fetch_assoc($result_assessor)) {
                        ?>
                            <div class="col">
                                <form action="survey.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $rs_assessor['id'] ?>">
                                    <?php if ($rs_assessor['assessor_images'] != "") { ?>
                                        <button type="submit" class="btn btn-light rounded-circle">
                                            <img class="rounded-circle" src="images/images_assessor/<?= $rs_assessor['assessor_images'] ?>" alt="">
                                        </button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn btn-light rounded-circle">
                                            <i class="far fa-user-circle fa-10x"></i>
                                        </button>
                                    <?php } ?>
                                </form>
                                <h6 class="mt-3 text-warning fw-bold"><?= $rs_assessor['assessor_fullname_th'] ?></h6>
                                <h6><?= $rs_assessor['assessor_fullname_en'] ?></h6>
                            </div>
                        <?php } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>
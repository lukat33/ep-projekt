<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 30-Dec-17
 * Time: 13:13
 */
    $title = 'Dodaj artikel';
    $currentPage = 'article_add';
    $page_type = 'private';
    include_once('head.php');
    include_once('../api/article_add_api.php');
?>
<html>
<body>
    <?php include('navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3" id="register-title"><h2>Dodaj artikel</h2></div>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mar-top-2rem">
                <div class="col-sm-3"></div>
                <div class="col-sm-4">
                    <label class="col-form-label">Ime izdelka</label>
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name;?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-row">
                        <label class="col-form-label">Cena</label>
                        <div class="input-group">
                            <span class="input-group-addon">€</span>
                            <input type="number" step="0.01" min="0" max="1000" name="price" id="price" class="form-control" value="<?php echo $price;?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <label class="col-form-label">Opis</label>
                    <div class="form-group">
                        <textarea class="form-control" name="description" id="description" rows="3"><?php echo $description;?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-md-4">
                    <label>Dodaj sliko</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">Išči… <input type="file" name="fileToUpload[]" id="imgInp" multiple></span>
                        </span>
                        <input type="text" name="tmp_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-sm-2 mar-top-2rem">
                    <button type="submit" name="article_add" class="btn btn-default" style="float: right;" >Dodaj artikel</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                    <div class="col-sm-1"> <img class="img-up" id='img-upload1'/> </div>
                    <div class="col-sm-1"> <img class="img-up" id='img-upload2'/> </div>
                    <div class="col-sm-1"> <img class="img-up" id='img-upload3'/> </div>
                    <div class="col-sm-1"> <img class="img-up" id='img-upload4'/> </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-md-6">
                    <?php
                        include('errors.php');
                        echo $article_add_succes;
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: STALKER
 * Date: 23.01.2018
 * Time: 15:08
 */

use yii\helpers\Html;

$this->title = 'Detail';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url'=> 'index.php?r=site/books&point_id=' . $book->points_id];
$this->params['breadcrumbs'][] = $this->title;

?>

<h1>Detail book</h1>

<div class="container">

    <?php $name_image = "@web/"; ?>
    <?php $name_image .= $book->image_dir . "/" . $book->image_name; ?>

    <div class="row">
        <div class="col-sm-5">
            <?php echo Html::img($name_image, ['width' => '400']) ?>
        </div>

        <div class="col-sm-5">

            <h3><?= $book->name; ?></h3>
            <h3><?= $book->author; ?></h3>
            <h3><?= $book->getDateText(); ?></h3>

        </div>

        <div class="col-sm-2 text-right">

            <div id="id_icon_free">
                <?php echo Html::img("@web/icons/icon_free.png", ['width' => '100']) ?>
            </div>

            <div id="id_icon_busy">
                <?php echo Html::img("@web/icons/icon_busy.png", ['width' => '100']) ?>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <?php if (!Yii::$app->user->isGuest) { ?>

                <div id="id_button_busy">
                    <?php echo Html::button('I took this book', [ 'class' => 'btn btn-lg btn-default', 'onclick' => 'set_book_busy(' . $book->id . ', ' . $book_count . ')' ]); ?>
                </div>

                <div id="id_button_free">
                    <?php echo Html::button('I return the book', [ 'class' => 'btn btn-lg btn-default', 'onclick' => 'set_book_free(' . $book->id . ')' ]); ?>
                </div>

            <?php } else { ?>

                <div>
                    <?php echo Html::a('You need to log in', ['site/login', 'book_id' => $book->id], ['class' => 'btn btn-lg btn-primary']) ?>
                </div>

            <?php } ?>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3><?= $book->description; ?></h3>
        </div>
    </div>

</div>

<script>

    set_book_busy = function(book_id, book_count) {

        //alert("Busy");

        if(book_count > 0) {

            alert("WARNING! You have a book on hand!");

        }

        $.ajax({
            url: "?r=site/set-status&status=busy&book_id=" + book_id,
            type: "GET",
            dataType: "html",
            data: "",
            success: function(res){

                if(res == "SUCCESSFUL_SET_BUSY") {

                    set_status_book("busy");

                }

                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    };

    set_book_free = function(book_id) {

        //alert("Free");

        $.ajax({
            url: "?r=site/set-status&status=free&book_id=" + book_id,
            type: "GET",
            dataType: "html",
            data: "",
            success: function(res){

                if(res == "SUCCESSFUL_SET_FREE") {

                    set_status_book("free");

                }

                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });

    };

    set_status_book = function(status) {

        //alert(status);

        if(status == "free") {

            if(document.getElementById("id_icon_free"))
                document.getElementById("id_icon_free").style.display = "";
            if(document.getElementById("id_icon_busy"))
                document.getElementById("id_icon_busy").style.display = "none";

            if(document.getElementById("id_button_free"))
                document.getElementById("id_button_free").style.display = "none";
            if(document.getElementById("id_button_busy"))
                document.getElementById("id_button_busy").style.display = "";

            console.log("set free");

        } else {

            if(document.getElementById("id_icon_free"))
                document.getElementById("id_icon_free").style.display = "none";
            if(document.getElementById("id_icon_busy"))
                document.getElementById("id_icon_busy").style.display = "";

            if(document.getElementById("id_button_free"))
                document.getElementById("id_button_free").style.display = "";
            if(document.getElementById("id_button_busy"))
                document.getElementById("id_button_busy").style.display = "none";

            console.log("set busy");
        }

    };

    set_status_book("<?= $book->status ?>");

</script>
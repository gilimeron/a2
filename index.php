<?php require('formLogic.php'); ?>

<!DOCTYPE html>

<html>

    <head>
        <title>Bill Splitter</title>
        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
        <link href='styles.css' rel='stylesheet'>
        <meta charset='utf-8'>
    </head>

    <body>
        <div class="container" id='border'>

            <h1>Bill Splitter</h1>

            <form action='index.php' class="form-horizontal">

                <div class="form-group">
                    <label for='pplCount' class="control-label col-sm-2">Split how many ways?</label>
                    <div class="col-sm-10">
                        <input type='number' name='pplCount' class='form-control' value='<?php if(isset($_GET['pplCount'])) echo $_GET['pplCount'] ?>'>
                    </div>
                </div>

                <div class="form-group">
                    <label for='billSum' class="control-label col-sm-2">How much was the tab?</label>
                    <div class="col-sm-10">
                        <input type='text' name='billSum' class='form-control' value='<?php if(isset($_GET['billSum'])) echo $_GET['billSum'] ?>'>
                    </div>
                </div>

                <div class="form-group">
                    <label for='serviceScore' class="control-label col-sm-2">How was the service?</label>
                    <div class='col-sm-10'>
                	      <select name='serviceScore' id='serviceScore' class='form-control'>
                            <option value='choose'> Please choose </option>
                            <option value='bad' <?php if(isset($_GET['serviceScore']) && $_GET['serviceScore'] == 'bad') echo 'selected'?>>Bad</option>
                            <option value='average' <?php if(isset($_GET['serviceScore']) && $_GET['serviceScore'] == 'average') echo 'selected'?>>Average</option>
                            <option value='good' <?php if(isset($_GET['serviceScore']) && $_GET['serviceScore'] == 'good') echo 'selected'?>>Good</option>
                            <option value='excellent' <?php if(isset($_GET['serviceScore']) && $_GET['serviceScore'] == 'excellent') echo 'selected'?>>Excellent</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <!-- <div class='checkbox'> -->
                      <label for='roundUp' class="control-label col-sm-2">Round up? </label>
                        <!-- <div class="col-sm-10"> -->
                      <input type='checkbox' name='roundUp' value='Yes' <?php if(isset($_GET['roundUp'])) echo 'CHECKED'?>>  Yes
                        <!-- </div> -->
                    <!-- </div> -->
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type='submit' value='Calculate' class="btn btn-default">
                    </div>
                </div>
            </form>

                <?php if($errors): ?>
                     <div class='alert alert-danger'>
                         <ul>
                             <?php foreach($errors as $error): ?>
                                 <li><?=$error?></li>
                             <?php endforeach; ?>
                         </ul>
                     </div>
                 <?php else: ?>
                    <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                	      everyone owes $<?=$dividedBill?>
                	  </div>
            		<?php endif; ?>

          <!-- </div> -->

        </div>
    </body>
</html>

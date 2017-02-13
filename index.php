<?php require('billCalculator.php'); ?>

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
  <h1>Bill Splitter</h1>

  <form method='POST' action='index.php'>

      <label for='billSum'>Split how many ways?</label>

      <input type='text' name='pplCount' value='<?php if(isset($_POST['pplCount'])) echo $_POST['pplCount'] ?>' required>
* Required
      <br>
      <label for='pplCount'>How much was the tab?</label>
      <input type='text' name='billSum' value='<?php if(isset($_POST['billSum'])) echo $_POST['billSum'] ?>' required>
      * Required
      <br>

        <label for='serviceScore'>How was the service?</label>
		    <select name='serviceScore' id='serviceScore'>
            <option value='choose'> Please choose </option>
            <option value='bad' <?php if(isset($_POST['serviceScore']) && $_POST['serviceScore'] == 'bad') echo 'selected'?>>Bad</option>
            <option value='average' <?php if(isset($_POST['serviceScore']) && $_POST['serviceScore'] == 'average') echo 'selected'?>>Average</option>
            <option value='good' <?php if(isset($_POST['serviceScore']) && $_POST['serviceScore'] == 'good') echo 'selected'?>>Good</option>
            <option value='excellent' <?php if(isset($_POST['serviceScore']) && $_POST['serviceScore'] == 'excellent') echo 'selected'?>>Excellent</option>
        </select>

        <fieldset class='checkboxes'>

          <label>Round up? <input type='checkbox' name='roundUp' value='roundUp' <?php if(isset($_POST['roundUp'])) echo 'CHECKED'?>> </label> Yes
        </fieldset>

    <input type='submit' value='Calculate'>

    <?php if($_POST): ?>
    			<div class="alert" role="alert">
    				Everyone has to pay $<?=$dividedBill?>
    			</div>
		<?php endif; ?>

  </form>
 </body>
</html>

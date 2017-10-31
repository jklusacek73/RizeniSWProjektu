<?php if(isset($_SESSION['zprava'])) : ?>
<div class=col-sm-12>
  <div class="alert alert-<?php echo $_SESSION['typ'] ?> alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $_SESSION['zprava'];
      unset($_SESSION['zprava']);
      unset($_SESSION['typ']);
    ?>
  </div>
</div>
<?php endif; ?>


<div id="tl_buttons">
<a href="<?php echo $this->hrefBack; ?>" class="header_back" title="<?php echo $this->goBack; ?>" accesskey="b" onclick="Backend.getScrollOffset();"><?php echo $this->goBack; ?></a>
</div>

<h2 class="sub_headline"><?php echo $this->headline; ?></h2>

<?php if ($this->hasError) : ?>
<div class="tl_xpl">
	<div class="tl_error" style="margin-bottom: 26px;">
		<?php echo $this->errorMessage; ?>
	</div>
	</div>
<?php else : ?>

<form action="<?php echo $this->request; ?>" id="tl_user_createUserForMember" class="tl_form" method="post" enctype="multipart/form-data">
<input type="hidden" name="FORM_SUBMIT" value="tl_user_createUserForMember" />

<div class="tl_formbody_edit">

<div class="tl_tbox">
  <h3><?php echo $this->member->generateLabel(); ?></h3>
  <?php echo $this->member->generateWithError(); if ($this->member->help): ?> 
	<p class="tl_help tl_tip"><?php echo $this->member->help; ?></p><?php endif; ?> 
</div>

</div>

<div class="tl_formbody_submit">

<div class="tl_submit_container">
<input type="submit" name="saveAndBack" id="saveAndBack" class="tl_submit" alt="<?php echo $this->submitAndBack; ?>" accesskey="s" value="<?php echo $this->submitAndBack; ?>" />
<input type="submit" name="saveAndEdit" id="saveAndEdit" class="tl_submit" alt="<?php echo $this->submitAndEdit; ?>" accesskey="e" value="<?php echo $this->submitAndEdit; ?>" />
<input type="submit" name="saveAndNew"  id="saveAndNew"  class="tl_submit" alt="<?php echo $this->submitAndNew; ?>"  accesskey="n" value="<?php echo $this->submitAndNew; ?>" /> 
</div>

</div>
</form>
<?php endif; ?>

<div class='registrationForm'>
<?php $form = $this->beginWidget('CActiveForm') ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
<?php echo $form->label($model,'login'); ?>
<?php echo $form->textField($model,'login'); ?>
</div>

<div class="row">
<?php echo $form->label($model,'name'); ?>
<?php echo $form->textField($model,'name'); ?>
</div>

<div class="row">
<?php echo $form->label($model,'email'); ?>
<?php echo $form->textField($model,'email'); ?>
</div>

<div class="row">
<?php echo $form->label($model,'password'); ?>
<?php echo $form->passwordField($model,'password'); ?>
</div>
<div class="registrationRow">
<?php echo $form->label($model, 'confirmation'); ?>
<?php echo $form->passwordField($model, 'confirmation'); ?>
</div>

<div class="row submit">
<?php echo CHtml::submitButton('Регистрация'); ?>
</div>

<?php $this->endWidget(); ?>

</div>
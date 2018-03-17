<?php
/**
 * Displays the login page.
 *
 * @var $this View
 * @var $form ActiveForm
 * @var $model LoginForm;
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\forms\LoginForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="col-md-4 col-md-offset-4">
	<div class="login-panel logo-panel">
		<?php
			if ($hasLogo && $logo != '') {
				echo Html::img($logo, ['alt' => 'logo']);
			}
		?>		
	</div>
	<!-- ./login-panel logo-panel -->
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?= Yii::t('login', Yii::$app->name) ?></h3>
		</div>
		<!-- ./panel-heading -->
		
		<div class="panel-body">

			<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
			
			<fieldset>
				
				<div class="form-group">
					<?php 
						echo $form->field($model, 'username')->textInput([
							'autofocus' => true,
							'placeholder' => true,
							'class' => 'form-control'
						])->label(false); 
					?>
				</div>
				<!-- ./form-group -->

				<div class="form-group">
					<?php 
						echo $form->field($model, 'password')->passwordInput([
							'placeholder' => true,
							'class' => 'form-control'
						])->label(false); 
					?>
				</div>
				<!-- ./form-group -->

				<div class="checkbox">
					<?php 
						echo $form->field($model, 'rememberMe')->checkbox(); 
					?>
				</div>
				<!-- ./checkbox -->

				<?php 
					echo Html::submitButton(Yii::t('login', 'Login'), [
						'class' => 'btn btn-lg btn-success btn-block',
						'name' => 'login-button'
					]);
				?>

			</fieldset>
			
			<?php ActiveForm::end(); ?>
			<!-- #login-form -->
			
		</div>
		<!-- ./panel-body -->
	</div>
	<!-- ./panel panel-default -->
</div>
<!-- ./col-md-4 col-md-offset-4 -->

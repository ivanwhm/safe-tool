<?php
/**
 * Displays the create page to StoryAcceptanceCriteria CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model StoryAcceptanceCriteria
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\StoryAcceptanceCriteria;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-acceptance-criteria', 'Add acceptance criteria');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'View story'),
		"icon" => Icon::show('book'),
		"url" => $model->getStory()->getLink()
	],
	[
		"label" => Yii::t('story-acceptance-criteria', 'Acceptance criterias'),
		"icon" => Icon::show('check-circle'),
		"url" => Url::to(['story/view', 'id' => $model->getAttribute('story_id')])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => false
	]
];

?>
<div class="story-acceptance-criteria-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>

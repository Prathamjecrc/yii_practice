<?php
/** @var yii\web\View $this */
/** @var app\models\Name $nameModel */
/** @var app\models\Country $countryModel */
/** @var app\models\State $stateModel */
/** @var app\models\City $cityModel */
/** @var object $latestData */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'User Form';
$this->registerCss("
    .has-error .help-block {
        color: red; /* Only change error message color to red */
    }
");
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <!-- Name field -->
    <?= $form->field($nameModel, 'name')->textInput(['maxlength' => true]) ?>

    <!-- Country dropdown -->
    <?= $form->field($countryModel, 'country')->dropDownList([
        'India' => 'India',
        'USA' => 'USA'
    ], [
        'id' => 'country-dropdown', 
        'prompt' => 'Select a country'
    ]) ?>

    <!-- State dropdown -->
    <?= $form->field($stateModel, 'state')->dropDownList([], [
        'id' => 'state-dropdown', 
        'prompt' => 'Select a state'
    ]) ?>

    <!-- City dropdown -->
    <?= $form->field($cityModel, 'city')->dropDownList([], [
        'id' => 'city-dropdown', 
        'prompt' => 'Select a city'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <?php $flashData = Yii::$app->session->getFlash('success'); ?>
    <!-- Render only the dynamic title -->
    <h2 id="dynamic-title">
        Hi <?= Html::encode($flashData['name']) ?>, you are from <?= Html::encode($flashData['country']) ?>, your state is <?= Html::encode($flashData['state']) ?>, and you live in <?= Html::encode($flashData['city']) ?>. That's great!
    </h2>
<?php endif; ?>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const countryDropdown = document.getElementById('country-dropdown');
    const stateDropdown = document.getElementById('state-dropdown');
    const cityDropdown = document.getElementById('city-dropdown');

    // Country to state and city mapping
    const countryToStateMap = {
        'India': ['Gujarat', 'Rajasthan'],
        'USA': ['Florida', 'North Carolina']
    };

    const stateToCityMap = {
        'Gujarat': ['Ahmedabad', 'Rajkot'],
        'Rajasthan': ['Chittorgarh', 'Udaipur'],
        'Florida': ['Palm Beach', 'Panama City'],
        'North Carolina': ['Charlotte', 'Greenville']
    };

    // Handle country change to update state options
    countryDropdown.addEventListener('change', function () {
        const selectedCountry = countryDropdown.value;
        stateDropdown.innerHTML = '<option value="">Select a state</option>'; // Reset state dropdown
        cityDropdown.innerHTML = '<option value="">Select a city</option>'; // Reset city dropdown

        if (selectedCountry && countryToStateMap[selectedCountry]) {
            countryToStateMap[selectedCountry].forEach(function (state) {
                const option = document.createElement('option');
                option.value = state;
                option.text = state;
                stateDropdown.appendChild(option);
            });
        }
    });

    // Handle state change to update city options
    stateDropdown.addEventListener('change', function () {
        const selectedState = stateDropdown.value;
        cityDropdown.innerHTML = '<option value="">Select a city</option>'; // Reset city dropdown

        if (selectedState && stateToCityMap[selectedState]) {
            stateToCityMap[selectedState].forEach(function (city) {
                const option = document.createElement('option');
                option.value = city;
                option.text = city;
                cityDropdown.appendChild(option);
            });
        }
    });
});
</script>

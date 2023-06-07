<?php

namespace app\models;

use Yii;
use DateTime;
use yii\grid\GridView;

class CustomGridView extends GridView
{
    public function renderTableBody()
    {
        $models = array_values($this->dataProvider->getModels()); // Ensure the models are indexed numerically
        $keys = array_values($this->dataProvider->getKeys()); // Ensure the keys are indexed numerically
        $rows = [];
        foreach ($models as $index => $model) {
            $key = $keys[$index];
            $row = $this->renderTableRow($model, $key, $index);
            $group = $this->getGroupRow($model, $key, $index);
            if ($group !== null) {
                $rows[] = $group;
            }
            $rows[] = $row;
        }
        return "<tbody>\n" . implode("\n", $rows) . "\n</tbody>";
    }

    public function getGroupRow($model, $key, $index)
    {
        $groupValue = date_create_from_format('Y-m-d', $model->date)->format('F Y'); // Formatage du mois et de l'année (ex: "May 2023")
        $groupValue = ucfirst($groupValue); // Mettre la première lettre en majuscule
    
        $intlFormatter = new \IntlDateFormatter(
            \Yii::$app->language = "fr-FR",
            \IntlDateFormatter::LONG,
            \IntlDateFormatter::NONE
        );
        $intlFormatter->setPattern('MMMM Y');
        $groupValue = $intlFormatter->format(date_create_from_format('F Y', $groupValue));
    
        $prevModel = $index > 0 ? $this->dataProvider->getModels()[$index - 1] : null;
        $prevGroupValue = $prevModel !== null ? date_create_from_format('Y-m-d', $prevModel->date)->format('F Y') : null;
    
        if ($groupValue !== $prevGroupValue) {
            return '<tr class="group-row"><td colspan="' . count($this->columns) . '">' . $groupValue . '</td></tr>';
        }
    
        return null;
    }



}

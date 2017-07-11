<?php
namespace app\components;

use yii\rbac\Rule;

class ResearcherRule extends Rule
{
    public $name = 'isResearcher';

    public function execute($user_id, $item, $params)
    {
        return isset($params['model']) ? $params['model']->created_by == $user_id : false;
    }
}
?>
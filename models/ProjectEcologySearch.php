<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectEcology;

/**
 * ProjectEcologySearch represents the model behind the search form about `app\models\ProjectEcology`.
 */
class ProjectEcologySearch extends ProjectEcology
{
    public $searchAll;
    public $type;
    public $fullname_th;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faculty_id', 'type_id'], 'integer'],
            [['year', 'name', 'personal_code', 'summary', 'created_by', 'created_date', 'updated_by', 'updated_date', 'type', 'searchAll', 'fullname_th'], 'safe'],
            [['budget'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProjectEcology::find()->joinWith('projectType')->joinWith('researcher');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['type'] = [
            'asc' => ['project_type.type' => SORT_ASC],
            'desc' => ['project_type.type'=> SORT_DESC], 
        ]; 

        $dataProvider->sort->attributes['fullname_th'] = [
            'asc' => ['researcher.fullname_th' => SORT_ASC],
            'desc' => ['researcher.fullname_th'=> SORT_DESC], 
        ];
        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'faculty_id' => $this->faculty_id,
            'budget' => $this->budget,
            'type_id' => $this->type_id,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);*/

        $query->orFilterWhere(['like', 'name', $this->searchAll])
            ->orFilterWhere(['like', 'researcher.fullname_th', $this->searchAll])
            ->orFilterWhere(['like', 'summary', $this->searchAll])
            ->orFilterWhere(['like', 'year', $this->searchAll])
            ->orFilterWhere(['like', 'project_type.type', $this->searchAll]);

        return $dataProvider;
    }
}

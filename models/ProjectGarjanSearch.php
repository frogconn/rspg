<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectGarjan;

/**
 * ProjectGarjanSearch represents the model behind the search form about `app\models\ProjectGarjan`.
 */
class ProjectGarjanSearch extends ProjectGarjan
{
    public $type;
    public $fullname_th;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year', 'faculty_id', 'type_id'], 'integer'],
            [['name', 'personal_code', 'summary', 'start', 'stop', 'created_by', 'created_date', 'update_by', 'update_date', 'type', 'fullname_th'], 'safe'],
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
        $query = ProjectGarjan::find()->joinWith('researcher');

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
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'faculty_id' => $this->faculty_id,
            'budget' => $this->budget,
            'type_id' => $this->type_id,
            'start' => $this->start,
            'stop' => $this->stop,
            //'created_date' => $this->created_date,
            //'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'project_type.type', $this->type])
            ->andFilterWhere(['like', 'researcher.fullname_th', $this->fullname_th]);

        return $dataProvider;
    }
}

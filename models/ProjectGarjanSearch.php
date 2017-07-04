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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faculty_id', 'project_type_id'], 'integer'],
            [['year', 'name', 'personal_code', 'summary', 'created_by', 'created_date', 'update_by', 'update_date'], 'safe'],
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
        $query = ProjectGarjan::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'faculty_id' => $this->faculty_id,
            'budget' => $this->budget,
            'project_type_id' => $this->project_type_id,
            'created_date' => $this->created_date,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'personal_code', $this->personal_code])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Researcher;

/**
 * ResearcherSearch represents the model behind the search form about `app\models\Researcher`.
 */
class ResearcherSearch extends Researcher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'foreigner', 'institution_id', 'faculty_id', 'gender', 'created_by', 'update_by'], 'integer'],
            [['pers_id', 'title', 'fristname_th', 'lastname_th', 'fristname_en', 'lastname_en', 'fullname_th', 'fullname_en', 'email', 'telephone', 'update_date', 'created_date'], 'safe'],
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
        $query = Researcher::find();

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
            'foreigner' => $this->foreigner,
            'institution_id' => $this->institution_id,
            'faculty_id' => $this->faculty_id,
            'gender' => $this->gender,
            'update_date' => $this->update_date,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'pers_id', $this->pers_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'fristname_th', $this->fristname_th])
            ->andFilterWhere(['like', 'lastname_th', $this->lastname_th])
            ->andFilterWhere(['like', 'fristname_en', $this->fristname_en])
            ->andFilterWhere(['like', 'lastname_en', $this->lastname_en])
            ->andFilterWhere(['like', 'fullname_th', $this->fullname_th])
            ->andFilterWhere(['like', 'fullname_en', $this->fullname_en])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telephone', $this->telephone]);

        return $dataProvider;
    }
}
